<?php

namespace App\Controllers;

use App\Common\ActivatorInterface;
use App\Common\EmailActivator;
use App\Common\SmsActivator;
use App\Common\TgActivator;
use App\Repositories\Constants\ConfirmationTypes;
use App\Repositories\UserSettingsRepository;
use App\Services\UserSettingsService;
use Env\Request;
use Env\Response;

class SettingsController
{
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var Response
     */
    protected Response $response;

    /**
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function changeAction(UserSettingsService $service): void
    {
        if ($this->request->session()->get('settings.confirmation.code.confirmed') !== 1) {
            $this->response->error('Code not confirmed');
        }

        $this->request->session()->unset('settings.confirmation');

        $service->changeSetting(
            $this->request->user()->getId(),
            $this->request->getParam('name'),
            $this->request->getParam('value'),
        );
    }

    /**
     * @param ActivatorInterface $activator
     *
     * @return void
     */
    public function verifyCodeAction(ActivatorInterface $activator): void
    {
        $code = $this->request->getParam('code');

        if ($activator->verifyCode($code)) {
            $this->request->session()->set('settings.confirmation.code.confirmed', 1);
            $this->response->success();
        }

        $this->response->error('Invalid code');
    }

    /**
     * @param UserSettingsService $service
     *
     * @return void
     */
    public function getSettingsAction(UserSettingsService $service): void
    {
        $this->response->json([
            'settings' => $service->getUserSettings($this->request->user()->getId()),
        ]);
    }

    /**
     * @param UserSettingsRepository $repository
     *
     * @return void
     */
    public function sendCodeAction(UserSettingsRepository $repository): void
    {
        $settingName = $this->request->getParam('name');

        if (
            !empty($this->request->session()->get('settings.confirmation.code.sent'))
            && (time() - $this->request->session()->get('settings.confirmation.code.sent')) <= 45
        ) {
            $this->response->error('wait');
        }

        $this->request->session()->unset('settings.confirmation.code.sent');

        $setting = $repository->findSetting($this->request->user()->getId(), $settingName);

        switch ($setting->getConfirmationType()) {
            case ConfirmationTypes::TG:
                (new TgActivator())->sendCode();
                break;
            case ConfirmationTypes::EMAIL:
                (new EmailActivator())->sendCode();
                break;
            case ConfirmationTypes::SMS:
                (new SmsActivator())->sendCode();
                break;
        }

        $this->request->session()->set('settings.confirmation.code.sent', time());

        $this->response->success();
    }

    /**
     * @param UserSettingsService $service
     *
     * @return void
     */
    public function changeConfirmationTypeAction(UserSettingsService $service): void
    {
        $type = ConfirmationTypes::tryFrom($this->request->getParam('type'));

        if ($type === null) {
            $this->response->error('Invalid type');
        }

        $service->changeConfirmationType(
            $this->request->user()->getId(),
            $this->request->getParam('name'),
            $type
        );

        $this->response->success();
    }
}