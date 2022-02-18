<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\Shipping;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;


class CheckoutComponent extends Component
{
    public $totalPrice;

    public $fname;
    public $lname;
    public $email;
    public $mobile;
    public $line1;
    public $line2;
    public $province;
    public $country;
    public $zipcode;
    public $city;   
    public $paymentmethod;   

    protected $rules = [
       'fname'      => 'required',
       'lname'      => 'required',
       'email'      => 'required | email',
       'mobile'     => 'required | numeric',
       'line1'      => 'required',
       'line2'      => 'required',
       'province'    => 'required',
       'country'    => 'required',
       'zipcode'     => 'required',
       'city'       => 'required',
       'paymentmethod' => 'required'
    ];

    public function mount()
    {
        $this->totalPrice = session()->has('checkout') ? session()->get('checkout')['total'] : 0;

        //  if user frist time to sell on wibsite
        
        $userData = Order::latest()->where('user_id',Auth::id())->first();
        if($userData){
            $this->fname = $userData->first_name;
            $this->lname = $userData->last_name;
            $this->email = $userData->email;
            $this->mobile = $userData->mobile;
            $this->line1 = $userData->line1;
            $this->line2 = $userData->line2;
            $this->province = $userData->province;
            $this->country = $userData->country;
            $this->zipcode = $userData->zipcode;
            $this->city = $userData->city;   
        }
    }

    public function fillOrderData()
    {
        $this->validate();

        $order = new Order();

        $order->user_id         = Auth::id();
        $order->first_name      = $this->fname;
        $order->last_name       = $this->lname;
        $order->email           = $this->email;
        $order->mobile          = $this->mobile;
        $order->line1           = $this->line1;
        $order->line2           = $this->line2;
        $order->province        = $this->province;
        $order->country         = $this->country;
        $order->zipcode         = $this->zipcode;
        $order->city            = $this->city;
        $order->status          = 'ordered';  
        $order->subtotal        = session()->get('checkout')['subtotal'];
        $order->tax             = session()->get('checkout')['tax'];
        $order->total           = session()->get('checkout')['total'];
        $order->discount        = session()->get('checkout')['discount'];
        $order->save();

        return $order->id;
    }

    public function reduceQuantityProduct($orderId){

        $order = Order::find($orderId);

        foreach($order->orderItem as $item){
            $product = Product::find($item->product_id);
            $product->quantity -= $item->quantity;
            if($product->quantity == 0){
                $product->delete();
            }else{
                $product->save(); 
            }
        }

    }

    public function fillOrderItemsData($orderId)
    {
        foreach(Cart::instance('shop')->content() as $item){
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $orderId;
            $orderItem->price = $item->price;
            $orderItem->quantity = $item->qty;
            $orderItem->save();
        }

        $this->reduceQuantityProduct($orderId);

    }

    public function fillShippingData($orderId)
    {
        $shipping = new Shipping();

        $shipping->order_id        = $orderId;
        $shipping->first_name      = $this->fname;
        $shipping->last_name       = $this->lname;
        $shipping->email           = $this->email;
        $shipping->mobile          = $this->mobile;
        $shipping->line1           = $this->line1;
        $shipping->line2           = $this->line2;
        $shipping->province        = $this->province;
        $shipping->country         = $this->country;
        $shipping->zipcode         = $this->zipcode;
        $shipping->city            = $this->city;
        $shipping->save();
    }

    public function fillTransactionData($orderId)
    {
        $transaction = new Transaction();

        $transaction->user_id = Auth::id();
        $transaction->order_id = $orderId;
        $transaction->mode = $this->paymentmethod;
        $transaction->status = 'pending';
        $transaction->save();

    }

    public function endCheckout()
    {
        Cart::instance('shop')->destroy();
        $this->emitTo('cart-count-component','refreshComponent');
        session()->forget('cheackout');

        return redirect('thankyou');
    }

    public function setOrder(){
       
        // to add items to order table
        $orderId = $this->fillOrderData();

        // to add items to orderItems table

        $this->fillOrderItemsData($orderId);

        // to add data to shipping table

        $this->fillShippingData($orderId);

        // to add data to transactions table

        $this->fillTransactionData($orderId);

        // end processing

        $this->endCheckout();
    }

    
    public function render()
    {
        // $userData = Order::latest()->where('user_id',Auth::id())->first();

        return view('livewire.checkout-component');
    }
}
