<div class="container">
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                 <h2>all coupons </h2> 
                 <a href="{{route('coupons.add')}}" style="float: right">
                    <button class="btn btn-primary"><i class="fa fa-plus"></i> Add coupon</button>
                 </a>  
                </div>
    
                
            </div>              
             <!-- /. ROW  -->
              <hr />
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <td>id</td>
                        <td>code</td>
                        <td>coupon type</td>
                        <td>value</td>
                        <td>cart value</td>
                        <td>control</td>
                    </tr>
                </thead>
                <tbody>
                    @if ($coupons)
    
                        @foreach ($coupons as $coupon)
                            <tr>
                                <td>{{$coupon->id}}</td>
                                <td>{{$coupon->code}}</td>
                                <td>{{$coupon->type}}</td>
                                <td>
                                    @if ($coupon->type == 'fixed')
                                        ${{$coupon->value}}
                                    @else
                                        {{$coupon->value}}%
                                    @endif
                                </td>
                                <td>${{$coupon->cart_value}}</td>
                                <td>
                                    <a title="edit" href="{{route('coupons.edit' ,  $coupon->id )}}" class="btn btn-success"><i class="fa fa-edit"></i></a> 
                                    <a title="delete" href="#" wire:click.prevent='deleteCoupon({{$coupon->id}})' class="btn btn-warning" ><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        
                    @endif
                    
                </tbody>
                
            </table>
        </div>
             <!-- /. ROW  -->           
    </div>{{$coupons->links()}}
         <!-- /. PAGE INNER  -->
        </div>
     <!-- /. PAGE WRAPPER  -->
    </div>
    
</div>