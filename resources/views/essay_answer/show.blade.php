@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.essays-answer.title')</h3>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr><th>@lang('quickadmin.essays-answer.fields.essay')</th>
                    <td>{{ $essays_answer->essay->essay_text or '' }}</td></tr><tr><th>@lang('quickadmin.essays-answer.fields.answer')</th>
                    <td>{{ $essays_answer->answer }}</td></tr><tr><th>@lang('quickadmin.essays-answer.fields.correct')</th>
                    <td>{{ $essays_answer->correct == 1 ? 'Yes' : 'No' }}</td></tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('essays_answer.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop