@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.essay.title')</h3>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr><th>@lang('quickadmin.essay.fields.topic')</th>
                    <td>{{ $essay->topic->title or '' }}</td></tr><tr><th>@lang('quickadmin.essay.fields.essay-text')</th>
                    <td>{!! $essay->essay_text !!}</td></tr><tr><th>@lang('quickadmin.essay.fields.code-snippet')</th>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('essay.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop