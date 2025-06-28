<?php

namespace App\Filament\Resources\InstructorResource\Pages;

use App\Filament\Resources\InstructorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInstructors extends ListRecords
{
    protected static string $resource = InstructorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('export')
                ->label('Export CSV')
                ->color('success')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () {
                    $instructors = \App\Models\Instructor::all();
                    
                    $filename = 'instructors-' . now()->format('Y-m-d-H-i-s') . '.csv';
                    
                    $headers = [
                        'Content-Type' => 'text/csv',
                        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                    ];
                    
                    $callback = function() use ($instructors) {
                        $file = fopen('php://output', 'w');
                        
                        // Add headers
                        fputcsv($file, [
                            'First Name',
                            'Last Name', 
                            'Birth Date',
                            'Email Address',
                            'Phone Number',
                            'Specialization',
                            'Created At',
                            'Updated At'
                        ]);
                        
                        // Add data
                        foreach ($instructors as $instructor) {
                            fputcsv($file, [
                                $instructor->first_name,
                                $instructor->last_name,
                                $instructor->birth_date,
                                $instructor->email_address,
                                $instructor->phone_number,
                                $instructor->specialization,
                                $instructor->created_at,
                                $instructor->updated_at
                            ]);
                        }
                        
                        fclose($file);
                    };
                    
                    return response()->stream($callback, 200, $headers);
                }),
        ];
    }
}
