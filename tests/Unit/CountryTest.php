<?php

use SETW\Api\Country\Country;

test('Can get countries', function () {
    $country = new Country(
        $_ENV['user'],
        $_ENV['password'],
    );

    expect($country->get())->toBeObject()->not->toBeEmpty();
});

test('Can get country by Region', function () {
    $country = new Country(
        $_ENV['user'],
        $_ENV['password']
    );

    $response = $country->getByRegionId(37);

    expect($response)->toBeObject()->not->toBeEmpty();

    expect($response->country_region)
        ->not
        ->toBeEmpty();
});
