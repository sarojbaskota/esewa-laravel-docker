<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

require '../vendor/autoload.php';

use Cixware\Esewa\Client;
use Cixware\Esewa\Config;

class ProductController extends Controller
{
    public function pay(Request $request)
    {
        $pid = uniqid();
        $amount = 500; // you can use form if you want
        // create  'product_id' => $pid, here and tracke your order payment based on that 

        // either it's success or failed 

        // set success and failure callback urls
        $successUrl = url('/success');
        $failureUrl = url('/fail');

        // config for local
        $config = new Config($successUrl, $failureUrl);


        // initialize eSewa client
        $esewa = new Client($config);

        $esewa->process($pid, $amount, 0, 0, 0); // change if you need
    }


    public function success()
    {
        $pid = $_GET['oid'];
        $refId = $_GET['refId'];
        $amount = $_GET['amt'];
        return 'success';
        // check and do further code 
    }

    public function fail()
    {
         $_GET['pid'];
        return 'failed';

        // check and do further code 
    }
}
