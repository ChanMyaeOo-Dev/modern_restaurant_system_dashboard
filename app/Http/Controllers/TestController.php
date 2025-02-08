<?php

namespace App\Http\Controllers;

use phpseclib\Crypt\RSA;

class TestController extends Controller
{
    public function encryptData()
    {
        $items_data = array(
            "name" => "Dinger University Donation",
            "amount" => "1000",
            "quantity" => "1"
        );

        $data_pay = json_encode(array(
            "providerName" => "KoChan",
            "methodName" => "donation",
            "totalAmount" => "1000",
            "items" => json_encode(array($items_data)),
            "orderId" => 2000,
            "customerName" => "Chan Myae Oo",
            "customerPhone" => "09779866151"
        ));

        $publicKey = '-----BEGIN PUBLIC KEY-----MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC2w9xvFJNFZRWshQgfReIHCDLlE5xos+MsOX0Zt4R9HspFbeqPQ19rbX6q7hHWHtARrEbu0qeJ79vrqHYAFDT4hKG3sBjtMnsgHWWPeJ6QmiCE/KJaD/vbjQKmYHDNPkUtPdVBTRxIXbJFbs1oipvbEQ2RLYWRqGHL0oGzO1EvcQIDAQAB-----END PUBLIC KEY-----';

        $rsa = new \phpseclib\Crypt\RSA();

        extract($rsa->createKey(1024));
        $rsa->loadKey($publicKey); // public key
        $rsa->setEncryptionMode(2);

        $ciphertext = $rsa->encrypt($data_pay);

        $value = base64_encode($ciphertext);
        return $value;
    }
    public function index()
    {
        $product_name = "Smart Serve MSME";
        $amount = 100000;
        $quantity = 2;
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


        // $publicKey = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCFD4IL1suUt/TsJu6zScnvsEdLPuACgBdjX82QQf8NQlFHu2v/84dztaJEyljv3TGPuEgUftpC9OEOuEG29z7z1uOw7c9T/luRhgRrkH7AwOj4U1+eK3T1R+8LVYATtPCkqAAiomkTU+aC5Y2vfMInZMgjX0DdKMctUur8tQtvkwIDAQAB';
        $publicKey = '-----BEGIN PUBLIC KEY-----MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCFD4IL1suUt/TsJu6zScnvsEdLPuACgBdjX82QQf8NQlFHu2v/84dztaJEyljv3TGPuEgUftpC9OEOuEG29z7z1uOw7c9T/luRhgRrkH7AwOj4U1+eK3T1R+8LVYATtPCkqAAiomkTU+aC5Y2vfMInZMgjX0DdKMctUur8tQtvkwIDAQAB-----END PUBLIC KEY-----';


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
            "redirect_url" => $redirect_url
        ]);
    }
}
