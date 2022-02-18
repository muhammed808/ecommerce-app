<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;

use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $letestProduct = Product::orderBy('created_at','desc')->limit(8)->get(); 

        $saleProducts = Product::where('sale_price','>',0)->inRandomOrder()->get()->take(8);

        return view('livewire.home-component' , ['letestProduct' => $letestProduct , 'saleProducts' => $saleProducts ] );
    }
}
