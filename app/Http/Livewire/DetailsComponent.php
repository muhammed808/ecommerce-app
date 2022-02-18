<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class DetailsComponent extends Component
{
    public $slug;
    public $quantity;
    public $MaxQuantity;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->quantity = 1;
        
    }

    public function reduce(){
        $this->quantity --;
    }
    public function increase(){
        $this->quantity = ($this->quantity > $this->MaxQuantity)? $this->quantity+1 : $this->quantity;
    }

    public function addWishlist($product_id,$product_name,$quantity,$product_price){
        $product = Product::where('id',$product_id)->first() ;
        $price = $product->sale_price != NULL ? $product->sale_price : $product->regular_price ;

        Cart::instance('wishlist')->add($product_id,$product_name,$quantity,$price)->associate('App\Models\Product');
        $this->emitTo('wishlist-component','refreshComponent');
    }
    public function store($product_id,$product_name,$quantity,$product_price)
    {
        $product = Product::where('id',$product_id)->first() ;
        $price = $product->sale_price != NULL ? $product->sale_price : $product->regular_price ;

        Cart::instance('shop')->add($product_id,$product_name,$quantity,$price)->associate('App\Models\Product');
        
        session()->flash('success_messege','item added in cart');
        return redirect()->route('product.cart');
    }

    
    public function render()
    {
        $product = Product::where('slug',$this->slug)->first();
        $popular_products = Product::inRandomOrder()->limit(4)->get();
        $related_products = Product::where('category_id',$product->category_id)->inRandomOrder()->limit(7)->get();
        return view('livewire.details-component',['product' => $product , 'popular_products' => $popular_products , 'related_products' => $related_products]);
    }
}
