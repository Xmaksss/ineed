<?php

use App\Slider;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Slider::class, function (ModelConfiguration $model) {
    $model->setTitle('Slider');
    // Display
    $model->onDisplay(function () {
	return AdminDisplay::table()->setApply(function($query) {
		    $query->orderBy('sort', 'asc');
		})->setColumns([
		    AdminColumn::text('id')->setLabel('ID')->setWidth('30px'),
		    AdminColumn::custom('Main Image', function(\Illuminate\Database\Eloquent\Model $model) {
				return '<img src="/' . $model->image . '" style="width: 100px"/>';
			    })->setWidth('100px'),
		    AdminColumn::link('title_en')->setLabel('Title [en]'),
		    AdminColumn::datetime('created_at')->setLabel('Created At')->setFormat('d.m.Y')->setWidth('150px'),
		    AdminColumn::datetime('updated_at')->setLabel('Updated At')->setFormat('d.m.Y')->setWidth('150px'),
		    AdminColumn::text('sort')->setLabel('Sort')->setWidth('30px'),
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
				    AdminFormElement::text("sub_title_$lang", "Sub Title [$lang]")->required(),
				    AdminFormElement::text("button_$lang", "Button text [$lang]")
			]))->setLabel($lang);
	    }

	    return $tabs;
	});

	$form = AdminForm::form()->setElements([

		    
		    AdminFormElement::image('image', 'Image')->required(),
		    AdminFormElement::number('sort', 'Sort Order')->setDefaultValue(0),
		    AdminFormElement::text('link', 'Button link')
		])->addElement($tabs);

	$form->getButtons()
		->setSaveButtonText('Save slide')
		->hideSaveAndCloseButton();
	return $form;
    });
});
