<?php

use App\Size;
use App\Material;
use App\Type;
use App\Color;
use App\Body;
use App\Border;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Size::class, function (ModelConfiguration $model) {
    $model->setTitle('Size');
    // Display
    $model->onDisplay(function () {
	return AdminDisplay::table()->setApply(function($query) {
		    $query->orderBy('order', 'asc');
		})->setColumns([
		    AdminColumn::text('id')->setLabel('ID')->setWidth('30px'),
		    AdminColumn::link('title_en')->setLabel('Title [en]'),
		    AdminColumn::datetime('created_at')->setLabel('Created At')->setFormat('d.m.Y')->setWidth('150px'),
		    AdminColumn::datetime('updated_at')->setLabel('Updated At')->setFormat('d.m.Y')->setWidth('150px'),
		    AdminColumn::text('order')->setLabel('Order')->setWidth('30px'),
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
		    
				    AdminFormElement::text("title_$lang", "Title [$lang]")->required()
		    
			]))->setLabel($lang);
	    }

	    return $tabs;
	});

	$form = AdminForm::form()->setElements([

		    AdminFormElement::number('order', 'Sort Order')->setDefaultValue(0)
		])->addElement($tabs);
	
	$form->getButtons()
		->setSaveButtonText('Save size')
		->hideSaveAndCloseButton();
	return $form;
    });
});

AdminSection::registerModel(Material::class, function (ModelConfiguration $model) {
    $model->setTitle('Material');
    // Display
    $model->onDisplay(function () {
	return AdminDisplay::table()->setApply(function($query) {
		    $query->orderBy('order', 'asc');
		})->setColumns([
		    AdminColumn::text('id')->setLabel('ID')->setWidth('30px'),
		    AdminColumn::link('title_en')->setLabel('Title [en]'),
		    AdminColumn::datetime('created_at')->setLabel('Created At')->setFormat('d.m.Y')->setWidth('150px'),
		    AdminColumn::datetime('updated_at')->setLabel('Updated At')->setFormat('d.m.Y')->setWidth('150px'),
		    AdminColumn::text('order')->setLabel('Order')->setWidth('30px'),
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

				    AdminFormElement::text("title_$lang", "Title [$lang]")->required()
			
			]))->setLabel($lang);
	    }

	    return $tabs;
	});

	$form = AdminForm::form()->setElements([

		    AdminFormElement::number('order', 'Sort Order')->setDefaultValue(0)
		])->addElement($tabs);
	
	$form->getButtons()
		->setSaveButtonText('Save material')
		->hideSaveAndCloseButton();
	return $form;
    });
});

AdminSection::registerModel(Type::class, function (ModelConfiguration $model) {
    $model->setTitle('Type');
    // Display
    $model->onDisplay(function () {
	return AdminDisplay::table()->setApply(function($query) {
		    $query->orderBy('order', 'asc');
		})->setColumns([
		    AdminColumn::text('id')->setLabel('ID')->setWidth('30px'),
		    AdminColumn::link('title_en')->setLabel('Title [en]'),
		    AdminColumn::datetime('created_at')->setLabel('Created At')->setFormat('d.m.Y')->setWidth('150px'),
		    AdminColumn::datetime('updated_at')->setLabel('Updated At')->setFormat('d.m.Y')->setWidth('150px'),
		    AdminColumn::text('order')->setLabel('Order')->setWidth('30px'),
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

				    AdminFormElement::text("title_$lang", "Title [$lang]")->required()
			]))->setLabel($lang);
	    }

	    return $tabs;
	});

	$form = AdminForm::form()->setElements([
		    AdminFormElement::select('material_id', 'Material', Material::pluck('title_en', 'id')->all())->required(),
		    AdminFormElement::number('order', 'Sort Order')->setDefaultValue(0)
		])->addElement($tabs);

	$form->getButtons()
		->setSaveButtonText('Save Type')
		->hideSaveAndCloseButton();
	return $form;
    });
});

