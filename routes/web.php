<?php
//front-end
Route::get('/', 'HomeController@index')->name('home');

Route::get('/category/{slug}/{id}', [
    'as' => 'category.product',
    'uses' => 'HomeController@selectcategory'
]);

Route::get('/add-to-cart/{id}', [
    'as' => 'product.addToCart',
    'uses' => 'HomeController@addToCart',
]);

Route::get('/show-cart', [
    'as' => 'product.showCart',
    'uses' => 'HomeController@showCart',
]);

Route::get('/update-cart', [
    'as' => 'product.updateCart',
    'uses' => 'HomeController@updateCart',
]);

Route::get('/delete-cart/{id}', [
    'as' => 'product.deleteCart',
    'uses' => 'HomeController@deleteCart',
]);

Route::get('/details-product/{id}', [
    'as' => 'product.detailsProduct',
    'uses' => 'HomeController@detailsProduct',
]);
Route::get('/login-checkout', [
    'as' => 'product.loginCheckout',
    'uses' => 'HomeController@loginCheckout',
]);
Route::get('/logout-checkout', [
    'as' => 'product.logoutCheckout',
    'uses' => 'HomeController@logoutCheckout',
]);
Route::post('/add-customer', [
    'as' => 'product.addCustomer',
    'uses' => 'HomeController@addCustomer',
]);
Route::get('/checkout', [
    'as' => 'product.checkout',
    'uses' => 'HomeController@checkout',
]);
Route::post('/save-checkout-customer', [
    'as' => 'product.savecheckoutcustomer',
    'uses' => 'HomeController@savecheckoutcustomer',
]);
Route::get('/payment', [
    'as' => 'product.payment',
    'uses' => 'HomeController@payment',
]);
Route::post('/login-customer', [
    'as' => 'product.loginCustomer',
    'uses' => 'HomeController@loginCustomer',
]);
Route::post('/order-place', [
    'as' => 'product.orderPlace',
    'uses' => 'HomeController@orderPlace',
]);


//back-end
Route::get('/admin', 'AdminController@loginAdmin');
Route::post('/admin', 'AdminController@postloginAdmin');

Route::get('/home', function () {
    return view('home');
});

