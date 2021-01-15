@extends('admin_layout');
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập Nhật Thương Hiệu
            </header>

            <div class="panel-body">
            @foreach($edit_brand_product as $key=> $edit_value)
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-brand-product', $edit_value->brand_id)}}" method="post">
                    {{ csrf_field() }}
                    <?php
	$message = Session::get('message');
	if($message){
		echo $message;
		Session::get('message',null);
    }
    else
    echo null;
	?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Danh Mục</label>
                            <input name="brand_product_name" value="{{$edit_value->brand_name}}" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea name="brand_product_desc" class="form-control"
                                placeholder="Mô tả danh mục"> {{$edit_value->brand_desc}} </textarea>
                        </div>

                        <button type="submit" name="update_brand_product" class="btn btn-info">Update</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>

    </div>
</div>

@endsection