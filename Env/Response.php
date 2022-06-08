<?php

namespace Env;

interface Response
{
    /**
     * @param array $data
     *
     * @return void
     */
    public function json(array $data): void;

    /**
     * @param array $data
     *
     * @return void
     */
    public function success(array $data = []): void;

    /**
     * @param string $message
     *
     * @return void
     */
    public function error(string $message): void;
}