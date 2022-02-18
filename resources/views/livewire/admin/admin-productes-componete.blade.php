<div class="container">
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                 <h2>all productes </h2> 
                 <a href="{{route('products.add')}}" style="float: right">
                    <button class="btn btn-primary"><i class="fa fa-plus"></i> Add product</button>
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
                        <td>image</td>
                        <td>name</td>
                        <td>stock</td>
                        <td>prise</td>
                        <td>sale price</td>
                        <td>end sale</td>
                        <td>quantity</td>
                        <td>category</td>
                        <td>date</td>
                        <td>control</td>
                    </tr>
                </thead>
                <tbody>
                    @if ($products)

                        @foreach ($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td class="thumbnnail">
                                    <a href="{{route('product.details',$product->slug)}}" title="{{$product->name}}">
                                        <figure><img src="{{ asset('assets/images/products')}}/{{$product->image}}"  width="60" alt=""></figure>
                                    </a>
                                </td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->stock_status}}</td>
                                <td>{{$product->regular_price}}</td>
                                <td>{{$product->sale_price}}</td>
                                
                                <td>{{$product->end_sale}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>{{date("jS F, Y",strtotime($product->created_at))}}</td>
                                <td>
                                    <a title="edit" href="{{route('products.edit' ,  $product->id )}}" class="btn btn-success"><i class="fa fa-edit"></i></a> 
                                    <a title="delete" href="#" wire:click.prevent='deleteProducts({{$product->id}})' class="btn btn-warning" ><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    @endif
                    
                </tbody>
            </table>
            <span style="text-align: center;">
                {{$products->links()}}
            </span>
        </div>
             <!-- /. ROW  -->           
</div>
         <!-- /. PAGE INNER  -->
        </div>
</div>
