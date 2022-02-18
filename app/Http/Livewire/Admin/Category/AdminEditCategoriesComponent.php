<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;

class AdminEditCategoriesComponent extends Component
{
    public $category_id;
    public $name;
    public $slug;
    protected $rules = [
        'name' => 'unique:categories',
    ];

    public function mount($category_id)
    {
        $this->category_id = $category_id;
        $this->name = Category::find($category_id)->name;
    }
    public function generatSlug()
    {
        $this->slug = Str::slug($this->name);
    }
    public function updateCategory()
    {
        $this->validate();
        $category = new Category();
        $category->where('id' , $this->category_id)->update([
            'name' => $this->name,
            'slug' => $this->slug,
        ]);
        session()->flash('success_messege','category updateing done');
    }
    public function render()
    {
        $category = Category::find($this->category_id);
        return view('livewire.admin.admin-edit-categories-component' , ['category' => $category]);
    }
}
