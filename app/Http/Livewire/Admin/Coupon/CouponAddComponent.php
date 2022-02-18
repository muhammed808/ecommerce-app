<?php

namespace App\Http\Livewire\Admin\Coupon;

use App\Models\Coupon;
use Livewire\Component;

class CouponAddComponent extends Component
{
    public $code;
    public $type;
    public $value;
    public $cart_value;

    protected $rules = [
        'code' => 'required | unique:coupons',
        'type' => 'required',
        'value' => 'required | numeric',
        'cart_value' => 'required | numeric',
    ];

    public function storeCoupon()
    {
        $this->validate();

        $coupon = new Coupon();
        $coupon->code = $this->code ;
        $coupon->type = $this->type ;
        $coupon->value = $this->value ;
        $coupon->cart_value = $this->cart_value ;
        
        $coupon->save();
        session()->flash('success_messege','coupon adding done');
    }
    public function render()
    {
        return view('livewire.admin.coupon.coupon-add-component');
    }
}
