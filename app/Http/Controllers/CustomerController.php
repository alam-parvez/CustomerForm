<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer_form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|unique:customers|max:10',
            'name' => 'required|string|min:3|max:50',
            'age' => 'required|integer|min:1|max:120',
            'image' => 'required|string'
        ]);

        Log::info('Validation Passed');

        //to check image is received
        if (!$request->image) {
            Log::error('Image data is missing');
            return back()->with('error', 'Image capture failed!');
        }

        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->image));
        $imageName = time() . '.png';
        file_put_contents(public_path('uploads/') . $imageName, $imageData);
        $imagePath = 'uploads/' . $imageName;

        Log::info('Image saved at:' . $imagePath);



        // Store in Database
        Customer::create([
            'customer_id' => $request->customer_id,
            'name' => $request->name,
            'age' => $request->age,
            'image' => $imagePath
        ]);

        Log::info('Customer saved successfully');

        return redirect('/customers/create')->with([
            'success' => 'Customer added successfully!',
            'image' => $imagePath
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
