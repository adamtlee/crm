<?php

namespace App\Filament\Resources\ProspectResource\Pages;

use App\Filament\Resources\ProspectResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProspects extends ListRecords
{
    protected static string $resource = ProspectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('export')
                ->label('Export CSV')
                ->color('success')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () {
                    $prospects = \App\Models\Prospect::all();
                    
                    $filename = 'prospects-' . now()->format('Y-m-d-H-i-s') . '.csv';
                    
                    $headers = [
                        'Content-Type' => 'text/csv',
                        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                    ];
                    
                    $callback = function() use ($prospects) {
                        $file = fopen('php://output', 'w');
                        
                        // Add headers
                        fputcsv($file, [
                            'First Name',
                            'Last Name',
                            'Email Address',
                            'Phone Number',
                            'Description',
                            'Created At',
                            'Updated At'
                        ]);
                        
                        // Add data
                        foreach ($prospects as $prospect) {
                            fputcsv($file, [
                                $prospect->first_name,
                                $prospect->last_name,
                                $prospect->email_address,
                                $prospect->phone_number,
                                $prospect->description,
                                $prospect->created_at,
                                $prospect->updated_at
                            ]);
                        }
                        
                        fclose($file);
                    };
                    
                    return response()->stream($callback, 200, $headers);
                }),
        ];
    }
}
