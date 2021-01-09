@extends('layout')
@section('content')
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập</h2>
						<form action="{{URL::to('/login-customer')}}" method="post">
						{{csrf_field()}}
							<input name="email_account" type="text" placeholder="Name" />
							<input name="password_account" type="password" placeholder="Pasword" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Ghi nhớ
							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Tạo tài khoảng</h2>
						<form action="{{URL::to('/add-customer')}}" method="post">
						{{csrf_field()}}
							<input name="customer_name" type="text" placeholder="Name"/>
							<input name="customer_email" type="email" placeholder="Email Address"/>
							<input name="customer_password" type="password" placeholder="Password"/>
							<input name="customer_phone" type="text" placeholder="Phone"/>
							<button type="submit" class="btn btn-default">Đăng kí</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection