<?php
namespace App\Api\Voucher;

use App\Api\Client;
use App\Enums\Action;
use App\Helper;

class Voucher extends Client
{
    const POST_METHOD   = "POST";
    const STATUS_OK     = "Ok";
    const VOUCHER_ROUTE = "voucher.php";

    /**
     * Add Voucher
     *
     * @param array $data
     * @return object
     */
    public function add(array $data)
    {
        $this->setMethod(self::POST_METHOD);

        return $this->sendRequest(
            $data,
            $this->getDefaultData(Action::ADD_VOUCHERS->value)
        );
    }

    /**
     * Edit Voucher
     *
     * @param array $data
     * @return object
     */
    public function edit(array $data)
    {
        return $this->sendRequest(
            array_merge(
                $this->getDefaultData(Action::CHECK_VOUCHER->value),
                $data
            )
        );
    }

    /**
     * Get All Vouchers
     *
     * @return object
     */
    public function get()
    {
        return $this->sendRequest(
            $this->getDefaultData(Action::GET_ALL_VOUCHERS->value)
        );
    }

    /**
     * Get Voucher Link
     *
     * @param string $voucherNumber
     * @param string $voucherKey
     * @return object
     */
    public function link(string $voucherNumber, string $voucherKey): object
    {
        $query = Helper::arrayToQueryParams([
            'voucher_number' => $voucherNumber,
            'voucher_key'    => $voucherKey,
            'change_lang'    => $this->lang,
        ]);

        return (object) $this->createLinkResponse($query);
    }

    /**
     * Get voucher price
     *
     * @param array $data
     * @return object
     */
    public function price(array $data)
    {
        return $this->sendRequest(
            array_merge(
                $this->getDefaultData(Action::GET_VOUCHER_PRICE->value),
                $data
            )
        );
    }

    /**
     * Get status
     *
     * @param string $voucherNumber
     * @return object
     */
    public function status(string $voucherNumber)
    {
        return $this->sendRequest(
            array_merge(
                $this->getDefaultData(Action::GET_VOUCHER_STATUS->value),
                ['voucher_number' => $voucherNumber]
            )
        );
    }

    /**
     * Requuire voucher annulation
     *
     * @param string $voucherNumber
     * @param string $comments
     *
     * @return object
     */
    public function requireAnnulation(string $voucherNumber, string $comments = '')
    {
        return $this->sendRequest(
            array_merge(
                $this->getDefaultData(Action::REQUIRE_ANNULATION->value),
                [
                    'voucher_number' => $voucherNumber,
                    'comments'       => $comments,
                ]
            )
        );
    }

    /**
     * Check voucher | Validate voucher informatiion
     *
     * @param array $data
     * @return object
     */
    public function check(array $data)
    {
        return $this->sendRequest(
            array_merge(
                $this->getDefaultData(Action::CHECK_VOUCHER->value),
                $data
            )
        );
    }

    /**
     * Get Voucher by voucher number
     *
     * @param string $voucherNumber
     * @return object
     */
    public function getByVoucherNumber(string $voucherNumber)
    {
        return $this->sendRequest(
            array_merge(
                $this->getDefaultData(Action::GET_VOUCHER->value),
                ['voucher_number' => $voucherNumber]
            ));
    }

    /**
     * Count vouchers
     *
     * @param string $filter
     * @return object
     */
    public function countVouchers(string $filter = '')
    {
        return $this->sendRequest(
            array_merge(
                $this->getDefaultData(Action::COUNT_VOUCHERS->value),
                ['filter' => $filter]
            ));
    }   

    protected function createLinkResponse(string $query): array
    {
        return [
            'voucher_link'   => $this->getURI() . self::VOUCHER_ROUTE . $query,
            'voucher_status' => self::STATUS_OK,
        ];
    }
}
