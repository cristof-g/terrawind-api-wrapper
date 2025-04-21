<?php

use App\Api\Tariff\Tariff;

test('can get tariffs by product id', function () {
    $tariff = new Tariff(
        $_ENV['user'],
        $_ENV['password'],
    );

    $response = $tariff->getByProductId(9500);

    expect(isset($response->error))
        ->toBeFalse();

    expect($response)
        ->toBeObject()
        ->not
        ->toBeEmpty();
});
