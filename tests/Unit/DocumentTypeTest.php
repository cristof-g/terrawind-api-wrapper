<?php

use App\Api\DocumentType\DocumentType;

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