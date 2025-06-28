<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEvents extends ListRecords
{
    protected static string $resource = EventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('export')
                ->label('Export CSV')
                ->color('success')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () {
                    $events = \App\Models\Event::with('location')->get();
                    
                    $filename = 'events-' . now()->format('Y-m-d-H-i-s') . '.csv';
                    
                    $headers = [
                        'Content-Type' => 'text/csv',
                        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                    ];
                    
                    $callback = function() use ($events) {
                        $file = fopen('php://output', 'w');
                        
                        // Add headers
                        fputcsv($file, [
                            'Name',
                            'Duration',
                            'Date Time',
                            'Location',
                            'Type',
                            'Participant Count',
                            'Instructor Count',
                            'Created At',
                            'Updated At'
                        ]);
                        
                        // Add data
                        foreach ($events as $event) {
                            fputcsv($file, [
                                $event->name,
                                $event->duration,
                                $event->date_time,
                                $event->location ? $event->location->name : '',
                                $event->type,
                                $event->participant_count,
                                $event->instructor_count,
                                $event->created_at,
                                $event->updated_at
                            ]);
                        }
                        
                        fclose($file);
                    };
                    
                    return response()->stream($callback, 200, $headers);
                }),
        ];
    }
}
