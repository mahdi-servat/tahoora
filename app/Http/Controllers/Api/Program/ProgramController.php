<?php

namespace App\Http\Controllers\Api\Program;

use App\Actions\Program\FindProgramAction;
use App\Actions\Program\GetAllProgramAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Program\Api\FindProgramRequest;
use App\Http\Requests\Program\Api\GetAllProgramRequest;
use App\Http\Resources\Program\ProgramCollection;
use App\Http\Resources\Program\ProgramResource;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(GetAllProgramRequest $request)
    {
        $data = app(GetAllProgramAction::class)->handle($request);

        return new ProgramCollection($data);
    }

    public function find(FindProgramRequest $request)
    {
        $request->content_type = "api";

        $data = app(FindProgramAction::class)->handle($request);

        return new ProgramResource($data);
    }
}
