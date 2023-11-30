<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class EsewaIntegration extends Controller
{
    // follow doc for more 
    //https://developer.esewa.com.np/pages/Epay-V2#transactionflow
    //  raw code without package 

    public function index()
    {
            $url = "https://uat.esewa.com.np/epay/main";
            $data =[
                'amt'=> 100,
                'pdc'=> 0,
                'psc'=> 0,
                'txAmt'=> 0,
                'tAmt'=> 100,
                'pid'=>'ee2c3ca1-696b-4cc5-a6be-2c40d929d453',
                'scd'=> 'EPAYTEST',
                'su'=>'http://localhost:8000/esewa/success?q=su',
                'fu'=>'http://localhost:8000/esewa/fail??q=fu'
            ];

        // generate form from attributes
        $htmlForm = '<form method="POST" action="'.$url.'" id="esewa-form">';

        foreach ($data as $name => $value):
            $htmlForm .= sprintf('<input name="%s" type="hidden" value="%s">', $name, $value);
        endforeach;

        $htmlForm .= '</form><script type="text/javascript">document.getElementById("esewa-form").submit();</script>';

        // output the form
        echo $htmlForm;


    }
    function generateSignature($total_amount, $transaction_uuid, $product_code, $secret_key)
    {
        // Concatenate parameters in the specified order
        $message = "total_amount={$total_amount},transaction_uuid={$transaction_uuid},product_code={$product_code}";
    
        // Calculate HMAC/SHA256 hash
        $signature = hash_hmac('sha256', $message, $secret_key, true);
    
        // Encode in base64
        $signature_base64 = base64_encode($signature);
    
        return $signature_base64;
    }

    public function pay() {
       
    }
    public function success(Request $request) {
        return $request;
    }

    public function fail(Request $request) {
        return $request;
    }

   
}
