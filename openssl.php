<?php
    $data="12345";
    //clave del cifrado
    $key="mi_key_secret";
    //metodo de cifrado
    $cipher="aes-256-cbc";
    //vector de inicializacion para el cifrado
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher));

    $cifrado = openssl_encrypt($data,$cipher,$key,OPENSSL_RAW_DATA,$iv);
    echo "Cifrado: " . base64_encode($cifrado);

    //$decifrado = openssl_decrypt($cifrado,$cipher,$key,OPENSSL_RAW_DATA,$iv);
    //echo "Decifrado: " . $decifrado;

    $textoCifrado = base64_encode($iv . $cifrado);
    $iv_dec = substr(base64_decode($textoCifrado), 0, openssl_cipher_iv_length($cipher));
    $cifradoSinIV = substr(base64_decode($textoCifrado), openssl_cipher_iv_length($cipher));

    $decifrado = openssl_decrypt($cifradoSinIV,$cipher,$key,OPENSSL_RAW_DATA,$iv_dec);
    echo "Decifrado: " . $decifrado;
