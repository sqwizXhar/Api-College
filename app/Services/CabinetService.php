<?php

namespace App\Services;

use App\Models\Cabinet;

class CabinetService extends BaseService
{
    public function __construct(Cabinet $cabinet)
    {
        parent::__construct($cabinet);
    }
}
