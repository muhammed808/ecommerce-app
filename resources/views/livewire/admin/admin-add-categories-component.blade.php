<div class="container">


<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>add category </h2>  
                <a href="{{route('admin.categories')}}" style="float: right">
                    <button class="btn btn-primary"> All Categories</button>
                 </a>   
            </div>                    
        </div>              
            <!-- /. ROW  -->
            <hr />
        <div class="container">
            <form wire:submit.prevent='storeCategory'>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">name</label>
                    <div class="col-sm-10">
                    <input type="text" name="name"  wire:model='name' wire:keyup='genarateSlug' class="form-control" id="name" placeholder="name" value="" autofocus>
                    @if (Session::has('success_messege'))
                    <div class="alert alert-success">
                        <strong>success</strong> {{Session::get('success_messege')}}
                    </div>
                    @endif
                    @error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror
                    </div>
                    
                </div>

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