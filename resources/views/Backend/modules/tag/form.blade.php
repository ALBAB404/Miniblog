{!! Form::label('name', 'Name', ['class' => 'my-2']) !!}
{!! Form::text('name', null, [
    'id' => 'name',
    'class' => 'form-control',
    'placeholder' => 'Enter Tag Name',
]) !!}
{!! Form::label('slug', 'Slug', ['class' => 'my-2']) !!}
{!! Form::text('slug', null, [
    'id' => 'slug',
    'class' => 'form-control ',
    'placeholder' => 'Enter Tag Slug',
]) !!}
{!! Form::label('order_by', 'Tag Serial', ['class' => 'my-2']) !!}
{!! Form::number('order_by', null, ['class' => 'form-control ', 'placeholder' => 'Select Tag Serial']) !!}
{!! Form::label('status', 'Tag Serial', ['class' => 'my-2']) !!}
{!! Form::select('status', [1 => 'Active', 0 => 'Inactive'], null, [
    'class' => 'form-control ',
    'placeholder' => 'Enter Tag status',
]) !!}
