<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class InvoiceController extends Controller
{
    //

    public function changStuts($order_id){
        $order =  Order::find($order_id);
        $order->status = 'delivered';
        $order->delivered_date = DB::raw('CURRENT_TIMESTAMP');
        $order->save();
    }

    public function index($order_id){

        $order =  Order::find($order_id);

        $client = new Party([
            'name'          => "muhammed abu hassiba",
            'phone'         => "012222222",
            'custom_fields' => [
                'business  id' => "46456",
            ],
        ]);

        $customer = new Party([
            'name'          => $order->user->name,
            'address'       => $order->line1,
            'code'          => '#'.$order->user_id,
            'custom_fields' => [
                'order number'    => '>'. $order->id .'<',
                'phone'           => $order->mobile,
                'line2'           => $order->line2,
                'city'            => $order->city,
                'province'        => $order->province,
                'country'         => $order->country,
                'zipcode'         => $order->zipcode,
            ],
        ]);

        $items = [];

        foreach($order->orderItem as $item){
            array_push($items,(new InvoiceItem())->title($item->product->name)->pricePerUnit($item->price)->quantity($item->quantity) ) ;
        }



        $invoice = Invoice::make('receipt')
            ->series('BIG')
            ->status(__('invoices::invoice.paid'))
            ->sequence(667)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($client)
            ->buyer($customer)
            ->date(now())
            ->dateFormat('d/m/Y')
            ->payUntilDays(14)
            ->currencySymbol('$')
            ->currencyCode('USD')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator(',')
            ->currencyDecimalPoint('.')
            ->totalDiscount($order->discount)
            ->totalTaxes($order->tax)
            // ->totalAmount($order->total)
            ->filename($client->name . '_' . $order->id )
            ->addItems($items)
            //->notes($notes)
//            ->logo(public_path('assets/images/logo-top-1.png'))
            
            ->save('public');

            $this->changStuts($order_id);

        return $invoice->stream();
    }
}
