<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class ProductsImport implements ToCollection, WithHeadingRow
{

    private array $errors = [];
    private int $importedCount = 0;

    public function collection(Collection $rows)
    {
        foreach($rows as $index => $row){
            $data = $row->toArray();

            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'sku' => 'required|string|max:100|unique:products,sku',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
            ]);
            if ($validator->fails()) {
                $this->errors[] =[
                    'row' => $index + 1,
                    'errors' => $validator->errors()->all()
                ];
                continue;
            }

            Product::create($data);
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
