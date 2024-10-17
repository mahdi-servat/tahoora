<?php

namespace Mmwdali\ContainerBuilder\Http;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Kris\LaravelFormBuilder\FormBuilder;

abstract class AutoApiController extends Controller
{
    abstract public function getClass(): array;


    public array $class;

    public function __construct(FormBuilder $formBuilder)
    {
        $this->class = $this->getClass();
    }

    public function index()
    {
        $request = app($this->class['indexRequest']);

        $data = app($this->class['indexAction'])->handle($request);


        return view($this->viewPath . '.list', compact('data', 'props'));
    }

    public function create()
    {
        $request = app($this->class['createRequest']);

        $data = null;

        $props = $this->props;

        $form = $this->formBuilder->create($this->class['form'], [
            'method' => 'POST',
            'class' => 'form row',
            'url' => route($this->class['routePrefix'] . '.store'),
            'model' => $data,
            'enctype' => 'multipart/form-data',
            'data' => []
        ]);

        return view($this->viewPath . '.create', compact('form', 'data', 'props'));

    }

    public function store()
    {
        $request = app($this->class['storeRequest']);

        DB::beginTransaction();
        try {
            DB::commit();
            $data = app($this->class['createAction'])->handle($request);
            return redirect(route($this->class['routePrefix'] . '.index'))->with('success', __('messages.success_message'));
        } catch (\Exception $e) {
            DB::rollback();
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $msg = 'messages.duplicate_entry';
            } else {
                $msg = $e->getMessage() . ' ' . $e->getLine();
            }
            return redirect()->back()->withInput()->with('error', __($msg));
        }
    }

    public function edit()
    {
        $request = app($this->class['editRequest']);

        $data = app($this->class['findAction'])->handle($request);

        $props = $this->props;

        $form = $this->formBuilder->create($this->class['form'], [
            'method' => 'POST',
            'class' => 'form row',
            'url' => route($this->class['routePrefix'] . '.update', ['id' => $request->id]),
            'model' => $data,
            'enctype' => 'multipart/form-data',
            'data' => []
        ]);

        return view($this->viewPath . '.create', compact('form', 'data', 'props'));
    }

//
    public function update()
    {

        $request = app($this->class['updateRequest']);

        DB::beginTransaction();
        try {
            DB::commit();
            $data = app($this->class['updateAction'])->handle($request, $request->id);
            return redirect(route($this->class['routePrefix'] . '.index'))->with('success', __('messages.success_message'));
        } catch (\Exception $e) {
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $msg = 'messages.duplicate_entry';
            } else {
                $msg = $e->getMessage() . ' ' . $e->getLine();
            }
            return redirect()->back()->withInput()->with('error', __($msg));
        }
    }

    public function destroy()
    {
        $request = app($this->class['deleteRequest']);

        DB::beginTransaction();
        try {
            DB::commit();
            $data = app($this->class['deleteAction'])->handle($request);
            return redirect()->back()->with('success', __('messages.success_message'));
        } catch (\Exception $e) {
            if (strpos($e->getMessage(), 'Cannot delete') !== false) {
                $msg = 'messages.used_entry';
            } else {
                $msg = $e->getMessage() . ' ' . $e->getLine();
            }
            return redirect()->back()->with('error', __($msg));
        }
    }
}
