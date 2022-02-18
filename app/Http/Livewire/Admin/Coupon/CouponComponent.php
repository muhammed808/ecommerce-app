<?php

namespace App\Http\Livewire\Admin\Coupon;

use App\Models\Coupon;
use Livewire\Component;
use Livewire\WithPagination;

class CouponComponent extends Component
{
    use WithPagination;
    public function deleteCoupon($id)
    {
        Coupon::where('id',$id)->delete();
    }
    public function render()
    {
        $coupons = Coupon::latest()->paginate(10)->withQueryString();
        return view('livewire.admin.coupon.coupon-component',['coupons' => $coupons]);
    }
}
