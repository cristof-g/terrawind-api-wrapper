<?php

use SETW\Api\DocumentType\DocumentType;

test('Can get documents types', function(){
    $documentType = new DocumentType(
        $_ENV['user'],
        $_ENV['password']
    );

    expect($documentType->get())
        ->toBeObject()
        ->not
        ->toBeEmpty();
});