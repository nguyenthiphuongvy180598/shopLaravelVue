@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Edit Product
                </header>
                <div class="panel-body">
                    <div class="position-center">
                    @foreach ($edit_product as $key => $edit_value)
                        
                    <form role="form" action="{{URL::to('/update-product/'.$edit_value->product_id)}}" method="post"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product name</label>
                        <input type="text" value="{{$edit_value->product_name}}" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Product name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Image</label>
                            <input type="file" name="product_image" class="form-control">
                            <img src="{{URL::to('uploads/product/',$edit_value->product_image)}}" height="100" width="100" alt="Haven't yet">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea style="resize: none" rows="8" name="product_desc" class="form-control" id="exampleInputPassword1" placeholder="Description">{{$edit_value->product_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Content</label>
                            <textarea style="resize: none" rows="8" name="product_content" class="form-control" id="exampleInputPassword1" placeholder="Content">{{$edit_value->product_content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0">Hide</option>
                                <option value="1">Show</option>
                            </select>    
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach ($category_product as $key => $cate)
                                    @if($cate->category_id==$edit_value->category_id)
                                    <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                    @else
                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                    @endif
                                @endforeach
                            </select>    
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Price</label>
                            <input type="text" value="{{$edit_value->product_price}}" name="product_price" class="form-control" id="exampleInputPassword1" placeholder="Price">
                        </div>
                        <button type="submit" name="update_product" class="btn btn-info">Edit Product</button>
                    </form>
                    
                    @endforeach
                    </div>

                </div>
            </section>

    </div>
</div>

@endsection