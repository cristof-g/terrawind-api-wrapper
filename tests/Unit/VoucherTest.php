<?php

use SETW\Api\Voucher\Voucher;
use SETW\Helper;

$faker = Faker\Factory::create();

$voucher = new Voucher(
    $_ENV['user'],
    $_ENV['password'],
);

$vocuherData = [
    'voucher_date_from'              => Helper::date('d/m/Y', "now", "+5 days"),
    'voucher_date_to'                => Helper::date('d/m/Y', "now", '+15 days'),
    'voucher_int_ref'                => "",
    'voucher_product_id'             => 6743,
    'country_id'                     => 140,
    'passenger_document_type_id'     => 2,
    'passenger_document_number'      => "GTA30244",
    'passenger_birth_date'           => Helper::date('d/m/Y', '1991-10-01'),
    'passenger_gender'               => "M",
    'passenger_first_name'           => $faker->firstName(),
    'passenger_last_name'            => $faker->lastName(),
    'passenger_second_name'          => "",
    'passenger_country_id'           => 227,
    'passenger_city'                 => '',
    'passenger_address'              => '',
    'passenger_phone'                => $faker->phoneNumber(),
    'passenger_email'                => $faker->email(),
    'passenger_emergency_first_name' => $faker->name(),
    'passenger_emergency_last_name'  => $faker->lastName(),
    'passenger_emergency_phone_1'    => $faker->phoneNumber(),
    'passenger_emergency_phone_2'    => $faker->phoneNumber(),
    'ccoverages'                     => [],
];

test('check voucher', function () use ($voucher, $vocuherData) {
    $response = $voucher->check($vocuherData);

    expect(isset($response->error))
        ->toBeFalse();

    expect($response->voucher_status)
        ->toBe("OK");
});

test('add voucher', function () use ($voucher, $vocuherData) {
    $response = $voucher->add(['vouchers' => [$vocuherData]]);

    expect(isset($response->error))
        ->toBeFalse();

    expect($response->voucher_status)->toBe("OK");
});

test('edit voucher', function () use ($voucher, $vocuherData) {
    unset($vocuherData['voucher_int_ref']);
    unset($vocuherData['voucher_product_id']);

    $vocuherData['voucher_number'] = "";

    $response = $voucher->edit($vocuherData);

    expect(isset($response->error))
        ->toBeFalse();

    expect($response->voucher_status)
        ->toBe("OK");
});

test('get all vouchers', function () use ($voucher) {
    $response = $voucher->get();

    expect(isset($response->error))
        ->toBeFalse();

    expect((isset($response->voucher)))
        ->toBeTrue();
});

test('can get voucher link', function () use ($voucher) {
    $response = $voucher->link('MEX2302226199A2', 'DE350ACD8FFDD7752F2A');

    expect($response->voucher_link)
        ->toBeString()
        ->not
        ->toBeEmpty();

    expect($response->voucher_status)
        ->toBe("Ok");
});

test('get voucher price', function () use ($voucher) {
    $response = $voucher->price([
        'product_id'            => 9657,
        'passengers'            => 1,
        'date_from'             => Helper::date('d/m/Y', "now", "+5 days"),
        'date_to'               => Helper::date('d/m/Y', "now", '+15 days'),
        'passengers_ages'       => [31],
        'passengers_ccoverages' => [],
    ]);

    expect(isset($response->price))->toBeTrue();

    expect($response->price)->toBe("82.94");
});

test('get voucher status', function () use ($voucher) {
    $response = $voucher->status('MEX2302226199A2');

    expect($response->status_id)->toBe("0");

    expect($response->status_text)->toBe('Normal');
});

test('can required annulation', function () use ($voucher) {
    $response =  $voucher->requireAnnulation('', 'cancel voucher test');

    expect($response->voucher_status)
        ->toBe("OK");
});

test('can get voucher by number', function () use ($voucher) {
    $response = $voucher->getByVoucherNumber('MEX2302226199A2');

    expect(isset($response->voucher))
        ->toBeTrue();

    expect($response->voucher->voucher_number)
        ->toBe('MEX2302226199A2');
});

test('get count vouchers', function () use ($voucher) {
    $response = $voucher->countVouchers();

    expect(isset($response->vouchers_count))
        ->toBeTrue();

    expect($response->vouchers_count)
        ->toBe("1");
});
