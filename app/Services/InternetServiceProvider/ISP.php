<?php

namespace App\Services\InternetServiceProvider;

interface ISP
{
    public function setMonth(int $month): void;

    public function calculateTotalAmount(): int;
}
