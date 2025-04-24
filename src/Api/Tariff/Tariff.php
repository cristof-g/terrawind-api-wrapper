<?php
namespace SETW\Api\Tariff;

use SETW\Api\Client;
use SETW\Contracts\EmisionInterface;
use SETW\Enums\Action;

class Tariff extends Client implements EmisionInterface
{
    public function get()
    {}

    public function getByProductId($productId)
    {
        return $this->sendRequest([
            'action'     => Action::GET_TARIFFS->value,
            'product_id' => $productId,
            'language'   => $this->lang,
        ]);
    }
}
