<!DOCTYPE html>
<html>
<head>
	<title>Billing App</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="p-3 text-center">
			    <h4 class="mb-3">Billing Page</h4>
			</div>
	
			<form class="form-inline" method="POST" action="{{ route('purchase.store') }}">
				@csrf
			 	<div class="form-group row mb-3">
				    <label for="customer_email" class="col-sm-2 col-form-label">Customer Email</label>
				    <div class="col-sm-3">
				    	<input type="email" class="form-control" id="customer_email" name="customer_email" aria-describedby="emailHelp" placeholder="Email ID" required>
					</div>
					<div class="col-sm-3">
						<button type="button" class="btn btn-outline-secondary" id="view_purchase">View previous Purchase</button>
					</div>
			 	</div>
			 	<div class="form-group row mb-2">
			 		<div class="col-sm-12 text-center">
			 			<button type="button" class="btn btn-secondary" id="add_bill_product">Add New</button>
			 		</div>
			 	</div>
			 	<div class="form-group row">
			 		<label class="col-sm-2 col-form-label">Bill Section</label>
				 	<div class="col-sm-9 Bill_section">
				 		<div class="row mb-3">
					 		<div class="col-sm-3">
					 			<select name="product[id][]" class="form-control product-list" required>
					 				<option value="">Please select Product</option>
					 				@foreach ($products as $product)
					 					<option value="{{ $product['id'] }}">{{ $product['productID'] }} ( {{ $product['name'] }} )</option>
					 				@endforeach
					 			</select>
					 		</div>
					 		<div class="col-sm-3">
					 			<input type="text" class="form-control" name="product[quantity][]" placeholder="Quantity" required>
					 		</div>
				 		</div>
				 		<div class="row mb-3">
					 		<div class="col-sm-3">
					 			<select name="product[id][]" class="form-control product-list">
					 				<option value="">Please select Product</option>
					 				@foreach ($products as $product)
					 					<option value="{{ $product['id'] }}">{{ $product['productID'] }} ( {{ $product['name'] }} )</option>
					 				@endforeach
					 			</select>
					 		</div>
					 		<div class="col-sm-3">
					 			<input type="text" class="form-control" name="product[quantity][]" placeholder="Quantity">
					 		</div>
				 		</div>
				 		<div class="row mb-3">
					 		<div class="col-sm-3">
					 			<select name="product[id][]" class="form-control product-list">
					 				<option value="">Please select Product</option>
					 				@foreach ($products as $product)
					 					<option value="{{ $product['id'] }}">{{ $product['productID'] }} ( {{ $product['name'] }} )</option>
					 				@endforeach
					 			</select>
					 		</div>
					 		<div class="col-sm-3">
					 			<input type="text" class="form-control" name="product[quantity][]" placeholder="Quantity">
					 		</div>
				 		</div>

				 	</div>	
			 	</div>
			 	<hr class="hr" />

			 	<div class="form-group row mb-3">
			 		<label class="col-form-label col-sm-2">Denominations</label>
			 		<div class="col-sm-9">
				 		<div class="form-group row mb-2">
				 			<label for="fivehundred" class="col-form-label col-sm-2">500</label>
				 			<div class="col-sm-3">
				 				<input type="text" name="fivehundred" id="fivehundred" class="form-control">
				 			</div>
				 		</div>
				 		<div class="form-group row mb-2">
				 			<label for="twohundred" class="col-form-label col-sm-2">200</label>
				 			<div class="col-sm-3">
				 				<input type="text" name="twohundred" id="twohundred" class="form-control">
				 			</div>
				 		</div>
				 		<div class="form-group row mb-2">
				 			<label for="hundred" class="col-form-label col-sm-2">100</label>
				 			<div class="col-sm-3">
				 				<input type="text" name="hundred" id="hundred" class="form-control">
				 			</div>
				 		</div>
				 		<div class="form-group row mb-2">
				 			<label for="fifty" class="col-form-label col-sm-2">50</label>
				 			<div class="col-sm-3">
				 				<input type="text" name="fifty" id="fifty" class="form-control">
				 			</div>
				 		</div>
				 		<div class="form-group row mb-2">
				 			<label for="twenty" class="col-form-label col-sm-2">20</label>
				 			<div class="col-sm-3">
				 				<input type="text" name="twenty" id="twenty" class="form-control">
				 			</div>
				 		</div>
				 		<div class="form-group row mb-2">
				 			<label for="ten" class="col-form-label col-sm-2">10</label>
				 			<div class="col-sm-3">
				 				<input type="text" name="ten" id="ten" class="form-control">
				 			</div>
				 		</div>
				 		<div class="form-group row mb-2">
				 			<label for="five" class="col-form-label col-sm-2">5</label>
				 			<div class="col-sm-3">
				 				<input type="text" name="five" id="five" class="form-control">
				 			</div>
				 		</div>
				 		<div class="form-group row mb-2">
				 			<label for="two" class="col-form-label col-sm-2">2</label>
				 			<div class="col-sm-3">
				 				<input type="text" name="two" id="two" class="form-control">
				 			</div>
				 		</div>
				 		<div class="form-group row mb-2">
				 			<label for="one" class="col-form-label col-sm-2">1</label>
				 			<div class="col-sm-3">
				 				<input type="text" name="one" id="one" class="form-control">
				 			</div>
				 		</div>
				 	</div>
			 	</div>
			 	<div class="form-group row">
			 		<label class="col-form-label col-sm-2">Cash paid by customer</label>
			 		<div class="col-sm-3">
			 			<input type="text" name="cash_paid_by_customer" class="form-control" id="cash_paid_by_customer" placeholder="Amount">
			 		</div>
			 	</div>
			 	<div class="row">
			 		<div class="col-md-12 text-end">
					 	<button type="cancel" class="btn btn-outline-secondary ">Cancel</button>
					  	<button type="submit" class="btn btn-outline-success">Generate Bill</button>
					</div>
			  	</div>
			</form>
		</div>
	</div>
<script type="text/javascript" src="{{ asset('/js/jquery-3.6.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(e){
	$('.product-list').select2();

	$('#add_bill_product').click(function(e){
		var ele = $('.Bill_section').find('.row:nth-child(2)').prop('outerHTML');
    	$('.Bill_section').append(ele);

	});
	$('#view_purchase').click(function(e){
		var customer_email = $('#customer_email').val();
		if(customer_email == ''){
			alert('Please enter Email for check previous Purchase');
		} else {
			var url = '{{ route("purchaselist", ":email") }}';

			url = url.replace(':email', customer_email);

			window.location.href=url;
		}
	})
});
</script>
</body>
</html>