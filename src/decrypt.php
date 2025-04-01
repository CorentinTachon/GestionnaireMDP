<?php
function decrypt($data) {
    if ($data === null) {
        return '';
    }

    $key = 'rf3MUpnafsflihCNNMrlyDtKnI91LlDN_UmTV9VcEgo=';
    $cipher_algo = 'aes-256-cbc';
    $data = base64_decode($data);
    list($iv, $encrypted) = explode(':', $data, 2);
    return openssl_decrypt($encrypted, $cipher_algo, $key, 0, $iv);
}
?>