<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ImportOfProducts extends Component
{
    use WithFileUploads;

    public $file;
    public $errors=[];
    public $importedCount=0;
   /* public $importing = false;
    public $importResults = []; */

    public function importProducts()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        $productsImport = new ProductsImport();


        Excel::import($productsImport, $this->file);
        $this->errors = $productsImport->getErrors();
        $this->importedCount = $productsImport->getImportedCount();

        if(count($this->errors) == 0){
            session()->flash('swal',[
                'icon' => 'success',
                'title' => 'Importación Exitosa',
                'text' => "se han importado {$this->importedCount} productos."
            ]);
            return redirect()->route('admin.products.index');

        }
    }

    public function downloadTemplate()
    {
       return Excel::download(new \App\Exports\ProductTemplateExport, 'product_template.xlsx');
    }

    public function render()
    {
        return view('livewire.admin.import-of-products');
    }
}
