<?php

namespace App\Services;

use App\Contracts\AttachmentServiceInterface;
use App\Contracts\FormServiceInterface;
use App\Enums\AttachmentLinkTypeEnum;
use App\Enums\AttachmentTypeEnum;
use App\Enums\FieldKindEnum;
use App\Exceptions\NotFoundResourceException;
use App\Models\City;
use App\Models\EventForms;
use App\Models\EventFormsAnswers;
use App\Models\EventFormsFillers;
use App\Models\EventFormsPerson;
use App\Models\UserDetail;
use App\Models\Webinar;
use Illuminate\Http\UploadedFile;

class FormService implements FormServiceInterface
{
    function create($eventID, $formType, $form_create): EventForms
    {
        \DB::beginTransaction();
        try {
            EventForms::where([['event_id', $eventID], ['kind', $formType]])->delete();
            foreach ($form_create as $item) {
                $eventForms = EventForms::create([
                    'kind' => $formType,
                    'event_id' => $eventID,
                    'field_id' => $item['field_id'],
                    'required' => $item['required'],
                ]);
            }
            \DB::commit();
            return $eventForms;
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw $exception;
        }
    }

    function update($id, $required, $sort): EventForms
    {
        \DB::beginTransaction();
        try {
            $eventForms = $this->find($id);
            $eventForms->where('id', $id)->update([
                'required' => $required,
                'sort' => $sort,
            ]);
            \DB::commit();
            return $eventForms->refresh();
        } catch (\Exception $exception) {
            \DB::beginTransaction();
            throw $exception;
        }
    }

    function getForm($eventID, $formType)
    {
        $event = EventForms::where([['event_id', $eventID], ['kind', $formType]])->get();
        if ($event) {
            return $event;
        } else {
            throw new NotFoundResourceException();
        }
    }

    function fillers($eventID, $kind)
    {
        try {
            return EventFormsFillers::create([
                'user_id' => auth()->id(),
                'kind' => $kind,
                'event_id' => $eventID
            ]);
        } catch (\Exception $exception) {
            throw $exception;
        }

    }

    function answer($SSoUserDetail, $event_id, $formAnswers, $formFillers)
    {
        $user = auth()->user();
        try {
            $eventFormFillers = EventFormsFillers::where('id', $formFillers)->first();
            $filed = [];
            if ($eventFormFillers->kind == FieldKindEnum::real_person)
                $filed = [
                    ['field_id' => '14', 'value' => $SSoUserDetail['first_name']],
                    ['field_id' => '15', 'value' => $SSoUserDetail['last_name']],
                    ['field_id' => '16', 'value' => $SSoUserDetail['phone']],
                    ['field_id' => '17', 'value' => $SSoUserDetail['personal_code']],
                ];
            if ($eventFormFillers->kind == FieldKindEnum::legal_person)
                $filed = [
                    ['field_id' => '14', 'value' => $SSoUserDetail['first_name']],
                    ['field_id' => '15', 'value' => $SSoUserDetail['last_name']],
                    ['field_id' => '16', 'value' => $SSoUserDetail['phone']],
                    ['field_id' => '17', 'value' => $SSoUserDetail['personal_code']],
                ];

            $form_answers = array_merge($filed, $formAnswers);
            $user->first_name = $SSoUserDetail['first_name'];
            $user->last_name = $SSoUserDetail['last_name'];
            $user->save();
            UserDetail::updateOrCreate(['user_id' => $user->id], ['national_code' => $SSoUserDetail['personal_code']]);
            foreach ($form_answers as $key => $item) {

                if ($item['field_id'] == 18)
                    UserDetail::updateOrCreate(['user_id' => $user->id], ['gender' => $item['value_id'] == 19 ? 'male' : 'female']);
                if ($item['field_id'] == 21)
                    UserDetail::updateOrCreate(['user_id' => $user->id], ['birthday' => $item['value']]);
                if ($item['field_id'] == 22)
                    UserDetail::updateOrCreate(['user_id' => $user->id], ['father' => $item['value']]);
                if ($item['field_id'] == 36)
                    UserDetail::updateOrCreate(['user_id' => $user->id], ['province_id' => City::where('id', $item['value_id'])->pluck('province_id')[0], 'city_id' => $item['value_id']]);
                if ($item['field_id'] == 35)
                    $user->email = $item['value'];

                EventFormsAnswers::updateOrCreate(['event_form_fillers_id' => $eventFormFillers->id, 'field_id' => $item['field_id']], [
                    'answer_id' => !empty($item['value_id']) && $item['value_id'] ? $item['value_id'] : null,
                    'answer_value' => !empty($item['value']) && $item['value'] ? $item['value'] : null,
                ]);
            }
            return EventFormsAnswers::where('event_form_fillers_id', $eventFormFillers->id)->get();
        } catch (\Exception $exception) {
            throw $exception;
        }

    }

