<?php

use App\User;
use Illuminate\Support\Facades\Hash;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(User::class, function (ModelConfiguration $model) {
    $model->setTitle('Users');
    // Display
    $model->onDisplay(function () {
	return AdminDisplay::table()->setApply(function($query) {
		    $query->orderBy('id', 'asc');
		})->setColumns([
		    AdminColumn::text('id')->setLabel('ID')->setWidth('50px'),
		    AdminColumn::link('name')->setLabel('Name'),
		    AdminColumn::text('email')->setLabel('Email'),
		    AdminColumn::datetime('created_at')->setLabel('Created')->setFormat('d.m.Y')->setWidth('150px'),
		    AdminColumn::custom('Admin', function(\Illuminate\Database\Eloquent\Model $model) {
				return $model->is_admin ? 'yes': 'no';
			    })->setWidth('50px'),
		])->disablePagination();
    });

    $model->onCreate(function() {
	

	$form = AdminForm::form()->setElements([

		    AdminFormElement::text('name', 'Name')->required(),
		    AdminFormElement::text('email', 'Email')->required()->unique(),
		    AdminFormElement::password('password', 'Password')->required()->hashWithBcrypt()
	    
		]);

	$form->getButtons()
		->setSaveButtonText('Save user')
		->hideSaveAndCloseButton();
	return $form;
    });

    $model->onEdit(function($model){
	//dd($model);
	$form = AdminForm::form()->setElements([

	    AdminFormElement::text('name', 'Name'),
	    AdminFormElement::text('email', 'Email')
	    
	]);

	$form->getButtons()
		->setSaveButtonText('Save user')
		->hideSaveAndCloseButton();
	return $form;
    });
    
});
