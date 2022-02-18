
<div class="wrap-iten-in-cart">
<div class="container">
        
        <h2 class="title-box">order details</h2>
        <ul class="products-cart"> 
            @foreach ($order->orderItem as $item)
           
                <li class="pr-cart-item">
                    <div class="product-image">
                        <figure><img src="{{ asset('assets/images/products')}}/{{$item->product->image}}" alt="{{$item->product->name}}"></figure>
                    </div>
                    <div class="product-name">
                        <a class="link-to-product" href="{{route('product.details' , $item->product->slug)}}">{{$item->product->name}}</a>
                    </div>
                    @if ($item->product->sale_price != NULL)
                        <div class="price-field produtc-price"><p class="price">{{$item->product->sale_price}}</p></div>
                    @else
                        <div class="price-field produtc-price"><p class="price">{{$item->product->regular_price}}</p></div>
                    @endif
            
                    <div class="price-field sub-total"><p class="price">{{$item->quantity}}</p></div>

                </li>
            @endforeach
        </ul>

        <div class="summary">
            <div class="order-summary">
                <h4 class="title-box">Order Summary</h4>
                <p class="summary-info"><span class="title">Subtotal</span><b class="index">${{$order->subtotal}}</b></p>

                <p class="summary-info"><span class="title">discount</span><b class="index">-${{$order->discount}}</b></p>
                <p class="summary-info"><span class="title">tax ({{config('cart.tax')}}%)</span><b class="index">${{number_format($order->tax,2,'.',',')}}</b></p>
                <p class="summary-info"><span class="title">Total</span><b class="index">${{number_format($order->total,2,'.',',')}}</b></p>

            </div>
        </div>
        <div class="summary">
            <div class="order-summary">
                <h4 class="title-box">data address</h4>
                <p class="summary-info"><span class="title">line 1</span><b class="index">{{$order->line1}}</b></p>
                <p class="summary-info"><span class="title">line 2</span><b class="index">{{$order->line2}}</b></p>
                <p class="summary-info"><span class="title">city</span><b class="index">{{$order->city}}</b></p>
                <p class="summary-info"><span class="title">country</span><b class="index">{{$order->country}}</b></p>
            </div>
            <a href="{{route('admin.invoice',$order->id)}}" target="_balnk" class="btn btn-success">
                invoice
            </a>
        </div>
</div>