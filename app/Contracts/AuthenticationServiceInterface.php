<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;

interface AuthenticationServiceInterface
{
    function SSoAuthentication($userToken);

    function apiAuthentication($request): User;

    function webAuthentication(string $phone, string $verificationCode): User;

    function sendVerificationCode(string $phone): void;

    function getAuthenticatedUser(): User;

}
