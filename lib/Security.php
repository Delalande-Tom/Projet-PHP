<?php
class Security {
    private static $seed = 'G24oHwJz1t';

    public static function hacher($texte_en_clair) {
        $steak_hache = hash('sha256', $texte_en_clair);
        return Security::$seed . $steak_hache;
    }
    public static function generateRandomHex() {
        $numbytes = 16;
        $bytes = openssl_random_pseudo_bytes($numbytes);
        $hex = bin2hex($bytes);
        return $hex;
    }
}
?>
