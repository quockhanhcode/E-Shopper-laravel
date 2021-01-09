@extends('admin_layout');
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Sản Phẩm
            </header>

            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                    
                    {{ csrf_field() }}
                    <?php
	$message = Session::get('message');
	if($message){
		echo $message;
		Session::get('message',null);
	}
	?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Sản phẩm</label>
                            <input name="product_name" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea name="product_desc" class="form-control"
                                placeholder="Mô tả danh mục"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung</label>
                            <textarea name="product_content" class="form-control"
                                placeholder="Mô tả danh mục"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Giá tiền</label>
                            <textarea name="product_price" class="form-control"
                                placeholder="Mô tả danh mục"></textarea>
                        </div>

                        <div class="form-group">
                        <label for="exampleInput">Danh mục</label>
                            <select name="category_product" class="form-control input-sm m-bot15">
                                @foreach($category_product as $key => $cate)
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                        <label for="exampleInput">Thương Hiệu</label>
                            <select name="brand_product" class="form-control input-sm m-bot15">
                            @foreach($brand_product as $key => $brand)
                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                        <label for="exampleInput">Hiển thị</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input name="product_image" type="file" id="exampleInputFile">
                            <p class="help-block">Example block-level help text here.</p>
                        </div>
                        <button type="submit" name="add_product" class="btn btn-info">Thêm</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>

@endsection