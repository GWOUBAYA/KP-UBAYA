@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.essays-answers.title')</h3>

    <p>
        <a href="{{ route('essays_answers.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($essays_answers) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('quickadmin.essays-answers.fields.question')</th>
                        <th>@lang('quickadmin.essays-answers.fields.answer')</th>
                        <th>@lang('quickadmin.essays-answers.fields.correct')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($essays_answers) > 0)
                        @foreach ($essays_answers as $essays_answer)
                            <tr data-entry-id="{{ $essays_answer->id }}">
                                <td></td>
                                <td>{{ $essays_answer->question->question_text or '' }}</td>
                                <td>{{ $essays_answer->answer }}</td>
                                <td>{{ $essays_answer->correct == 1 ? 'Yes' : 'No' }}</td>
                                <td>
                                    <a href="{{ route('essays_answers.show',[$essays_answer->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    <a href="{{ route('essays_answers.edit',[$essays_answer->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['essays_answers.destroy', $essays_answer->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('essays_answers.mass_destroy') }}';
    </script>
@endsection