<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use App\Order;
use App\OrderDetail;
use App\Payment;
use App\Product;
use App\Shipping;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use ReCaptcha\ReCaptcha;
use Illuminate\Validation;
use App\Rules\RegisterCustomerCaptcha;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    private $slider;
    private $category;
    private $product;
    private $customer;
    private $shipping;

    public function __construct(Slider $slider, Category $category, Product $product, Customer $customer, Shipping $shipping)
    {
        $this->slider = $slider;
        $this->category = $category;
        $this->product = $product;
        $this->customer = $customer;
        $this->shipping = $shipping;
    }

    public function index()
    {
        $sliders = $this->slider->latest()->get();
        $categorys = $this->category->where('parent_id', 0)->get();
        $products = $this->product->latest()->take(6)->get();
        $productsRecommend = $this->product->latest('views_count', 'desc')->take(9)->get();
        $categoryLimits = $this->category->where('parent_id', 0)->take(3)->get();
        //Lấy số lượng sản phẩm đã thêm để hiển thị lên thẻ cart
        if (session()->get('cart') != null) {
            $cartsNumber = count(session()->get('cart'));
        } else {
            $cartsNumber = 0;
        }

        return view('frontend.home.home', compact('sliders', 'categorys', 'products', 'productsRecommend', 'categoryLimits', 'cartsNumber'));
    }

    //front-end
    public function selectcategory($slug, $categoryId)
    {
        $sliders = $this->slider->latest()->get();
        $categorys = $this->category->where('parent_id', 0)->get();
        $categoryLimits = $this->category->where('parent_id', 0)->take(3)->get();
        $products = $this->product->where('category_id', $categoryId)->paginate(9);
        //Lấy số lượng sản phẩm đã thêm để hiển thị lên thẻ cart
        if (session()->get('cart') != null) {
            $cartsNumber = count(session()->get('cart'));
        } else {
            $cartsNumber = 0;
        }

        return view('frontend.product.category.list', compact('sliders', 'categorys', 'categoryLimits', 'products', 'categoryId', 'cartsNumber'));
    }

    //front-end
    public function addToCart($id)
    {
//        session()->flush('cart'); //xoa session
        $product = $this->product->find($id);
        $cart = session()->get('cart'); // lấy giá trị trong session để thêm quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->feature_image_path
            ];
        }
        // Tạo session với key => value
        session()->put('cart', $cart);

        //Lấy số lượng sản phẩm đã thêm để hiển thị lên thẻ cart
        $cartsNumber = count(session()->get('cart'));

        //sau khi tạo xong session thì return cho ajax thông báo cho người dùng
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'cartNumber' => $cartsNumber
        ], 200);
    }

    public function showCart()
    {
        $categorys = $this->category->where('parent_id', 0)->get();
        $categoryLimits = $this->category->where('parent_id', 0)->take(3)->get();
        $carts = session()->get('cart');
        //Lấy số lượng sản phẩm đã thêm để hiển thị lên thẻ cart
        if (session()->get('cart') != null) {
            $cartsNumber = count(session()->get('cart'));
        } else {
            $cartsNumber = 0;
        }

        return view('frontend.product.cart.cart', compact('categorys', 'categoryLimits', 'carts', 'cartsNumber'));
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $carts = session()->get('cart'); //lay session
            $carts[$request->id]['quantity'] = $request->quantity; //update dung key value tuong ung
            session()->put('cart', $carts); // update lai session
            $carts = session()->get('cart');
            $cart_component = view('frontend.product.cart.component.cart_component', compact('carts'))->render(); //dung render ra html (json)
            return response()->json([
                'cart_component' => $cart_component,
                'code' => 200
            ], 200);
        }
    }

    public function deleteCart($id)
    {
        $carts = session()->get('cart'); //lay session
        unset($carts[$id]);
        session()->put('cart', $carts); // update lai session
        $carts = session()->get('cart');
        //Lấy số lượng sản phẩm đã thêm để hiển thị lên thẻ cart
        $cartsNumber = count(session()->get('cart'));
        $cart_component = view('frontend.product.cart.component.cart_component', compact('carts'))->render(); //dung render ra html (json)
        return response()->json([
            'cart_component' => $cart_component,
            'code' => 200,
            'cartNumber' => $cartsNumber
        ], 200);
    }

    public function detailsProduct($id)
    {
        $categorys = $this->category->where('parent_id', 0)->get();
        $categoryLimits = $this->category->where('parent_id', 0)->take(3)->get();
        //Lấy số lượng sản phẩm đã thêm để hiển thị lên thẻ cart
        if (session()->get('cart') != null) {
            $cartsNumber = count(session()->get('cart'));
        } else {
            $cartsNumber = 0;
        }
        $product = $this->product->find($id);

        return view('frontend.product.details.details', compact('categorys', 'categoryLimits', 'cartsNumber', 'product'));
    }

    public function loginCheckout()
    {
        $categorys = $this->category->where('parent_id', 0)->get();
        $categoryLimits = $this->category->where('parent_id', 0)->take(3)->get();
        //Lấy số lượng sản phẩm đã thêm để hiển thị lên thẻ cart
        if (session()->get('cart') != null) {
            $cartsNumber = count(session()->get('cart'));
        } else {
            $cartsNumber = 0;
        }
        return view('frontend.product.checkout.logincheckout', compact('categorys', 'categoryLimits', 'cartsNumber'));
    }

    public function addCustomer(Request $request)
    {


        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'g-recaptcha-response' => new RegisterCustomerCaptcha()

        ]);

        $customer_id = $this->customer->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
        ])->id;

        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $data['name']);


        return redirect()->route('product.checkout');

    }

    public function checkout()
    {
        $categorys = $this->category->where('parent_id', 0)->get();
        $categoryLimits = $this->category->where('parent_id', 0)->take(3)->get();
        if (session()->get('cart') != null) {
            $cartsNumber = count(session()->get('cart'));
        } else {
            $cartsNumber = 0;
        }
        return view('frontend.product.checkout.checkout', compact('categoryLimits', 'categorys','cartsNumber'));
    }

    public function savecheckoutcustomer(Request $request)
    {
        try {
            DB::beginTransaction();
            $shipping_id = $this->shipping->create([
                'email' => $request->email,
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'note' => $request->note,
                'customer_id' => Session::get('customer_id')
            ])->id;

            Session::put('shipping_id', $shipping_id);

            DB::commit();
            return redirect()->route('product.payment');
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();

        }
    }

    public function payment()
    {
        $carts = session()->get('cart');

        $categorys = $this->category->where('parent_id', 0)->get();
        $categoryLimits = $this->category->where('parent_id', 0)->take(3)->get();
        return view('frontend.product.checkout.payment', compact('categorys', 'categoryLimits', 'carts'));
    }

    public function logoutCheckout()
    {
        Session::flush();
        return redirect()->route('home');
    }

    public function loginCustomer(Request $request)
    {
        $result = $this->customer->where('email', $request->email)->first();

        if (!empty($result) && Hash::check($request->password, $result->password)) {
            Session::put('customer_id', $result->id);
            return redirect()->route('product.checkout');
        } else {
            return redirect()->back()->with('message_login', 'Sai thông tin tài khoản hoặc mật khẩu');
        }
    }

    public function orderPlace(Request $request)
    {
        try {
            DB::beginTransaction();
            //Insert payment
            $payment = Payment::create([
                'payment_method' => $request->payment_method,
                'payment_status' => 'Đang chờ xử lý'
            ]);

            //Insert Order
            $order = Order::create([
                'customer_id' => Session::get('customer_id'),
                'shipping_id' => Session::get('shipping_id'),
                'payment_id' => $payment->id,
                'order_total' => $request->cart_total,
                'order_status' => 'Đang chờ xử lý',
            ]);

            $carts = session()->get('cart');
            foreach ($carts as $key => $value) {
                //Insert OrderDetail
                $order_detail = OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $key,
                    'product_name' => $value['name'],
                    'product_price' => $value['price'],
                    'product_sales_quantity' => $value['quantity'],
                ]);
            }
            DB::commit();
            Session::forget('cart');
//            Session::forget('shipping_id');
            $categorys = $this->category->where('parent_id', 0)->get();
            $categoryLimits = $this->category->where('parent_id', 0)->take(3)->get();
            return view('frontend.product.checkout.thanks', compact('categorys', 'categoryLimits'));
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();

        }
    }
}
