{!! Form::open(['action' => ['Panel\RankAlexaController@import'] ,'class' => 'form-horizontal', 'files' => true]) !!}
	{!! Form::file('excel') !!}
	{!! Form::submit("ارسال",['class' => 'btn btn-success']) !!}
{!! Form::close() !!} 

