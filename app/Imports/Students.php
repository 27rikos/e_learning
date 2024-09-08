<?php

namespace App\Imports;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Students implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $tanggal_lhr = isset($row['tanggal_lhr']) ? $this->transformDate($row['tanggal_lhr']) : null;

            // Handle NIK as a number without scientific notation
            $nik = isset($row['nik']) ? $this->convertNumber($row['nik']) : null;

            // Log the transformed date and NIK
            Log::info('Parsed birthdate and NIK:', ['tanggal_lhr' => $tanggal_lhr, 'nik' => $nik]);

            User::create([
                'name' => $row['name'],
                'jenkel' => $row['jenkel'],
                'tempat_lhr' => $row['tempat_lhr'],
                'tanggal_lhr' => $tanggal_lhr,
                'nik' => $nik, // Storing NIK as a number (ensuring it's not in scientific notation)
                'agama' => $row['agama'],
                'alamat' => $row['alamat'],
                'kelas' => $row['kelas'],
                'email' => $row['email'],
                'password' => Hash::make($row['password']),
            ]);
        }
    }

    /**
     * Mengubah format tanggal menjadi Y-m-d dengan logging tambahan untuk debugging.
     *
     * @param mixed $value
     * @return string|null
     */
    private function transformDate($value)
    {
        Log::info('Original birthdate value:', ['value' => $value]);

        // Jika nilai adalah instance DateTime
        if ($value instanceof \DateTime) {
            Log::info('Date is already an instance of DateTime:', ['date' => $value->format('Y-m-d')]);
            return $value->format('Y-m-d');
        }

        // Jika tanggal berupa angka serial Excel
        if (is_numeric($value)) {
            $date = Carbon::parse(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
            Log::info('Date converted from Excel serial:', ['date' => $date->format('Y-m-d')]);
            return $date->format('Y-m-d');
        }

        // Proses tanggal jika dalam format string
        $formats = ['d/m/y', 'd-m-Y', 'Y-m-d', 'd/m/Y'];

        foreach ($formats as $format) {
            try {
                $date = Carbon::createFromFormat($format, $value);
                Log::info('Date matched with format:', ['format' => $format, 'date' => $date->format('Y-m-d')]);
                return $date->format('Y-m-d');
            } catch (\Exception $e) {
                Log::warning('Date format mismatch:', ['format' => $format, 'value' => $value]);
                continue;
            }
        }
        Log::error('No matching date format found', ['value' => $value]);
        return null;
    }

    /**
     * Convert large numbers safely without scientific notation.
     *
     * @param mixed $number
     * @return string
     */
    private function convertNumber($number)
    {
        // Check if the number is too large for an integer, return it as a string to avoid scientific notation
        if (is_numeric($number)) {
            // Using number_format to convert large numbers to avoid scientific notation
            return number_format($number, 0, '', '');
        }

        return $number;
    }
}
