@extends('layout')
@section('content')

<section id="cart_items">
		<div class="container">
        <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
</div>

			<div class="register-req">
				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<form action="{{URL::to('/save-checkout-customer')}}" method="post">
									{{csrf_field()}}
									<input type="text" name="shipping_email" placeholder="Email*">
									<input type="text" name="shipping_name" placeholder="First Name">
									<input type="text" name="shipping_address" placeholder="Address">
									<input type="text" name="shipping_phone" placeholder="Phone">

									<p>Shipping Order</p>
									<textarea name="shipping_notes"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
									<button type="submit" class="btn btn-primary" name="send_order">Gửi</button>
								</form>
							</div>
						</div>
					</div>
					<!-- <div class="col-sm-4">
						<div class="order-message">
							<p>Shipping Order</p>
							<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
							<label><input type="checkbox">Shipping to bill address</label>
						</div>	
					</div>					 -->
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
	</section> <!--/#cart_items-->

@endsection