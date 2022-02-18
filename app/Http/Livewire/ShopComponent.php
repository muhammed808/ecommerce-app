<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;



class ShopComponent extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $sorting;
    public $pageSize;
    public $minPrice;
    public $maxPrice;

    public function mount()
    {
        $this->sorting = 'id';
        $this->pageSize = 12;
        $this->minPrice = 0;
        $this->maxPrice = 10000;
    }

    public function store($product_id,$product_name,$product_price)
    {
        $product = Product::find($product_id);

        $price = $product->sale_price == NULL ? $product->regular_price : $product->sale_price ;


        Cart::instance('shop')->add($product_id,$product_name,1,$price)->associate('App\Models\Product');
        session()->flash('success_messege','item added in cart');
        return redirect()->route('product.cart');
    }

    public function render()
    {
        
        if( $this->sorting == 'price-desc'){
            $ordering = 'DESC';
            $this->sorting = 'regular_price';
        }else{
            $ordering = 'ASC';
        }

        $products =  Product::whereBetween('regular_price',[$this->minPrice , $this->maxPrice])
        ->orWhereBetween('sale_price',[$this->minPrice , $this->maxPrice])
        ->orderBy($this->sorting,$ordering)
        ->paginate($this->pageSize);

        $categories = Category::all();
        $popular_products = Product::inRandomOrder()->limit(4)->get();
        return view('livewire.shop-component' , ['products' => $products , 'categories' => $categories , 'popular_products' => $popular_products ]);
    }
}
