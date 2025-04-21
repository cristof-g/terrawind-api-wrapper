<?php
namespace App\Api;

use App\Helper;

class Client
{
    const BASE_URI         = "https://emision.setw.net";
    const BASE_URI_SANDBOX = "https://sandbox.setw.net";

    const API_PATH         = "/api/";
    const API_SANDBOX_PATH = "/emision/api/";

    public string $apiVersion = "v2";

    protected string $user;
    protected string $password;
    protected bool $sandbox;
    protected string $lang   = 'en';
    protected string $method = 'GET';
    protected $client;

    public function __construct(string $user, string $password, bool $sandbox = true)
    {
        $this->user     = $user;
        $this->password = $password;
        $this->sandbox  = $sandbox;

        $this->initConnection();
    }

    public function initConnection(): void
    {
        $this->client = new \GuzzleHttp\Client(['base_uri' => $this->getURI()]);
    }

    public function setLang(string $lang): void
    {
        $this->lang = $lang;
    }

    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    protected function getApiPath(): string
    {
        return $this->sandbox ? self::API_SANDBOX_PATH : self::API_PATH;
    }

    protected function getRequestData(array $data): array
    {
        $auth = ['auth' => [$this->user, $this->password]];

        if ($this->isGetMethod()) {
            return array_merge($auth, ['query' => $data]);
        }

        return array_merge($auth, ['form_params' => $data]);
    }

    protected function getURI(): string
    {
        return $this->sandbox ? self::BASE_URI_SANDBOX : self::BASE_URI;
    }

    protected function getUrl(string $query): string
    {
        return $this->getApiPath() . "{$this->apiVersion}/{$query}";
    }

    protected function sendRequest(array $data, array $query = []): mixed
    {
        $uri = $this->getUrl(
            Helper::arrayToQueryParams($query)
        );

        $response = $this->client->request(
            $this->method,
            $uri,
            $this->getRequestData($data)
        );

        $body = Helper::cleanString(
            (string) $response->getBody()->getContents()
        );

        $xml = Helper::stringToXML($body);

        return Helper::parseXML($xml);
    }

    /**
     * Default Voucher Data
     *
     * @param string $action
     * @return array
     */
    protected function getDefaultData(string $action): array
    {
        return [
            'action'   => $action,
            'language' => $this->method,
        ];
    }

    protected function isGetMethod(): bool
    {
        return $this->method == 'GET';
    }

}
