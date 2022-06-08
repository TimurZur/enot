<?php

namespace Env;

use App\Repositories\Models\UserModel;

interface Request
{
    /**
     * @return bool
     */
    public function isXmlHttpRequest(): bool;

    /**
     * @param string $path
     *
     * @return void
     */
    public function redirect(string $path): void;

    /**
     * @return Session
     */
    public function session(): Session;

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getParam(string $key): mixed;

    /**
     * @return UserModel
     */
    public function user(): UserModel;
}