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

    public function exportCsv()
    {
        $invoices = \App\Models\Invoice::with(['member', 'membership', 'event'])->get();
        $csv = '';
        $headers = [
            'Invoice Number', 'Member', 'Membership', 'Event', 'Invoice Date', 'Due Date',
            'Subtotal', 'Tax', 'Discount', 'Total', 'Status', 'Notes', 'Payment Terms'
        ];
        $csv .= implode(',', $headers) . "\n";
        foreach ($invoices as $invoice) {
            $csv .= implode(',', [
                $invoice->invoice_number,
                '"' . ($invoice->member ? $invoice->member->first_name . ' ' . $invoice->member->last_name : '') . '"',
                '"' . ($invoice->membership->name ?? '') . '"',
                '"' . ($invoice->event->name ?? '') . '"',
                $invoice->invoice_date,
                $invoice->due_date,
                $invoice->subtotal,
                $invoice->tax_amount,
                $invoice->discount_amount,
                $invoice->total_amount,
                $invoice->status,
                '"' . str_replace('"', '""', $invoice->notes) . '"',
                '"' . str_replace('"', '""', $invoice->payment_terms) . '"',
            ]) . "\n";
        }
        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="invoices.csv"');
    }
} 