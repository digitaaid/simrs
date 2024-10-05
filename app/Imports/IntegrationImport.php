<?php

namespace App\Imports;

use App\Models\Integration;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IntegrationImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if ($row['name']) {
                Integration::updateOrCreate(
                    [
                        'name' => $row['name'],
                    ],
                    [
                        'slug' => $row['slug'],
                        'user_id' => $row['user_id'],
                        'base_url' => $row['base_url'],
                        'user_id' => $row['user_id'],
                        'auth_url' => $row['auth_url'],
                        'user_key' => $row['user_key'],
                        'secret_key' => $row['secret_key'],
                        'description' => $row['description'],
                        'user' => $row['user'],
                        'user' => $row['user'] ?? auth()->user()->id,
                        'pic' => $row['pic'] ?? auth()->user()->name,
                        'status' => $row['status'] ?? 1,
                        'updated_at' => $row['updated_at'] ?? now(),
                        'created_at' => $row['created_at'] ?? now(),
                    ]
                );
            }
        }
    }
}
