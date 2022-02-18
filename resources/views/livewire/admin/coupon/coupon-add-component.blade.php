<div class="container">
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>add coupon </h2>  
                    <a href="{{route('admin.coupons')}}" style="float: right">
                        <button class="btn btn-primary"> All coupon</button>
                     </a>   
                </div>                    
            </div>              
                <!-- /. ROW  -->
                <hr />
            <div class="container">
                <form wire:submit.prevent='storeCoupon'>
                    <div class="form-group row">
                        <label for="code" class="col-sm-2 col-form-label">code</label>
                        <div class="col-sm-10">
                            <input type="text" name="code"  wire:model='code' class="form-control" id="code" placeholder="code" value="" autofocus>
                             @error('code') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            
                           
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <label for="coupon_type" class="col-sm-2 col-form-label">coupon type</label>
                        <div class="col-sm-10">
                            <select name="type"  wire:model='type' id="coupon_type" class="form-control">
                                <option value="0" hidden>--select type--</option>
                                <option value="fixed">fixed</option>
                                <option value="percent">percent</option>
                            </select>
                        @error('coupon_type')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="value" class="col-sm-2 col-form-label">value</label>
                        <div class="col-sm-10">
                            <input type="text" name="value"  wire:model='value' class="form-control" id="value" placeholder="value" value="" >
                             @error('value') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cart_value" class="col-sm-2 col-form-label">cart value</label>
                        <div class="col-sm-10">
                            <input type="text" name="cart_value"  wire:model='cart_value' class="form-control" id="cart_value" placeholder="cart_value" value="" >
                             @error('cart_value') <div class="alert alert-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                        @if (Session::has('success_messege'))
                            <div class="alert alert-success">
                                <strong>success</strong> {{Session::get('success_messege')}}
                            </div>
                        @endif
                    <input type="submit" class="btn btn-primary pull-right" value="save" />
    
                </form>
            </div>
                <!-- /. ROW  -->           
        </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    </div>
