<?php

namespace Env;

interface Session
{
    /**
     * @param string $key
     * @param $value
     *
     * @return void
     */
    public function set(string $key, $value): void;

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key): mixed;

    /**
     * @param string $key
     *
     * @return void
     */
    public function unset(string $key): void;
}