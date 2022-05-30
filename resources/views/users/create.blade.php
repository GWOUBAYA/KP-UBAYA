@extends('layouts.app')

@section('content')
<h3 class="page-title">@lang('quickadmin.users.title')</h3>
{!! Form::open(['method' => 'POST', 'route' => ['users.store']]) !!}

<div class="panel panel-default">
    <div class="panel-heading">
        @lang('quickadmin.create')
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('name'))
                <p class="help-block">
                    {{ $errors->first('name') }}
                </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('email', 'Email*', ['class' => 'control-label']) !!}
                {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('email'))
                <p class="help-block">
                    {{ $errors->first('email') }}
                </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('phone', 'phone*', ['class' => 'control-label']) !!}
                {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('address', 'address*', ['class' => 'control-label']) !!}
                {!! Form::text('address', old('address'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('education', 'education*', ['class' => 'control-label']) !!}
                {!! Form::text('education', old('education'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>

            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('work', 'work*', ['class' => 'control-label']) !!}
                {!! Form::text('work', old('work'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>

            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('link', 'link*', ['class' => 'control-label']) !!}
                {!! Form::text('link', old('link'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('status', 'status*', ['class' => 'control-label']) !!}
                {!! Form::text('status', old('status'), ['class' => 'form-control', 'placeholder' => '0']) !!}
                <p class="help-block"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('password'))
                <p class="help-block">
                    {{ $errors->first('password') }}
                </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('role_id', 'Role*', ['class' => 'control-label']) !!}
                {!! Form::select('role_id', $roles, old('role_id'), ['class' => 'form-control']) !!}
                <p class="help-block"></p>
                @if($errors->has('role_id'))
                <p class="help-block">
                    {{ $errors->first('role_id') }}
                </p>
                @endif
            </div>
        </div>

    </div>
</div>

{!! Form::submit(trans('quickadmin.save'), ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}
@stop