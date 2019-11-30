@extends('layouts.app')
@section('content')
	<div class="jumbotron">
	  <h1 class="display-4">Welcome back!</h1>
	  <p class="lead">Here you can find all your account information</p>
	  <hr class="my-4">
	  {{-- <p>It uses utility classes for typography and spacing to space content out within the larger container.</p> --}}
	  {{-- <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> --}}
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-6 col-12">
				<div class="card">
				  <div class="card-header">
				    Overview <span class="text-muted float-right">{{$user->account->account_number}}</span>
				  </div>
				  <div class="card-body">
				    <h1 class="card-title"> @convert($user->account->balance) </h1>

				    <form action="/send" method="POST">
		    		@csrf
					    <div class="input-group mb-3 border">
					    	<input type="number" name="account_id" hidden value="{{$user->account->id}}">
					    	<input type="number" step="0.01" name="amount" min="1" max="{{$user->account->balance}}"  placeholder="&euro;" aria-describedby="button-addon2">
					    	<input type="text" name="sender_account_number" hidden value="{{$user->account->account_number}}" >
						 	 <input type="text" name="receiver_account_number" class="form-control" placeholder="Account number" aria-label="Recipient's account number" aria-describedby="button-addon2">
						 	  <div class="input-group-append">
							    <button type="submit" class="btn btn-outline-secondary" type="button" id="button-addon2">Send money</button>
							  </div>
						</div>
					</form>

					<p class="text-center">- or select from your contacts -</p>

					<form action="/send" method="POST">
	    			 @csrf
						<div class="input-group">
							<input type="number" name="account_id" hidden value="{{$user->account->id}}">
							<input type="number" step="0.01" name="amount" min="1" max="{{$user->account->balance}}" placeholder="&euro;" aria-describedby="button-addon2">
							<input type="text" name="sender_account_number" hidden value="{{$user->account->account_number}}" >
							  <select class="custom-select" name="receiver_account_number" id="inputGroupSelect04" aria-label="Example select with button addon">
							    <option selected>Choose recipient..</option>
							    @foreach($allAccounts as $account)
							    <option value="{{$account->account_number}}">{{$account->user->name}}</option>
							    @endforeach
							  </select>
							  <div class="input-group-append">
							    <button type="submit" class="btn btn-outline-secondary" type="button">Send money</button>
							  </div>
						</div>
					</form>

				  </div>
				</div>
			</div>
			<div class="col-md-6 col-12">
				<div class="card">
				  <div class="card-header">
				    Last operations
				  </div>
				  <div class="card-body">
				  	@if(count($user->account->transfers) > 0)
					  	@foreach($user->account->transfers->sortByDesc('created_at') as $transfer)
					  	<div class="{{$transfer->amount > 0 ? 'transfer-green' : 'transfer-red'}}" >
						    <p class="card-title float-right text-muted">{{$transfer->created_at}}</p>
						    <h4 class="lead-4">@convert($transfer->amount)</h4>
						    <p>From: {{$transfer->user->name}}</p>
						    <hr>
						</div>
					    @endforeach
					    <a href="#" class="btn btn-primary">Show more</a>
					@else
						<p>No latest transactions..</p>
				    @endif
				  </div>
				</div>
			</div>
		</div>
	</div>
@endsection