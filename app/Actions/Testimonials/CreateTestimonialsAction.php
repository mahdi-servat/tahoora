<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Testimonials;

use App\Actions\Attachment\CreateAttachmentAction;
use App\Repositories\TestimonialsRepositoryEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CreateTestimonialsAction
{
	public $repository;


	public function __construct()
	{
		$this->repository = App::make(TestimonialsRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        $data = $request->only([
            'title',
            'description',
            'museum_id',
        ]);
        $attachmentRequest = Request::create('test', 'post', [
            'file' => $request->thump,
            'title' => "بارگذاری شده در توصیفات",
        ]);
        $file = app(CreateAttachmentAction::class)->handle($attachmentRequest);

        $data['thump_id'] = $file->id;
        return $this->repository->create($data);

    }
}
