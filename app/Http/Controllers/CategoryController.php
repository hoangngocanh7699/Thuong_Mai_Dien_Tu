<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryAddRequest;
use App\Product;
use App\Slider;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use App\Compoments\Recusive;

class CategoryController extends Controller
{
    use DeleteModelTrait;

    private $category;

    public function __construct(Category $category, Slider $slider, Product $product)
    {
        $this->category = $category;
        $this->slider = $slider;
        $this->product = $product;
    }

    public function create()
    {
        $htmlOption = $this->getcategory($parent_id = '');
        return view('admin.category.add', compact('htmlOption'));
    }

    public function getcategory($parent_id)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parent_id);

        return $htmlOption;
    }


    public function index()
    {
        $data = $this->category->latest()->paginate(5);
        return view('admin.category.index', compact('data'));
    }

    public function store(CategoryAddRequest $request)
    {
        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name)//dùng để chèn các khoảng trống trong name thành dấu gạch ngang
        ]);
        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = $this->category->find($id);
        $htmlOption = $this->getcategory($category->parent_id);

        return view('admin.category.edit', compact('category', 'htmlOption'));
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->category);
    }

    public function update($id, CategoryAddRequest $request)
    {
        $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name)
        ]);

        return redirect()->route('categories.index');
    }
}
