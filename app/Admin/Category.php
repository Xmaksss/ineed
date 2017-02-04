<?php

use App\Category;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Category::class, function (ModelConfiguration $model) {
    $model->setTitle('Category');
    // Display
    $model->onDisplay(function () {
	return AdminDisplay::table()->setApply(function($query) {
		    $query->orderBy('sort', 'asc');
		})->setColumns([
		    AdminColumn::text('id')->setLabel('ID')->setWidth('30px'),
		    AdminColumn::link('title_en')->setLabel('Title [en]'),
		    AdminColumn::datetime('created_at')->setLabel('Created At')->setFormat('d.m.Y')->setWidth('150px'),
		    AdminColumn::datetime('updated_at')->setLabel('Updated At')->setFormat('d.m.Y')->setWidth('150px'),
		    AdminColumn::custom('Published', function(\Illuminate\Database\Eloquent\Model $model) {
				return $model->public ? 'yes' : 'no';
			    })->setWidth('50px'),
		    AdminColumn::text('sort')->setLabel('Sort')->setWidth('30px'),
		])->disablePagination();
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
	//$locales = \Config::get('app.locales');
	$locales = ['en','ru'];
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

		    AdminFormElement::number('sort', 'Sort Order')->setDefaultValue(0),
		    AdminFormElement::checkbox('public', 'Published')
		])->addElement($tabs);
	
	$form->getButtons()
		->setSaveButtonText('Save category')
		->hideSaveAndCloseButton();
	return $form;
    });

});