AdminSection::registerModel(Color::class, function (ModelConfiguration $model) {
    $model->setTitle('Color');
    // Display
    $model->onDisplay(function () {
	return AdminDisplay::table()->setApply(function($query) {
		    $query->orderBy('order', 'asc');
		})->setColumns([
		    AdminColumn::text('id')->setLabel('ID')->setWidth('30px'),
		    AdminColumn::custom('Color', function(\Illuminate\Database\Eloquent\Model $model) {
			if($model->color != '' && strlen($model->color) > 2) {
			    return '<div style="background: ' . $model->color . '; width: 50px; height: 50px; box-shadow: 1px 1px 10px #aaa"></div>';
			} else if($model->image != ''){
			    return '<img src="/'.$model->image.'" style="width: 50px; box-shadow: 1px 1px 10px #aaa"/>';
			} else {
			    return '<div style="background: linear-gradient(-45deg, #ddd 50%, #333 50%); width: 50px; height: 50px; box-shadow: 1px 1px 10px #aaa"></div>';
			}
				
			    })->setWidth('80px'),
		    AdminColumn::datetime('created_at')->setLabel('Created At')->setFormat('d.m.Y')->setWidth('150px'),
		    AdminColumn::datetime('updated_at')->setLabel('Updated At')->setFormat('d.m.Y')->setWidth('150px'),
		    AdminColumn::text('order')->setLabel('Order')->setWidth('30px'),
		])->disablePagination();
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {

	$form = AdminForm::form()->setElements([
	    
		    AdminFormElement::number('order', 'Sort Order')->setDefaultValue(0),
		    AdminFormElement::text('color', 'Color'),
		    AdminFormElement::image('image', 'Image')
	    
		]);

	$form->getButtons()
		->setSaveButtonText('Save Color')
		->hideSaveAndCloseButton();
	return $form;
    });
});

AdminSection::registerModel(Body::class, function (ModelConfiguration $model) {
    $model->setTitle('Body');
    // Display
    $model->onDisplay(function () {
	return AdminDisplay::table()->setApply(function($query) {
		    $query->orderBy('order', 'asc');
		})->setColumns([
		    AdminColumn::text('id')->setLabel('ID')->setWidth('30px'),
		    AdminColumn::link('title_en')->setLabel('Title [en]'),
		    AdminColumn::datetime('created_at')->setLabel('Created At')->setFormat('d.m.Y')->setWidth('150px'),
		    AdminColumn::datetime('updated_at')->setLabel('Updated At')->setFormat('d.m.Y')->setWidth('150px'),
		    AdminColumn::text('order')->setLabel('Order')->setWidth('30px'),
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

				    AdminFormElement::text("title_$lang", "Title [$lang]")->required()
			]))->setLabel($lang);
	    }

	    return $tabs;
	});

	$form = AdminForm::form()->setElements([
		    AdminFormElement::number('order', 'Sort Order')->setDefaultValue(0)
		])->addElement($tabs);

	$form->getButtons()
		->setSaveButtonText('Save Body')
		->hideSaveAndCloseButton();
	return $form;
    });
});

AdminSection::registerModel(Border::class, function (ModelConfiguration $model) {
    $model->setTitle('Border');
    // Display
    $model->onDisplay(function () {
	return AdminDisplay::table()->setApply(function($query) {
		    $query->orderBy('order', 'asc');
		})->setColumns([
		    AdminColumn::text('id')->setLabel('ID')->setWidth('30px'),
		    AdminColumn::custom('Color', function(\Illuminate\Database\Eloquent\Model $model) {
				return '<div style="background: ' . $model->color . '; width: 50px; height: 50px; box-shadow: 1px 1px 10px #aaa"></div>';
			    })->setWidth('80px'),
		    AdminColumn::datetime('created_at')->setLabel('Created At')->setFormat('d.m.Y')->setWidth('150px'),
		    AdminColumn::datetime('updated_at')->setLabel('Updated At')->setFormat('d.m.Y')->setWidth('150px'),
		    AdminColumn::text('order')->setLabel('Order')->setWidth('30px'),
		])->disablePagination();
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {

	$form = AdminForm::form()->setElements([
	    AdminFormElement::select('body_id', 'Body', Body::pluck('title_en', 'id')->all())->required(),
	    AdminFormElement::number('order', 'Sort Order')->setDefaultValue(0),
	    AdminFormElement::text('color', 'Color')
	]);

	$form->getButtons()
		->setSaveButtonText('Save Border')
		->hideSaveAndCloseButton();
	return $form;
    });
});
