<?php

namespace App\Imports;

use App\Models\Warehouse;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class WarehousesImport implements ToCollection, WithHeadingRow
{
    private array $errors = [];
    private int $importedCount = 0;
     public function collection(Collection $rows)
    {
         foreach($rows as $index => $row){
            $data = $row->toArray();
            $validator = Validator::make($data, [
                'name' => 'required|string|max:255|unique:warehouses,name',
                'location' => 'nullable|string',
            ]);
            if ($validator->fails()) {
                $this->errors[] =[
                    'row' => $index + 1,
                    'errors' => $validator->errors()->all()
                ];
                continue;
            }
            Warehouse::create($data);
            $this->importedCount++;
        }
    }
    public function getErrors()
    {
        return $this->errors;
    }
    public function getImportedCount()
    {
        return $this->importedCount;
    }
}
