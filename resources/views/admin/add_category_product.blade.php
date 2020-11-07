@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Add new Category
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
                    <form role="form" action="{{URL::to('/add-category')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category name</label>
                            <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Category name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea style="resize: none" rows="8" name="category_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select name="category_product_status" class="form-control input-sm m-bot15">
                                <option value="0">Hide</option>
                                <option value="1">Show</option>
                            </select>    
                        </div>
                        <button type="submit" name="add_category_product" class="btn btn-info">Add Category</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>

@endsection