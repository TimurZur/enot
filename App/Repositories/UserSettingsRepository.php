<?php

namespace App\Repositories;

use App\Repositories\Models\UserSettingsModel;

interface UserSettingsRepository
{
    /**
     * @param int $userId
     *
     * @return UserSettingsModel[]
     */
    public function findByUserId(int $userId): array;

    /**
     * @param int $userId
     * @param string $settingName
     *
     * @return UserSettingsModel
     */
    public function findSetting(int $userId, string $settingName): UserSettingsModel;

    /**
     * @param UserSettingsModel $model
     *
     * @return void
     */
    public function save(UserSettingsModel $model): void;
}