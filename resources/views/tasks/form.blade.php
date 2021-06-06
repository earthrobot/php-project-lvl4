{{ Form::bsText('name') }}
{{ Form::bsTextarea('description') }}
{{ Form::bsSelect('status_id', $taskStatuses, null, ['placeholder' => '----------']) }}
{{ Form::bsSelect('assigned_to_id', $users, null, ['placeholder' => '----------']) }}
{{ Form::bsSelect('labels[]', $labels, null, ['class' => 'select-multiple', 'multiple' => 'multiple', 'placeholder' => '']) }}
