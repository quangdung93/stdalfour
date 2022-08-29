@extends('user.layout.master')
@section('content')
	@if($newspage->ID == 1)
		<div class="section-daily pt-5 pb-5"> 
			<div class="container">
				<div class="row">
					{!! $newspage->CONTENT !!}
				</div>
			</div>
		</div>
	@else
		<div class="seciton-introduce pt-5 pb-5">
			<div class="container">
				{!! $newspage->CONTENT !!}
			</div>
		</div>
	@endif
@endsection