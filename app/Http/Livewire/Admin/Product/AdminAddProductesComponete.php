<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Livewire\WithFileUploads;
class AdminAddProductesComponete extends Component
{
    use WithFileUploads;

    protected $rules = [
        'name' => 'string | required | unique:products',
        'short_description' => 'string | required',
        'description' => 'string | required',
        'SKU' => 'string | required',
        'regular_price' => 'numeric | required',
        'sale_price' => 'nullable | numeric| lt:regular_price',
        'end_sale' => 'nullable | date',
        'quantity' => 'numeric | required',
        'image' => 'image | required',
        'category_id' => 'required',
    ];
    protected $messages = [
        'name.unique' => 'pleasse change this name'
    ];

    public $name;
    public $short_description;
    public $description;
    public $regular_price;
    public $sale_price;
    public $end_sale;
    public $SKU;
    public $quantity;
    public $stock_status;
    public $featured;
    public $image;
    public $category_id;

    public function mount(){
        $this->stock_status = 'instock';
        $this->featured = 0;
    }
    

    public function addProduct()
    {
        $this->validate();
        $product = new Product();
        $product->name                 = $this->name;
        $product->slug                 = Str::slug($this->name) ;
        $product->short_description    = $this->short_description;
        $product->description          = $this->description;
        $product->regular_price        = $this->regular_price;
        $product->sale_price           = $this->sale_price  ;
        $product->end_sale             = $this->end_sale   ;
        $product->SKU                  = $this->SKU;
        $product->quantity             = $this->quantity;
        $product->stock_status         = $this->stock_status;
        $product->featured             = $this->featured;
        $imageName                     = Carbon::now()->timestamp. '.' .$this->image->extension();
        $this->image->storeAs('products',$imageName);
        $product->image                = $imageName;
        $product->category_id          = $this->category_id;
        $product->save();
        session()->flash('success_messege','product has been added');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-add-productes-componete' , ['categories' => $categories]);
    }
}
