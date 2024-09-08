<?php

namespace App\Imports;

use App\Models\Mapel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MataPelajaran implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Mapel::create([
                'mapel' => $row['mapel'],
                'keterangan' => $row['keterangan'],
            ]);
        }
    }
}
