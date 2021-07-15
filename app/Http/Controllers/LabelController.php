<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LabelController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Label::class, 'label');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labels = Label::all();
        return response()
            ->view('labels.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $label = new Label();
        return response()
            ->view('labels.create', compact('label'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $this->validate($request, [
            'name' => 'required|unique:labels'
        ]);

        $label = new Label();
        $label->fill($data);

        $label->createdBy()->associate(Auth::id());

        $label->save();

        flash(__('messages.label_store_success'))->success();

        return redirect()
            ->route('labels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function show(Label $label)
    {
        return response()
            ->view('labels.show', compact('label'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function edit(Label $label)
    {
        return response()
            ->view('labels.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Label $label)
    {
        $data = $request->all();

        $this->validate($request, [
            'name' => 'required|unique:labels,name,' . $label->id
        ]);

        $label->fill($data);
        $label->createdBy()->associate(Auth::id());
        $label->save();

        flash(__('messages.label_update_success'))->success();

        return redirect()
            ->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Label $label)
    {
        if ($label->tasks()->exists()) {
            flash(__('messages.label_delete_fail'))->error();
            return back();
        }

        $label->delete();
        flash(__('messages.label_delete_success'))->success();

        return redirect()
            ->route('labels.index');
    }
}
