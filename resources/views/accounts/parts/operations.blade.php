<div class="card">
	  <div class="card-header">
	    Last operations
	  </div>
	  <div class="card-body">
	  	@if(count($account->transfers) > 0)
		  	@foreach($account->transfers->sortByDesc('created_at') as $transfer)
		  	<div class="{{$transfer->amount > 0 ? 'transfer-green' : 'transfer-red'}}" >
			    <p class="card-title float-right text-muted">{{$transfer->created_at}}</p>
			    <h4 class="lead-4">@convert($transfer->amount)</h4>
			    <p>
			    	@if($transfer->amount > 0)
			    	From: {{$transfer->user->name}} {{$transfer->sender_account_number}}</p>
			    	@else
			    	To: {{$transfer->receiver_account_number}}
			    	@endif
			    </p>
			    	
			    <hr>
			</div>
		    @endforeach
		@else
			<p>No latest transactions..</p>
	    @endif
	  </div>
</div>