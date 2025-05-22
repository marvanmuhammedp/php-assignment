<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;

class InvoiceController extends Controller
{
     public function index()
    {
        $invoices = Invoice::with('customer')->get();
        
        return response()->json([
            'status' => 'success',
            'data' => $invoices
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:unpaid,paid,cancelled',
        ]);

        $invoice = Invoice::create($validated);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Invoice created successfully',
            'data' => $invoice
        ], 201);
    }
}
