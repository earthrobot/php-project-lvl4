<div class="form-group">
    {{ Form::label($name, __('messages.' . $name . '_label'), ['class' => 'control-label']) }}
    {{ Form::text($name, $value, array_merge(['class' => $errors->has($name) ? 'form-control is-invalid' : 'form-control'], $attributes)) }}
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
