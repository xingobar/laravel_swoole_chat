<?php


use Illuminate\Http\Request;
use SwooleTW\Http\Websocket\Facades\Websocket;

/*
|--------------------------------------------------------------------------
| Websocket Routes
|--------------------------------------------------------------------------
|
| Here is where you can register websocket events for your application.
|
*/

Websocket::on('connect', function ($websocket, Request $request) {
    // called while socket on connect
    $websocket->emit('example', '我是伺服器這邊連結成功的訊息');
});

Websocket::on('disconnect', function ($websocket) {
    // called while socket on disconnect
    $websocket->emit('example', '你已經斷開連結');
});

Websocket::on('example', function ($websocket, $data) {
    // 群播, 自己不會收到
    $websocket->broadcast()->emit('message', 'this is a test');

    // 非群播
    $websocket->emit('example', 'this is a example channel');
});
