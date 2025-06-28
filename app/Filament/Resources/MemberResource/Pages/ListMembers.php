<?php

namespace App\Filament\Resources\MemberResource\Pages;

use App\Filament\Resources\MemberResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMembers extends ListRecords
{
    protected static string $resource = MemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('export')
                ->label('Export CSV')
                ->color('success')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () {
                    $members = \App\Models\Member::with(['membership'])->get();
                    $filename = 'members-' . now()->format('Y-m-d-H-i-s') . '.csv';
                    $headers = [
                        'Content-Type' => 'text/csv',
                        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                    ];
                    $callback = function() use ($members) {
                        $file = fopen('php://output', 'w');
                        // Add headers
                        fputcsv($file, [
                            'First Name',
                            'Last Name', 
                            'Email',
                            'Phone',
                            'Date of Birth',
                            'Membership',
                            'Membership Price',
                            'Membership Currency',
                            'Address',
                            'Emergency Contact',
                            'Emergency Phone',
                            'Medical Conditions',
                            'Allergies',
                            'Created At',
                            'Updated At'
                        ]);
                        // Add data
                        foreach ($members as $member) {
                            fputcsv($file, [
                                $member->first_name,
                                $member->last_name,
                                $member->email,
                                $member->phone,
                                $member->date_of_birth,
                                $member->membership->name ?? '',
                                $member->membership->price ?? '',
                                $member->membership->currency ?? '',
                                $member->address,
                                $member->emergency_contact,
                                $member->emergency_phone,
                                $member->medical_conditions,
                                $member->allergies,
                                $member->created_at,
                                $member->updated_at
                            ]);
                        }
                        fclose($file);
                    };
                    return response()->stream($callback, 200, $headers);
                }),
        ];
    }
}
