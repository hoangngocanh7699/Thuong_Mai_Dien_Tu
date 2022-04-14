<?php

namespace App\Http\Controllers;

use App\Compoments\MenuRecusive;
use App\Http\Requests\MenuAddRequest;
use App\Menu;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    use DeleteModelTrait;

    private $menuRecusive;
    private $menu;

    public function __construct(MenuRecusive $menuRecusive, Menu $menu)
    {
        $this->menuRecusive = $menuRecusive;
        $this->menu = $menu;
    }

    public function index()
    {
        $data = $this->menu->paginate(5);
        return view('admin.menus.index', compact('data'));
    }

    public function create()
    {
        $selectOption = $this->menuRecusive->menuRecusiveAdd();
        return view('admin.menus.add', compact('selectOption'));
    }

    public function store(MenuAddRequest $request)
    {
        $this->menu->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name)
        ]);
        return redirect()->route('menus.index');
    }

    public function edit($id, Request $request)
    {
        $menuFollowEdit = $this->menu->find($id);
        $selectOption = $this->menuRecusive->menuRecusiveEdit($menuFollowEdit->parent_id);
        return view('admin.menus.edit', compact('selectOption', 'menuFollowEdit'));
    }

    public function update($id, MenuAddRequest $request)
    {
        $this->menu->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name)
        ]);

        return redirect()->route('menus.index');
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->menu);
    }
}
