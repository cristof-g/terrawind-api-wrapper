<?php
namespace SETW\Api\Upgrade;

use SETW\Api\Client;
use SETW\Enums\Action;

class Upgrade extends Client
{
    public function get(int $productId, int $pasengerAge, int $tripDays)
    {
        return $this->sendRequest([
            'action'        => Action::GET_UPGRADES->value,
            'product_id'    => $productId,
            'passenger_age' => $pasengerAge,
            'trip_days'     => $tripDays,
            'language'      => $this->lang,
        ]);
    }
}
