<?php

namespace App\Livewire\Admin;

use App\Imports\CategoriesImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;


class ImportOfCategories extends Component
{
    use WithFileUploads;
     public $file;
    public $errors=[];
    public $importedCount=0;

    public function downloadTemplate()
    {
       return Excel::download(new \App\Exports\CategoriesTemplateExport(), 'categories_template.xlsx');
    }

    public function importCategories()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        $categoriesImport = new CategoriesImport();


        Excel::import($categoriesImport, $this->file);
        $this->errors = $categoriesImport->getErrors();
        $this->importedCount = $categoriesImport->getImportedCount();

        if(count($this->errors) == 0){
            session()->flash('swal',[
                'icon' => 'success',
                'title' => 'Importación Exitosa',
                'text' => "se han importado {$this->importedCount} categorias correctamente."
            ]);
            return redirect()->route('admin.categories.index');

        }
    }
    public function render()
    {
        return view('livewire.admin.import-of-categories');
    }
}
