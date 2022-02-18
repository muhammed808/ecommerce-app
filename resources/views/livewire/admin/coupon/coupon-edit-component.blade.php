<div class="container">
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                 <h2>edit coupon </h2> 
                 <a href="{{route('admin.coupons')}}" style="float: right">
                    <button class="btn btn-primary"> All coupons</button>
                 </a>     
                </div>                    
            </div>              
             <!-- /. ROW  -->
              <hr />
            <div class="container">
                <form enctype="multipart/form-data">
                    
                    <div class="form-group row">
                        <label for="code" class="col-sm-2 col-form-label">code</label>
                        <div class="col-sm-10">
                        <input type="text" wire:model='code' value="{{$coupon->code}}" name="code" class="form-control" id="code"  autofocus>
                        @error('code')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">type</label>
                        <div class="col-sm-10">
                            <select id="type" wire:model='type' name="type" class="form-control">
                                <option value="0" hidden>--select coupon--</option>
                                <option value="fixed"
                                 @if (old('type') == $coupon->type )
                                    selected
                                @endif
                                >fixed</option>
                                <option value="percent"
                                @if (old('type') == $coupon->type )
                                    selected
                                @endif>percent</option>
                                
                                    {{-- <option 
                                        value="{{$coupon->type}}"
                                        @if (old('type') == $coupon->type )
                                            selected
                                        @endif>
                                    {{$coupon->name}}</option> --}}
                                
                            </select>
                        {{-- <input type="text" wire:model='type' value="{{$coupon->type}}" name="type" class="form-control" id="type"  > --}}
                        @error('type')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="value" class="col-sm-2 col-form-label">value</label>
                        <div class="col-sm-10">
                        <input type="text" wire:model='value' value="{{$coupon->value}}" name="value" class="form-control" id="value"  >
                        @error('value')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cart_value" class="col-sm-2 col-form-label">cart_value</label>
                        <div class="col-sm-10">
                        <input type="text" wire:model='cart_value' value="{{$coupon->value}}" name="cart_value" class="form-control" id="cart_value"  >
                        @error('cart_value')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                    
                    @if (Session::has('success_messege'))
                    <div class="alert alert-success">
                        <strong>success</strong> {{Session::get('success_messege')}}
                    </div>
                    @endif

                    <input type="submit" class="btn btn-primary" value="update" wire:click.prevent='editCoupon' />                    
                </form>
            </div>
             <!-- /. ROW  -->           
        </div>
         <!-- /. PAGE INNER  -->
        </div>
</div>

