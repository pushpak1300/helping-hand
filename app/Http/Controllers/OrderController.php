<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Razorpay\Api\Api;

class OrderController extends Controller
{
    private $api;
    public function __construct()
    {
        $this->api = new Api(Config::get('api_key'), Config::get('api_secret'));
    }

    public function order()
    {
        //todo
    }
}
