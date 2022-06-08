<?php

namespace App\Common;

class Activator implements ActivatorInterface
{
    public function getCode(): int
    {
        return 1;
    }

    /**
     * @param int $code
     *
     * @return bool
     */
    public function verifyCode(int $code): bool
    {
        return true;
    }
}