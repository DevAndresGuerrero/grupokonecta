<?php

namespace App\Http\Controllers\Api\V1;

use Validator;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerCollection;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Customer::class);

        return CustomerCollection::make(Customer::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('view', Customer::class);

        $validator = Validator::make($request->all(), [
            'name' => ['required','string','between:2,100'],
            'email' => ['required','string','email','max:100','unique:customers'],
            'address' => ['required','string','between:2,100'],
            'document' => ['required','string','between:2,100'],
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $customer = Customer::create($validator->validated());

        return response()->json([
            'message' => 'Customer successfully updated',
            'data' => $customer
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $this->authorize('view', $customer);

        return CustomerResource::make($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->authorize('view', $customer);

        $validator = Validator::make($request->all(), [
            'name' => ['required','string','between:2,100'],
            'email' => ['required','string','email','max:100','unique:customers,id,'.$customer->id],
            'address' => ['required','string','between:2,100'],
            'document' => ['required','string','between:2,100'],
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $customer->fill($validator->validated())->save();

        return response()->json([
            'message' => 'Customer successfully updated',
            'data' => $customer
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $this->authorize('view', $customer);

        $customer->delete();
        return response()->json(['message' => 'Customer successfully deleted'], 201);
    }
}
