@extends('admin_layout');
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên sản phẩm</th>
            <th>Giá tiền</th>
            <th>Mô tả</th>
            <th>Hình ảnh</th>
            <th>Nội dung</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Hiển thị</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_product as $key => $product)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{($product->product_name)}}</td>
            <td>{{($product->product_price)}}</td>
            <td>{{($product->product_desc)}}</td>
            <td> <img src="public/upload/product/{{$product->product_image}}" height="100" width="100"></td>
            <td>{{($product->product_content)}}</td>
            <td>{{($product->category_product)}}</td>
            <td>{{($product->brand_product)}}</td>
            
            <td><span class="text-ellipsis">
            <?php
            if($product->product_status === 0){
              echo "Hiện";
            }
            else
            echo "Ẩn";
            ?>
            </span></td>
            <td>
              <a type="button" href="{{URL::to('/edit-product',$product->product_id)}}" class="btn btn-warning">Sửa</a>

              <a type="button" href="{{URL::to('/delete-product',$product->product_id)}}" onclick="return confirm('Are you sure?')" class="btn btn-danger">Xóa</a>

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          
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
</div>
@endsection