{!! Form::label('name', 'Name', ['class' => 'my-2']) !!}
{!! Form::text('name', null, [
    'id' => 'name',
    'class' => 'form-control',
    'placeholder' => 'Enter Sub_Category Name',
]) !!}
{!! Form::label('slug', 'Slug', ['class' => 'my-2']) !!}
{!! Form::text('slug', null, [
    'id' => 'slug',
    'class' => 'form-control ',
    'placeholder' => 'Enter Sub_Category Slug',
]) !!}
{!! Form::label('category_id', 'Select Category', ['class' => 'my-2']) !!}
{!! Form::select('category_id', $categories, null, [
    'class' => 'form-select ',
    'placeholder' => 'Select Parent Category',
]) !!}
{!! Form::label('order_by', 'Sub_Category Serial', ['class' => 'my-2']) !!}
{!! Form::number('order_by', null, ['class' => 'form-control ', 'placeholder' => 'Select Sub_Category Serial']) !!}
{!! Form::label('status', 'Sub_Category Serial', ['class' => 'my-2']) !!}
{!! Form::select('status', [1 => 'Active', 0 => 'Inactive'], null, [
    'class' => 'form-control ',
    'placeholder' => 'Enter Sub_Category status',
]) !!}
