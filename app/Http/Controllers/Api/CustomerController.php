<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function login(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);

            $customer = Customer::where('email', $data['email'])->first();

            if (!empty($customer) && Hash::check($data['password'], $customer->password)) {
                return response()->json([
                    "code" => 200,
                    "message" => "Đăng nhập thành công",
                    "customer"=> $customer
                ], 200);
            } else {
                return response()->json([
                    "code" => 501,
                    "message" => "Sai thông tin tài khoản hoặc mật khẩu"
                ], 501);
            }       
        } catch (\Exception $exception) {
            Log::error('Lỗi', $exception->getMessage() . '--- Line' . $exception->getLine());
        }
    }
}
