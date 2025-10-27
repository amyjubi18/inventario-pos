<?php

namespace App\Services\Sidebar;

use Illuminate\Support\Facades\Gate;

class ItemLink implements ItemInterface
{
    public string $title;
    public string $url;
    public string $icon;
    public bool $active;
    public array $can;

    public function __construct(string $title, string $url, string $icon, bool $active =false , array $can=[])
    {
        $this->title = $title;
        $this->url = $url;
        $this->icon = $icon;
        $this->active = $active;
        $this->can = $can;
    }
    public function render(): string
    {
        $activeClass = $this->active ? 'bg-gray-100 dark:bg-gray-600' : '';
        return <<<HTML
        <a href="{$this->url}" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100  dark:hover:bg-gray-700 group dark:text-white  {$activeClass}">

               <span class="inline-flex items-center justify-center w-6 h-6 text-gray-500 dark:text-white ">
                <i class="{$this->icon}"></i>
               </span>
               <span class="ms-3">
                {$this->title}
            </span>
            </a>
        HTML;
    }
    public function authorize(): bool
    {
        return count($this->can) ? Gate::any($this->can) : true;
    }

}
