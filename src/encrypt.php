<?php
function encrypt($data) {
    $key = 'rf3MUpnafsflihCNNMrlyDtKnI91LlDN_UmTV9VcEgo=';
    $cipher_algo = 'aes-256-cbc';
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher_algo));
    $encrypted = openssl_encrypt($data, $cipher_algo, $key, 0, $iv);
    return base64_encode($iv . ':' . $encrypted);
}
?>