<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
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
    public function createCustomer(Request $request): JsonResponse
    {

        $request_data = $request->all();

        $validator = Validator::make($request_data, [
            'name' => 'required',
            'firstname' => 'required',
            'phone' => 'required',
            'sex' => 'required',
            'user_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Invalid Inputs',
                'error' => $validator->errors()
            ]);
        }

        $user = User::where('id', strval($request_data['user_id']))->exists();

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'Invalid user id',
            ]);
        }

        $customersPhonesList = Customer::where('user_id', strval($request_data['user_id']))->pluck('phone');

        foreach ($customersPhonesList as $phone) {
            if ($phone === strval($request_data['phone'])) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Un client existe déjà avec ce numéro',
                    'customer' => Customer::where('phone', strval($request_data['phone']))->first(),
                    'total_customers' => count(Customer::all())
                ]);
            }
        }

        $customer = new Customer();

        $customer->id = Str::uuid();
        $customer->name = strval($request_data['name']);
        $customer->firstname = strval($request_data['firstname']);
        $customer->phone = strval($request_data['phone']);
        $customer->sex = boolval($request_data['sex']);
        $customer->user_id = strval($request_data['user_id']);
        $customer->save();

        return response()->json([
            'status' => 200,
            'customer' => $customer,
            'total_customers' => count(Customer::all())
        ]);
    }

    public function showCustomer(string $id): JsonResponse
    {
        $customerId = htmlspecialchars(trim(strval($id)));
        $checkForCustomer = Customer::where('id', $customerId)->exists();
        if (!$checkForCustomer) {
            return response()->json([
                'status' => 404,
                'message' => 'Customer not found',
            ]);
        }
        return response()->json([
            'status' => 200,
            'customer' => Customer::where('id', $customerId)->first(),
            'total_customers' => count(Customer::all())
        ]);
    }
    public function editCustomerProfil(Request $request, string $id): JsonResponse
    {
        $request_data = $request->all();

        $validator = Validator::make($request_data, [
            'name' => 'required',
            'firstname' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'sex' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Invalid Inputs',
                'error' => $validator->errors()
            ]);
        }
        $customerId = htmlspecialchars(trim(strval($id)));
        /** @var Customer */
        $customer = Customer::where('id', $customerId)->exists();
        if ($customer == false) {
            abort(404);
        }
        /** @var Customer */
        $customerDetails = Customer::where('id', $customerId)->first();
        if ($customerDetails instanceof Customer) {
            $customerDetails->name = strval($request_data['name']);
            $customerDetails->firstname = strval($request_data['firstname']);
            $customerDetails->phone = strval($request_data['phone']);
            $customerDetails->address = strval($request_data['address']);
            $customerDetails->sex = boolval($request_data['sex']);
            $customerDetails->save();

            return response()->json([
                'status' => 200,
                'customer' => $customerDetails,
                'total_customers' => count(Customer::all())
            ]);
        }
    }
}
