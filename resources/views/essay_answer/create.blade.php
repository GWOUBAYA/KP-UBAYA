@extends('layouts.app')

@section('content')
<h3 class="page-title">@lang('quickadmin.essay-answer.title')</h3>
{!! Form::open(['method' => 'POST', 'route' => ['essay_answers.store']]) !!}

<div class="panel panel-default">
    <div class="panel-heading">
        @lang('quickadmin.create')
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('essay_id', 'essay*', ['class' => 'control-label']) !!}
                {!! Form::select('essay_id', $essay, old('essay_id'), ['class' => 'form-control']) !!}
                <p class="help-block"></p>
                @if($errors->has('essay_id'))
                <p class="help-block">
                    {{ $errors->first('essay_id') }}
                </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('answer', 'Answer*', ['class' => 'control-label']) !!}
                {!! Form::text('answer', old('answer'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('answer'))
                <p class="help-block">
                    {{ $errors->first('answer') }}
                </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('correct', 'Correct', ['class' => 'control-label']) !!}
                {!! Form::hidden('correct', 0) !!}
                {!! Form::checkbox('correct', 1, 0, ['class' => 'form-control']) !!}
                <p class="help-block"></p>
                @if($errors->has('correct'))
                <p class="help-block">
                    {{ $errors->first('correct') }}
                </p>
                @endif
            </div>
        </div>

    </div>
</div>

{!! Form::submit(trans('quickadmin.save'), ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}
@stop