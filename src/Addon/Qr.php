<?php

namespace Nocks\SDK\Addon;

use Endroid\QrCode\QrCode;

/**
 * Class Qr
 * @package Nocks\SDK\Addon
 */
class Qr
{
    function render($text, $size = 200)
    {
        $qrCode = new QrCode;
        $qrCode->setText($text);
        $qrCode->setSize($size);

        return $qrCode->getDataUri($text);
    }
}