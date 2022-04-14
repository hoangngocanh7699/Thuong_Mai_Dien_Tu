<?php

namespace App\Services;

use App\Product;
use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicyAccess
{

    public function setGateAndPolicyAccess()
    {
        $this->defineGateCategory();
        $this->defineGateProduct();
        $this->defineGateMenu();
        $this->defineGateSlider();
        $this->defineGateSetting();
        $this->defineGateUser();
        $this->defineGatePermission();
        $this->defineGateRole();
        $this->defineGateOrder();
    }

    private function defineGateCategory()
    {
        Gate::define('category-list', 'App\Policies\CategoryPolicy@view');
        Gate::define('category-add', 'App\Policies\CategoryPolicy@create');
        Gate::define('category-edit', 'App\Policies\CategoryPolicy@update');
        Gate::define('category-delete', 'App\Policies\CategoryPolicy@delete');
    }

    private function defineGateProduct()
    {
        Gate::define('product-list', function ($user) {
            return $user->checkPermissionAccess('product-list');
        });

        Gate::define('product-add', function ($user) {
            return $user->checkPermissionAccess('product-add');
        });


        Gate::define('product-edit', function ($user, $id) {
            $product = Product::find($id);
            if ($user->checkPermissionAccess('product-edit' && $product->user_id === $user->id)) {
                return true;
            }
            return false;

        });

        Gate::define('product-delete', function ($user) {
            return $user->checkPermissionAccess('product-delete');
        });
    }

    private function defineGateMenu()
    {
        Gate::define('menu-list', function ($user) {
            return $user->checkPermissionAccess('menu-list');
        });

        Gate::define('menu-add', function ($user) {
            return $user->checkPermissionAccess('menu-add');
        });

        Gate::define('menu-edit', function ($user) {
            return $user->checkPermissionAccess('menu-edit');
        });

        Gate::define('menu-delete', function ($user) {
            return $user->checkPermissionAccess('menu-delete');
        });
    }

    private function defineGateSlider()
    {
        Gate::define('slider-list', function ($user) {
            return $user->checkPermissionAccess('slider-list');
        });

        Gate::define('slider-add', function ($user) {
            return $user->checkPermissionAccess('slider-add');
        });

        Gate::define('slider-edit', function ($user) {
            return $user->checkPermissionAccess('slider-edit');
        });

        Gate::define('slider-delete', function ($user) {
            return $user->checkPermissionAccess('slider-delete');
        });
    }

    private function defineGateSetting()
    {
        Gate::define('setting-list', function ($user) {
            return $user->checkPermissionAccess('setting-list');
        });

        Gate::define('setting-add', function ($user) {
            return $user->checkPermissionAccess('setting-add');
        });

        Gate::define('setting-edit', function ($user) {
            return $user->checkPermissionAccess('setting-edit');
        });

        Gate::define('setting-delete', function ($user) {
            return $user->checkPermissionAccess('setting-delete');
        });
    }

    private function defineGateUser()
    {
        Gate::define('user-list', function ($user) {
            return $user->checkPermissionAccess('user-list');
        });

        Gate::define('user-add', function ($user) {
            return $user->checkPermissionAccess('user-add');
        });

        Gate::define('user-edit', function ($user) {
            return $user->checkPermissionAccess('user-edit');
        });

        Gate::define('user-delete', function ($user) {
            return $user->checkPermissionAccess('user-delete');
        });
    }

    private function defineGateRole()
    {
        Gate::define('role-list', function ($user) {
            return $user->checkPermissionAccess('role-list');
        });

        Gate::define('role-add', function ($user) {
            return $user->checkPermissionAccess('role-add');
        });

        Gate::define('role-edit', function ($user) {
            return $user->checkPermissionAccess('role-edit');
        });

        Gate::define('role-delete', function ($user) {
            return $user->checkPermissionAccess('role-delete');
        });
    }

    private function defineGatePermission()
    {
        Gate::define('permission-list', function ($user) {
            return $user->checkPermissionAccess('permission-list');
        });
    }

    private function defineGateOrder(){
        Gate::define('order-list', function ($user) {
            return $user->checkPermissionAccess('order-list');
        });
        Gate::define('order-view', function ($user) {
            return $user->checkPermissionAccess('order-view');
        });
    }

}
