<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserProfileComponent extends Component
{
    public function render()
    {
        $orders = Order::where('user_id',Auth::id())->get();

        return view('livewire.user.user-profile-component',['orders'=>$orders]);
    }
}
