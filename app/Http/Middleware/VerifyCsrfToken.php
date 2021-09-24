<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "/admin/delete-season/{id}",
        "/admin/delete-type/{id}",
        "/admin/delete-flower_type/{id}",
        "/admin/update-status-user",
    ];
}
