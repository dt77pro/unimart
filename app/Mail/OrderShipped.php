<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\AdminTransaction;
use Gloudemans\Shoppingcart\Facades\Cart;



class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $transactions;
    public $carts;
    public $name;
    public $email;
    public $address;
    public $phone;

    public function __construct(AdminTransaction $transactions, $name, $address, $phone, $email, $carts)
    {
        $this->transactions = $transactions;
        $this->carts = $carts;
        $this->name = $name;
        $this->phone = $email;
        $this->address = $address;
        $this->phone = $phone;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('dt77pro@gmail.com', 'Unimart')
                    ->view('mail.order')
                    ->subject('Cảm ơn bạn đã xác nhận địa chỉ email trên Unimart')
                    ->with([
                        'carts' => $this->carts,
                        'name' => $this->name,
                        'email' => $this->email,
                        'address' => $this->address,
                        'phone' => $this->phone,
                    ]);
    }
}
