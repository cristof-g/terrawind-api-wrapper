<?php

use App\Api\Product\Product;

test('Can get products', function(){
    $product = new Product(
        $_ENV['user'],
        $_ENV['password'],
    );

    $res = $product->get();

    expect($res)
        ->toBeObject()
        ->not
        ->toBeEmpty();
});