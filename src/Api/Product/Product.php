<?php
namespace App\Api\Product;

use App\Api\Client;
use App\Contracts\EmisionInterface;
use App\Enums\Action;

class Product extends Client implements EmisionInterface
{
    public function get()
    {
        return $this->sendRequest(
            $this->getDefaultData(Action::GET_PRODUCTS->value)
        );
    }

    public function getWithComissions()
    {
        return $this->sendRequest(
            $this->getDefaultData(Action::GET_PRODUCT_COMISSION->value)
        );
    }
}
