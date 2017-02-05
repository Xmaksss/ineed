<?php

use SleepingOwl\Admin\Navigation\Page;

// Default check access logic
// AdminNavigation::setAccessLogic(function(Page $page) {
// 	   return auth()->user()->isSuperAdmin();
// });
//
// AdminNavigation::addPage(\App\User::class)->setTitle('test')->setPages(function(Page $page) {
// 	  $page
//		  ->addPage()
//	  	  ->setTitle('Dashboard')
//		  ->setUrl(route('admin.dashboard'))
//		  ->setPriority(100);
//
//	  $page->addPage(\App\User::class);
// });
//
// // or
//
//AdminSection::addMenuPage(\App\User::class);

return [
    [
	'title' => 'Dashboard',
	'icon' => 'fa fa-dashboard',
	'url' => route('admin.dashboard'),
    ],
    [
	'title' => 'Information',
	'icon' => 'fa fa-exclamation-circle',
	'url' => route('admin.information'),
    ],
	    (new Page(\App\User::class))
	    ->setIcon('fa fa-user')
	    ->setPriority(300)->addBadge(function () {
	return \App\User::count();
    }, ['class' => 'label-success']),
	    (new Page(\App\Category::class))
	    ->setIcon('fa fa-archive')
	    ->setPriority(400)->addBadge(function () {
	return \App\Category::count();
    }),
	    (new Page(\App\Product::class))
	    ->setIcon('fa fa-suitcase')
	    ->setPriority(500)->addBadge(function () {
	return \App\Product::count();
    }),
    [
	'title' => 'Options',
	'icon' => 'fa fa-folder',
	'priority' => 600,
	'pages' => [
		    (new Page(\App\Size::class))
		    ->setIcon('fa fa-minus')
		    ->setPriority(0),
		    (new Page(\App\Material::class))
		    ->setIcon('fa fa-minus')
		    ->setPriority(100)
		    ->setPriority(0),
		    (new Page(\App\Type::class))
		    ->setIcon('fa fa-minus')
		    ->setPriority(200)
		    ->setPriority(0),
		    (new Page(\App\Color::class))
		    ->setIcon('fa fa-minus')
		    ->setPriority(300)
		    ->setPriority(0),
		    (new Page(\App\Body::class))
		    ->setIcon('fa fa-minus')
		    ->setPriority(400)
		    ->setPriority(0),
		    (new Page(\App\Border::class))
		    ->setIcon('fa fa-minus')
		    ->setPriority(500)
	]
    ],
	    (new Page(\App\Slider::class))
	    ->setIcon('fa fa-picture-o')
	    ->setPriority(700)->addBadge(function () {
	return \App\Slider::count();
    })
	// Examples
	// [
	//    'title' => 'Content',
	//    'pages' => [
	//
    //        \App\User::class,
	//
    //        // or
	//
    //        (new Page(\App\User::class))
	//            ->setPriority(100)
	//            ->setIcon('fa fa-user')
	//            ->setUrl('users')
	//            ->setAccessLogic(function (Page $page) {
	//                return auth()->user()->isSuperAdmin();
	//            }),
	//
    //        // or
	//
    //        new Page([
	//            'title'    => 'News',
	//            'priority' => 200,
	//            'model'    => \App\News::class
	//        ]),
	//
    //        // or
	//        (new Page(/* ... */))->setPages(function (Page $page) {
	//            $page->addPage([
	//                'title'    => 'Blog',
	//                'priority' => 100,
	//                'model'    => \App\Blog::class
	//		      ));
	//
	//		      $page->addPage(\App\Blog::class);
	//	      }),
	//
    //        // or
	//
    //        [
	//            'title'       => 'News',
	//            'priority'    => 300,
	//            'accessLogic' => function ($page) {
	//                return $page->isActive();
	//		      },
	//            'pages'       => [
	//
    //                // ...
	//
    //            ]
	//        ]
	//    ]
	// ]
];
