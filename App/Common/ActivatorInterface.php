<?php

namespace App\Common;

interface ActivatorInterface
{
    /**
     * @return int
     */
    public function getCode(): int;

    /**
     * @param int $code
     *
     * @return bool
     */
    public function verifyCode(int $code): bool;
}