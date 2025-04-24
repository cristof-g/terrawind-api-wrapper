<?php

use SETW\Api\Upgrade\Upgrade;

test('can get upgrades', function () {
    $upgrade = new Upgrade(
        $_ENV['user'],
        $_ENV['password']
    );

    $response = $upgrade->get(8563, 30, 30);

    expect($response)
        ->toBeObject()
        ->not
        ->toBeEmpty();

    expect(isset($response->error))
        ->toBeFalse();
});
