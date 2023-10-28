<?php

namespace App\Exceptions;

use App\Jobs\TelegramLogError;
use Exception;
use Illuminate\Support\Facades\Log;

class TelegramLogHandler extends Exception
{
    public function report($exception): void
    {
        if ($this->isCriticalError($exception)) {
            dispatch(new TelegramLogError('Произошла критическая ошибка: ' . $exception->getMessage()));
            Log::error($exception);
        }
    }

    protected function isCriticalError($exception): bool
    {
        return $exception->getCode() !== 422;
    }
}
