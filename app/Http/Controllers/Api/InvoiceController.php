<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return response()->json([
            'status' => 'success',
            'data' => $invoices
        ]);
    }

    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $invoice
        ]);
    }
} 