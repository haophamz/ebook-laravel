<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $orders;

    public function __construct(Order $order, $orders)
    {
        $this->order = $order;
        $this->orders = $orders;
    }

    public function build()
    {
        return $this->subject('Thanh toán thành công đơn hàng #' . $this->order->id)
            ->view('emails.payment-success');
    }
}