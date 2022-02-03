<?php

namespace App\Services\EmployeeManagement;

class Staff implements Employee
{
    public function applyJob(): bool
    {
        return false;
    }

    public function salary(): int
    {
        return 200;
    }
}
