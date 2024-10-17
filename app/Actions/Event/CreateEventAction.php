<?php

/**
 * Actions are class for process
 */

namespace App\Actions\Event;

use App\Repositories\EventRepositoryEloquent;
use App\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CreateEventAction
{
	public EventRepositoryEloquent $repository;


	public function __construct()
	{
		$this->repository = App::make(EventRepositoryEloquent::class);
	}


	public function handle(Request $request)
	{
        $data = $request->only([
            'language_id',
            'status_id',
            'title',
            'second_title',
            'price',
            'url_path',
            'live_url_path',
            'contacts',
            'location_text',
            'summary',
            'content',
        ]);

        if ($request->has('thump')) {
            $file = $request->thump;
            $type = $file->getMimeType();
            $fileHash = str_replace('.' . $file->extension(), '', $file->hashName());
            $fileName = $fileHash . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('eventImage', $fileName, 'uploads');
            $data['thump'] = 'uploads/' . $path;
        }
        $data['price'] = !empty($request->price) ? Util::convertToEn($request->price) : null ;
        $data['start_date'] = !empty($request->start_date) ? Util::toGregorian($request->start_date) : null;
        $data['end_date'] = !empty($request->end_date) ? Util::toGregorian($request->end_date) : null;

        $event = $this->repository->create($data);

        return $event;
	}
}
