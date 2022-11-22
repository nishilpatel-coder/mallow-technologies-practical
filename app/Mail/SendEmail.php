<?php

namespace App\Mail;

use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Product;
use App\Models\Denomination;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $purchase;
    public $purchaseDetail;
    public $product;
    public $denomination;

    public function __construct($purchase)
    {
        $this->purchase = $purchase;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $purchase_id = $this->purchase->id;
        $purchaseDetail = PurchaseDetail::with('products')->where('purchase_id','=',$purchase_id)->get();
        $DenominationDetails = Denomination::where('purchase_id','=',$purchase_id)->where('bill_type','=','OUT')->get();
        return $this->view('invoice',array('purchase' => $this->purchase,'purchaseDetails'=>$purchaseDetail,'DenominationDetails'=>$DenominationDetails));
    }
}
