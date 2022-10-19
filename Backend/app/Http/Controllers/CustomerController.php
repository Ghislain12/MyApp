<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
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
}
