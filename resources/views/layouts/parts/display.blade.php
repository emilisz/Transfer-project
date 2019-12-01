<div class="jumbotron mt-2">
	  <h1 class="display-4">Welcome back, {{$account->user->name}}! </h1>
	  <p class="lead">Here you can find all your account information</p>
	  <hr class="my-4">
	  <span>Current account number: <strong>{{$account->account_number}}</strong></span>
	  <span class="float-right">
	  		<form action="/create" method="POST">
    		@csrf
    			<input type="text" name="user_id" hidden value="{{$account->user->id}}">
    			<button type="submit" class="btn btn-outline-primary">Create new account</button>
		    </form>
	  	</span>
	</div>