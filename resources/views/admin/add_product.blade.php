@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add new Product
                </header>
                <div class="panel-body">
                    <div class="position-center">
                    @php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class="text-alert">',$message,'</span>';
                            Session::put('message', null);
                        }
                    @endphp
                    <form role="form" action="{{URL::to('/add-product')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product name</label>
                            <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Category name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Image</label>
                            <input type="file" name="product_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea id="ckeditor1" style="resize: none" rows="8" name="product_desc" class="form-control" id="exampleInputPassword1" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Content</label>
                            <textarea style="resize: none" rows="8" name="product_content" class="form-control" id="exampleInputPassword1" placeholder="Content"></textarea>
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
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endforeach
                            </select>    
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Price</label>
                            <input type="text" name="product_price" class="form-control" id="exampleInputPassword1" placeholder="Price"></textarea>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Add Product</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>

@endsection