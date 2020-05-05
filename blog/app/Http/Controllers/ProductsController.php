<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use DB;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show all products
     */
    public function index(){
        try{
            $products = Product::with('category')->get();

            return response()->json([
                'data' => $products
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'status' => '500',
                'error' => $e->getMessage(),
            ]);
        }
        
    }

    /**
     * Store product
     */
    public function store(Request $request){

        try{
            $this->validate($request, [
                'name' => 'required',
                'category_id' => 'required',
            ]);

            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $request->category_id,
            ]);
    
            return response()->json([
                'status' => '201',
                'data' => $product
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => '500',
                'error' => $e->getMessage(),
            ]);
        } 
    }

    /**
     * update product
     */
    public function update(Request $request, $id){
        try{
            $this->validate($request, [
                'name' => 'required',
            ]);
            $checkProduct = Product::findOrFail($id);
            $product = $checkProduct->update([
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $request->category_id
                ]);
    
            return response()->json([
                'status' => '200',
                'data' => $product
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => '500',
                'error' => $e->getMessage(),
            ]);
        } 
    }

    /**
     * delete product
     */
    public function destroy($id){
        try{
            $product = Product::where('id', $id)->delete();
            
            return response()->json([
                'status' => '200',
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => '500',
                'error' => $e->getMessage(),
            ]);
        } 
    }
}
