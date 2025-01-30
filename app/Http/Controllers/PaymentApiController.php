<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpseclib\Crypt\RSA;

class PaymentApiController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'amount' => 'required',
        ]);
        $product_name = "Smart Serve MSME";
        $amount = $request->amount;
        $quantity = 1;
        $total = $amount * $quantity;
        $orderId = "order_" . uniqid();
        $name = "Chan Myae Oo";

        $items_data = array(
            "name" => "$product_name",
            "amount" => "$amount",
            "quantity" => "$quantity"
        );

        $data_pay = json_encode(array(
            "clientId" => "5688c9ce-dd4f-3930-a184-19c67c98e211",
            "publicKey" => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC2w9xvFJNFZRWshQgfReIHCDLlE5xos+MsOX0Zt4R9HspFbeqPQ19rbX6q7hHWHtARrEbu0qeJ79vrqHYAFDT4hKG3sBjtMnsgHWWPeJ6QmiCE/KJaD/vbjQKmYHDNPkUtPdVBTRxIXbJFbs1oipvbEQ2RLYWRqGHL0oGzO1EvcQIDAQAB",
            "items" => json_encode(array($items_data)),
            "customerName" => $name,
            "totalAmount" => "$total",
            "merchantOrderId" => "$orderId",
            "merchantKey" => "ptc99er.Y0GWC66tobKN1B2FNt8P6_wMHd0",
            "projectName" => "MSME",
            "merchantName" => "KoChan"
        ));


        $publicKey = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCFD4IL1suUt/TsJu6zScnvsEdLPuACgBdjX82QQf8NQlFHu2v/84dztaJEyljv3TGPuEgUftpC9OEOuEG29z7z1uOw7c9T/luRhgRrkH7AwOj4U1+eK3T1R+8LVYATtPCkqAAiomkTU+aC5Y2vfMInZMgjX0DdKMctUur8tQtvkwIDAQAB';

        $rsa = new RSA();

        extract($rsa->createKey(1024));
        $rsa->loadKey($publicKey); // public key
        $rsa->setEncryptionMode(2);
        $ciphertext = $rsa->encrypt($data_pay);
        $value = base64_encode($ciphertext);

        $urlencode_value = urlencode($value);

        $encryptedHashValue = hash_hmac('sha256', $data_pay, '0c6fbc2e8b3e3d0e8301c9179ddfc587');

        $redirect_url = "https://prebuilt.dinger.asia/?hashValue=$encryptedHashValue&payload=$urlencode_value";

        return response()->json([
            'redirect_url' => $redirect_url
        ]);
    }
}
