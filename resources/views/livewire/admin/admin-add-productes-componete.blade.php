<div class="container">
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                 <h2>add product </h2> 
                 <a href="{{route('admin.products')}}" style="float: right">
                    <button class="btn btn-primary"> All products</button>
                 </a>     
                </div>                    
            </div>              
             <!-- /. ROW  -->
              <hr />
            <div class="container">
                <form enctype="multipart/form-data">
                    
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">name</label>
                        <div class="col-sm-10">
                        <input type="text" wire:model='name' placeholder="name" name="name" class="form-control" id="name" value="{{old('name')}}" autofocus>
                        @error('name')

                            <div class="alert alert-danger">
                                {{$message}}
                            </div>

                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="short_description" class="col-sm-2 col-form-label">short description</label>
                        <div class="col-sm-10">
                        <input type="text" wire:model='short_description' placeholder="short description" name="short_description" class="form-control" id="short_description"value="{{old('short_description')}}" >
                        @error('short_description')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">description</label>
                        <div class="col-sm-10">
                        <input type="text" wire:model='description' placeholder="description" name="description" class="form-control" id="description"value="{{old('description')}}" >
                        @error('description')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="regular_price" class="col-sm-2 col-form-label">regular price</label>
                        <div class="col-sm-10">
                        <input type="text" wire:model='regular_price' placeholder="regular price" name="regular_price" class="form-control" id="regular_price"value="{{old('regular_price')}}" >
                        @error('regular_price')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sale_price" class="col-sm-2 col-form-label">sale price</label>
                        <div class="col-sm-10">
                        <input type="text" wire:model='sale_price' placeholder="sale price" name="sale_price" class="form-control" id="sale_price"value="{{old('sale_price')}}" >
                        @error('sale_price')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sale_price" class="col-sm-2 col-form-label">end sale date</label>
                        <div class="col-sm-10">
                        <input type="date" wire:model='end_sale' name="end_sale" class="form-control" id="end_sale" >
                        @error('end_sale')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="SKU" class="col-sm-2 col-form-label">SKU</label>
                        <div class="col-sm-10">
                        <input type="text" wire:model='SKU' placeholder="SKU" name="SKU" class="form-control" id="SKU"value="{{old('SKU')}}" >
                        @error('SKU')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="quantity" class="col-sm-2 col-form-label">quantity</label>
                        <div class="col-sm-10">
                        <input type="text" wire:model='quantity' placeholder="quantity" name="quantity" class="form-control" id="quantity"value="{{old('quantity')}}" >
                        @error('quantity')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stock_status" class="col-sm-2 col-form-label">stock status</label>
                        <div class="col-sm-10">
                        <select id="stock_status" name="stock_status" class="form-control" wire:model='stock_status'>
                            <option value="instock">instock</option>
                            <option value="outofstock">outofstock</option>
                        </select>
                            @error('stock_status')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="featured" class="col-sm-2 col-form-label">featured</label>
                        <div class="col-sm-10">
                        <select id="featured" name="featured" wire:model='featured' class="form-control">
                            <option value="0">no</option>
                            <option value="1">yes</option>
                        </select>
                            @error('featured')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-sm-2 col-form-label">product image</label>
                        <div class="col-sm-10">
                        <input type="file" wire:model='image' name="image" class="form-control" id="image"value="{{old('image')}}" >

                        @if ($image)
                            <img src='{{$image->temporaryUrl()}}' width="120" />
                        @endif
                        
                        @error('image')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="col-sm-2 col-form-label">category</label>
                        <div class="col-sm-10">
                        <select id="category" wire:model='category_id' name="category_id" class="form-control">
                            <option value="0" hidden>--select category--</option>
                            @foreach ($categories as $category)
                                <option 
                                    value="{{$category->id}}"
                                    @if (old('category_id') == $category->id )
                                        selected
                                    @endif>
                                {{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
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

                    
                    <input type="submit" class="btn btn-primary" value="add" wire:click.prevent='addProduct' />                    
                </form>
            </div>
              

             <!-- /. ROW  -->           
        </div>
         <!-- /. PAGE INNER  -->
        </div>
</div>
