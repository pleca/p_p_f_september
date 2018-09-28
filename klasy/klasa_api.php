<?php

class api {


    public static function encryptUrlValue ($url, $key = "ksdkjhIUy&^%&^TDhjewhge2y3guy%^%$")
    {

        $method = 'AES-256-CBC';
        $ivSize = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($ivSize);

        $encrypted = openssl_encrypt($url, $method, $key, OPENSSL_RAW_DATA, $iv);
        $encrypted = trim(strtr(base64_encode($iv.$encrypted), '+/', '-_'), '=');

        return $encrypted;
    }


    public static function decryptUrlValue ($url, $key = "ksdkjhIUy&^%&^TDhjewhge2y3guy%^%$")
    {

        $method = 'AES-256-CBC';
        $url = base64_decode(str_pad(strtr($url, '-_', '+/'), strlen($url) % 4, '=', STR_PAD_RIGHT));
        $ivSize = openssl_cipher_iv_length($method);
        $iv = substr($url, 0, $ivSize);
        $url = openssl_decrypt(substr($url, $ivSize), $method, $key, OPENSSL_RAW_DATA, $iv);

        return $url;
    }

}