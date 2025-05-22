<?php

namespace App\Actions\Dashboard;

use App\Models\Invoice;
use Illuminate\Http\Request;

class CreateInvoice
{
    public function handle(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'date'        => 'required|date',
            'amount'      => 'required|numeric|min:0',
            'status'      => 'required|in:paid,unpaid,cancelled',
        ]);

        return Invoice::create($validated);
    }
}
