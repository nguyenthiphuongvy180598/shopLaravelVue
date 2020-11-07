<?php

namespace App\Jobs;
use Illuminate\Foundation\Bus\Dispatchable;
use Cart;

class UpdateCart
{
    use Dispatchable;
    private $cartItems;
    public function __construct($cartItems)
    {
        $this->cartItems = $cartItems; 
    }
    public function handle()
    {
        foreach($this->cartItems as $key => $value){
            Cart::update($value['rowId'], $value['qty']);
        }
    }
}