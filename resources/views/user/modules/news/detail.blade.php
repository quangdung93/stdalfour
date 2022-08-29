@extends('user.layout.master')
@section('content')
	<div class="seciton-introduce pt-5 pb-5">
		<div class="container">
			<h1>{{ $news->NAME }}</h1>
			<div class="des">
				{{ $news->SUMMARY }}
			</div>
			<div class="content">
				{!! $news->CONTENT !!}
			</div>
		</div>
	</div>
@endsection