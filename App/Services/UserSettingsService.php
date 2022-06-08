<?php

namespace App\Services;

use App\Repositories\Constants\ConfirmationTypes;
use App\Repositories\Models\UserSettingsModel;
use App\Repositories\UserSettingsRepository;

class UserSettingsService
{
    /**
     * @var UserSettingsRepository
     */
    protected UserSettingsRepository $repository;

    public function __construct(UserSettingsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $userId
     * @param string $name
     * @param string $value
     *
     * @return void
     */
    public function changeSetting(int $userId, string $name, string $value): void
    {
        $setting = $this->repository->findSetting($userId, $name);
        $setting->setValue($value);
        $this->repository->save($setting);
    }

    /**
     * @param int $userId
     *
     * @return array|array[]
     */
    public function getUserSettings(int $userId): array
    {
        return array_map(function (UserSettingsModel $setting) {
            return [
                'name' => $setting->getName(),
                'value' => $setting->getValue(),
                'confirmationType' => $setting->getConfirmationType(),
            ];
        }, $this->repository->findByUserId($userId));
    }

    /**
     * @param int $userId
     * @param string $settingName
     * @param ConfirmationTypes $newType
     *
     * @return void
     */
    public function changeConfirmationType(int $userId, string $settingName, ConfirmationTypes $newType): void
    {
        $setting = $this->repository->findSetting($userId, $settingName);
        $setting->setConfirmationType($newType);
        $this->repository->save($setting);
    }
}