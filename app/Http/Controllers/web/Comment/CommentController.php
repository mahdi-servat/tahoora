<?php

namespace App\Http\Controllers\web\Comment;

use App\Actions\Comment\FindCommentAction;
use App\Actions\Comment\GetAllCommentAction;
use App\Http\Controllers\Controller;
use App\Models\Comment\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $data = app(GetAllCommentAction::class)->handle($request);

        return view('admin.layouts.comment.list' , compact('data'));
    }


    public function edit(Request $request)
    {
        $data = app(FindCommentAction::class)->handle($request);

        return view('admin.layouts.comment.create' , compact('data'));
    }


    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = Comment::find($request->id);
            $data->update([
                'status_id' => $request->status_id
            ]);
            DB::commit();
            return redirect(route('comment.index'))->with('success', __('messages.success_message'));
        }catch (\Exception $e){
            DB::rollback();
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                $msg = 'messages.duplicate_entry';
            } else {
                $msg = $e->getMessage() . ' ' . $e->getLine();
            }
            return redirect()->back()->withInput()->with('error', __($msg));
        }
    }
}
