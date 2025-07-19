<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileUser extends Controller
{
    public function show(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }
}
