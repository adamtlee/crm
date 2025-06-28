<?php

namespace App\Filament\Resources\MembershipResource\Pages;

use App\Filament\Resources\MembershipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMemberships extends ListRecords
{
    protected static string $resource = MembershipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('export')
                ->label('Export CSV')
                ->color('success')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () {
                    $memberships = \App\Models\Membership::all();
                    
                    $filename = 'memberships-' . now()->format('Y-m-d-H-i-s') . '.csv';
                    
                    $headers = [
                        'Content-Type' => 'text/csv',
                        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                    ];
                    
                    $callback = function() use ($memberships) {
                        $file = fopen('php://output', 'w');
                        
                        // Add headers
                        fputcsv($file, [
                            'Name',
                            'Description',
                            'Price',
                            'Currency',
                            'Formatted Price',
                            'Created At',
                            'Updated At'
                        ]);
                        
                        // Add data
                        foreach ($memberships as $membership) {
                            fputcsv($file, [
                                $membership->name,
                                $membership->description,
                                $membership->price,
                                $membership->currency,
                                $membership->formatted_price,
                                $membership->created_at,
                                $membership->updated_at
                            ]);
                        }
                        
                        fclose($file);
                    };
                    
                    return response()->stream($callback, 200, $headers);
                }),
        ];
    }
}
