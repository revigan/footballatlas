<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mews\Captcha\Facades\Captcha;

class CaptchaController extends Controller
{
    /**
     * Reload captcha image.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reload()
    {
        return response()->json(['captcha' => Captcha::img('flat')]);
    }
}
