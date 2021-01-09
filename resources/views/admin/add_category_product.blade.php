@extends('admin_layout');
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Danh Mục
            </header>

            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                    
                    {{ csrf_field() }}
                    <?php
	$message = Session::get('message');
	if($message){
		echo $message;
		Session::get('message',null);
	}
	?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Danh Mục</label>
                            <input name="category_product_name" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea name="category_product_desc" class="form-control"
                                placeholder="Mô tả danh mục"></textarea>
                        </div>

                        <div class="form-group">
                        <label for="exampleInput">Hiển thị</label>
                            <select name="category_product_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiện</option>
                            </select>
                        </div>

                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>

@endsection