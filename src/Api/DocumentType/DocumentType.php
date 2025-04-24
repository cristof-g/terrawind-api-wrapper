<?php
namespace SETW\Api\DocumentType;

use SETW\Api\Client;
use SETW\Contracts\EmisionInterface;
use SETW\Enums\Action;

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