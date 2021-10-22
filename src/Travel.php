<?php
namespace TW;

class Travel
{
    const BASE_URI         = 'https://emision.setw.net';
    const BASE_URI_SANDBOX = 'https://emision.sandbox-setw.info';

    protected $client;
    protected $lang   = 'en';
    protected $method = 'GET';
    protected $sandbox;

    public function __construct($user, $password, $sandbox = false)
    {
        $this->user     = $user;
        $this->password = $password;
        $this->sandbox  = $sandbox;

        $this->initClientConnection();
    }

    /**
     * Init Client Connection to the Web Services
     *
     * @param [type] $sandbox
     * @return void
     */
    protected function initClientConnection()
    {
        $uri = $this->getURI();

        $this->client = new \GuzzleHttp\Client(['base_uri' => $uri]);
    }

    protected function getURI()
    {
        return $this->sandbox ? self::BASE_URI_SANDBOX : self::BASE_URI;
    }

    /**
     * Set Lang
     *
     * @param string $lang | en|es
     * @return void
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * Set method form
     *
     * @param string $method
     * @return void
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * Add New Voucher
     *
     * @param array $vauchers | Passengers Data
     * @return object
     */
    public function addVouchers(array $vauchers)
    {
        return $this->sendRequest($vauchers, '?action=add_vouchers');
    }

    /**
     * Edit Voucher
     *
     * @param array $data
     * @return object
     */
    public function editVoucher(array $data)
    {
        return $this->sendRequest($data, '?action=edit_voucher');
    }

    /**
     * Get Countries
     *
     * @return array
     */
    public function getCountries()
    {
        return $this->sendRequest([
            'action'   => 'get_countries',
            'language' => $this->lang,
        ]);
    }

    /**
     * Product Id
     *
     * @param integer $productId
     * @return object
     */
    public function getCoverages(int $productId)
    {
        return $this->sendRequest([
            'action'     => 'get_coverages',
            'language'   => $this->lang,
            'product_id' => $productId,
        ]);
    }

    /**
     * Get Currencies
     *
     * @return object
     */
    public function getCurrencies()
    {
        return $this->sendRequest([
            'action' => 'get_currencies',
        ]);
    }

    /**
     * Get Documents Types
     *
     * @return object
     */
    public function getDocumentTypes()
    {
        return $this->sendRequest([
            'action' => 'get_document_types',
        ]);
    }

    /**
     * Get Regions
     *
     * @return object
     */
    public function getRegions()
    {
        return $this->sendRequest([
            'action' => 'get_regions',
        ]);
    }

    /**
     * Get Terrawind products
     *
     * @param string $language
     * @return object
     */
    public function getProducts()
    {
        return $this->sendRequest([
            'action'   => 'get_products',
            'language' => $this->lang,
        ]);
    }

    /**
     * Get Product ID by product code
     *
     * @param string $productCode
     * @return object
     */
    public function getProductId(string $productCode)
    {
        return $this->sendRequest([
            'action'       => 'get_product_id',
            'language'     => $this->lang,
            'product_code' => $productCode,
        ]);
    }

    /**
     * Get Tariffs of specific product
     *
     * @param integer $productId
     * @return object
     */
    public function getTariffs(int $productId)
    {
        return $this->sendRequest([
            'action'     => 'get_tariffs',
            'product_id' => $productId,
        ]);
    }

    /**
     * Get Voucher by voucher number
     *
     * @param string $voucherNumber
     * @return object
     */
    public function getVoucher(string $voucherNumber)
    {
        return $this->sendRequest([
            'action'         => 'get_voucher',
            'voucher_number' => $voucherNumber,
        ]);
    }

    /**
     * Get Voucher Link
     *
     * @param string $voucherNumber
     * @param string $voucherKey
     * @return array
     */
    public function getVoucherLink(string $voucherNumber, string $voucherKey)
    {
        if (!empty($voucherNumber) && !empty($voucherKey)) {
            return [
                'voucher_link'   => $this->getURI() . '/voucher.php?voucher_number=' . $voucherNumber . '&voucher_key=' . $voucherKey . '&change_lang=' . $this->lang,
                'voucher_status' => 'OK',
            ];
        }

        return [
            'voucher_status' => 'ERROR',
        ];
    }

    /**
     * Get Voucher Price
     *
     * @param integer $productId
     * @param integer $passengers
     * @param mixed $dateFrom (dataTime/String)
     * @param mixed $dateTo (DataTime/String)
     * @return object
     */
    public function getVoucherPrice(int $productId, int $passengers, $dateFrom, $dateTo)
    {
        return $this->sendRequest([
            'action'     => 'get_voucher_price',
            'language'   => $this->lang,
            'product_id' => $productId,
            'passengers' => $passengers,
            'date_from'  => $dateFrom,
            'date_to'    => $dateTo,
        ]);
    }

    /**
     * Get Voucher Status
     *
     * @param array $data
     * @return object
     */
    public function getVoucherStatus(array $data)
    {
        return $this->checkVoucher($data, '?action=edit_voucher');
    }

    /**
     * Require Voucher Annulation
     *
     * @param string $voucherNumber
     * @param string $comments
     * @return object
     */
    public function requireVoucherAnnulation(string $voucherNumber, string $comments = '')
    {
        return $this->sendRequest([
            'action'         => 'require_voucher_annulation',
            'voucher_number' => $voucherNumber,
            'comments'       => $comments,
        ]);
    }

    /**
     * Check Voucher
     *
     * @param array $data
     * @return object
     */
    protected function checkVoucher(array $data)
    {
        $data = array_merge(['action' => 'check_voucher'], $data);

        return $this->sendRequest($data);
    }

    /**
     * Send Client Request
     *
     * @param array $data
     * @param string $params Additional params to URL
     * @return object
     */
    protected function sendRequest(array $data, string $params = '')
    {
        $formData = ['auth' => [$this->user, $this->password]];
        $uri      = '/api/' . $params;

        if ($this->method == 'GET') {
            $formData['query'] = $data;
        } else {
            $formData['form_params'] = $data;
        }

        $response = $this->client->request($this->method, $uri, $formData);

        $body = (string) $response->getBody()->getContents();
        $body = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $body);
        $xml  = simplexml_load_string($body, 'SimpleXMLElement', LIBXML_NOCDATA);

        return $this->parseXML($xml);
    }

    /**
     * Parse XML
     *
     * @param object $xml
     * @return string
     */
    protected function parseXML($xml)
    {
        return unserialize(serialize(json_decode(json_encode((array) $xml, 1))));
    }

    protected function hasError($data)
    {
        return isset($data->error);
    }
}
