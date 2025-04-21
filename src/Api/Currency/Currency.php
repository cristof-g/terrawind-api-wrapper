<?php
namespace App\Api\Currency;

use App\Api\Client;
use App\Contracts\EmisionInterface;
use App\Enums\Action;

class Currency extends Client implements EmisionInterface
{
    public function get()
    {
        return $this->sendRequest([
            'action'   => Action::GET_CURRENCIES->value,
            'language' => $this->lang,
        ]);
    }
}
