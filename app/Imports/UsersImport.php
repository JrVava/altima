<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Hash;

class UsersImport implements ToModel, WithHeadingRow
{
    protected $data = [];

    public function headingRow(): int
    {
        return 2; // Change this if your header row is not the first row
    }
    public function model(array $row){
        $checkUser = User::where("emp_code", $row["emp_code"])->exists();
        if(!$checkUser && $row['emp_code'] != ''){
            $data = [
                'emp_code' => $row['emp_code'],
                'user_name' => $row['user_name'],
                'position_code' => $row['position_code'],
                'position_name' => $row['position_name'],
                'hq_code' => $row['hq_code'],
                'hq_name' => $row['hq_name'],
                'password' =>  Hash::make($row['emp_code']),
                'role' => $row['role']
            ];
            $user = new User();
            $user->fill($data);
            $user->save();
        }
    }
}
