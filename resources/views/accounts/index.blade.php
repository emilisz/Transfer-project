@extends('layouts.app')
@section('content')
	@include('accounts.parts.display')
	@include('layouts.messages')

	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-12">
				<div class="card">
				  @include('accounts.parts.overview')
				  <div class="card-body">
				    <h1 class="card-title"><span class="badge badge-pill badge-light">@convert($account->balance)</span> </h1>
				    <hr>

				    {{-- BETWEEN ACCOUNTS --}}
				    <div class="transfer p-3">
				    	<h5>Transfer between my accounts
				    		<span class="float-right">
				    			@include('accounts.parts.forms.account')
				    		</span>
				    	</h5>
				    	
				    	<div class="mt-2 pt-3">
				    		@include('accounts.parts.forms.between')
				    	</div>
				    </div>
				    <hr>

				    {{-- TO OTHER ACCOUNTS --}}
					<div class="transfer p-3">
						@include('accounts.parts.forms.another')
					</div>

				  </div>
				</div>
			</div>
			
			<div class="col-lg-6 col-12">
				@include('accounts.parts.operations')
			</div>
		</div>
	</div>
@endsection