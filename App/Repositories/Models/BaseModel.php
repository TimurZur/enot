<?php

namespace App\Repositories\Models;

interface BaseModel
{
    /**
     * @return int
     */
    public function getPkValue(): int;
}