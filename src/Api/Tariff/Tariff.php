<?php
namespace App\Api\Tariff;

use App\Api\Client;
use App\Contracts\EmisionInterface;
use App\Enums\Action;

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
