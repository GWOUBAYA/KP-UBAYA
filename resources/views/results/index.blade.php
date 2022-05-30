@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.results.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($results) > 0 ? 'datatable' : '' }}">
                @if (session('status1'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status1') }}
                        </div>
                @elseif (session('status2'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status2') }}
                        </div>
                    @endif
                <thead>
                    <tr>
                    @if(Auth::user()->isAdmin())
                        <th>@lang('quickadmin.results.fields.user')</th>
                    @endif
                        <th>@lang('quickadmin.results.fields.date')</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($results) > 0)
                        @foreach ($results as $result)
                            <tr>
                            @if(Auth::user()->isAdmin())
                                <td>{{ $result->name or '' }}</td>
                            @endif
                                <td>{{ $result->created_at or '' }}</td>
                                @if($result->status == 0)
                                <td>Pending</td>
                                @elseif($result->status == 1)
                                <td>Diterima</td>
                                @elseif($result->status == 2)
                                <td>Ditolak</td>
                                
                                @endif
                                @if(Auth::user()->isAdmin())
                                <td class="text-center">
                                    <div class="row justify-content-center">
                                        @if($result->status == 2)
                                        <div class="col-sm-12">
                                            <form action="{{ route('acc', $result->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}
        
                                                <button type="submit" href="#" style="width: 100%" class="btn btn-success">
                                                    Terima
                                                </button>
                                            </form>
                                        </div>
                                        @elseif($result->status == 1)
                                        <div class="col-sm-12">
                                            <form action="{{ route('dec', $result->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}
        
                                                <button type="submit" href="#" style="width: 100%" class="btn btn-danger">
                                                    Tolak
                                                </button>
                                            </form>
                                            
                                        </div>
                                        
                                            @elseif($result->status == 0)
                                        <div class="col-sm-6">
                                            <form action="{{ route('acc', $result->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}
        
                                                <button type="submit" href="#" style="width: 100%" class="btn btn-success">
                                                    Terima
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-sm-6">
                                            <form action="{{ route('dec', $result->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('put') }}
        
                                                <button type="submit" href="#" style="width: 100%" class="btn btn-danger">
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                    {{-- </form>
                                    <form action="#" method="POST">
                                        @method('PUT') @csrf

                                        
                                    </form> --}}
{{-- 
                                    <a href="{{ route('results.show',[$result->id]) }}" class="btn btn-xs btn-success">@lang('Terima')</a>
                                    <a href="{{ route('results.show',[$result->id]) }}" class="btn btn-xs btn-danger">@lang('Tolak')</a> --}}
                                </td>
                                @endif
                                @if(!Auth::user()->isAdmin())
                                <td>
                                    <a href="{{ route('results.show',[$result->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