Route::prefix('admin')->group(function () {

    Route::get('/', [
        'as' => 'logout.logout',
        'uses' => 'AdminController@logout'
    ]);
    //Categorys
    Route::prefix('categories')->group(function () {
        Route::get('/', [
            'as' => 'categories.index',
            'uses' => 'CategoryController@index',
            'middleware' => 'can:category-list'
        ]);
        Route::get('/create', [
            'as' => 'categories.create',
            'uses' => 'CategoryController@create',
            'middleware' => 'can:category-add'
        ]);
        Route::post('/store', [
            'as' => 'categories.store',
            'uses' => 'CategoryController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'categories.edit',
            'uses' => 'CategoryController@edit',
            'middleware' => 'can:category-edit'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'categories.delete',
            'uses' => 'CategoryController@delete',
            'middleware' => 'can:category-delete'
        ]);

        Route::post('/update/{id}', [
            'as' => 'categories.update',
            'uses' => 'CategoryController@update'
        ]);
    });

    //Menus
    Route::prefix('menus')->group(function () {
        Route::get('/', [
            'as' => 'menus.index',
            'uses' => 'MenuController@index',
            'middleware' => 'can:menu-list'
        ]);

        Route::get('/create', [
            'as' => 'menus.create',
            'uses' => 'MenuController@create',
            'middleware' => 'can:menu-add'
        ]);
        Route::post('/store', [
            'as' => 'menus.store',
            'uses' => 'MenuController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'menus.edit',
            'uses' => 'MenuController@edit',
            'middleware' => 'can:menu-edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'menus.update',
            'uses' => 'MenuController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'menus.delete',
            'uses' => 'MenuController@delete',
            'middleware' => 'can:menu-delete'
        ]);

    });

    //Products
    Route::prefix('products')->group(function () {
        Route::get('/search', [
            'as' => 'product.searchbar',
            'uses' => 'Search\ProductSearchBar@ProductSearch',
        ]);
        Route::get('/', [
            'as' => 'product.index',
            'uses' => 'AdminProductController@index',
            'middleware' => 'can:product-list'
        ]);

        Route::get('/create', [
            'as' => 'product.create',
            'uses' => 'AdminProductController@create',
            'middleware' => 'can:product-add'
        ]);

        Route::post('/store', [
            'as' => 'product.store',
            'uses' => 'AdminProductController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'product.edit',
            'uses' => 'AdminProductController@edit',
            'middleware' => 'can:product-edit,id'
        ]);

        Route::post('/update/{id}', [
            'as' => 'product.update',
            'uses' => 'AdminProductController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'product.delete',
            'uses' => 'AdminProductController@delete',
            'middleware' => 'can:product-delete'
        ]);
    });

    //Sliders
    Route::prefix('sliders')->group(function () {
        Route::get('/', [
            'as' => 'slider.index',
            'uses' => 'AdminSliderController@index',
            'middleware' => 'can:slider-list'
        ]);

        Route::get('/create', [
            'as' => 'slider.create',
            'uses' => 'AdminSliderController@create',
            'middleware' => 'can:slider-add'
        ]);

        Route::post('/store', [
            'as' => 'slider.store',
            'uses' => 'AdminSliderController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'slider.edit',
            'uses' => 'AdminSliderController@edit',
            'middleware' => 'can:slider-edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'slider.update',
            'uses' => 'AdminSliderController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'slider.delete',
            'uses' => 'AdminSliderController@delete',
            'middleware' => 'can:slider-delete'
        ]);

    });

    //Settings
    Route::prefix('settings')->group(function () {
        Route::get('/', [
            'as' => 'setting.index',
            'uses' => 'AdminSettingController@index',
            'middleware' => 'can:setting-list'
        ]);
        Route::get('/create', [
            'as' => 'setting.create',
            'uses' => 'AdminSettingController@create',
            'middleware' => 'can:setting-add'
        ]);

        Route::post('/store', [
            'as' => 'setting.store',
            'uses' => 'AdminSettingController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'setting.edit',
            'uses' => 'AdminSettingController@edit',
            'middleware' => 'can:setting-edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'setting.update',
            'uses' => 'AdminSettingController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'setting.delete',
            'uses' => 'AdminSettingController@delete',
            'middleware' => 'can:setting-delete'
        ]);

    });

    //Users
    Route::prefix('users')->group(function () {
        Route::get('/', [
            'as' => 'users.index',
            'uses' => 'AdminUserController@index',
            'middleware' => 'can:user-list'
        ]);

        Route::get('/create', [
            'as' => 'users.create',
            'uses' => 'AdminUserController@create',
            'middleware' => 'can:user-add'
        ]);

        Route::post('/store', [
            'as' => 'users.store',
            'uses' => 'AdminUserController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'users.edit',
            'uses' => 'AdminUserController@edit',
            'middleware' => 'can:user-edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'users.update',
            'uses' => 'AdminUserController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'users.delete',
            'uses' => 'AdminUserController@delete',
            'middleware' => 'can:user-delete'
        ]);

    });

    //Roles
    Route::prefix('roles')->group(function () {
        Route::get('/', [
            'as' => 'roles.index',
            'uses' => 'AdminRoleController@index',
            'middleware' => 'can:role-list'
        ]);

        Route::get('/create', [
            'as' => 'roles.create',
            'uses' => 'AdminRoleController@create',
            'middleware' => 'can:role-add'
        ]);

        Route::post('/store', [
            'as' => 'roles.store',
            'uses' => 'AdminRoleController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'roles.edit',
            'uses' => 'AdminRoleController@edit',
            'middleware' => 'can:role-edit'
        ]);

        Route::post('/update/{id}', [
            'as' => 'roles.update',
            'uses' => 'AdminRoleController@update'
        ]);

//        Route::get('/delete/{id}', [
//            'as' => 'roles.delete',
//            'uses' => 'AdminRoleController@delete'
//        ]);

    });

    //Permission
    Route::prefix('permissions')->group(function () {
        Route::get('/create', [
            'as' => 'permissions.create',
            'uses' => 'AdminPermissionController@createPermissions',
            'middleware' => 'can:permission-list'
        ]);

        Route::post('/store', [
            'as' => 'permissions.store',
            'uses' => 'AdminPermissionController@store'
        ]);
    });

    //Order
    Route::prefix('order')->group(function () {
        Route::get('/', [
            'as' => 'order.index',
            'uses' => 'AdminOrderController@index',
            'middleware' => 'can:order-list'
        ]);

        Route::get('/view/{id}', [
            'as' => 'order.view',
            'uses' => 'AdminOrderController@view',
            'middleware' => 'can:order-view'
        ]);
        Route::get('/checked_status/{id}', [
            'as' => 'order.checked_status',
            'uses' => 'AdminOrderController@checked_status'
        ]);

    });


});


