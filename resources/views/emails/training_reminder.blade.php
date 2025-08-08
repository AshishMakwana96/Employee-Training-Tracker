<p>Hi {{ $employee->name }},</p>

<p>This is a reminder that your training "<strong>{{ $training->title }}</strong>" is due on <strong>{{ $training->due_date->format('Y-m-d') }}</strong>.</p>

<p>Please complete it on time.</p>
