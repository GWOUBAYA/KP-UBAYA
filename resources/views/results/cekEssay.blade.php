@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.laravel-quiz')</h3>
    {{-- {!! Form::open(['method' => 'POST', 'route' => ['tests.store']]) !!} --}}

    <div class="panel panel-default">
        <div class="panel-heading">
            Jawaban User
        </div>
        <?php //dd($questions) ?>
    @if(count($results) > 0)
        <div class="panel-body">
        <?php $j = 1; ?>
        @foreach($results as $result)
            @if ($j > 1) <hr /> @endif
            <div class="row">
                <div class="col-xs-12 form-group">
                    <div class="form-group">
                        <strong>Question {{ $j }}.<br />{!! nl2br($result->essay_text) !!}</strong>

                        @if ($result->code_snippet != '')
                            <div class="code_snippet">{!! $result->code_snippet !!}</div>
                        @endif

                        <input
                            type="hidden"
                            name="questions2[{{ $j }}]"
                            value="{{ $result->id }}">
                        {!! Form::label('essay_text', 'Essay text*', ['class' => 'control-label']) !!}
                        {!! Form::textarea('essay_text'.$j, $result->answer, ['class' => 'form-control ', 'placeholder' => '','readonly']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('essay_text'))
                        <p class="help-block">
                            {{ $errors->first('essay_text') }}
                        </p>
                        @endif
                        <div class="row justify-content-center">
                            <div class="col-sm-6">
                                <form action="{{ route('acc2', ['id1'=>$result->test_id, 'id2'=>$result->essay_id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('put') }}

                                    <button type="submit" href="#" style="width: 100%" class="btn btn-success">
                                        Benar
                                    </button>
                                </form>
                            </div>
                            <div class="col-sm-6">
                                <form action="{{ route('dec2', ['id1'=>$result->test_id, 'id2'=>$result->essay_id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('put') }}

                                    <button type="submit" href="#" style="width: 100%" class="btn btn-danger">
                                        Salah
                                    </button>
                                </form>
                            </div>
                        </div>

                    
                    </div>
                </div>
            </div>
        <?php $j++; ?>
        @endforeach
        </div>
    @endif
    </div>

    {{-- {!! Form::close() !!} --}}
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
