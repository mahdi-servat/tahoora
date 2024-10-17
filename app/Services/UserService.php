<?php

namespace App\Services;

use App\Contracts\UserServiceInterface;
use App\Exceptions\NotFoundResourceException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService implements UserServiceInterface
{

    function create(string $firstName, string $lastName, string $phone,  $roles ): User
    {
        \DB::beginTransaction();
        try {
            $data = [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'phone' => phone_normalization($phone),
            ];
            $user = User::create(
                $data
            );
            if (!empty($roles)) {
                $user->roles()->sync($roles);
            }
            \DB::commit();
            return $user;
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }
    }

    function update(int $id, string $firstName, string $lastName, string $phone, array $roles = []): User
    {
        \DB::beginTransaction();
        try {
            $data = [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'phone' => phone_normalization($phone),
            ];
            $user = User::find($id);
            $user->update(
                $data
            );
            $user->roles()->sync($roles);
            \DB::commit();
            return $user;
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }
    }

    function findOrCreateUserByPhone($request): User
    {
        try {
            $user = $this->findUserByPhone($request->phone);
        } catch (\Exception) {
            try {
                $user = $this->create($request->first_name, $request->last_name, $request->phone,'');
            } catch (\Exception) {
                throw new \Exception(__('messages.error_user_create_message'));
            }
        }


        return $user;
    }

    function findUserByPhone(string $phone): User
    {
        $phone = phone_normalization($phone);
        $user = User::where('phone', $phone)->first();
        if (!$user) {
            throw new NotFoundResourceException();
        }
        return $user;
    }

    public function index(Request $request): LengthAwarePaginator
    {
        return User::paginate();
    }
}
