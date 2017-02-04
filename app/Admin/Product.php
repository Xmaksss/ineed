<?php

use App\Product;
use App\Size;
use App\Material;
use App\Type;
use App\Color;
use App\Body;
use App\Border;

use App\CategoryDescription;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Product::class, function (ModelConfiguration $model) {
    $model->setTitle('Product');
    // Display
    $model->onDisplay(function () {
	return AdminDisplay::table()->setApply(function($query) {
		    $query->orderBy('id', 'asc');
		})->setColumns([
		    AdminColumn::text('id')->setLabel('ID')->setWidth('30px'),
		    AdminColumn::custom('Main Image', function(\Illuminate\Database\Eloquent\Model $model) {
				return '<img src="'. $model->image_main .'"/>';
			    })->setWidth('100px'),
		    AdminColumn::link('title_en')->setLabel('Title [en]'),
		    AdminColumn::datetime('created_at')->setLabel('Created At')->setFormat('d.m.Y')->setWidth('150px'),
		    AdminColumn::datetime('updated_at')->setLabel('Updated At')->setFormat('d.m.Y')->setWidth('150px'),
		    AdminColumn::custom('Published', function(\Illuminate\Database\Eloquent\Model $model) {
				return $model->public ? 'yes' : 'no';
			    })->setWidth('50px'),
		])->disablePagination();
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
	//$locales = \Config::get('app.locales');
	$locales = ['en', 'ru'];
	$tabs = AdminDisplay::tabbed();

	$tabs->setTabs(function () use ($locales) {
	    $tabs = array();
	    foreach ($locales as $lang) {
		$tabs[] = AdminDisplay::tab(AdminForm::elements([
				    AdminFormElement::text("title_$lang", "Title [$lang]")->required(),
				    AdminFormElement::textarea("description_$lang", "Description [$lang]")->required(),
			]))->setLabel($lang);
	    }
	    
	    $tabs[] = AdminDisplay::tab(AdminForm::elements([
				AdminFormElement::image('image_main', 'Main Image'),
				AdminFormElement::image('image_1', 'Image 1'),
				AdminFormElement::image('image_2', 'Image 2'),
				AdminFormElement::image('image_3', 'Image 3'),
				AdminFormElement::image('image_4', 'Image 4'),
				AdminFormElement::image('image_5', 'Image 5'),
				AdminFormElement::image('image_6', 'Image 6'),
		    ]))->setLabel('Images');
	    
	    $tabs[] = AdminDisplay::tab(AdminForm::elements([
				AdminFormElement::select('size_id', 'Size', Size::pluck('title_en', 'id')->all())->required(),
		
				AdminFormElement::select('material_id', 'Material', Material::pluck('title_en', 'id')->all())
				    ->required(),
		
				AdminFormElement::dependentselect('type_id', 'Type')
					->setModelForOptions(Type::class, 'title_en')
					->setDataDepends(['material_id'])
					->setLoadOptionsQueryPreparer(function($item, $query) {
					    return $query->where('id', $item->getDependValue('material_id'));
					})
		    ]))->setLabel('Options');

	    return $tabs;
	});
	
	$form = AdminForm::form()->setElements([
		    AdminFormElement::select('category_id', 'Category',  App\Category::pluck('title_en','id')->all())->required(),
		    AdminFormElement::text('slug', 'Seo Url')->required(),
		    AdminFormElement::number('price', 'Price')->required(),
		    AdminFormElement::number('price_new', 'New Price')->required(),
		    AdminFormElement::checkbox('public', 'Published'),
	    
		])->addElement($tabs);
	;
	$form->getButtons()
		->setSaveButtonText('Save Product')
		->hideSaveAndCloseButton();
	return $form;
    });
});
