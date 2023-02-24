<?php

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use TW\Travel;

final class TravelTest extends TestCase
{
    const PRODUCT_ID = 6742;

    protected $travel;
    protected $isSandbox = true;

    public function __construct()
    {
        parent::__construct();

        $this->travel = new Travel(
            $_ENV['user'],
            $_ENV['password'],
            $this->isSandbox
        );
    }

    public function testCanGetCountries(): void
    {
        $countries = $this->travel->getCountries();

        $this->assertNotEmpty($countries->country);
    }

    public function testCanGetCurrencies()
    {
        $currencies = $this->travel->getCurrencies();
        $this->assertNotEmpty($currencies->currency);
    }

    public function testCanGetDocumentsTypes()
    {
        $documents = $this->travel->getDocumentTypes();
        $this->assertNotEmpty($documents->document_type);
    }

    public function testCanGetRegions()
    {
        $regions = $this->travel->getRegions();
        $this->assertNotEmpty($regions->region);
    }

    public function testCanGetProducts()
    {
        $products = $this->travel->getProducts();
        $this->assertNotEmpty($products->product);
    }

    public function testCanGetProductId()
    {
        $products = $this->travel->getProductId('IMX-TRADI'); // Product - International
        $this->assertNotEmpty($products->product);
    }

    public function testCanGetTariffs()
    {
        $tariffs = $this->travel->getTariffs(self::PRODUCT_ID);
        $this->assertNotEmpty($tariffs->tariff);
    }

    public function testCanGetVoucherPrice()
    {
        $now      = Carbon::now();
        $dateFrom = $now->format('d/m/Y');
        $dateTo   = $now->add(5, 'day')->format('d/m/Y');

        $voucher = $this->travel->getVoucherPrice(self::PRODUCT_ID, 2, $dateFrom, $dateTo, [40, 50]);

        $this->assertNotEmpty($voucher);
        $this->assertGreaterThan(0, $voucher->price);
    }

    public function testCanAddVoucher()
    {
        $now      = Carbon::now();
        $faker    = \Faker\Factory::create('es_MX');
        $dateFrom = $now->add(5, 'day')->format('d/m/Y');
        $dateTo   = $now->add(10, 'day')->format('d/m/Y');

        $data = [
            'vouchers' => [
                0 => [
                    'voucher_date_from'              => $dateFrom,
                    'voucher_date_to'                => $dateTo,
                    'voucher_int_ref'                => '',
                    'voucher_product_id'             => self::PRODUCT_ID,
                    'country_id'                     => 201,
                    'passenger_document_type_id'     => 2,
                    'passenger_document_number'      => 'geroasd02',
                    'passenger_birth_date'           => '01/01/1990',
                    'passenger_gender'               => 'M',
                    'passenger_first_name'           => $faker->firstNameMale,
                    'passenger_last_name'            => $faker->lastName,
                    'passenger_second_name'          => '',
                    'passenger_country_id'           => 140,
                    'passenger_city'                 => 'Baja California Sur',
                    'passenger_address'              => $faker->streetAddress,
                    'passenger_phone'                => $faker->phoneNumber,
                    'passenger_email'                => $faker->email,
                    'passenger_emergency_first_name' => $faker->firstNameFemale,
                    'passenger_emergency_last_name'  => $faker->lastName,
                    'passenger_emergency_phone_1'    => $faker->phoneNumber,
                    'passenger_emergency_phone_2'    => $faker->phoneNumber,
                ],
            ],
        ];

        $this->travel->setMethod('POST');
        $voucher = $this->travel->addVouchers($data);

        var_dump($voucher);

        $this->assertNotEmpty($voucher);
        $this->assertNotEmpty($voucher->voucher->voucher_number);
    }

    public function testCanGetVoucherStatus()
    {
        $now      = Carbon::now();
        $faker    = \Faker\Factory::create('es_MX');
        $dateFrom = $now->add(5, 'day')->format('d/m/Y');
        $dateTo   = $now->add(10, 'day')->format('d/m/Y');

        $data = [
            'voucher_date_from'              => $dateFrom,
            'voucher_date_to'                => $dateTo,
            'voucher_int_ref'                => '',
            'voucher_product_id'             => self::PRODUCT_ID,
            'country_id'                     => 201,
            'passenger_document_type_id'     => 2,
            'passenger_document_number'      => 'xxxxxxx',
            'passenger_birth_date'           => '01/01/1990',
            'passenger_gender'               => 'M',
            'passenger_first_name'           => $faker->firstNameMale,
            'passenger_last_name'            => $faker->lastName,
            'passenger_second_name'          => '',
            'passenger_country_id'           => 140,
            'passenger_city'                 => 'Baja California Sur',
            'passenger_address'              => $faker->streetAddress,
            'passenger_phone'                => $faker->phoneNumber,
            'passenger_email'                => $faker->email,
            'passenger_emergency_first_name' => $faker->firstNameFemale,
            'passenger_emergency_last_name'  => $faker->lastName,
            'passenger_emergency_phone_1'    => $faker->phoneNumber,
            'passenger_emergency_phone_2'    => $faker->phoneNumber,
            'ccoverages'                     => "",
        ];

        $this->travel->setMethod('POST');
        $this->travel->setLang('en');
        $voucher = $this->travel->getVoucherStatus($data);

        $this->assertNotEmpty($voucher);
        $this->assertEquals($voucher->voucher_status, 'OK');
    }

    public function testCanGetVoucher()
    {
        $voucher = $this->travel->getVoucher('MEX200423C2EAB5');

        $this->assertEquals('MEX200423C2EAB5', $voucher->voucher->voucher_number);
    }

    public function testCanRequireVoucherAnnulation()
    {
        $voucher = $this->travel->requireVoucherAnnulation('MEX20042309D008');

        $this->assertNotEmpty($voucher);
        $this->assertEquals($voucher->voucher_status, 'OK');
    }

    public function testCanGetVoucherLink()
    {
        $voucher = $this->travel->getVoucherLink('MEX200424E4B52F', '8733455323BE1DBADB1F');

        $this->assertEquals($voucher['voucher_status'], "OK");
    }

    public function testCanGetUpgradeCoverage()
    {
        $voucher = $this->travel->getUpgrades(self::PRODUCT_ID, 30, 40);

        $this->assertNotEmpty($voucher);
    }
}
