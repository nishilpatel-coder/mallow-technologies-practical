<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Product;
use App\Models\Denomination;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use View;


class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseRequest $request)
    {
        $customer_email = $request->customer_email;
        $products = $request->product;
        $cashPaidByCustomer = $request->cash_paid_by_customer;
        $fivehundred = (empty($request->fivehundred))?0:$request->fivehundred;
        $twohundred = (empty($request->twohundred))?0:$request->twohundred;
        $hundred = (empty($request->hundred))?0:$request->hundred;
        $fifty = (empty($request->fifty))?0:$request->fifty;
        $twenty = (empty($request->twenty))?0:$request->twenty;
        $ten = (empty($request->ten))?0:$request->ten;
        $five = (empty($request->five))?0:$request->five;
        $two = (empty($request->two))?0:$request->two;
        $one = (empty($request->one))?0:$request->one;

        $total_price = 0;
        $total_tax = 0;
        $purchaseDetail = array();
        foreach ($products['id'] as $Pkey => $Pvalue) {
            if(!empty($Pvalue)){
                $detail = array();
                $detail['product_id'] = $Pvalue;
                $detail['quantity'] = $products['quantity'][$Pkey];
                $detail['unit'] = 'KG';
                $product = Product::where('id','=',$Pvalue)->get();
                foreach ($product as $PDkey => $PDvalue) {
                    $product_price = number_format($PDvalue->price*$products['quantity'][$Pkey],2);
                    $product_tax = number_format($product_price*$PDvalue->tax /100,2);
                }
                $detail['total_price'] = $product_price;
                $detail['tax_price'] = $product_tax;
                $total_price +=$product_price;
                $total_tax +=$product_tax;
                $purchaseDetail[] = $detail;
            }
        }
        $net_price = $total_price+$total_tax;
        $payableToCustomer = $cashPaidByCustomer-floor($net_price);

        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $bill_no = substr(str_shuffle($str_result),0, 5);
        $purchaserecord = Purchase::create([
            'customer_email'=>$customer_email,
            'bill_no'=>'INV-'.$bill_no,
            'total_price'=>$total_price,
            'total_tax'=>$total_tax,
            'net_price'=>$net_price,
            'paid_by_customer'=>$cashPaidByCustomer,
            'payable_to_customer'=>$payableToCustomer
        ]);
        $purchaseID = $purchaserecord->id;

        foreach ($purchaseDetail as $PDkey => $PDvalue) {
            $PDvalue['purchase_id'] = $purchaseID;
            $purchaseDetailRecord = PurchaseDetail::create($PDvalue);
        }

        $DenominationRecord = Denomination::create([
            'fivehundred'=>$fivehundred,
            'twohundred'=>$twohundred,
            'hundred'=>$hundred,
            'fifty'=>$fifty,
            'twenty'=>$twenty,
            'ten'=>$ten,
            'five'=>$five,
            'two'=>$two,
            'one'=>$one,
            'purchase_id'=>$purchaseID,
            'bill_type'=>'IN',
        ]);

        $returnCash = array();

        if($payableToCustomer >= 500){
            $returnCash['fivehundred'] = floor($payableToCustomer/500);
            $payableToCustomer = $payableToCustomer - (500*$returnCash['fivehundred']);
        } else {
            $returnCash['fivehundred'] = 0;
        }

        if($payableToCustomer >= 200){
            $returnCash['twohundred'] = floor($payableToCustomer/200);
            $payableToCustomer = $payableToCustomer - (200*$returnCash['twohundred']);
        } else {
            $returnCash['twohundred'] = 0;
        }

        if($payableToCustomer >= 100){
            $returnCash['hundred'] = floor($payableToCustomer/100);
            $payableToCustomer = $payableToCustomer - (100*$returnCash['hundred']);
        } else {
            $returnCash['hundred'] = 0;
        }

        if($payableToCustomer >= 50){
            $returnCash['fifty'] = floor($payableToCustomer/50);
            $payableToCustomer = $payableToCustomer - (50*$returnCash['fifty']);
        } else {
            $returnCash['fifty'] = 0;
        }

        if($payableToCustomer >= 20){
            $returnCash['twenty'] = floor($payableToCustomer/20);
            $payableToCustomer = $payableToCustomer - (20*$returnCash['twenty']);
        } else {
            $returnCash['twenty'] = 0;
        }

        if($payableToCustomer >= 10){
            $returnCash['ten'] = floor($payableToCustomer/10);
            $payableToCustomer = $payableToCustomer - (10*$returnCash['ten']);
        } else {
            $returnCash['ten'] = 0;
        }

        if($payableToCustomer >= 5){
            $returnCash['five'] = floor($payableToCustomer/5);
            $payableToCustomer = $payableToCustomer - (5*$returnCash['five']);
        } else {
            $returnCash['five'] = 0;
        }

        if($payableToCustomer >= 2){
            $returnCash['two'] = floor($payableToCustomer/2);
            $payableToCustomer = $payableToCustomer - (2*$returnCash['two']);
        } else {
            $returnCash['two'] = 0;
        }

        if($payableToCustomer >= 1){
            $returnCash['one'] = floor($payableToCustomer/1);
            $payableToCustomer = $payableToCustomer - (1*$returnCash['one']);
        } else {
            $returnCash['one'] = 0;
        }
        $returnCash['purchase_id'] = $purchaseID;
        $returnCash['bill_type'] = 'OUT';
        
        $DenominationRecordOut = Denomination::create($returnCash);

        return redirect()->route('purchase.show', ['purchase' => $purchaseID]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {   
        $details['email'] = $purchase->customer_email;
        $details['purchase'] = $purchase;
        dispatch(new \App\Jobs\SendEmailJob($details));
        $purchase_id = $purchase->id;
        $purchaseDetail = PurchaseDetail::with('products')->where('purchase_id','=',$purchase_id)->get();
        $DenominationDetails = Denomination::where('purchase_id','=',$purchase_id)->where('bill_type','=','OUT')->get();
        return View::make('invoice', array('purchase' => $purchase,'purchaseDetails'=>$purchaseDetail,'DenominationDetails'=>$DenominationDetails));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseRequest  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }

    public function view_purchase($email)
    {
        $getPurchases = Purchase::where('customer_email','=',$email)->get();
        foreach ($getPurchases as $Pkey => $Pvalue) {
            $purchaseDetails = PurchaseDetail::with('products')->where('purchase_id','=',$Pvalue->id)->get();
            $getPurchases[$Pkey]['purchaseDetail'] = $purchaseDetails; 
        }
        return View::make('purchaselist', array('Purchases' => $getPurchases));
    }
}
