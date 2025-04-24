<?php

use SETW\Api\Region\Region;

test('can get regions', function () {
    $region = new Region(
        $_ENV['user'],
        $_ENV['password'],
    );

    $response = $region->get();

    expect($response)
        ->toBeObject()
        ->not
        ->toBeEmpty();
});
