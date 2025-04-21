<?php
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;


test("Can get connection", function(){
    $mock = new MockHandler([
        new Response(200, ['X-Foo' => 'Bar'], 'Hello, World'),
        new Response(202, ['Content-Length' => 0]),
        new RequestException('Error Communicating with Server', new Request('GET', 'test'))
    ]);

    $handlerStack = HandlerStack::create($mock);
    $client = new Client(['handler' => $handlerStack]);

    $response = $client->request('GET', '/');

    expect($response->getStatusCode())->toBe(200);
});