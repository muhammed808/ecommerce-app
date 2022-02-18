<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;



class CategoryComponent extends Component
{



    public $sorting;
    public $pageSize;
    public $category_slug;
    public $minPrice;
    public $maxPrice;

    public function mount($category_slug)
    {
        $this->sorting = 'id';
        $this->pageSize = 12;
        $this->category_slug = $category_slug;
        $this->minPrice = 0;
        $this->maxPrice = 10000;

    }
    public function store($product_id,$product_name,$product_price)
    {
        Cart::instance('shop')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success_messege','item added in cart');
        return redirect()->route('product.cart');
    }


    public function render()
    {

        $category = Category::where('slug',$this->category_slug)->first();
        $category_id = $category->id;
        $category_name = $category->name;

        if( $this->sorting == 'price-desc'){
            $ordering = 'DESC';
            $this->sorting = 'regular_price';
        }else{
            $ordering = 'ASC';
        }

        $products =  Product::where('category_id',$category_id)->where(function ($query){
            $query->whereBetween('regular_price',[$this->minPrice , $this->maxPrice])
                    ->orWhereBetween('sale_price',[$this->minPrice , $this->maxPrice]);
        })->orderBy($this->sorting,$ordering)->paginate($this->pageSize);

        $categories = Category::all();
        $popular_products = Product::inRandomOrder()->limit(4)->get();
        return view('livewire.shop-component' , ['products' => $products , 'categories' => $categories , 'category_name' => $category_name , 'popular_products' => $popular_products]);
    }
}
