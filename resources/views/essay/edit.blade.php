@extends('layouts.app')

@section('content')
<h3 class="page-title">@lang('quickadmin.essay.title')</h3>

{!! Form::model($essay, ['method' => 'PUT', 'route' => ['essay.update', $essay->id]]) !!}

<div class="panel panel-default">
    <div class="panel-heading">
        @lang('quickadmin.edit')
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('topic_id', 'Topic*', ['class' => 'control-label']) !!}
                {!! Form::select('topic_id', $topics, old('topic_id'), ['class' => 'form-control']) !!}
                <p class="help-block"></p>
                @if($errors->has('topic_id'))
                <p class="help-block">
                    {{ $errors->first('topic_id') }}
                </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('essay_text', 'Essay text*', ['class' => 'control-label']) !!}
                {!! Form::textarea('essay_text', old('essay_text'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('essay_text'))
                <p class="help-block">
                    {{ $errors->first('essay_text') }}
                </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('code_snippet', 'Code snippet', ['class' => 'control-label']) !!}
                {!! Form::textarea('code_snippet', old('code_snippet'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('code_snippet'))
                <p class="help-block">
                    {{ $errors->first('code_snippet') }}
                </p>
                @endif
            </div>
        </div>

    </div>
</div>

{!! Form::submit(trans('quickadmin.update'), ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}
@stop