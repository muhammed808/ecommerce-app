<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class SearchComponet extends Component
{
    public $product_cat;
    public $product_cat_id;
    public $search;

    public $sorting;
    public $pageSize;
    public $minPrice;
    public $maxPrice;

    public function mount()
    {
        $this->fill(request()->only('search','product_cat','product_cat_id'));
        $this->sorting = 'id';
        $this->pageSize = 12;
        $this->minPrice = 0;
        $this->maxPrice = 100000;
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

            $products =  Product::where('name','like', "%" . $this->search . "%")
            ->where(function ($query){
                if($this->product_cat_id){
                    $query->where('category_id',$this->product_cat_id);
                }
            })
            ->where(function ($query){
                $query->whereBetween('regular_price',[$this->minPrice , $this->maxPrice])
                        ->orWhereBetween('sale_price',[$this->minPrice , $this->maxPrice]);
            })
            ->orderBy($this->sorting,$ordering)
            ->paginate($this->pageSize)->withQueryString();

        $categories = Category::all();
        $popular_products = Product::inRandomOrder()->limit(4)->get();
        return view('livewire.shop-component' , ['products' => $products , 'categories' => $categories , 'popular_products' => $popular_products ]);

    }
}
