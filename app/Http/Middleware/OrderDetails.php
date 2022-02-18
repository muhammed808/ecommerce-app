<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderDetails
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userIdsAllow = Order::where('user_id',Auth::id())->select('id')->get();
        $ids = [];
        $orederId = $request->order_id;

        foreach($userIdsAllow as $id ){
            array_push($ids,$id->id);
        }
        
        if(in_array($orederId,$ids)){
            
            return $next($request);
        }else{
            return redirect()->back();
        }
    }
}
