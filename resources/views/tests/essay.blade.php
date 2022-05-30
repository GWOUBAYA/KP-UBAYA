@extends('layouts.app')

@section('content')
<h3 class="page-title">@lang('quickadmin.laravel-quiz')</h3>
{!! Form::open(['method' => 'POST', 'route' => ['tests.store']]) !!}

<div class="panel panel-default">
    <div class="panel-heading">
        @lang('quickadmin.quiz')
    </div>
    <?php //dd($essay) 
    ?>
    @if(count($essay) > 0)
    <div class="panel-body">
        <?php $i = 1; ?>
        @foreach($essay as $essay)
        @if ($i > 1)
        <hr /> @endif
        <div class="row">
            <div class="col-xs-12 form-group">
                <div class="form-group">
                    <strong>essay {{ $i }}.<br />{!! nl2br($essay->essay_text) !!}</strong>

                    @if ($essay->code_snippet != '')
                    <div class="code_snippet">{!! $essay->code_snippet !!}</div>
                    @endif

                    <input type="hidden" name="essay[{{ $i }}]" value="{{ $essay->id }}">

                    <br>
                    <label class="text-inline">
                        <input type="text" name="answers[{{ $essay->id }}]" value="">
                    </label>
                </div>
            </div>
        </div>
        <?php $i++; ?>
        @endforeach
    </div>
    @endif
</div>

{!! Form::submit(trans('quickadmin.submit_quiz'), ['class' => 'btn btn-danger']) !!}
{!! Form::close() !!}
@stop

@section('javascript')
@parent
<script src="{{ url('quickadmin/js') }}/timepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
<script>
    $('.datetime').datetimepicker({
        autoclose: true,
        dateFormat: "{{ config('app.date_format_js') }}",
        timeFormat: "hh:mm:ss"
    });
</script>

@stop