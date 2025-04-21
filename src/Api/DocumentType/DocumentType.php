<?php
namespace App\Api\DocumentType;

use App\Api\Client;
use App\Contracts\EmisionInterface;
use App\Enums\Action;

class DocumentType extends Client implements EmisionInterface
{
    public function get()
    {
        return $this->sendRequest([
            'action'   => Action::GET_DOCUMENT_TYPES->value,
            'language' => $this->lang,
        ]);
    }
}