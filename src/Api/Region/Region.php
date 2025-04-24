<?php
namespace SETW\Api\Region;

use SETW\Api\Client;
use SETW\Contracts\EmisionInterface;
use SETW\Enums\Action;

class Region extends Client implements EmisionInterface
{
    public function get()
    {
        return $this->sendRequest([
            'action'   => Action::GET_REGIONS->value,
            'language' => $this->lang,
        ]);
    }
}