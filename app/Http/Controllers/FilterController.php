<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

use LaravelLocalization;

class FilterController extends Controller {
    
    private $lang = 'en';

    public function getCategory(Request $request) {
	
	$cat_id = $request['cat_id'];

	$cat = DB::table('categories')
		->select('id', 'title_' .  $this->lang . ' as title')
		->where('id', $cat_id)
		->first();

	return response()->json($cat);
    }

    public function getSizes(Request $request) {
	$cat_id = $request['cat_id'];
	
	$data = DB::table('sizes')
		->select('sizes.id','sizes.title_' . $this->lang . ' as title')
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
		->select('materials.id', 'materials.title_' . $this->lang . ' as title')
		->leftJoin('products', 'materials.id', '=', 'products.material_id')
		->where('products.category_id', $cat_id)
		->where('products.size_id', $size_id)
		->orderBy('materials.order')
		->distinct()
		->get();

	return response()->json($data);
    }
    
    public function getTypes(Request $request) {
	$data = array();
	$data['lang'] = LaravelLocalization::getCurrentLocale();
	$cat_id = $request['cat_id'];
	$size_id = $request['size_id'];
	$material_id = $request['material_id'];
	
	$types_count = DB::table('types')
		->where('material_id', $material_id)
		->count();
	
	if($types_count > 0) {
	    $data['color'] = false;
	    $data['types'] = DB::table('types')
		    ->select('types.id', 'types.title_' . $this->lang . ' as title')
		    ->leftJoin('products', 'types.id', '=', 'products.type_id')
		    ->where('products.category_id', $cat_id)
		    ->where('products.size_id', $size_id)
		    ->where('products.material_id', $material_id)
		    ->orderBy('types.order')
		    ->distinct()
		    ->get();
	} else {
	    $data['color'] = true;
	    $data['types'] = array();
	}

	return response()->json($data);
    }
    public function getColors(Request $request) {
	$cat_id = $request['cat_id'];
	$size_id = $request['size_id'];
	$material_id = $request['material_id'];
	$type_id = $request['type_id'];
	
	if($type_id == 0 || empty($type_id)) {
	    $data = DB::table('colors')
		    ->select('colors.id', 'colors.title_' . $this->lang . ' as title', 'colors.color', 'colors.image')
		    ->leftJoin('products', 'colors.id', '=', 'products.color_id')
		    ->where('products.category_id', $cat_id)
		    ->where('products.size_id', $size_id)
		    ->where('products.material_id', $material_id)
		    ->orderBy('colors.order')
		    ->distinct()
		    ->get();
	} else {
	    $data = DB::table('colors')
		    ->select('colors.id', 'colors.title_' . $this->lang . ' as title', 'colors.color', 'colors.image')
		    ->leftJoin('products', 'colors.id', '=', 'products.color_id')
		    ->where('products.category_id', $cat_id)
		    ->where('products.size_id', $size_id)
		    ->where('products.material_id', $material_id)
		    ->where('products.type_id', $type_id)
		    ->orderBy('colors.order')
		    ->distinct()
		    ->get();
	}
	
	return response()->json($data);
    }
    
    public function getBodies(Request $request) {
	$cat_id = $request['cat_id'];
	$size_id = $request['size_id'];
	$material_id = $request['material_id'];
	$type_id = $request['type_id'];
	$color_id = $request['color_id'];

	if ($type_id == 0 || empty($type_id)) {
	    $data = DB::table('bodies')
		    ->select('bodies.id', 'bodies.title_' . $this->lang . ' as title')
		    ->leftJoin('products', 'bodies.id', '=', 'products.body_id')
		    ->where('products.category_id', $cat_id)
		    ->where('products.size_id', $size_id)
		    ->where('products.material_id', $material_id)
		    ->where('products.color_id', $color_id)
		    ->orderBy('bodies.order')
		    ->distinct()
		    ->get();
	} else {
	    $data = DB::table('bodies')
		    ->select('bodies.id', 'bodies.title_' . $this->lang . ' as title')
		    ->leftJoin('products', 'bodies.id', '=', 'products.body_id')
		    ->where('products.category_id', $cat_id)
		    ->where('products.size_id', $size_id)
		    ->where('products.material_id', $material_id)
		    ->where('products.type_id', $type_id)
		    ->where('products.color_id', $color_id)
		    ->orderBy('bodies.order')
		    ->distinct()
		    ->get();
	}

	return response()->json($data);
    }
    
