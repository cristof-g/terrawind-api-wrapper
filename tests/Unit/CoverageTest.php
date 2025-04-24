<?php

use SETW\Api\Coverage\Coverage;

test('get coverages', function () {
    $coverages = new Coverage(
        $_ENV['user'],
        $_ENV['password']
    );

    $coverages = $coverages->get(8563);

    expect($coverages)
        ->toBeObject()
        ->not
        ->toBeEmpty();
});

