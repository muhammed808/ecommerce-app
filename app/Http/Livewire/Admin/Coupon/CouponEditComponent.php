<?php

namespace App\Http\Livewire\Admin\Coupon;

use App\Models\Coupon;
use Livewire\Component;

class CouponEditComponent extends Component
{
    public $code;
    public $type;
    public $value;
    public $cart_value;
    public $coupon_id;
    

    protected $rules = [
        'code' => 'required',
        'type' => 'required',
        'value' => 'required | numeric',
        'cart_value' => 'required | numeric',
    ];
    public function mount($coupon_id)
    {
        $this->coupon_id    =  $coupon_id;
        $this->code         =  Coupon::find($coupon_id)->code;
        $this->type         =  Coupon::find($coupon_id)->type;
        $this->value        =  Coupon::find($coupon_id)->value;
        $this->cart_value   =  Coupon::find($coupon_id)->cart_value;
    }
    public function editCoupon(){
        $this->validate();
        $coupon         = Coupon::find($this->coupon_id);
        $coupon->code   = $this->code;
        $coupon->type   = $this->type;
        $coupon->value   = $this->value;
        $coupon->cart_value   = $this->cart_value;

        $coupon->save();
        session()->flash('success_messege','product has been updated');
    }
    public function render()
    {
        $coupon = Coupon::find($this->coupon_id);
        return view('livewire.admin.coupon.coupon-edit-component' , ['coupon' => $coupon]);
    }
}
