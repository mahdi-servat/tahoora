<?php

namespace App\Http\Controllers\web\ContactUs;

use App\Actions\ContactUs\CreateContactUsAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function postContact(Request $request): JsonResponse
    {
        return $this->json(app(CreateContactUsAction::class)->handle($request), 'با تشکر از شما. پیام شما ثبت گردید');
    }
}
