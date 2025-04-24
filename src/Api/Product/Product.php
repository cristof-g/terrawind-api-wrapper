<?php
namespace SETW\Api\Product;

use SETW\Api\Client;
use SETW\Contracts\EmisionInterface;
use SETW\Enums\Action;

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
