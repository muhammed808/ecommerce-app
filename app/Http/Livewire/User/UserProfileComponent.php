<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserProfileComponent extends Component
{

    public function addQuantity($orderItems) // to add quantity after canceled order
    {

        $arrIds = [];

        foreach($orderItems as $item){
            array_push($arrIds,$item->product_id);
        }
        $products = Product::whereIn('id',$arrIds)->get();

        foreach($orderItems as $item){
            foreach($products as $product){
                if($product->id == $item->product_id){
                    $product->quantity += $item->quantity; 
                    $product->save();
                    break;
                }
            }
        }
    }

    public function canceledOrder($order_id)
    {
        $order = Order::find($order_id);
        $order->status = 'canceled';
        $order->canseled_date = DB::raw('CURRENT_TIMESTAMP');
        $order->save();

        $this->addQuantity($order->orderItem); // call function
    }


    public function render()
    {
        $orders = Order::where('user_id',Auth::id())->orderBy('created_at','DESC')->get();

        return view('livewire.user.user-profile-component',['orders'=>$orders]);
    }
}
