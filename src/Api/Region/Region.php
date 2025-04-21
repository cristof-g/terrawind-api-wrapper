<?php
namespace App\Api\Region;

use App\Api\Client;
use App\Contracts\EmisionInterface;
use App\Enums\Action;

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