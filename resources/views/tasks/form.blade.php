{{ Form::bsText('name') }}
{{ Form::bsTextarea('description') }}
{{ Form::bsSelect('status_id', $task_statuses, null, ['placeholder' => '----------']) }}
{{ Form::bsSelect('assigned_to_id', $users, null, ['placeholder' => '----------']) }}
{{ Form::bsSelect('labels[]', $labels, null, ['multiple', 'placeholder' => '']) }}