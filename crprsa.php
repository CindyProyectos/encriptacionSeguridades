<?php
    include 'Crypt/RSA.php';

    //Genero objeto en base a la clase Crypt_RSA
    $rsa=new Crypt_RSA();
    //extraigo la llave primaria
    extract ($rsa->createKey());
    //$textoplano='abc';  - lo q voy a encriptar
    //con el objeto cargar el load key y guardar en private key
    $rsa->loadKey($privatekey);
    //$textoencriptado=rsa->encrypt($textoplano); - cifrar texto
    $rsa->loadKey($publickey);
    //$textodesencriptado=rsa->decrypt($textocifrado); - decifrar texto
?>
