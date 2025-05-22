<?php

namespace App\Actions\Dashboard;

use App\Models\Customer;
use Illuminate\Http\Request;

class CreateCustomer
{
    public function handle(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'email'   => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ]);

        return Customer::create($validated);
    }
}
