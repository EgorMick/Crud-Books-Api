<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use OpenApi\Attributes as OA;

#[OA\Info(
    title: 'swagger',
    version: '1.0',
)]
abstract class Controller
{
    use AuthorizesRequests;
}
