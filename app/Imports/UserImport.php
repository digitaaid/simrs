<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $user = User::updateOrCreate(
                [
                    'username' => $row['username'],
                ],
                [
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                    'google_id' => $row['google_id'],
                    'avatar' => $row['avatar'],
                    'avatar_original' => $row['avatar_original'],
                    'password' => $row['password'],
                    'email_verified_at' => $row['email_verified_at'],
                    'user_verify' => $row['user_verify'],
                    'pic' => $row['pic'],
                    'created_at' => $row['created_at'],
                    'updated_at' => $row['updated_at'],
                    'deleted_at' => $row['deleted_at'],
                ]
            );
            if (isset($row['roles'])) {
                $user->syncRoles([$row['roles']]);
            }
        }
    }
}
