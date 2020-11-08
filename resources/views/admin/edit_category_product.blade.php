@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Edit Category
                </header>
                <div class="panel-body">
                    <div class="position-center">
                    <form role="form" action="{{URL::to('/update-category/'.$edit_category_product->category_id)}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category name</label>
                        <input type="text" value="{{$edit_category_product->category_name}}" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Category name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea style="resize: none"  rows="8" name="category_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Description">{{$edit_category_product->category_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select name="category_product_status" class="form-control input-sm m-bot15" value="{{$edit_category_product->category_status}}">
                                <option value="0">Hide</option>
                                <option value="1">Show</option>
                            </select>    
                        </div>
                        <button type="submit" name="update_category" class="btn btn-info">Edit Category</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>

@endsection