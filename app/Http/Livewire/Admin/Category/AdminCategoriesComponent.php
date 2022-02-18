<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoriesComponent extends Component
{
    use WithPagination;

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $products = $category->products;
        foreach($products as $product){
            if(file_exists('assets/images/products/'.$product->image)){
                unlink('assets/images/products/'.$product->image);
            }
        }
        Category::where('id',$id)->delete();
    }


    public function render()
    {
        $categories = Category::latest()->paginate(10)->withQueryString();
        $categories->withPath('/admin/categories');
        return view('livewire.admin.admin-categories-component' , ['categories' => $categories]);
    }
}
