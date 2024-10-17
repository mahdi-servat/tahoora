<?php

namespace App\Http\Controllers\Api;

use App\Contracts\AuthenticationServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticationRequest;
use App\Http\Requests\Auth\SendVerificationCodeRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function __construct(readonly AuthenticationServiceInterface $authenticationService)
    {
    }

    public function sendVerificationCode(SendVerificationCodeRequest $request)
    {
        try {
            $this->authenticationService->sendVerificationCode($request->phone);
            return $this->json('کد تایید با موفقیت ارسال شد.');
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function authentication(AuthenticationRequest $request)
    {
        try {
            $data = $this->authenticationService->apiAuthentication($request);
            return new UserResource($data);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function getAuthenticatedUser(Request $request)
    {
        try {
            $user = $this->authenticationService->getAuthenticatedUser();
            return new UserResource($user);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public function checkDetailOnSSO(Request $request)
    {
        try {
            $SSoUserDetail = app(AuthenticationServiceInterface::class)->SSoAuthentication($request->bearerToken());
            $return = true;
            if (empty($SSoUserDetail['personal_code']) || empty($SSoUserDetail['full_name']))
                $return = false;
            return ['checkDetailOnSSO' => $return];
        } catch (\Exception $exception) {
            throw $exception;
        }
    }


}
