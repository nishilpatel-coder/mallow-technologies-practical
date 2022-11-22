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
	
			<div class="form-inline">
			 	<div class="form-group row">
				    <label for="customer_email" class="col-sm-2 col-form-label">Customer Email</label>
				    <div class="col-sm-3">
				    	{{ $purchase->customer_email }}
					</div>
			 	</div>
			 	<div class="row mt-3">
			 		<label class="col-sm-2 col-form-label">Bill Section</label>
			 		<div class="col-sm-10">
			 			<table class="table table-bordered">
			 				<tbody>
			 					@foreach ($purchaseDetails as $purchaseDetail)
			 					<tr>
			 						<td>{{ $purchaseDetail->products->productID }}</td>
			 						<td>{{ $purchaseDetail->unit }}</td>
			 						<td>{{ $purchaseDetail->quantity }}</td>
			 						<td>{{ $purchaseDetail->products->price }}</td>
			 						<td>{{ $purchaseDetail->products->tax }}%</td>
			 						<td>{{ $purchaseDetail->tax_price }}</td>
			 						<td>{{ $purchaseDetail->total_price }}</td>
			 					</tr>
			 					@endforeach
			 				</tbody>
			 			</table>
			 		</div>
			 	</div>

			 	<div class="row mt-5">
			 		<div class="col-md-12 text-end">
			 			<h5>Total price without tax : {{ $purchase->total_price }}</h5> 
			 			<h5>Total tax payable : {{ $purchase->total_tax }}</h5> 
			 			<h5>Net price of the purchase item : {{ $purchase->net_price }}</h5> 
			 			<h5>Rounded down value of the purchased items net price : {{ number_format(floor($purchase->net_price),2) }}</h5> 
			 			<h5>Balance payable to the customer : {{ number_format($purchase->payable_to_customer,2) }}</h5> 
			 		</div>
			 	</div>
			 	<hr class="hr" />

			 	<div class="row mt-5 mb-5">
			 		<div class="col-md-12 text-end">
			 			<h5>Balance Denomination</h5>
			 			@foreach($DenominationDetails as $DenominationDetail)
			 			@if( $DenominationDetail->fivehundred > 0)
			 			<h5>500 : {{ $DenominationDetail->fivehundred }}</h5> 
			 			@endif
			 			@if( $DenominationDetail->twohundred > 0)
			 			<h5>200 : {{ $DenominationDetail->twohundred }}</h5> 
			 			@endif
			 			@if( $DenominationDetail->hundred > 0)
			 			<h5>100 : {{ $DenominationDetail->hundred }}</h5> 
			 			@endif
			 			@if( $DenominationDetail->fifty > 0)
			 			<h5>50 : {{ $DenominationDetail->fifty }}</h5> 
			 			@endif
			 			@if( $DenominationDetail->twenty > 0)
			 			<h5>20 : {{ $DenominationDetail->twenty }}</h5> 
			 			@endif 
			 			@if( $DenominationDetail->ten > 0)
			 			<h5>10 : {{ $DenominationDetail->ten }}</h5> 
			 			@endif
			 			@if( $DenominationDetail->five > 0)
			 			<h5>5 : {{ $DenominationDetail->five }}</h5> 
			 			@endif
			 			@if( $DenominationDetail->two > 0)
			 			<h5>2 : {{ $DenominationDetail->two }}</h5> 
			 			@endif
			 			@if( $DenominationDetail->one > 0)
			 			<h5>1 : {{ $DenominationDetail->one }}</h5> 
			 			@endif
			 			@endforeach
			 		</div>
			 	</div>

			</div>
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