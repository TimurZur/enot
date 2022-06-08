<?php

namespace App\Repositories\Constants;

enum ConfirmationTypes: string
{
    case NONE = 'none';
    case SMS = 'sms';
    case TG = 'tg';
    case EMAIL = 'email';
}