<?php

namespace App\Repositories\Models;

use App\Repositories\Constants\ConfirmationTypes;

interface UserSettingsModel extends BaseModel
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getValue(): string;

    /**
     * @return ConfirmationTypes
     */
    public function getConfirmationType(): ConfirmationTypes;

    /**
     * @param $value
     *
     * @return void
     */
    public function setValue($value): void;

    /**
     * @param ConfirmationTypes $type
     *
     * @return void
     */
    public function setConfirmationType(ConfirmationTypes $type): void;
}