<?php

namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRService
{
    public function generate(
        string $text,
        string $format = 'svg',
        int $size = 300,
        int $margin = 4
    ) {
        return QrCode::format($format)
            ->size($size)
            ->margin($margin)
            ->generate($text);
    }

    public function generatePng(string $text): string
    {
        return QrCode::size(300)->generate($text);
    }
}
