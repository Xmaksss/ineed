<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use LaravelLocalization;

class MainController extends Controller {
    
    private $lang = 'en';
    
    public function __construct() {
	$this->lang = LaravelLocalization::getCurrentLocale();
    }
    
    public function index() {
	
	$data = array();

	$categories = DB::table('categories')
		->select('*', 'title_' . $this->lang .' as title')
		->where('public', 1)
		->orderBy('sort')
		->get();
	
	$data['categories'] = $categories;
	
	$slides = DB::table('sliders')
		->select('*', 'title_' . $this->lang . ' as title',
			'sub_title_' . $this->lang . ' as sub_title',
			'button_' . $this->lang . ' as button')
		->orderBy('sort')
		->get();
	
	$data['slides'] = $slides;

	return view('home', $data);
    }
    
}
