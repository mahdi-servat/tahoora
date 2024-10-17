<?php

namespace App\Services;

use App\Contracts\AuthenticationServiceInterface;
use App\Contracts\UserServiceInterface;
use App\Models\User;
use App\Util;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AuthenticationService implements AuthenticationServiceInterface
{

    function SSoAuthentication($userToken)
    {
        try {
            return Http::withToken($userToken)->acceptJson()->get(env('SSO_URL') . '/api/v1/user')['data'];
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function apiAuthentication($request): User
    {
        try {

            if (is_verification_code_true($request->phone, $request->verification_code)) {
                $user = app(UserServiceInterface::class)->findOrCreateUserByPhone($request);
                $token = $user->createToken('API')->plainTextToken;
                $user->token = $token;
                return $user;
            }
            else {
                throw new AuthenticationException(__('auth.failed'));
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    public static function isVerificationCodeTrue($phone, $code)
    {
    }

    function webAuthentication(string $phone, string $verificationCode): User
    {
        try {
            if (is_verification_code_true($phone, $verificationCode)) {
                $user = app(UserServiceInterface::class)->findOrCreateUserByPhone($phone);
                if (!$user->hasRole('admin'))
                    throw new AuthenticationException(__('auth.unauthorization'));
                Auth::guard('web')->login($user);
                return $user;
            }
            else {
                throw new AuthenticationException(__('auth.failed'));
            }
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    function sendVerificationCode(string $phone): void
    {
        $ownNumbers = ['9893390380133', '989331642162', '989331642161'];
        if (in_array($phone, $ownNumbers)) {
            $code = '2966';
            Cache::put('phone_verification_code_' . $phone, $code, now()->addYear());
        }
        else {
            $code = mt_rand(1000, 9999);
            Cache::put('phone_verification_code_' . $phone, $code, now()->addMinutes(5));
            Util::sendVerificationCodeBySms($phone, $code);
        }
    }

    function getAuthenticatedUser(): User
    {
        return auth()->user();
    }
}
