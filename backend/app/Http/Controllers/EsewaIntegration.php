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
        $decodedData = base64_decode('eyJ0cmFuc2FjdGlvbl9jb2RlIjoiMDAwNkdISSIsInN0YXR1cyI6IkNPTVBMRVRFIiwidG90YWxfYW1vdW50IjoiMTAwLjAiLCJ0cmFuc2FjdGlvbl91dWlkIjoiOUExNzg3NDAxNjcyNyIsInByb2R1Y3RfY29kZSI6IkVQQVlURVNUIiwic2lnbmVkX2ZpZWxkX25hbWVzIjoidHJhbnNhY3Rpb25fY29kZSxzdGF0dXMsdG90YWxfYW1vdW50LHRyYW5zYWN0aW9uX3V1aWQscHJvZHVjdF9jb2RlLHNpZ25lZF9maWVsZF9uYW1lcyIsInNpZ25hdHVyZSI6ImxnZW1iMUswVEVOcUlPS0VuamxJOGphM0dvNXRaTkxpd0c4Snc3MXZFZlE9In0=');
        $jsonData = json_decode($decodedData);
        return $jsonData->status;
        
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
        $message = 'total_amount='.$total_amount.',transaction_uuid='.$transaction_uuid.',product_code='.$product_code;
        // return $message;
        // Calculate HMAC/SHA256 hash
        $signature = hash_hmac('sha256', $message, $secret_key, true);
        // return $signature;
        // Encode in base64
        $signature_base64 = base64_encode($signature);

        return $signature_base64;
    }

    public function pay() {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(100000, 999999)
        . mt_rand(100000, 999999)
        . $characters[rand(0, strlen($characters) - 1)];
        // shuffle the result
        $pid = str_shuffle($pin);
        
        $sign = $this->generateSignature(100,$pid,'EPAYTEST','8gBm/:&EnhH.1/q');
        
        $url = 'https://rc-epay.esewa.com.np/api/epay/main/v2/form';
        $data =[
            'amount'=> 100,
            'failure_url'=>'http://localhost:8000/e-failure',
            'product_delivery_charge'=> 0,
            'product_service_charge'=> 0,
            'product_code'=> 'EPAYTEST',
            'signature'=> $sign,
            'signed_field_names'=> 'total_amount,transaction_uuid,product_code',
            'success_url'=>'http://localhost:8000/e-success',
            'tax_amount'=> 0,
            'total_amount'=> 100,
            'transaction_uuid'=> $pid,
        ];
        $htmlForm = '<form method="POST" action="'.$url.'" id="esewa-form">';

        foreach ($data as $name => $value):
            $htmlForm .= sprintf('<input name="%s" type="hidden" value="%s">', $name, $value);
        endforeach;

        $htmlForm .= '</form><script type="text/javascript">document.getElementById("esewa-form").submit();</script>';

        // output the form
        echo $htmlForm;
    }
    public function eSuccess(Request $request) {
        return $request;
        // handle request here 
        $decodedData = base64_decode($request->data);
        $jsonData = json_decode($decodedData);
        // check status 
        if($jsonData->status == 'COMPLETE'){
            // redirect customer to their order page or success message 
        }else{
            //handle failure
        }
    
    }

    public function eFailure(Request $request) {
        return $request;
        // handle request here 

    }

   
}
