<?php

namespace App\Http\Controllers\web\Program;

use App\Actions\Program\CreateProgramAction;
use App\Actions\Program\DeleteProgramAction;
use App\Actions\Program\FindProgramAction;
use App\Actions\Program\GetAllProgramAction;
use App\Actions\Program\UpdateProgramAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Program\Web\CreateProgramRequest;
use App\Http\Requests\Program\Web\DeleteProgramRequest;
use App\Http\Requests\Program\Web\FindProgramRequest;
use App\Http\Requests\Program\Web\GetAllProgramRequest;
use App\Http\Requests\Program\Web\StoreProgramRequest;
use App\Http\Requests\Program\Web\UpdateProgramRequest;
use Illuminate\Http\Request;
use Mmwdali\ContainerBuilder\Http\AutoWebController;

class ProgramController extends AutoWebController
{
    public function getClass() : array
    {
        return [
            'indexRequest' => GetAllProgramRequest::class ,
            'createRequest' => CreateProgramRequest::class ,
            'editRequest' => FindProgramRequest::class ,
            'storeRequest' => StoreProgramRequest::class ,
            'updateRequest' => UpdateProgramRequest::class ,
            'deleteRequest' => DeleteProgramRequest::class ,
            'indexAction' => GetAllProgramAction::class ,
            'createAction' => CreateProgramAction::class ,
            'deleteAction' => DeleteProgramAction::class,
            'findAction' => FindProgramAction::class,
            'updateAction' => UpdateProgramAction::class,
            'form' => ProgramForm::class,
            'viewPath' => 'admin.layouts.program',
            'routePrefix' => 'program',
            'list_title' => 'برنامه ها',
            'add_title' => 'برنامه',
        ];
    }
}
