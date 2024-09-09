<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class UsersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $users = User::with(['roles', 'userDetail'])
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'Admin');
            })
            ->whereHas('userDetail')
            ->get();

        // Transform the collection to match the headings
        $reponse =  $users->map(function ($user) {
                return [
                    $user->user_name,
                    $user->position_code,
                    $user->emp_code,
                    $user->position_name,
                    $user->hq_code,
                    $user->hq_name,
                    $user->role, // Assuming roles is a relationship,
                    $user->userDetail->doctor_name,
                    $user->userDetail->speciality,
                    $user->userDetail->place,
                    route('download', ['user_id' => $user->id])
                ];
        });
        return $reponse;
    }

    public function headings(): array
    {
        return [
            'User Name',
            'Position Code',
            'Employee Code',
            'Position Name',
            'HQ Code',
            'HQ Name',
            'Role',
            'Doctor Name',
            'Speciality',
            'Place',
            'Poster',
        ];
    }
}
