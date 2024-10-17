<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserServiceInterface
{
    function create(string $firstName, string $lastName, string $phone, int $roles): User;

    function update(int $id, string $firstName, string $lastName, string $phone, array $roles = []): User;

    function findOrCreateUserByPhone($request): User;

    function findUserByPhone(string $phone): User;

    public function index(Request $request): LengthAwarePaginator;
}
