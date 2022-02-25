<div class="container">
    

    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                 <h2>orders </h2> 
                </div>
    
                
            </div>              
             <!-- /. ROW  -->
              <hr />
        <div class="table-responsive">
            <table id="orderTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <td>id</td>
                        <td>subtotal</td>
                        <td>total</td>
                        <td>tax</td>
                        <td>discount</td>
                        <td>order date</td>
                        <td>status</td>
                        <td>control</td>
                    </tr>
                </thead>
                <tbody>
                    @if ($orders)
    
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->subtotal}}</td>
                                <td>{{$order->total}}</td>
                                <td>{{$order->tax}}</td>
                                <td>{{$order->discount}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>{{$order->status}}</td>
                                <td>
                                    <a href="{{route('user.orders.details',$order->id)}}">details</a> 
                                    @if ($order->status == 'ordered')
                                        - <a href="#" wire:click.prevent="canceledOrder('{{$order->id}}')">canceled</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        
                    @endif
                    
                </tbody>
                
            </table>
        </div>
             <!-- /. ROW  -->           
    </div>
         <!-- /. PAGE INNER  -->
        </div>
     <!-- /. PAGE WRAPPER  -->
    </div>
    
    </div>