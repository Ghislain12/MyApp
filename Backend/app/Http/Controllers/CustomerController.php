<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    // Get all customers

    public function index(): JsonResponse
    {
        /** @var Customer */
        $customers = Customer::all();
        if ($customers->count() < 0) {
            abort(404);
        }
        return response()->json([
            'customers' => $customers,
            'status' => 200,
            'total_customers' => $customers->count()
        ]);
    }

    public function getUserCustomers(string $id): JsonResponse
    {
        $userId = htmlspecialchars(trim(strval($id)));
        $checkUser = User::where('id', $userId)->exists();
        if (!$checkUser) {
            abort(404);
        } else {
            $checkCustomers = Customer::where('user_id', $userId)->exists();
            $customerList = Customer::where('user_id', $userId)->get();
            if ($checkCustomers) {
                return response()->json([
                    'status' => 200,
                    'customers' => $customerList,
                    'total_customers' => $customerList->count()
                ]);
            } else {
                abort(404);
            }
        }
    }
    public function editCustomerProfil(Request $request, string $id)
    {
        $validator = Validator::make($request, [
            'name' => 'required',
            'firstname' => 'required',
            'phone' => 'required',
            'sex' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Inputs',
                'error' => $validator->errors()
            ]);
        }
        $customerId = htmlspecialchars(trim(strval($id)));
        /** @var Customer */
        $customer = Customer::where('id', $customerId)->exists();

        if ($customer) {
            $customerDetails = Customer::where('id', $customerId)->get();
            if ($customerDetails instanceof Customer) {
                $customerDetails->name = $request['name'];
                $customerDetails->firstname = $request['firstname'];
                $customerDetails->phone = $request['phone'];
                $customerDetails->address = $request['address'];
                $customerDetails->sex = $request['sex'];

                return response()->json([
                    'status' => 200,
                    'customer' => $customerDetails,
                    'total_customers' => Customer::all()->count()
                ]);
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }
}
