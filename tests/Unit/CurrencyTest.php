<?php

use App\Api\Currency\Currency;

test('Can get currencies', function(){
    $currency = new Currency(
        $_ENV['user'],
        $_ENV['password']
    );

    expect($currency->get())
        ->toBeObject()
        ->not
        ->toBeEmpty();
});