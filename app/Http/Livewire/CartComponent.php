<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use App\Models\Product;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Session\Session;

class CartComponent extends Component
{
    public $haveCouponCode;
    public $couponCode;
    public $discount;
    public $subtotalAfterDiscount;
    public $taxAfterDiscount;
    public $totalAfterDiscount;


    public function increaseQuantity($rowId)
    {
        $product = Cart::instance('shop')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('shop')->update($rowId,$qty);
        $this->emitTo('cart-count-component','refreshComponent');
    }

    public function decreaseQuantity($rowId)
    {
        $product = Cart::instance('shop')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('shop')->update($rowId,$qty);
        $this->emitTo('cart-count-component','refreshComponent');
    }

    public function delete($rowId)
    {
        Cart::instance('shop')->remove($rowId);
        $this->emitTo('cart-count-component','refreshComponent');
        session()->flash('success_messege','item deleted from cart');
    }

    public function deleteAll()
    {
        Cart::instance('shop')->destroy();
        $this->emitTo('cart-count-component','refreshComponent');
    }


    public function calculatDiscount()
    {
        $subtotal =  str_replace(',','', Cart::instance('shop')->subtotal());
        if(session()->has('coupon')){
            if(session()->get('coupon')['type'] == 'fixed'){
                $this->discount = session()->get('coupon')['value'];
            }else{
                $this->discount = ($subtotal * session()->get('coupon')['value'])/100;
            }
            $this->subtotalAfterDiscount    = $subtotal - $this->discount;
            $this->taxAfterDiscount         = ($this->subtotalAfterDiscount * config('cart.tax'))/100;
            $this->totalAfterDiscount       = $this->subtotalAfterDiscount + $this->taxAfterDiscount;
        }
    }

    public function applyCoupon()
    {
        $subtotal =  str_replace(',','', Cart::instance('shop')->subtotal());
        
        $coupon = Coupon::where('code',$this->couponCode)->where('cart_value','<=',$subtotal)->first();

        if($coupon == null){
            session()->flash('coupon_message','coupon code is invalid!');
            return;
        }
        session()->put('coupon',[
            'code'       => $coupon->code,
            'type'       => $coupon->type,
            'value'      => $coupon->value,
            'cart_value' => $coupon->cart_value
        ]);
    }

    public function setAmountForCheckout()
    {
        if(session()->has('coupon')){
            $subtotal =  str_replace(',','', Cart::instance('shop')->subtotal());
            session()->put('checkout',[
                'discount'       => $this->discount,
                'subtotal'       => $subtotal,
                'tax'            => $this->taxAfterDiscount,
                'total'          => $this->totalAfterDiscount
            ]);
        }else{
            $subtotal =  str_replace(',','', Cart::instance('shop')->subtotal());
            $tax =  str_replace(',','', Cart::instance('shop')->tax());
            $total =  str_replace(',','', Cart::instance('shop')->total());
            session()->put('checkout',[
                'discount'       => 0,
                'subtotal'       => $subtotal,
                'tax'            => $tax,
                'total'          => $total
            ]);
        }

    }

    public function render()
    {
        $subtotal =  str_replace(',','', Cart::instance('shop')->subtotal());
        if(session()->has('coupon')){
            if($subtotal < session()->get('coupon')['cart_value'] ){
                session()->forget('coupon');
            }else{
                $this->calculatDiscount();
            }
        }
        $this->setAmountForCheckout();
        $products = Product::inRandomOrder()->limit(8)->get();
        return view('livewire.cart-component', ['products' => $products] );
    }
}
