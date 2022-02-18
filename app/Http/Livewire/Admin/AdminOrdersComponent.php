<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;

class AdminOrdersComponent extends Component
{

    public function render()
    {

        $orders = Order::orderBy('created_at','DESC')->get();
        return view('livewire.admin.admin-orders-component',['orders'=>$orders]);
    }
}
