<?php
namespace SETW\Api\Currency;

use SETW\Api\Client;
use SETW\Contracts\EmisionInterface;
use SETW\Enums\Action;

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
