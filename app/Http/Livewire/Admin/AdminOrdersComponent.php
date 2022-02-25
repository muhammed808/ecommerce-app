<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;

class AdminOrdersComponent extends Component
{
    public $orderStatus ;

    public function mount($order_status)
    {
        $this->orderStatus = $order_status;
    }

    public function render()
    {

        $orders = Order::where('status',$this->orderStatus)->orderBy('created_at','DESC')->get();
        return view('livewire.admin.admin-orders-component',['orders'=>$orders]);
    }
}
