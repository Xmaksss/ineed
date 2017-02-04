<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class FilterController extends Controller {
    
    public function getCategories() {

	$data = DB::table('categories')->select('id', 'title_en')->orderBy('sort')->get();

	return response()->json($data);
    }

    public function getSizes(Request $request) {
	$cat_id = $request['cat_id'];
	
	$data = DB::table('sizes')
		->select('sizes.id','sizes.title_en')
		->leftJoin('products', 'sizes.id', '=', 'products.size_id')
		->where('products.category_id', $cat_id)
		->orderBy('sizes.order')
		->distinct()
		->get();
	
	return response()->json($data);
    }
    
    public function getMaterials(Request $request) {
	$cat_id = $request['cat_id'];
	$size_id = $request['size_id'];

	$data = DB::table('materials')
		->select('materials.id', 'materials.title_en')
		->leftJoin('products', 'materials.id', '=', 'products.size_id')
		->where('products.category_id', $cat_id)
		->where('products.size_id', $size_id)
		->orderBy('materials.order')
		->distinct()
		->get();

	return response()->json($data);
    }
    
    public function getTypes(Request $request) {
	$cat_id = $request['cat_id'];
	$size_id = $request['size_id'];
	$material_id = $request['size_id'];

	$data = DB::table('materials')
		->select('materials.id', 'materials.title_en')
		->leftJoin('products', 'materials.id', '=', 'products.size_id')
		->where('products.category_id', $cat_id)
		->where('products.size_id', $size_id)
		->orderBy('materials.order')
		->distinct()
		->get();

	return response()->json($data);
    }

}
