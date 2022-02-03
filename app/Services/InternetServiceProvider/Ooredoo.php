<?php

namespace App\Services\InternetServiceProvider;

class Ooredoo implements ISP
{
    protected $operator = 'ooredoo';

    protected $month = 0;

    protected $monthlyFees = 150;

    public function setMonth(int $month): void
    {
        $this->month = $month;
    }

    public function calculateTotalAmount(): int
    {
        return $this->month * $this->monthlyFees;
    }
}
