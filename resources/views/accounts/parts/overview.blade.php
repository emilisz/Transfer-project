<div class="card-header">
				    Overview 
				    	<span class="text-muted float-right">
				    		<strong>
				    			<select class="custom-select" id="inputGroupSelect01" onchange="if (this.value) window.location.href=this.value">
								    <option selected>{{$account->account_number}}</option>
								    @foreach($myAccounts as $myAccount)
									    @if($myAccount->id !== $account->id)
									    <option value="/home/{{$myAccount->account_number}}">{{$myAccount->account_number}}</option>
									    @endif
								    @endforeach
								  </select>
				    		</strong>
				    	</span>
				  </div>