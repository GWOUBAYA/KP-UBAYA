@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.essays-answers.title')</h3>
    
    {!! Form::model($essay_answer, ['method' => 'PUT', 'route' => ['essay_answers.update', $essay_answer->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('essay_id', 'essay*', ['class' => 'control-label']) !!}
                    {!! Form::select('essay_id', $essays, old('essay_id'), ['class' => 'form-control']) !!}
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
                    {!! Form::checkbox('correct', 1, old('correct', 0), ['class' => 'form-control']) !!}
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

    {!! Form::submit(trans('quickadmin.update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

