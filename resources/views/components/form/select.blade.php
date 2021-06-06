<div class="form-group">
    {{ Form::label($name, __('messages.' . $name . '_label'), ['class' => 'control-label']) }}
    {{ Form::select($name, $options, $value, array_merge(['class' => $errors->has($name) ? 'form-control form-control-select is-invalid' : 'form-control form-control-select'], $attributes)) }}
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