    function person($SSoUserDetail, $formFillers, $persons, $formAnswers)
    {
        $filed = [
            ['field_id' => '60', 'value' => $SSoUserDetail['first_name']],
            ['field_id' => '61', 'value' => $SSoUserDetail['last_name']],
            ['field_id' => '62', 'value' => $SSoUserDetail['phone']],
            ['field_id' => '63', 'value' => $SSoUserDetail['personal_code']],
        ];
        try {

            $form_answers = array_merge($filed, $formAnswers);
            foreach ($form_answers as $item) {
                EventFormsAnswers::updateOrCreate(['event_form_fillers_id' => $formFillers, 'field_id' => $item['field_id']], [
                    'answer_id' => !empty($item['value_id']) && $item['value_id'] ? $item['value_id'] : null,
                    'answer_value' => !empty($item['value']) && $item['value'] ? $item['value'] : null,
                ]);
            }
            if (!empty($persons)) {
                EventFormsPerson::where('event_form_fillers_id', $formFillers)->delete();
                foreach ($persons as $person) {
                    $createdPerson = EventFormsPerson::updateOrCreate([
                        'event_form_fillers_id' => $formFillers,
                        'first_name' => $person['first_name'] ?? null,
                        'last_name' => $person['last_name'] ?? null,
                        'phone' => $person['phone'] ?? null,
                        'gender' => $person['gender'] ?? null,
                        'birthday' => $person['birthday'] ?? null,
                        'father' => $person['father'] ?? null,
                        'national_code' => $person['national_code'] ?? null,
                        'student_code' => $person['student_code'] ?? null,
                        'email' => $person['email'] ?? null,
                        'city_id' => $person['city_id'] ?? null,
                        'province_id' => $person['province_id'] ?? null,
                        'address' => $person['address'] ?? null,
                        'postal_code' => $person['postal_code'] ?? null,
                        'job' => $person['job'] ?? null,
                        'scientific_records' => $person['scientific_records'] ?? null,
                        'management_records' => $person['management_records'] ?? null,
                    ]);
                    if (!empty($person['avatar']) && $person['avatar'] instanceof UploadedFile)
                        app(AttachmentServiceInterface::class)->create($person['avatar'], $person['first_name'] . '_' . $person['last_name'] . '_avatar', EventFormsPerson::class, $createdPerson->id, AttachmentTypeEnum::image, AttachmentLinkTypeEnum::link);
                    if (!empty($person['resume']) && $person['resume'] instanceof UploadedFile)
                        app(AttachmentServiceInterface::class)->create($person['resume'], $person['first_name'] . '_' . $person['last_name'] . '_resume', EventFormsPerson::class, $createdPerson->id, AttachmentTypeEnum::attachment, AttachmentLinkTypeEnum::link);
                }
            }
            return EventFormsAnswers::where('event_form_fillers_id', $formFillers)->get();

        } catch (\Exception $exception) {
            throw $exception;
        }

    }

    function find(int $id): EventForms
    {
        $event = EventForms::find($id);
        if ($event) {
            return $event;
        } else {
            throw new NotFoundResourceException();
        }
    }

    function delete(int $id): bool|null
    {
        try {
            return Webinar::find($id)->delete();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
