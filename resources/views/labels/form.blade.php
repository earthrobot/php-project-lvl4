<div class="form-group">
    {{ Form::label('name', __('messages.name_label'), ['class' => 'control-label']) }}
    {{ Form::text('name', $label->name ?? '', ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control']) }}
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group ">
    {{ Form::label('description', __('messages.description_label'), ['class' => 'control-label']) }}
    {{ Form::textarea('description', $label->description ?? '', ['class' => 'form-control']) }}
</div>