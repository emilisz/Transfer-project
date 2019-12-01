<h5>Send money to other accounts</h5>
<form action="/send" method="POST">
@csrf
	<div class="input-group">
		<input type="number" name="account_id" hidden value="{{$account->id}}">
		<input type="number" name="user_id" hidden value="{{Auth::id()}}">
		<input type="number" step="0.01" name="amount" min="1" max="{{$account->balance}}" placeholder=" &euro;" aria-describedby="button-addon2" value="{{old('amount')}}">
		<input type="text" name="sender_account_number" hidden value="{{$account->account_number}}" >
		  <select class="custom-select" name="receiver_account_number" id="inputGroupSelect04" aria-label="Example select with button addon">
		  	@if (old('receiver_account_number'))
			      <option value="{{old('receiver_account_number')}}" selected>{{old('receiver_account_number')}}d</option>
			@else
			     <option selected value="">Choose recipient..</option>
			@endif
		    
		    @foreach($allAccounts as $receiverAccount)
		    <option value="{{$receiverAccount->account_number}}">{{$receiverAccount->user->name}} <span class="text-muted">{{$receiverAccount->account_number}}</span></option>
		    @endforeach
		  </select>
		  <div class="input-group-append">
		    <button type="submit" class="btn btn-outline-secondary" type="button">Send money</button>
		  </div>
	</div>
</form>