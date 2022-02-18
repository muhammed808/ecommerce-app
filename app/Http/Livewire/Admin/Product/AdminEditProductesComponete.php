<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class AdminEditProductesComponete extends Component
{
    use WithFileUploads;
    
    public $product_id;
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
    public $newimage;
    public $category_id;

    protected $rules = [
        'name'                  => 'string | required ',
        'short_description'     => 'string | required',
        'description'           => 'string | required',
        'SKU'                   => 'string | required',
        'regular_price'         => 'numeric | required',
        'sale_price'            => 'nullable | numeric | lt:regular_price',
        'end_sale'              => 'nullable | date',
        'quantity'              => 'numeric | required',
        // 'newimage'                 => 'image',
        'category_id'           => 'required',
    ];
    protected $messages = [
        'name.unique' => 'pleasse change this name'
    ];

    public function mount($product_id)
    {
        $this->product_id           =  $product_id;
        $this->name                 =  Product::find($product_id)->name;
        $this->short_description    =  Product::find($product_id)->short_description;
        $this->description          =  Product::find($product_id)->description;
        $this->regular_price        =  Product::find($product_id)->regular_price;
        $this->sale_price           =  Product::find($product_id)->sale_price;
        $this->end_sale             =  Product::find($product_id)->end_sale;
        $this->SKU                  =  Product::find($product_id)->SKU;
        $this->quantity             =  Product::find($product_id)->quantity;
        $this->stock_status         =  Product::find($product_id)->stock_status;
        $this->featured             =  Product::find($product_id)->featured;
        $this->image                =  Product::find($product_id)->image;
        $this->category_id          =  Product::find($product_id)->category_id;
    }
    public function editProduct()
    {

        $this->validate();
        $product = Product::find($this->product_id);
        $product->name                 = $this->name;
        $product->slug                 = Str::slug($this->name) ;
        $product->short_description    = $this->short_description;
        $product->description          = $this->description;
        $product->regular_price        = $this->regular_price;
        $product->sale_price           = ($this->sale_price == '') ? NULL : $this->sale_price  ;
        $product->end_sale             = ($this->end_sale  == '')? NULL : $this->end_sale ;
        $product->SKU                  = $this->SKU;
        $product->quantity             = $this->quantity;
        $product->stock_status         = $this->stock_status;
        $product->featured             = $this->featured;
        $product->category_id          = $this->category_id;
        if($this->newimage){

            $imageName = Carbon::now()->timestamp. '.' .$this->newimage->extension();
            $this->newimage->storeAs('products',$imageName);
            $product->image = $imageName;
        };
        $product->save();
        session()->flash('success_messege','product has been updated');
    }
    public function render()
    {
        $product = Product::find($this->product_id);
        $categories = Category::all();
        return view('livewire.admin.admin-edit-productes-componete' , ['product' => $product , 'categories' => $categories]);
    }
}
