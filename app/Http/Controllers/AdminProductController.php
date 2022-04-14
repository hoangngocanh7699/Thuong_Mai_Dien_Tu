<?php

namespace App\Http\Controllers;

use App\Category;
use App\Compoments\Recusive;
use App\Http\Requests\ProductAddRequest;
use App\Product;
use App\ProductImage;
use App\ProductTag;
use App\Tag;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageStrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Storage;
use DB;

class AdminProductController extends Controller
{
    use StorageImageStrait;
    use DeleteModelTrait;

    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;
    private $recusive;


    public function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag, ProductTag $productTag)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;

        $data = $this->category->all();
        $this->recusive = new Recusive($data);
    }

    //Trả về html view hiển thị danh sách Product
    public function index()
    {
        $product = $this->product->latest()->paginate(20);
        return view('admin.product.index', compact('product'));
    }
    //Trả về html view hiển thị trang thêm Product
    public function create()
    {
        $htmlOption = $this->getcategory($parent_id = '');
        return view('admin.product.add', compact('htmlOption'));
    }
    //Bỏ
    public function getcategory($parent_id)
    {
        $htmlOption = $this->recusive->categoryRecusive($parent_id);
        return $htmlOption;
    }
    //Nhận vào request các thông tin sản phẩm
    //Sau khi thêm sản phẩm trả về html view index ở trên
    public function store(ProductAddRequest $request)
    {
        try {

            DB::beginTransaction();
            //Insert data to products
            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];


            $dataUploadfeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');


            if (!empty($dataUploadfeatureImage)) {
                $dataProductCreate['feature_image_name'] = $dataUploadfeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadfeatureImage['file_path'];
            }
            $product = $this->product->create($dataProductCreate);


            //Insert data to product_images
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultipe($fileItem, 'product');

                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }

            //Insert tags for product
            if (!empty($request->tags)) {
                foreach ($request->tags as $tag) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tag]);

                    $tagId[] = $tagInstance->id;
                }
                $product->tags()->attach($tagId);
            }
            DB::commit();

            //Sau khi thêm sản phẩm xong quay lại trang danh sách sản phẩm
            return redirect()->route('product.index');
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();

        }
    }
    //Nhận vào id sản phẩm được sửa
    //Hiển thị trang edit có thông tin tương ứng với id
    public function edit($id)
    {
        $product = $this->product->find($id);
        $htmlOption = $this->recusive->categoryRecusive($parent_id = $product->category_id);
        return view('admin.product.edit', compact('htmlOption', 'product'));
    }
    //Cập nhật thông tin sp mới từ request gửi lên với id
    //Sau khi sửa thành công trả về html view index
    public function update(ProductAddRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            //Update data to products
            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadfeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');

            if (!empty($dataUploadfeatureImage)) {
                $dataProductUpdate['feature_image_name'] = $dataUploadfeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadfeatureImage['file_path'];
            }

            $this->product->find($id)->update($dataProductUpdate);
            $product = $this->product->find($id);

            //Update data to product_images
            $this->productImage->where('product_id', $id)->delete();
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultipe($fileItem, 'product');

                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }
            //Update tags for product
            if (!empty($request->tags)) {
                foreach ($request->tags as $tag) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tag]);
                    $tagId[] = $tagInstance->id;
                }
                $product->tags()->sync($tagId);
            }

            DB::commit();

            //Sau khi thêm sản phẩm xong quay lại trang danh sách sản phẩm
            return redirect()->route('product.index');
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
            return redirect()->route('product.create');
        }
    }
    //Xóa sản phẩm theo id được truyền vào
    //Trả về json 200 (success) cho ajax nếu xóa thành công
    //Trả về json 200 (fail) cho ajax nếu xóa không thành công
    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->product);
    }
}
