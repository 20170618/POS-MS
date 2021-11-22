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
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return view('admin.transactions', compact('sales'));
    }

    public function adminEload()
    {
        $sales = DB::table('sales')
            ->join('users','sales.PersonInCharge','=','users.UserID')
            ->select('sales.*', 'users.*', 'sales.created_at as created_at')
            ->orderBy('sales.SalesID', 'desc')
            ->get();
        return view('admin.eload', compact('sales'));
    }

    public function salesPersonEload()
    {
        $sales = DB::table('sales')
            ->join('users','sales.PersonInCharge','=','users.UserID')
            ->select('sales.*', 'users.*', 'sales.created_at as created_at')
            ->orderBy('sales.SalesID', 'desc')
            ->get();
        return view('salesperson.eload', compact('sales'));
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

    public function storeTransaction(Request $request){
        $validator = Validator::make($request->all(), [
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
                $salesDetails->LoadAmount = $data_ID['quantity'];
                $salesDetails->save();
            }

            return response()->json([
                'status'=>200,
                'message'=>'Added Successfully',
            ]);
        }
    }

    public function storeDebt(Request $request){
        $validator = Validator::make($request->all(), [
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
                    $salesDetails->LoadAmount = $data_ID['quantity'];
                    $salesDetails->save();
                }

                return response()->json([
                    'status'=>200,
                    'message'=>'Debt Record Added Successfully',
                ]);
            }


        }
    }

    public function transactionDetails($id){
        $details = DB::table('salesdetails')
                    ->join('product','SalesDetails.ProductID','=','product.ProductID')
                    ->select('SalesDetails.*', 'product.ProductName as ProductName', 'product.Price as ProductPrice')
                    ->where('SalesID', '=', $id)
                    ->get();
        $sales = DB::table('sales')
                    ->select()
                    ->where('SalesID','=',$id)
                    ->get();

        return view('admin.transactionDetails', compact('details','sales'));

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
        $sameProds = DB::table('product')->where('Price','=', $price)->get();

        return response()->json([
            'status'=>200,
            'products'=>$sameProds,
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

    public function adminGenerateReport(Request $request){
        $now = Carbon::now();
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $newStartDate = date('Y-m-d', strtotime($startDate));
        $newEndDate = date('Y-m-d', strtotime($endDate));

        $data = DB::table('product')
            ->select()
            ->where('Stock','=','0')
            ->whereBetween('updated_at', [$newStartDate, $newEndDate]);


         $pdf = PDF::loadview('exportToPDF', compact('data'));


        return $pdf->download('POS-MSReport_'.$now->toDateTimeString().'.pdf');
    }

    public function adminGenerateReport2(Request $request){
            $now = Carbon::now();
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate');

            $newStartDate = date('Y-m-d', strtotime($startDate));
            $newEndDate = date('Y-m-d', strtotime($endDate));

            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($this->convert_order_data_to_html($newStartDate, $newEndDate));
            $pdf->setPaper('A4', 'landscape');
            return $pdf->download('POS-MSReport_'.$now->toDateTimeString().'.pdf');
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
                        <td style = "text-align:center;">'.number_format($row->Price, 2).'</td>
                        <td style = "text-align:center;"><button onclick="addToInvoice(\' '.$row->ProductName.' \', \' '.$row->Price.' \' ,\' '.$row->ProductID.' \' )" class = "btn btn-primary" id = "add"> Add </button></td>
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

    public function searchTransactions(Request $request){
        if($request->ajax()){
            $output='';
            $query = $request->get('query');
            if($query != ''){
                $data = DB::table('sales')
                    ->join('users','sales.PersonInCharge','=','users.UserID')
                    ->join('credits','sales.SalesID','=','credits.SalesID')
                    ->select('users.FirstName as FirstName','sales.*','BalancePayDate','users.*','sales.created_at as created_at')
                    ->whereRaw("(BalancePayDate IS NOT NULL AND (sales.SalesID LIKE '%$query%' OR sales.created_at LIKE '%$query%' OR users.FirstName LIKE '%$query%' OR users.LastName LIKE '%$query%'))")
                    ->orderBy('sales.SalesID', 'desc')
                    ->get();
            }else{
                $data = DB::table('sales')->join('users','sales.PersonInCharge','=','users.UserID')
                ->join('credits','sales.SalesID','=','credits.SalesID')
                ->whereRaw("BalancePayDate IS NOT NULL")->get();
            }

            $total_row = $data->count();
            if($total_row > 0){

                    foreach($data as $row){
                    $output .= '
                    <tr style = "align-content: center; text-align: center;">
                        <th scope="row">'.$row->SalesID.'</th>
                        <td>'.$row->ModeOfPayment.'</td>
                        <td>'.$row->created_at.'</td>
                        <td>'.$row->FirstName.' '.$row->LastName.'</td>
                        <td>
                                <a href="'.route('admin.transactionDetails', $row->SalesID).'" class="btn btn-primary "><i class="fas fa-eye"></i></a>
                                <a class="btn btn-primary" href="'.route('admin.editTransaction', $row->SalesID).'"><i class="fas fa-pen"></i></a>
                                &nbsp;
                                <button class="btn btn-secondary delete_transaction" value="'.$row->SalesID.'" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fas fa-archive"></i></button>
                        </td>
                    </tr>
                    ';
                    }

            }else{
                $output = '
                <tr style = "text-align:center;">
                    <td colspan = "4"> No Data Found! </td>
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



    // public function createPDF(){
    //     // retrieve all records from db
    //     $now = Carbon::now();
    //     // $check = $request->input('checkedRadio');

    //     // if($check =='MonthlyRadio'){
    //     //     $startDate = Carbon::createFromFormat('d/m/Y H:i:s', '01/'.$now->month.'/'.$now->year.' 00:00:00');
    //     //     $endDate = Carbon::createFromFormat('d/m/Y H:i:s', '31/'.$now->month.'/'.$now->year.' 23:59:59');

    //     //     $transactions=DB::table('sales')
    //     //         ->whereBetween('created_at', [$startDate, $endDate])
    //     //         ->get();

    //     //     echo $transactions;

    //     // }else if($check=='AnnualRadio'){
    //     //     $startDate = Carbon::createFromFormat('d/m/Y H:i:s', '01/01/'.$now->year.' 00:00:00');
    //     //     $endDate = Carbon::createFromFormat('d/m/Y H:i:s', '31/12/'.$now->year.' 23:59:59');

    //     //     $transactions=DB::table('sales')
    //     //         ->whereBetween('created_at', [$startDate, $endDate])
    //     //         ->get();

    //     //     echo $transactions;
    //     // }else if($check=='DailyRadio'){
    //     //     $startDate = Carbon::createFromFormat('d/m/Y H:i:s', ''.$now->day.'/'.$now->month.'/'.$now->year.' 00:00:00');
    //     //     $endDate = Carbon::createFromFormat('d/m/Y H:i:s', ''.$now->day.'/'.$now->month.'/'.$now->year.' 23:59:59');

    //     //     $transactions=DB::table('sales')
    //     //         ->whereBetween('created_at', [$startDate, $endDate])
    //     //         ->get();

    //     //     echo $transactions;
    //     // }
    //     // share data to view

    //     $data="sample";
    //      $pdf = PDF::loadview('exportToPDF', ['data'=>$data]);


    //     return $pdf->download('POS-MSReport_'.$now->toDateTimeString().'.pdf');
    // }
}

