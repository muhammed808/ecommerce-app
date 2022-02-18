<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class AdminAddCategoriesComponent extends Component
{
    public $name;
    public $slug;

    protected $rules = [
        'name' => 'unique:categories',
    ];

    public function genarateSlug()
    {
        $this->slug = Str::slug($this->name);
    }
    public function storeCategory()
    {
        $this->validate();

        $category = new Category();
        $category->name = $this->name ;
        $category->slug = $this->slug ;
        $category->save();
        session()->flash('success_messege','category adding done');
    }
    public function render()
    {
        return view('livewire.admin.admin-add-categories-component');
    }
}
