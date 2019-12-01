@extends('layouts.app')
@section('content')
	@include('layouts.parts.display')

	<div class="container">
		<div class="row">
			<div class="col-md-6 col-12">
				<div class="card">
				  @include('layouts.parts.overview')
				  <div class="card-body">
				    <h1 class="card-title"><span class="badge badge-pill badge-light">@convert($account->balance)</span> </h1>
				    <hr>

				    {{-- BETWEEN ACCOUNTS --}}
				    <div class="transfer p-3">
				    	@include('layouts.parts.forms.between')
				    </div>
				    <hr>

				    {{-- TO OTHER ACCOUNTS --}}
					<div class="transfer p-3">
						@include('layouts.parts.forms.another')
					</div>

				  </div>
				</div>
			</div>
			
			<div class="col-md-6 col-12">
				@include('layouts.parts.operations')
			</div>
		</div>
	</div>
@endsection