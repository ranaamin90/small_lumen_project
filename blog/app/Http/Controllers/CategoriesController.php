<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
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
     * Show all categories
     */
    public function index(){
        try{
            $categories = Category::get();

            return response()->json([
                'status' => '200',
                'data' => $categories
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => '500',
                'error' => $e->getMessage(),
            ]);
        }
        
    }

    /**
     * Store category
     */
    public function store(Request $request){

        try{
            $this->validate($request, [
                'name' => 'required',
            ]);
    
            $category = Category::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
    
            return response()->json([
                'status' => '201',
                'data' => $category
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => '500',
                'error' => $e->getMessage(),
            ]);
        } 
    }

    /**
     * update category
     */
    public function update(Request $request, $id){
        try{
            $this->validate($request, [
                'name' => 'required',
            ]);
            $checkCategory = Category::findOrFail($id);
            $category = $checkCategory->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
    
            return response()->json([
                'status' => '200',
                'data' => $category
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => '500',
                'error' => $e->getMessage(),
            ]);
        } 
    }

    /**
     * delete category
     */
    public function destroy($id){
        try{
            $category = Category::where('id', $id)->delete();

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
