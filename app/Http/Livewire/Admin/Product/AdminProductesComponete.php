<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;


class AdminProductesComponete extends Component
{
    use WithPagination;
    public $testing;
    public function mount(){
        $this->testing = 'sale_price';
    }
    public function deleteProducts($id){
        $product = Product::find($id);
        $file = $product->image;
        
        if(file_exists('assets/images/products/'.$file)){
            unlink('assets/images/products/'.$file);
        };
        Product::find($id)->delete();
    }
    public function render()
    {
        $products = Product::latest()->paginate(10)->withQueryString();
        $products->withPath('/admin/products');
        return view('livewire.admin.admin-productes-componete' , ['products' => $products]);
    }
}
