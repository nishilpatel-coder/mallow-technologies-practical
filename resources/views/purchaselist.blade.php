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
			    <h4 class="mb-3">Purchase List</h4>
			</div>
		</div>

		<div class="row">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>purchase ID</th>
						<th>Bill No.</th>
						<th>Total Price</th>
						<th>Total Tax Price</th>
						<th>Net Price</th>
						<th>Paid by Customer</th>
					</tr>
				</thead>
				<tbody>
					@foreach($Purchases as $purchase)
						<tr>
							<td>{{ $purchase->id }}</td>
							<td>{{ $purchase->bill_no }}</td>
							<td>{{ $purchase->total_price }}</td>
							<td>{{ $purchase->total_tax }}</td>
							<td>{{ $purchase->net_price }}</td>
							<td>{{ $purchase->paid_by_customer }}</td>
						</tr>
						<tr>
							<td colspan="6">
								<table class="table mb-0">
									<thead>
										<tr>
											<th>Product ID</th>
											<th>Name</th>
											<th>Quantity</th>
											<th>Purchase price</th>
											<th>Tax Price</th>
											<th>Total Price</th>
										</tr>
									</thead>
									<tbody>
										@foreach($purchase->purchaseDetail as $purchaseDetail)
										<tr>
											<td>{{$purchaseDetail->products->productID}}</td>
											<td>{{$purchaseDetail->products->name}}</td>
											<td>{{$purchaseDetail->quantity}}</td>
											<td>{{$purchaseDetail->total_price}}</td>
											<td>{{$purchaseDetail->tax_price}}</td>
											<td>{{$purchaseDetail->total_price+$purchaseDetail->tax_price}}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
<script type="text/javascript" src="{{ asset('/js/jquery-3.6.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(e){
	$('.product-list').select2();

	$('#add_bill_product').click(function(e){
		var ele = $('.Bill_section').find('.row:first').prop('outerHTML');
    	$('.Bill_section').append(ele);

	});
});
</script>
</body>
</html>