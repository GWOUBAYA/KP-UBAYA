@extends('layouts.app')

@section('content')
<h3 class="page-title">@lang('quickadmin.essay.title')</h3>

<p>
    <a href="{{ route('essay.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
</p>

<div class="panel panel-default">
    <div class="panel-heading">
        @lang('quickadmin.list')
    </div>

    <div class="panel-body">
        <table class="table table-bordered table-striped {{ count($essay) > 0 ? 'datatable' : '' }} dt-select">
            <thead>
                <tr>
                    <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                    <th>@lang('quickadmin.essay.fields.topic')</th>
                    <th>@lang('quickadmin.essay.fields.essay-text')</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @if (count($essay) > 0)
                @foreach ($essay as $essay)
                <tr data-entry-id="{{ $essay->id }}">
                    <td></td>
                    <td>{{ $essay->topic->title or '' }}</td>
                    <td>{!! $essay->essay_text !!}</td>
                    <td>
                        <a href="{{ route('essay.show',[$essay->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                        <a href="{{ route('essay.edit',[$essay->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                        'route' => ['essay.destroy', $essay->id])) !!}
                        {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="7">@lang('quickadmin.no_entries_in_table')</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@stop

@section('javascript')
<script>
        window.route_mass_crud_entries_destroy = '{{ route('essay.mass_destroy') }}';
    </script>
@endsection