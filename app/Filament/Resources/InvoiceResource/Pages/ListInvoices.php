<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInvoices extends ListRecords
{
    protected static string $resource = InvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('export')
                ->label('Export CSV')
                ->color('success')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () {
                    $invoices = \App\Models\Invoice::with(['member', 'membership', 'event'])->get();
                    $filename = 'invoices-' . now()->format('Y-m-d-H-i-s') . '.csv';
                    $headers = [
                        'Content-Type' => 'text/csv',
                        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                    ];
                    $callback = function() use ($invoices) {
                        $file = fopen('php://output', 'w');
                        // Add headers
                        fputcsv($file, [
                            'Invoice Number', 'Member', 'Membership', 'Event', 'Invoice Date', 'Due Date',
                            'Subtotal', 'Tax', 'Discount', 'Total', 'Status', 'Notes', 'Payment Terms'
                        ]);
                        // Add data
                        foreach ($invoices as $invoice) {
                            fputcsv($file, [
                                $invoice->invoice_number,
                                $invoice->member ? $invoice->member->first_name . ' ' . $invoice->member->last_name : '',
                                $invoice->membership->name ?? '',
                                $invoice->event->name ?? '',
                                $invoice->invoice_date,
                                $invoice->due_date,
                                $invoice->subtotal,
                                $invoice->tax_amount,
                                $invoice->discount_amount,
                                $invoice->total_amount,
                                $invoice->status,
                                $invoice->notes,
                                $invoice->payment_terms,
                            ]);
                        }
                        fclose($file);
                    };
                    return response()->stream($callback, 200, $headers);
                }),
        ];
    }
}
