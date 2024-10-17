<?php

namespace App\Actions\ContactUs;

use App\Repositories\ContactUsRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CreateContactUsAction
{
    public $repository;


    public function __construct()
    {
        $this->repository = App::make(ContactUsRepositoryEloquent::class);
    }


    public function handle(Request $request)
    {
        $data = $request->only([
            'category',
            'description',
            'name',
            'email',
            'phone',
        ]);

        if (auth('sanctum')->check()) {
            $data['user_id'] = auth('sanctum')->id();
            $data['name'] = auth('sanctum')->user()->getFullNameAttribute();
            $data['phone'] = auth('sanctum')->user()->phone;
        }

        if (!empty($data['user_id']) && $data['user_id'] != 1)
            send_notification_to_admin_by_sms('یک پیام جدید در ارتباط باما برای شما نوشته شد.');

        return $this->repository->create($data);

    }
}
