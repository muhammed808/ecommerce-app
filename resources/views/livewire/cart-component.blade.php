
<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="{{route('home')}}" class="link">home</a></li>
                <li class="item-link"><span>cart</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            @if (Session::has('success_messege'))
                <div class="alert alert-success">
                    <strong>success</strong> {{Session::get('success_messege')}}
                </div>
            @endif
            <div class="wrap-iten-in-cart">
                @if (Cart::instance('shop')->count() > 0 )
                    <h3 class="box-title">Products Name</h3>
                    <ul class="products-cart"> 
                        @foreach (Cart::instance('shop')->content() as $item)
                       
                            <li class="pr-cart-item">
                                <div class="product-image">
                                    <figure><img src="{{ asset('assets/images/products')}}/{{$item->model->image}}" alt="{{$item->model->name}}"></figure>
                                </div>
                                <div class="product-name">
                                    <a class="link-to-product" href="{{route('product.details' , $item->model->slug)}}">{{$item->model->name}}</a>
                                </div>
                                @if ($item->model->sale_price != NULL)
                                    <div class="price-field produtc-price"><p class="price">{{$item->model->sale_price}}</p></div>
                                @else
                                    <div class="price-field produtc-price"><p class="price">{{$item->model->regular_price}}</p></div>
                                @endif
                        
                                <div class="quantity">
                                    <div class="quantity-input">
                                        <input type="text" name="product-quatity" value="{{$item->qty}}" data-max="120" pattern="[0-9]*" >									
                                        <a class="btn btn-increase" href="#"wire:click.prevent="increaseQuantity('{{$item->rowId}}')"></a>
                                        <a class="btn btn-reduce" href="#"wire:click.prevent="decreaseQuantity('{{$item->rowId}}')"></a>
                                    </div>
                                </div>
                                <div class="price-field sub-total"><p class="price">{{$item->model->subtotal}}</p></div>
                                <div class="delete">
                                    <a href="#" class="btn btn-delete" title="" wire:click.prevent="delete('{{$item->rowId}}')">
                                        <span>Delete from your cart</span>
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <h1>no items selected</h1>
                @endif
            </div>

            <div class="summary">
                <div class="order-summary">
                    <h4 class="title-box">Order Summary</h4>
                    <p class="summary-info"><span class="title">Subtotal</span><b class="index">${{Cart::instance('shop')->subtotal()}}</b></p>
                    @if (Session::has('coupon'))
                        <p class="summary-info"><span class="title">discount ({{Session::get('coupon')['code']}})</span><b class="index">-${{$discount}}</b></p>
                        <p class="summary-info"><span class="title">tax ({{config('cart.tax')}}%)</span><b class="index">${{number_format($taxAfterDiscount,2,'.',',')}}</b></p>
                        <p class="summary-info"><span class="title">subtotal with discount</span><b class="index">${{number_format($subtotalAfterDiscount,2,'.',',')}}</b></p>
                        <p class="summary-info total-info "><span class="title">Total</span><b class="index">${{number_format($totalAfterDiscount,2,'.',',')}}</b></p>
                    @else
                        <p class="summary-info"><span class="title">tax</span><b class="index">${{Cart::instance('shop')->tax()}}</b></p>
                        <p class="summary-info"><span class="title">Shipping</span><b class="index">Free Shipping</b></p>
                        <p class="summary-info total-info "><span class="title">Total</span><b class="index">${{Cart::instance('shop')->total()}}</b></p>
                    @endif

                </div>
                <div class="checkout-info">
                    @if (!Session::has('coupon'))
                        <label class="checkbox-field">
                            <input class="frm-input " name="have-code" id="have-code" value="1" wire:model='haveCouponCode' type="checkbox"><span>I have coupon code</span>
                        </label>    
                        @if ($haveCouponCode == 1)
                            <div class="summary-item shipping-method">
                                <form wire:submit.prevent='applyCoupon()'>
                                    <h4 class="title-box">Discount Codes</h4>
                                    <p class="row-in-form">
                                        <label for="coupon-code">Enter Your Coupon code:</label>
                                        <input id="coupon-code" wire:model.lazy='couponCode' type="text" name="coupon-code" value="" placeholder="coupon code">
                                        @if (Session::has('coupon_message'))
                                            <div class="alert alert-danger">
                                                <strong>error</strong> {{Session::get('coupon_message')}}
                                            </div>
                                        @endif	
                                    </p>
                                    <button type="submit" class="btn btn-small">Apply</button>
                                </form>
                            </div>
                        @endif
                    @endif
                    <a class="btn btn-checkout" href="{{route('checkout')}}">Check out</a>
                    <a class="link-to-shop" href="{{route('shop')}}">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                </div>
                <div class="update-clear">
                    <a class="btn btn-clear" href="#" wire:click.prevent="deleteAll()">Clear Shopping Cart</a>
                    <a class="btn btn-update" href="#">Update Shopping Cart</a>
                </div>
            </div>

            <div class="wrap-show-advance-info-box style-1 box-in-site">
                <h3 class="title-box">Most Viewed Products</h3>
                <div class="wrap-products">
                    <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >
                        @foreach ($products as $product)
                            <div class="product product-style-2 equal-elem ">
                                <div class="product-thumnail">
                                    <a href="{{route('product.details',$product->slug)}}" title="{{$product->name}}">
                                        <figure><img src="{{ asset('assets/images/products') }}/{{$product->image}}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                    </a>
                                    <div class="group-flash">
                                        <span class="flash-item bestseller-label">Bestseller</span>
                                    </div>
                                    <div class="wrap-btn">
                                        <a href="{{route('product.details',$product->slug)}}" class="function-link">quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a href="{{route('product.details',$product->slug)}}" class="product-name"><span>{{$product->name}}</span></a>
                                    @if ($product->sale_price != NULL)
                                        <div class="wrap-price"><ins><p class="product-price">${{$product->sale_price}}</p></ins> <del><p class="product-price">${{$product->regular_price}}</p></del></div>
                                    @else
                                        <div class="wrap-price"><span class="product-price">${{$product->regular_price}}</span></div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div><!--End wrap-products-->
            </div>

        </div><!--end main content area-->
    </div><!--end container-->
</main>