    public function getBorders(Request $request) {
	$data = array();
	
	$cat_id = $request['cat_id'];
	$size_id = $request['size_id'];
	$material_id = $request['material_id'];
	$type_id = $request['type_id'];
	$color_id = $request['color_id'];
	$body_id = $request['body_id'];
	
	$borders_count = DB::table('borders')
		->where('body_id', $body_id)
		->count();
	
	if($borders_count > 0) {
	    $data['product'] = false;
	    if ($type_id == 0 || empty($type_id)) {
		$data['borders'] = DB::table('borders')
			->select('borders.id', 'borders.color')
			->leftJoin('products', 'borders.id', '=', 'products.border_id')
			->where('products.category_id', $cat_id)
			->where('products.size_id', $size_id)
			->where('products.material_id', $material_id)
			->where('products.color_id', $color_id)
			->where('products.body_id', $body_id)
			->orderBy('borders.order')
			->distinct()
			->get();
	    } else {
		$data['borders'] = DB::table('borders')
			->select('borders.id', 'borders.color')
			->leftJoin('products', 'borders.id', '=', 'products.border_id')
			->where('products.category_id', $cat_id)
			->where('products.size_id', $size_id)
			->where('products.material_id', $material_id)
			->where('products.type_id', $type_id)
			->where('products.color_id', $color_id)
			->where('products.body_id', $body_id)
			->orderBy('borders.order')
			->distinct()
			->get();
	    }
	} else {
	    $data['product'] = true;
	    $data['borders'] = array();
	}

	return response()->json($data);
    }
    
    public function getProduct(Request $request) {
	$cat_id = $request['cat_id'];
	$size_id = $request['size_id'];
	$material_id = $request['material_id'];
	$type_id = $request['type_id'];
	$color_id = $request['color_id'];
	$body_id = $request['body_id'];
	$border_id = $request['border_id'];
	
	
	if ($type_id == 0 || empty($type_id)) {
	    if ($border_id == 0 || empty($border_id)) {
		$data = DB::table('products')
			->select('*', 'title_' . $this->lang . ' as title',  'description_' . $this->lang . ' as description')
			->where('products.category_id', $cat_id)
			->where('products.size_id', $size_id)
			->where('products.material_id', $material_id)
			->where('products.color_id', $color_id)
			->where('products.body_id', $body_id)
			->first();
	    } else {
		$data = DB::table('products')
			->select('*', 'title_' . $this->lang . ' as title', 'description_' . $this->lang . ' as description')
			->where('products.category_id', $cat_id)
			->where('products.size_id', $size_id)
			->where('products.material_id', $material_id)
			->where('products.color_id', $color_id)
			->where('products.body_id', $body_id)
			->where('products.border_id', $border_id)
			->first();
	    }
	    
	} else {
	    if ($border_id == 0 || empty($border_id)) {
		$data = DB::table('products')
			->select('*', 'title_' . $this->lang . ' as title', 'description_' . $this->lang . ' as description')
			->where('products.category_id', $cat_id)
			->where('products.size_id', $size_id)
			->where('products.material_id', $material_id)
			->where('products.type_id', $type_id)
			->where('products.color_id', $color_id)
			->where('products.body_id', $body_id)
			->first();
	    } else {
		$data = DB::table('products')
			->select('*', 'title_' . $this->lang . ' as title', 'description_' . $this->lang . ' as description')
			->where('products.category_id', $cat_id)
			->where('products.size_id', $size_id)
			->where('products.material_id', $material_id)
			->where('products.type_id', $type_id)
			->where('products.color_id', $color_id)
			->where('products.body_id', $body_id)
			->where('products.border_id', $border_id)
			->first();
	    }
	}
	
	return response()->json($data);
    }
}
