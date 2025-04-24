<?php
namespace SETW\Api\Coverage;

use SETW\Api\Client;
use SETW\Enums\Action;

class Coverage extends Client
{
    public function get(int $productId)
    {
        return $this->sendRequest([
            'action'     => Action::GET_COVERAGES->value,
            'product_id' => $productId,
            'language'   => $this->lang,
        ]);
    }
}
