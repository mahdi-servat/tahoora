<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Program;

use App\Repositories\ProgramRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CreateProgramAction
{
	public ProgramRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(ProgramRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        $data = $request->only([
            'language_id',
            'title',
            'status_id',
            'description',
            'url',
        ]);

        if ($request->has('thump')) {
            $file = $request->thump;
            $type = $file->getMimeType();
            $fileHash = str_replace('.' . $file->extension(), '', $file->hashName());
            $fileName = $fileHash . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('programImage', $fileName, 'uploads');
            $data['thump'] = 'uploads/' . $path;
        }

        return $this->repository->create($data);
	}
}
