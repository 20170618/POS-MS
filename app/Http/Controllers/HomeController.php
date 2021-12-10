<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Credit;
use App\Models\Product;
use App\Models\Sales;
use App\Models\SalesDetails;
use App\Models\Category;
use App\Models\ELoad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App;
use Redirect,Response;
use Illuminate\Support\Facades\Log;
use PDF;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('salesperson.home');
    }

    public function firstrun()
    {
        $users = Users::all();

        if(isEmpty($users))
        {
            echo 'it works';
            return view('auth.firstSetup');
         }else{
            echo 'it did not work';
            return view('auth.login');
         }
    }

    public function categoriesView()
    {
        $categories = Category::all();
        return view('admin.category',compact('categories'));
    }

    // public function salespersonProducts()
    // {
    //     $foodProducts = DB::table('product')
    //         ->select('ProductName', 'Price')
    //         ->where('Category', '=' , 'food')
    //         ->latest()
    //         ->get();
    //     $nonFoodProducts = DB::table('product')
    //         ->select('ProductName', 'Price')
    //         ->where('Category', '=' , 'nonFood')
    //         ->latest()
    //         ->get();
    //     $eLoads = DB::table('product')
    //         ->select('ProductName', 'Price')
    //         ->where('Category', '=' , 'eLoad')
    //         ->latest()
    //         ->get();
    //     return view('salesperson.salespersonproducts', compact('foodProducts', 'nonFoodProducts', 'eLoads'));
    // }

    public function salespersonAddTransactions()
    {
        // $products = DB::table('product')
        //     ->select('ProductName', 'Price')
        //     ->get();
        return view('salesperson.salespersonaddtransaction');
    }

    public function fetchLoadWallet()
    {
        $smart = DB::table('product')->select('Stock')->where('ProductName','LIKE','%SMART%')->first();
        $globe = DB::table('product')->select('Stock')->where('ProductName','LIKE','%GLOBE%')->first();

        return response()->json([
            'smart'=> $smart,
            'globe'=>$globe,
        ]);
    }

    public function refillLoadWallet(Request $request, $operator)
    {
        if($operator=='SMART'){
            $old =  DB::table('product')->select('Stock')->where('ProductName','LIKE','%SMART%')->first();
            $newval = floatval($request->input('loadval'));
            $new = $old->Stock + $newval;
            Product::where('ProductName', 'LIKE', '%SMART%')->update(['Stock' => $new]);
            Product::where('ProductName', 'LIKE', '%TNT%')->update(['Stock' => $new]);

            return response()->json([
                'status' => 'Success',
                'message' => 'Load has been successfully restocked.'
            ]);
        }else if($operator=='GLOBE'){
            $old =  DB::table('product')->select('Stock')->where('ProductName','LIKE','%GLOBE%')->first();
            $newval = floatval($request->input('loadval'));
            $new = $old->Stock + $newval;
            Product::where('ProductName', 'LIKE', '%GLOBE%')->update(['Stock' => $new]);
            Product::where('ProductName', 'LIKE', '%TM%')->update(['Stock' => $new]);

            return response()->json([
                'status' => 'Success',
                'message' => 'Load has been successfully restocked.'
            ]);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('admin.home');
    }

    public function adminProfile()
    {
        return view('admin.profile');
    }

    public function adminOldPassword($id, Request $request){
        
        $validator = Validator::make($request->all(), [
            'password'=> 'required|string|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>2002021,
            ]);
        }else{
            $user = DB::table('users')->select('users.*')->where('UserID','=',$id)->first();
            $pass = $user->password;
            $toHash = $request->input('password');
            $old = $request->input('oldPassword');
            
            if(password_verify($old, $pass)){
                $userAcc = User::find($id);
                $userAcc->password = Hash::make($toHash);
                $userAcc->update();
                return response()->json([
                    'status'=>200,
                ]);
            }else{
                return response()->json([
                'status'=>212121,
                ]);
            }
        }
        
        
    }

    public function adminProducts()
    {
        $products = DB::table('product')

            ->select()
            ->get();

        return view('admin.products', compact('products'));
    }

    public function salesPersonProducts()
    {
        $products = DB::table('product')

        ->select()
        ->get();

        return view('salesperson.salespersonproducts', compact('products'));
    }

    public function adminTransactions()
    {
        $sales = DB::table('sales')
            ->join('users','sales.PersonInCharge','=','users.UserID')
            ->select('sales.*', 'users.*', 'sales.created_at as created_at')
            ->where('ModeOfPayment','!=','Credit')
            ->orderBy('sales.SalesID', 'desc')
            ->get();
        $salesdetails = DB::table('salesdetails')
            ->join('sales','salesdetails.SalesID','=','sales.SalesID')
            ->join('product','salesdetails.ProductID','=','product.productID')
            ->select()
            ->get();
        return view('admin.transactions', compact('sales','salesdetails'));
    }

    public function adminEload()
    {
        $sales = DB::table('sales')
            ->join('users','sales.PersonInCharge','=','users.UserID')
            ->select('sales.*', 'users.*', 'sales.created_at as created_at')
            ->orderBy('sales.SalesID', 'desc')
            ->get();
        $regular = DB::table('product')
            ->where('ProductName', 'LIKE', '%Regular%')
            ->get();
        $promos = DB::table('product')
            ->where('ProductName', 'NOT LIKE', '%Regular%')
            ->where('Category', '=', 'E-Load Promo')
            ->get();
        $eloads = DB::table('eloads')
            ->join('product','eloads.ProductID','=','product.ProductID')
            ->select('eloads.*','product.ProductName',)
            ->get();
        return view('admin.eload', compact('sales', 'regular','promos','eloads'));
    }

    public function salesPersonEload()
    {
        $sales = DB::table('sales')
            ->join('users','sales.PersonInCharge','=','users.UserID')
            ->select('sales.*', 'users.*', 'sales.created_at as created_at')
            ->orderBy('sales.SalesID', 'desc')
            ->get();
        $regular = DB::table('product')
            ->where('ProductName', 'LIKE', '%Regular%')
            ->get();
        $promos = DB::table('product')
            ->where('ProductName', 'NOT LIKE', '%Regular%')
            ->where('Category', '=', 'E-Load Promo')
            ->get();
        $eloads = DB::table('eloads')
            ->join('product','eloads.ProductID','=','product.ProductID')
            ->select('eloads.*','product.ProductName',)
            ->get();
        return view('salesperson.eload', compact('sales', 'regular','promos','eloads'));
    }

    public function adminAddTransactions()
    {
        $debtors = DB::table('credits')
             ->select()
             ->whereNull('BalancePayDate')
             ->get();
        return view('admin.addtransaction', compact('debtors'));
    }

    public function deleteTransaction($id){
         $sales = DB::table('sales')
             ->join('users','sales.PersonInCharge','=','users.UserID')
             ->select('sales.*', 'users.*')
             ->where('sales.SalesID','=', $id)
             ->get('salesID');

        if($sales){
            return response()->json([
            'status'=>200,
            'sales'=>$sales,
        ]);
        }
    }

    public function updateTransaction(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'AmountToPay' =>'required|max:191',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator,
            ]);
        }
        else
        {
            $sales = Sales::find($id);
            if($sales)
            {
                $sales->AmountToPay = $request->input('AmountToPay');
                $sales->update();

                $products = $request->input('toBeUpdated');
                if($products){
                    foreach ($products as $product_ID) {
                        $salesDetails = DB::table('salesdetails')
                            ->join('product','SalesDetails.ProductID','=','product.ProductID')
                            ->select('SalesDetails.*', 'product.ProductName as ProductName', 'product.Price as ProductPrice')
                            ->where('salesdetails.SalesID','=',$id)
                            ->where('ProductName','=',$product_ID['name'])
                            ->update(array('Quantity' => $product_ID['quantity']));

                            return response()->json([
                                'status'=>200,
                                'message'=>'Updated Successfully',
                            ]);
                    }
                }

                $data = $request->input('toBeRemoved');
                if ($data) {
                    foreach ($data as $data_ID) {
                        $salesDetails = DB::table('salesdetails')
                            ->join('product','SalesDetails.ProductID','=','product.ProductID')
                            ->select('SalesDetails.*', 'product.ProductName as ProductName', 'product.Price as ProductPrice')
                            ->where('salesdetails.SalesID','=',$id)
                            ->where('ProductName','=',$data_ID)
                            ->delete();

                            return response()->json([
                                'status'=>200,
                                'message'=>'Updated Successfully',
                            ]);
                }

                }

            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'Pizza Not Found',
                ]);
            }

        }
    }

    public function destroyTransaction($id)
    {
        SalesDetails::where('SalesID',$id)->delete();
        //$salesDetails->delete();

        $sales = Sales::find($id);
        $sales->delete();

        //return redirect()->route('admin.transactions')->with('deleteTransaction','Transaction has been deleted successfully!');
        return response()->json([
            'status'=>200,
            'message'=>'Transaction Deleted Successfully',
        ]);
    }

    public function filterPromos(){
        $promos = DB::table('product')
            ->where('ProductName', 'NOT LIKE', '%Regular%')
            ->where('Category', '=', 'E-Load Promo')
            ->get();
        return response()->json([
            'status'=>200,
            'message'=>'Filtered Successfully',
            'promos'=>$promos,
        ]);
    }

    public function storeEload(Request $request){

        
        $operator = $request->input('Operator');
        $verpro = $request->input('isPromo');
        $promoDetail = DB::table('product')->select()->where('ProductID','=',($request->input('ProductID')))->first();

        if($verpro == 1){
            $contains = str_contains(strval($promoDetail->ProductName), 'SMART');
            $containsB = str_contains(strval($promoDetail->ProductName), 'TNT');
            $contains2 = str_contains(strval($promoDetail->ProductName), 'GLOBE');
            $contains2B = str_contains(strval($promoDetail->ProductName), 'TM');
            if($contains || $containsB){
                $operator="SMART";
            }else if($contains2 || $contains2B){
                $operator="GLOBE";
            }
        }
        
        if($operator=="SMART"){
            $smart = DB::table('product')->select('Stock')->where('ProductName','LIKE','%SMART%')->first();
            $oldval = floatval($smart->Stock);
            $newval = floatval($request->input('LoadAmount'));
            $new = $oldval - $newval;

            Product::where('ProductName', 'LIKE', '%SMART%')->update(['Stock' => $new]);
            Product::where('ProductName', 'LIKE', '%TNT%')->update(['Stock' => $new]);
            
        }else if($operator=="GLOBE"){
            $globe = DB::table('product')->select('Stock')->where('ProductName','LIKE','%GLOBE%')->first();
            $oldval = floatval($globe->Stock);
            $newval = floatval($request->input('LoadAmount'));
            $new = $oldval - $newval;
            
            Product::where('ProductName', 'LIKE', '%GLOBE%')->update(['Stock' => $new]);
            Product::where('ProductName', 'LIKE', '%TM%')->update(['Stock' => $new]);
        }

        $eLoad = new ELoad;
        $eLoad->ProductID = $request->input('ProductID');
        $eLoad->LoadAmount = $request->input('LoadAmount');
        $eLoad->save();

        return response()->json([
            'status'=>200,
            'message'=>'E-Load transaction successful!',
        ]);
    }

    public function getPromoPrice($id){
        $product = Product::find($id);
        return response()->json([
            'status'=>200,
            'product'=>$product,
        ]);
    }

    public function storeTransaction(Request $request){
        $validator = Validator::make($request->all(), [
            'PersonInChargeID' =>'required',
            'PersonInCharge' =>'required',
            'ModeOfPayment' =>'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->errors()->all(),
            ]);
        }else{
            $sales= new Sales;
            $sales->PersonInChargeID = $request->input('PersonInChargeID');
            $sales->PersonInCharge = $request->input('PersonInCharge');
            $sales->ModeOfPayment = $request->input('ModeOfPayment');
            
            $sales->save();
            $id = $sales->SalesID;

            $data = $request->input('products');

            foreach ($data as $data_ID) {
                $salesDetails = new SalesDetails;
                $salesDetails->SalesID = $id;
                $salesDetails->ProductID = $data_ID['id'];
                $salesDetails->Quantity = $data_ID['quantity'];
                $salesDetails->save();

                $prod = Product::find($data_ID['id']);
                $prod->Stock = $prod->Stock - $data_ID['quantity'];
                $prod->update();
            }

            return response()->json([
                'status'=>200,
                'message'=>'Added Successfully',
            ]);
        }
    }

    public function storeDebt(Request $request){
        $validator = Validator::make($request->all(), [
            'PersonInChargeID' =>'required',
            'PersonInCharge' =>'required',
            'ModeOfPayment' =>'required',
            'AmountPaid' =>'required',
            'DebtorName' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->errors()->all(),
            ]);
        }else{
            if(DB::table('credits')->where('Debtor',$request->input('DebtorName'))->exists()){
                return response()->json([
                    'status'=>20012,
                    'message'=>'Debtor has outstanding balance! Transaction failed!',
                ]);
            }else{
                $sales= new Sales;
                $sales->PersonInChargeID = $request->input('PersonInChargeID');
                $sales->PersonInCharge = $request->input('PersonInCharge');
                $sales->ModeOfPayment = 'Credit';
                $sales->save();
                $id = $sales->SalesID;

                $debtor=new Credit;
                $debtor->SalesID =$id;
                $debtor->Debtor = $request->input('DebtorName');
                $debtor->Balance = $request->input('Balance');
                $debtor->InitialPayment= $request->input('AmountPaid');
                $debtor->save(); // store new debtor into db

                $data = $request->input('products');

                foreach ($data as $data_ID) {
                    $salesDetails = new SalesDetails;
                    $salesDetails->SalesID = $id;
                    $salesDetails->ProductID = $data_ID['id'];
                    $salesDetails->Quantity = $data_ID['quantity'];
                    $salesDetails->save();

                    $prod = Product::find($data_ID['id']);
                    $prod->Stock = $prod->Stock - $data_ID['quantity'];
                    $prod->update();
                }

                return response()->json([
                    'status'=>200,
                    'message'=>'Debt Record Added Successfully',
                ]);
            }


        }
    }

    public function editTransaction($id){
        $details = DB::table('SalesDetails')
            ->join('product','SalesDetails.ProductID','=','product.ProductID')
            ->select('SalesDetails.*', 'product.ProductName as ProductName', 'product.Price as ProductPrice', DB::raw('product.Price*SalesDetails.Quantity as AmountDue'))
            ->where('SalesID', '=', $id)
            ->get();
        $sales = DB::table('sales')
            ->select()
            ->where('SalesID','=',$id)
            ->get();

        return view('admin.editTransaction', compact('details','sales'));
    }

    public function viewSamePricedProducts($price){
        $sameProds = DB::table('product')->select('product.*')->where('Price','=', $price)->get();

        return response()->json([
            'status'=>200,
            'products'=>$sameProds,
            'message'=>"working",
        ]);
    }

    public function search(){
        $search_text = $_GET['query'];
        $products = Product::where('ProductName', 'LIKE', '%'.$search_text.'%')->get();

        return view('admin.addtransaction', compact('products'));
    }

    public function searchUnderCategory(Request $request){

        $query = $request->input('query');
        $cID = $request->input('cID');

        try{
            $products = DB::table('product')
            ->whereRaw("((Category = '$cID') AND (ProductName LIKE '%$query%' OR Price LIKE '%$query%' OR Stock LIKE '%$query%'))")
            ->get();

            return response()->json([
                'status' => 200,
                'products' => $products
            ]);

        }catch(\Illuminate\Database\QueryException $ex){
            return response()->json([
                'status' => 123,
                'message' => $ex
            ]);
        }

    }

    public function reportPreview(Request $request){
        $request->validate([
            'Category' => 'required|min:1',
            'modeOfPayment' => 'required|min:1'
        ]);

        $now = Carbon::now();
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $newStartDate = date('Y-m-d', strtotime($startDate)).' 00:00:00';
        $newEndDate = date('Y-m-d', strtotime($endDate)).' 23:59:59';

        $consumableSales = DB::table('salesdetails')
            ->join('product','salesdetails.ProductID','=','product.ProductID')
            ->select(DB::raw('SUM(Quantity) as sold, salesdetails.ProductID, (product.Price * SUM(Quantity)) as cost, product.Category, product.ProductName'))
            ->where('product.Category','=','Consumable')
            ->whereBetween('salesdetails.created_at',[$newStartDate, $newEndDate])
            ->groupBy('salesdetails.ProductID', 'product.Price', 'product.Category', 'product.ProductName')
            ->get();
        $nonConsumableSales = DB::table('salesdetails')
            ->join('product','salesdetails.ProductID','=','product.ProductID')
            ->select(DB::raw('SUM(Quantity) as sold, salesdetails.ProductID, (product.Price * SUM(Quantity)) as cost, product.Category, product.ProductName'))
            ->where('product.Category','=','Non-Consumable')
            ->whereBetween('salesdetails.created_at',[$newStartDate, $newEndDate])
            ->groupBy('salesdetails.ProductID', 'product.Price', 'product.Category', 'product.ProductName')
            ->get();
        $eLoadSales = DB::table('eloads')
            ->join('product','eloads.ProductID','=','product.ProductID')
            ->select(DB::raw('eloads.ProductID, SUM(LoadAmount) as sold, product.Category, product.ProductName'))
            ->where('product.Category','LIKE','%E-Load%')
            ->whereBetween('eloads.created_at',[$newStartDate, $newEndDate])
            ->groupBy('eloads.ProductID', 'product.Category', 'product.ProductName')
            ->get();

        $categories = $request->get('Category');

        $outOfStocks = DB::table('product')
            ->select()
            ->where('Stock','<=','5')
            ->get();

        $sales = DB::table('sales')
            ->select()
            ->where('ModeOfPayment','=','Cash')
            ->whereBetween('created_at',[$newStartDate, $newEndDate])
            ->count();
        $debts = DB::table('sales')
            ->select()
            ->where('ModeOfPayment','=','Credit')
            ->whereBetween('created_at',[$newStartDate, $newEndDate])
            ->count();
        
        return route('reportGenerate')
            ->with('startDate',$newStartDate)
            ->with('endDate',$newEndDate)
            ->with('now',$now)
            ->with('outOfStocks', $outOfStocks)
            ->with('sales',$sales)
            ->with('debts',$debts)
            ->with('consumableSales',$consumableSales)
            ->with('nonConsumableSales',$nonConsumableSales)
            ->with('eLoadSales',$eLoadSales)
            ->with('categories',$categories);
    }

    public function adminGenerateReport(Request $request){
        $request->validate([
            'Category' => 'required|min:1',
            'modeOfPayment' => 'required|min:1'
        ]);

        $now = Carbon::now();
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $newStartDate = date('Y-m-d', strtotime($startDate)).' 00:00:00';
        $newEndDate = date('Y-m-d', strtotime($endDate)).' 23:59:59';

        $categories = $request->get('Category');
        $modeOfPayment = $request->get('modeOfPayment');

        if (in_array('Cash', $modeOfPayment) && !in_array('Credit', $modeOfPayment)) {
            $consumableSales = DB::table('salesdetails')
                ->join('sales','salesdetails.salesID','=','sales.salesID')
                ->join('product','salesdetails.ProductID','=','product.ProductID')
                ->select(DB::raw('SUM(Quantity) as sold, salesdetails.ProductID, (product.Price * SUM(Quantity)) as cost, product.Category, product.ProductName'))
                ->where('sales.ModeOfPayment','=','Cash')
                ->where('product.Category','=','Consumable')
                ->whereBetween('salesdetails.created_at',[$newStartDate, $newEndDate])
                ->groupBy('salesdetails.ProductID', 'product.Price', 'product.Category', 'product.ProductName')
                ->get();
            $nonConsumableSales = DB::table('salesdetails')
                ->join('sales','salesdetails.salesID','=','sales.salesID')
                ->join('product','salesdetails.ProductID','=','product.ProductID')
                ->select(DB::raw('SUM(Quantity) as sold, salesdetails.ProductID, (product.Price * SUM(Quantity)) as cost, product.Category, product.ProductName'))
                ->where('sales.ModeOfPayment','=','Cash')
                ->where('product.Category','=','Non-Consumable')
                ->whereBetween('salesdetails.created_at',[$newStartDate, $newEndDate])
                ->groupBy('salesdetails.ProductID', 'product.Price', 'product.Category', 'product.ProductName')
                ->get();
            $eLoadSales = DB::table('eloads')
                ->join('product','eloads.ProductID','=','product.ProductID')
                ->select(DB::raw('eloads.ProductID, SUM(LoadAmount) as sold, product.Category, product.ProductName'))
                ->where('product.Category','LIKE','%E-Load%')
                ->whereBetween('eloads.created_at',[$newStartDate, $newEndDate])
                ->groupBy('eloads.ProductID', 'product.Category', 'product.ProductName')
                ->get();
            $reportType = "Sales Breakdown";
        } else if (in_array('Credit', $modeOfPayment) && !in_array('Cash', $modeOfPayment)) {
            $consumableSales = DB::table('salesdetails')
                ->join('sales','salesdetails.salesID','=','sales.salesID')
                ->join('product','salesdetails.ProductID','=','product.ProductID')
                ->select(DB::raw('SUM(Quantity) as sold, salesdetails.ProductID, (product.Price * SUM(Quantity)) as cost, product.Category, product.ProductName'))
                ->where('sales.ModeOfPayment','=','Credit')
                ->where('product.Category','=','Consumable')
                ->whereBetween('salesdetails.created_at',[$newStartDate, $newEndDate])
                ->groupBy('salesdetails.ProductID', 'product.Price', 'product.Category', 'product.ProductName')
                ->get();
            $nonConsumableSales = DB::table('salesdetails')
                ->join('sales','salesdetails.salesID','=','sales.salesID')
                ->join('product','salesdetails.ProductID','=','product.ProductID')
                ->select(DB::raw('SUM(Quantity) as sold, salesdetails.ProductID, (product.Price * SUM(Quantity)) as cost, product.Category, product.ProductName'))
                ->where('sales.ModeOfPayment','=','Credit')
                ->where('product.Category','=','Non-Consumable')
                ->whereBetween('salesdetails.created_at',[$newStartDate, $newEndDate])
                ->groupBy('salesdetails.ProductID', 'product.Price', 'product.Category', 'product.ProductName')
                ->get();
            $eLoadSales = '[]';
            $reportType = "Debts Breakdown";
        }else{
            $consumableSales = DB::table('salesdetails')
                ->join('product','salesdetails.ProductID','=','product.ProductID')
                ->select(DB::raw('SUM(Quantity) as sold, salesdetails.ProductID, (product.Price * SUM(Quantity)) as cost, product.Category, product.ProductName'))
                ->where('product.Category','=','Consumable')
                ->whereBetween('salesdetails.created_at',[$newStartDate, $newEndDate])
                ->groupBy('salesdetails.ProductID', 'product.Price', 'product.Category', 'product.ProductName')
                ->get();
            $nonConsumableSales = DB::table('salesdetails')
                ->join('product','salesdetails.ProductID','=','product.ProductID')
                ->select(DB::raw('SUM(Quantity) as sold, salesdetails.ProductID, (product.Price * SUM(Quantity)) as cost, product.Category, product.ProductName'))
                ->where('product.Category','=','Non-Consumable')
                ->whereBetween('salesdetails.created_at',[$newStartDate, $newEndDate])
                ->groupBy('salesdetails.ProductID', 'product.Price', 'product.Category', 'product.ProductName')
                ->get();
            $eLoadSales = DB::table('eloads')
                ->join('product','eloads.ProductID','=','product.ProductID')
                ->select(DB::raw('eloads.ProductID, SUM(LoadAmount) as sold, product.Category, product.ProductName'))
                ->where('product.Category','LIKE','%E-Load%')
                ->whereBetween('eloads.created_at',[$newStartDate, $newEndDate])
                ->groupBy('eloads.ProductID', 'product.Category', 'product.ProductName')
                ->get();
            $reportType = "Sales Breakdown";
        }
        

        

        $outOfStocks = DB::table('product')
            ->select()
            ->where('Stock','<=','5')
            ->get();

        $sales = DB::table('sales')
            ->select()
            ->where('ModeOfPayment','=','Cash')
            ->whereBetween('created_at',[$newStartDate, $newEndDate])
            ->count();
        $debts = DB::table('sales')
            ->select()
            ->where('ModeOfPayment','=','Credit')
            ->whereBetween('created_at',[$newStartDate, $newEndDate])
            ->count();
        
        // PDF Format
        $title = "Migui's Store Report";
        $output = '
        <head>
                <style>
                    .page-break {
                        page-break-after: always;
                    }

                    body {
                        font-family: "Trebuchet MS", sans-serif;
                    }
                    th, td {
                        border: 1px solid #ddd;
                        padding: 8px;
                    }

                    th {
                        padding-top: 12px;
                        padding-bottom: 12px;
                        text-align: left;
                        background-color: #343a41;;
                        color: white;
                    }

                    table {
                        border-collapse: collapse;
                        width: 100%;
                    }


             </style>
        </head>
        <body>
        <div class="row">
            <h4 style="text-align: center;margin-top: 30%">'.$title.'</h4>
            <h5 style="text-align: center">Date Created: '.$now.'</h5>
            <h5 style="text-align: center">Start Date: '.$newStartDate.' End Date: '.$newEndDate.'</h5>
        </div>

        <div class="page-break"></div>

        <h5 style="text-align: center">'.$reportType.'</h5>
        ';
        if (in_array('Consumable', $categories) || in_array('allCheck', $categories)) {
            $output .='<div>';
        } else {
            $output .='<div hidden>';
        }

        $output.=
        '<h5>Consumable</h5>
        <table class="table table-light">
            <thead class="thead-dark">
                <tr>
                    <th>Product Name</th>
                    <th># Sold</th>
                    <th>Sale Per Product</th>
                </tr>
                
            </thead>
            <tbody>'
        ;
        $totalCon = 0;
        if ($consumableSales == '[]') {
            $output .=
            '<tr>
                <td colspan="3" style="text-align: center">No Products</td>
            </tr> ';
        } else {
            
            foreach ($consumableSales as $consumableSale) {
                $output .=
                '<tr>
                    <td>'.$consumableSale->ProductName.'</td>
                    <td>'.$consumableSale->sold.'</td>
                    <td>'.$consumableSale->cost.'</td>
                </tr>'
                ;
                $totalCon += $consumableSale->cost;
            }
            $output .= 
            ' <tr>
                <td colspan="2" style="text-align: right">Total:</td>
                <td><b>'.$totalCon.'</b></td>
            </tr>'
            ;
        }

        $output .= 
        '</tbody>
        </table>
        </div>
        '
        ;

        if (in_array('Non-Consumable', $categories) || in_array('allCheck', $categories)) {
            $output .='<div>';
        } else {
            $output .='<div hidden>';
        }

        $output.=
        '<h5>Non-Consumable</h5>
        <table class="table table-light">
            <thead class="thead-dark">
                <tr>
                    <th>Product Name</th>
                    <th># Sold</th>
                    <th>Sale Per Product</th>
                </tr>
                
            </thead>
            <tbody>'
        ;
        $totalNCon = 0;
        if ($nonConsumableSales == '[]') {
            $output .=
            '<tr>
                <td colspan="3" style="text-align: center">No Products</td>
            </tr> ';
        } else {
            
            foreach ($nonConsumableSales as $nonConsumableSale) {
                $output .=
                '<tr>
                    <td>'.$nonConsumableSale->ProductName.'</td>
                    <td>'.$nonConsumableSale->sold.'</td>
                    <td>'.$nonConsumableSale->cost.'</td>
                </tr>'
                ;
                $totalNCon += $nonConsumableSale->cost;
            }
            $output .= 
            ' <tr>
                <td colspan="2" style="text-align: right">Total:</td>
                <td><b>'.$totalNCon.'</b></td>
            </tr>'
            ;
        }

        $output .= 
        '</tbody>
        </table>
        </div>
        '
        ;

        if (in_array('E-Load', $categories) || in_array('allCheck', $categories)) {
            $output .='<div>';
        } else {
            $output .='<div hidden>';
        }

        $output.=
        '<h5>E-Load</h5>
        <table class="table table-light">
            <thead class="thead-dark">
                <tr>
                    <th>Product Name</th>
                    <th>Sale Per Product</th>
                </tr>
                
            </thead>
            <tbody>'
        ;
        $totalELoad = 0;
        if ($eLoadSales == '[]') {
            $output .=
            '<tr>
                <td colspan="2" style="text-align: center">No Products</td>
            </tr> ';
        } else {
            
            foreach ($eLoadSales as $eLoadSale) {
                $output .=
                '<tr>
                    <td>'.$eLoadSale->ProductName.'</td>
                    <td>'.$eLoadSale->sold.'</td>
                </tr>'
                ;
                $totalELoad += $eLoadSale->sold;
            }
            $output .= 
            ' <tr>
                <td colspan="1" style="text-align: right">Total:</td>
                <td><b>'.$totalELoad.'</b></td>
            </tr>'
            ;
        }

        $output .= 
        '</tbody>
        </table>
        </div>
        
        <div class="page-break"></div>
        
        <h5 style="text-align: center">Products Out of Stock</h5>
                            <table class="table table-light">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Stock</th>
                                    </tr>
                                     
                                </thead>
                                <tbody>'
        ;
        
        if ($outOfStocks == '[]') {
            $output .=
            '<tr>
                <td colspan="3" style="text-align: center">No Products</td>
             </tr> '
            ;
        } else {
            foreach ($outOfStocks as $outOfStock) {
                $output .=
                '<tr>
                    <td>'.$outOfStock->ProductName.'</td>
                    <td>'.$outOfStock->Category.'</td>
                    <td>'.$outOfStock->Stock.'</td>
                </tr> '
                ;
            }
        }

        $totalSales = $totalCon + $totalNCon + $totalELoad;

        $output .=
        '</tbody>
        </table>'
        ;

        $output .='
        <h5 style="text-align: center">Summary</h5>

        <table class="table table-light">
            <thead class="thead-dark">
                <tr>
                    <th># of Sales</th>
                    <th># of Debts</th>
                    <th>Total Sales</th>
                </tr>
                
            </thead>
            <tbody>
                <tr>
                    <td>'.$sales.'</td>
                    <td>'.$debts.'</td>
                    <td>'.$totalSales.'</td>
                </tr>
            </tbody>
        </table>
        </body>
        </html>';
        // End of PDF Format


            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($output);
            $pdf->setPaper('A4', 'landscape');
            return $pdf->download('POS-MS Report '.$now.'.pdf');
    }

    function convert_order_data_to_html($sD, $eD)
    {
        $now = Carbon::now();
        $data = DB::table('product')
            ->select()
            ->where('Stock','=','0')
            ->whereBetween('updated_at', [$sD, $eD])
            ->get();

        $data2 = DB::table('sales')
            ->join('users','sales.PersonInCharge','=','users.UserID')
            ->select('sales.*','users.FirstName as fName','users.LastName as lName')
            ->get();
        $title = "Migui's Store Report";
        $output = '
        <head>
                <style>
                    .page-break {
                        page-break-after: always;
                    }

                    body {
                        font-family: "Trebuchet MS", sans-serif;
                    }
                    th, td {
                        border: 1px solid #ddd;
                        padding: 8px;
                    }

                    th {
                        padding-top: 12px;
                        padding-bottom: 12px;
                        text-align: left;
                        background-color: #343a41;;
                        color: white;
                    }

                    table {
                        border-collapse: collapse;
                        width: 100%;
                    }


             </style>
        </head>
        <body>
        <div class="row">
            <h2 style="text-align: center;margin-top: 50%">'.$title.'</h2>
            <h3 style="text-align: center">Date Created: '.$now.'</h3>
            <h3 style="text-align: center">Start Date: '.$sD.' End Date: '.$eD.'</h3>
        </div>
            <div class="page-break"></div>
            <h3>Products Out of Stock</h3>
                <table class="table table-light">
                    <thead class="thead-light">
                        <tr>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
        ';
        foreach ($data as $da) {
            $output .= '
            <tr>
                <td>'.$da->ProductName.'</td>
                <td>'.$da->Category.'</td>
                <td>'.$da->Stock.'</td>
            </tr>
            ';
        }
        $output .= '</tbody>
    </table>
    <div class="page-break"></div>
    <h3>All Transactions</h3>
                <table class="table table-light">
                    <thead class="thead-light">
                        <tr>
                            <th>SalesID</th>
                            <th>PersonInCharge</th>
                            <th>Mode Of Payment</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($data2 as $da2) {
            $output .= '
            <tr>
                <td>'.$da2->SalesID.'</td>
                <td>'.$da2->fName.' '.$da2->lName.'</td>
                <td>'.$da2->ModeOfPayment.'</td>
            </tr>
            ';
        }

        $output .='
        </tbody>
    </table>
        </body>
        </html>';
        return $output;
        
    }


    public function categoryInput($query){

        $categories = DB::table('categories')->where('CategoryName', 'LIKE', '%'.$query.'%')->get();

        if(DB::table('categories')->where('CategoryName', 'LIKE', '%'.$query.'%')->first()){
            return response()->json([
                'status' => 123,
                'message' => 'Make sure it is unique!',
                'category' => $categories
            ]);
        }else{
            return response()->json([
                'status' => 101,
                'message' => 'Category is unique',
            ]);
        }

    }

    public function categoryStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categoryName' => ['required', 'max:50', 'unique:categories,CategoryName', 'regex:/^[\pL\s]+$/u'],
            'catDescription' => 'required|max:255',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->errors()->all(),
            ]);
        }else{

        $category = new Category;
        $category->CategoryName = $request->input('categoryName');
        $category->Description = $request->input('catDescription');
        $category->save();

        return response()->json([
            'status' => 202,
            'message' => 'success'
        ]);
        }
    }

    public function categoryEdit($id)
    {
        //
        $category = Category::find($id);
        if($category){
            return response()->json([
                'status'=>200,
                'category'=>$category,
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Pizza Not Found',
            ]);
        }
    }

    public function categoryUpdate(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'CategoryName' =>['required', 'max:50', 'unique:categories,CategoryName', 'regex:/^[\pL\s]+$/u'],
            'Description' =>'required|max:255',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->errors()->all(),
            ]);
        }
        else
        {
            $categories = Category::find($id);


            if($categories)
            {
                $categories->CategoryName = $request->input('CategoryName');
                $categories->Description = $request->input('Description');
                $categories->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'Category Updated Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'Pizza Not Found',
                ]);
            }

        }
    }
    public function categoryDestroy($id)
    {
        //


        try
        {
            $category = Category::find($id);
            $category->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Category Deleted Successfully',
            ]);
        }catch(\Illuminate\Database\QueryException $ex)
        {
            return response()->json([
                'status'=>404,
                'message'=>'This category has existing products.',
            ]);
        }


    }

    public function action(Request $request){
        if($request->ajax()){
            $output='';
            $query = $request->get('query');
            if($query != ''){
                $data = DB::table('product')
                    ->where('Category','NOT LIKE','%E-Load%')
                    ->where('ProductName', 'LIKE', '%'.$query.'%')
                    ->orWhere('Category', 'LIKE', $query.'%')
                    ->orderBy('ProductName', 'desc')
                    ->take(7)
                    ->get();
            }else{
                $data = DB::table('product')->where('Category','NOT LIKE','%E-Load%')->take(7)->get();
            }

            $total_row = $data->count();
            if($total_row > 0){

                    foreach($data as $row){
                    $output .= '
                    <tr style = "color:white;">
                        <td>'.$row->ProductName.'</td>
                        <td>'.$row->Category.'</td>
                        <td>'.$row->Stock.'</td>
                        <td style = "text-align:center;">'.number_format($row->Price, 2).'</td>
                        <td style = "text-align:center;"><button onclick="addToInvoice(\' '.$row->ProductName.' \', \' '.$row->Price.' \' ,\' '.$row->ProductID.'\' ,\' '.$row->Stock.' \')" class = "btn btn-primary" id = "add"> Add </button></td>
                    </tr>
                    ';
                    }

            }else{
                $output = '
                <tr style = "color:white; text-align:center;">
                    <td colspan = "3"> No Data Found! </td>
                </tr>
                ';
            }
            $data = array(
                'table_data' => $output,
                'total_data' => $total_row,
            );
            echo json_encode($data);
        }
    }

    public function showTransactionDetails($id){
        $details = DB::table('salesdetails')
                    ->join('sales','salesdetails.SalesID','=','sales.SalesID')
                    ->join('product','salesdetails.ProductID','=','product.ProductID')
                    ->select('salesdetails.*','sales.*','product.*','product.ProductName as ProductName','product.Price as ProductPrice')
                    ->where('salesdetails.salesID','=',$id)
                    ->get();

        // return response()->json([
        //     'status' => 123,
        //     'details' => $details
        // ]);
        return (compact('details'));
    }

    public function searchTransactions(Request $request){
        if($request->ajax()){
            $output='';
            $query = $request->get('query');
            if($query != ''){
                $credits = DB::table('sales')
                    ->join('users','sales.PersonInChargeID','=','users.UserID')
                    ->join('credits','sales.SalesID','=','credits.SalesID')
                    ->select('sales.*','users.*')
                    ->whereNotNull('credits.BalancePayDate');

                $data = DB::table('sales')
                    ->join('users','sales.PersonInChargeID','=','users.UserID')
                    ->join('credits','sales.SalesID','=','credits.SalesID')
                    ->select()
                    //->whereNotNull('credits.BalancePayDate')
                    //->orWhere('sales.SalesID', '=', $query)
                    ->whereRaw("credits.BalancePayDate IS NOT NULL AND (sales.SalesID LIKE '%$query%' OR sales.created_at LIKE '%$query%' OR users.FirstName LIKE '%$query%' OR users.LastName LIKE '%$query%')")
                    ->get();

                $details = DB::table('salesdetails')
                    ->join('sales','salesdetails.SalesID','=','sales.SalesID')
                    ->join('product','salesdetails.ProductID','=','product.ProductID')
                    ->select('salesdetails.*','sales.*','product.*','product.ProductName as ProductName')
                    ->get();

            }else{
                $credits = DB::table('sales')
                ->join('users','sales.PersonInChargeID','=','users.UserID')
                ->join('credits','sales.SalesID','=','credits.SalesID')
                ->select('sales.*','users.*')
                ->whereNotNull('credits.BalancePayDate');

                $data = DB::table('sales')
                ->join('users','sales.PersonInChargeID','=','users.UserID')
                ->select()
                ->where('ModeOfPayment','=','Cash')
                ->union($credits)
                ->get();

                $details = DB::table('salesdetails')
                ->join('sales','salesdetails.SalesID','=','sales.SalesID')
                ->join('product','salesdetails.ProductID','=','product.ProductID')
                ->select('salesdetails.*','sales.*','product.*','product.ProductName as ProductName','product.Price as ProductPrice')
                ->get();
            }
            $total = 0;
            $total_row = $data->count();
            if($total_row > 0){

                    foreach($data as $row){
                    $output .= '
                    <tr style = "align-content: center; text-align: center;">
                        <th scope="row">'.$row->SalesID.'</th>
                        <td>'.$row->ModeOfPayment.'</td>
                        <td>'.$row->created_at.'</td>
                        <td>'.$row->FirstName.' '.$row->LastName.'</td>';

                        foreach ($details as $detail) {
                            if ($detail->SalesID == $row->SalesID) {
                                $total += ($detail->Quantity * $detail->ProductPrice);
                            }
                        }

                    $output .='
                        <td>&#8369;'.number_format($total, 2).'</td>
                        <td>
                                <button class="btn btn-primary transactionDetails" value="'.$row->SalesID.'"><i class="fas fa-eye"></i></button>
                                <a class="btn btn-primary" href="'.route('admin.editTransaction', $row->SalesID).'"><i class="fas fa-pen"></i></a>
                                <button class="btn btn-secondary delete_transaction" value="'.$row->SalesID.'" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fas fa-archive"></i></button>
                        </td>
                    </tr>
                    ';
                    $total = 0;
                    }

            }else{
                $output = '
                <tr style = "text-align:center;">
                    <td colspan = "6"> No Data Found! </td>
                </tr>
                ';
            }
            $data = array(
                'table_data' => $output,
                'total_data' => $total_row,
            );
            echo json_encode($data);
        }
    }

    public function adminDebtors()
    {
        $debtors = DB::table('credits')
            ->select()
            ->whereNull('BalancePayDate')
            ->get();
        return view('admin.debtors', compact('debtors'));
    }

    public function debtorsRecordView($id){
        $debtor = DB::table('credits')
            ->where('SalesID','=',$id)
            ->get();

        if($debtor){
            return response()->json([
                'status'=>200,
                'debtor'=>$debtor,
            ]);
        }else{
            return response()->json([
                'status'=>400,
                'debtor'=>$debtor,
            ]);
        }

    }

    public function debtorsClearRecord($id){
        $currentDate = Carbon::now();

        DB::table('credits')
        ->where("SalesID", '=',  $id)
        ->update(['credits.BalancePayDate'=> $currentDate]);

        return response()->json([
            'status'=>100,
            'message'=>'Debt record has been successfully cleared!'
        ]);
        // $product->ProductName = $request->input('ProductName');
        // $product->Price = $request->input('Price');
        // $product->Stock = $request->input('Stock');
        // $product->update();
        // return response()->json([
        //     'status'=>200,
        //     'message'=>'Product Updated Successfully',
        // ]);
    }

    public function adminUserManagement()
    {
        $actives = DB::table('users')
            ->select()
            ->where('userType', '=' ,'admin')
            ->orWhere('userType', '=', 'user')
            ->orderBy('UserID')
            ->paginate(7);
        $restricteds = DB::table('users')
            ->select()
            ->where('userType', '=' ,'restricted')
            ->paginate(7);
        return view('admin.userManagement', compact('actives','restricteds'));
    }

    public function adminReports()
    {
        $salespersons = DB::table('users')
            ->select()
            ->where('UserType','=','admin')
            ->orWhere('UserType','=','user')
            ->get();
        return view('admin.reports', compact('salespersons'));
    }


}