<?php

namespace App\Contracts;

use App\Models\EventForms;

interface FormServiceInterface
{
    function create($eventID, $formType, $form_create): EventForms;

    function update($id, $required, $sort): EventForms;

    function getForm($eventID, $formType);

    function fillers($eventID, $kind);

    function answer($SSoUserDetail, $event_id, $formAnswers, $formFillers);

    function person($SSoUserDetail ,$formFillers, $persons,$formAnswers);

    function find(int $id): EventForms;

    function delete(int $id): bool|null;

}
