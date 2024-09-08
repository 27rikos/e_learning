<?php

namespace App\Imports;

use App\Models\Kelas;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Room implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Kelas::create([
                'kelas' => $row['kelas'],
            ]);
        }
    }
}
