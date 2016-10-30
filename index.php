<?php
use MyVendor\Amidakuji\Amidakuji;

require_once __DIR__ . '/vendor/autoload.php';

// 動作確認用
try {
    $filePath = 'example2.dat';
    $amidakuji = new Amidakuji($filePath);
    $number = $amidakuji->findStartNumber(1);
    if ($number !== false) {
        echo $number;
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
