<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect,Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function view($id)
    {
        //
        $products = Product::where('Category','=',$id)->get();
        $category = $id;
        return (compact('products', 'category'));
        
    }

    public function search()
    {
        $search_text = $_GET['query'];
        $products = Product::where('ProductName', 'LIKE', '%'.$search_text.'%')->get();

        return view('admin.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if ($request->input('Category') == "E-Load Promo") {
            $validator = Validator::make($request->all(), [
                'ProductName' =>['required', 'max:50', 'unique:product,ProductName','regex:/^[a-zA-Z0-9 ()]+$/'] ,
                'Price' =>['required', 'min:1', 'not_in:0'],
                'Category' =>'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'ProductName' =>['required', 'max:50', 'unique:product,ProductName','regex:/^[a-zA-Z0-9 ()]+$/'] ,
                'Price' =>['required', 'min:1', 'not_in:0'],
                'Category' =>'required',
                'Stock' => ['required', 'min:0', 'numeric'],
            ]);
        }
        
        

        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->errors()->all(),
                'error'=>'Please fill all fields'
            ]);
        }else{
            $operator = $request->input('Operator');
            if ($request->input('Category') == "E-Load Promo") {
                $eLoadWallet = Product::where('ProductName', 'LIKE', '%'.$operator.'%')
                ->where('Category', 'LIKE', '%E-Load%')
                ->first();
                $loadWallet = $eLoadWallet->Stock;

                $product = new Product;
                $product->ProductName = $request->input('ProductName');
                $product->Price = $request->input('Price');
                $product->Category = $request->input('Category');
                $product->Stock = $loadWallet;
                $product->save();
                return response()->json([
                    'status'=>200,
                    'message'=>'Product Added Successfully'
                ]);
            } else {
                $product = new Product;
                $product->ProductName = $request->input('ProductName');
                $product->Price = $request->input('Price');
                $product->Category = $request->input('Category');
                $product->Stock = $request->input('Stock');
                $product->save();
                return response()->json([
                'status'=>200,
                'message'=>'Product Added Successfully'
                ]);
            }
                        
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Product::find($id);

        if($product){
            return response()->json([
                'status'=>200,
                'product'=>$product,
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Pizza Not Found',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     *//*
    public function update(Request $request, Product $product)
    {
        //
    }*/

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'ProductName' =>['required', 'max:50', 'unique:product,ProductName,'.$id.','.'ProductID'.'','regex:/^[a-zA-Z0-9 ()]+$/'] ,
            'Price' =>['required', 'min:1', 'not_in:0'],
            'Category' =>'required',
            'Stock' => ['required', 'min:0', 'numeric'],
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validator->errors()->all(),
                'error'=>'Please fill all fields'
            ]);
        }else{
            $product = Product::find($id);
            if($product)
            {
                $product->ProductName = $request->input('ProductName');
                $product->Price = $request->input('Price');
                $product->Category = $request->input('Category');
                $product->Stock = $request->input('Stock');
                $product->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'Product Updated Successfully',
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::find($id);
        $product->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Product Deleted Successfully',
        ]);
    }
}
