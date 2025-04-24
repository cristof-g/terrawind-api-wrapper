<?php
namespace SETW\Api\Country;

use SETW\Api\Client;
use SETW\Contracts\EmisionInterface;
use SETW\Enums\Action;

class Country extends Client implements EmisionInterface
{
    public function get()
    {
        return $this->sendRequest([
            'action'   => Action::GET_COUNTRIES->value,
            'language' => $this->lang,
        ]);
    }

    public function getByRegionId($regionId)
    {
        return $this->sendRequest([
            'action'    => Action::GET_COUNTRY_BY_REGION->value,
            'language'  => $this->lang,
            'region_id' => $regionId,
        ]);
    }
}
