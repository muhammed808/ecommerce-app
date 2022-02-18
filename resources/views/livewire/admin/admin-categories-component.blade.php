<div class="container">
    

<div id="page-wrapper" >
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
             <h2>all categories </h2> 
             <a href="{{route('categories.add')}}" style="float: right">
                <button class="btn btn-primary"><i class="fa fa-plus"></i> Add category</button>
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
                    <td>name</td>
                    <td>slug</td>
                    <td>control</td>
                </tr>
            </thead>
            <tbody>
                @if ($categories)

                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td><a href="{{route('product.category' , $category->slug) }}">{{$category->slug}}</a></td>
                            <td>
                                <a title="edit" href="{{route('categories.edit' ,  $category->id )}}" class="btn btn-success"><i class="fa fa-edit"></i></a> 
                                <a title="delete" href="#" wire:click.prevent='deleteCategory({{$category->id}})' class="btn btn-warning" ><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    
                @endif
                
            </tbody>
            
        </table>
    </div>
         <!-- /. ROW  -->           
</div>{{$categories->links()}}
     <!-- /. PAGE INNER  -->
    </div>
 <!-- /. PAGE WRAPPER  -->
</div>

</div>