<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '5025800924:AAG6ghT_u5HOqtghJaLcaODTOPn0RjP8rWk/webhook',
        'bot*'
    ];
}
