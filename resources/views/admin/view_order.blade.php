@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
      Customer Information
    </div>
    @php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message', null);
    }
    @endphp
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Customer name</th>
            <th>Phone</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          <td>{{$order_by_id[0]->customer_name}}</td>
          <td>{{$order_by_id[0]->customer_phone}}</td>
          </tr>
        </tbody>
      </table>
    </div>
</div>
<br>
<div class="panel panel-default">
    <div class="panel-heading">
      Shipping Information
    </div>
    @php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message', null);
    }
    @endphp
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Shipping</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Notes</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$order_by_id[0]->shipping_name}}</td>
            <td>{{$order_by_id[0]->shipping_address}}</td>
            <td>{{$order_by_id[0]->shipping_phone}}</td>
            <td>{{$order_by_id[0]->shipping_notes}}</td>
          </tr>
        </tbody>
      </table>
    </div>
</div>
<br>
  <div class="panel panel-default">
    <div class="panel-heading">
      Order Detail Table
    </div>
    @php
    $message = Session::get('message');
    if($message){
        echo '<span class="text-alert">',$message,'</span>';
        Session::put('message', null);
    }
    @endphp
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Product name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($order_by_id as $v_content)
          <tr>
            <td>{{$v_content->product_name}}</td>
            <td>{{$v_content->product_sale_quantity}}</td>
            <td>{{$v_content->product_price}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
@endsection