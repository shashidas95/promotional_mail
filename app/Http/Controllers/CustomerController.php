<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Mail\PromotionalEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{
    public function ListCustomer()
    {
        return $customers = Customer::all();
    }

    public function CreateCustomer(CustomerRequest $request)
    {
        try {
            $customer = Customer::create($request->validated());
            return response()->json([
                'status' => 'success',
                'message' => "UserRegistration successful"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => "UserRegistration failed"
            ], 401);
        }
    }
    public function UpdateCustomer(CustomerRequest $request, Customer $customer)
    {
        try {
            $customer->update($request->validated());
            return response()->json([
                'status' => 'success',
                'message' => "UpdateCustomer successful"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => "UpdateCustomer failed"
            ], 401);
        }
    }

    public function DeleteCustomer(Customer $customer)
    {
        $customer->delete();
    }

    public function sendPromotionalEmails()
    {
        try {
            $customers = Customer::all();

            // Send the promotional email to each customer
            foreach ($customers as $customer) {
                Mail::to($customer->email)->send(new PromotionalEmail('shashi'));
            }
            return response()->json([
                'status' => 'success',
                'message' => "Sent Email successful"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => "sent email failed"
            ], 401);
        }
        // Fetch all customers from the customers table


    }
}
