@include('item.common.head')
@include('item.common.common')

<body>
	以下の通り更新します。よろしいですか？
	<br>
		<div class="col-5">
		
		<table border=0 class="table">
			<thead>
				<tr>
					<th>項目</th>
					<th>変更前</th>
					<th>変更後</th>
				</tr>
			</thead>
			
			<tr>
				<td><label for="id">ID</label></td>
				<td>{{session('item_before.id')}}</td>
				<td>{{session('item_after.id')}}</td>
			</tr>
			<tr>
				<td><label for="name">商品名</label></td>
				<td style="white-space: pre-wrap; word-break: break-word;">{{session('item_before.name')}}</td>
				@if(session('item_after.name') == session('item_before.name'))
				<td style="white-space: pre-wrap; word-break: break-word;">{{session('item_after.name')}}</td>
				@else
				<td class="text-danger" style="white-space: pre-wrap; word-break: break-word;">{{session('item_after.name')}}</td>
				@endif
			</tr>
			<tr>
				<td><label for="type">種別</label></td>
				<td>{{getTypeName(session('item_before.type'))}}</td>
				@if(session('item_after.type') == session('item_before.type'))
				<td>{{getTypeName(session('item_after.type'))}}</td>
				@else
				<td class="text-danger">{{getTypeName(session('item_after.type'))}}</td>
				@endif
			</tr>
			<tr>
				<td><label for="status">ステータス</label></td>
				<td>{{getStatus(session('item_before.status'))}}</td>
				@if(session('item_after.status') == session('item_before.status'))
				<td>{{getStatus(session('item_after.status'))}}</td>
				@else
				<td class="text-danger">{{getStatus(session('item_after.status'))}}</td>
				@endif
			</tr>
			
			<tr>
				<td><label for="dettail">詳細</label></td>
				<td style="white-space: pre-wrap; word-break: break-word;" >{{session('item_before.detail')}}</td>
				@if(session('item_after.detail') == session('item_before.detail'))
				<td style="white-space: pre-wrap; word-break: break-word;" >{{session('item_after.detail')}}</td>
				@else
				<td class="text-danger" style="white-space: pre-wrap; word-break: break-word; width:20%" >{{session('item_after.detail')}}</td>
				@endif
			</tr>
				
			<tr>
				<td><label for="user_id">登録者</label></td>
				<td>{{session('item_before.user_id')}}</td>
				@if(session('item_after.user_id') == session('item_before.user_id'))
				<td>{{session('item_after.user_id')}}</td>
				@else
				<td class="text-danger">{{session('item_after.user_id')}}</td>
				@endif
			</tr>
		</table>
	</div>
	
	<form action="{{route('updateItemDB',['user_id' => $user_id])}}" method="post">
		@csrf
		<input type="hidden" name="id" value="{{session('item_after.id')}}">
		<input type="hidden" name="name" value="{{session('item_after.name')}}">
		<input type="hidden" name="type" value="{{session('item_after.type')}}">
		<input type="hidden" name="status" value="{{session('item_after.status')}}">
		<input type="hidden" name="detail" value="{{session('item_after.detail')}}">
		<input type="hidden" name="user_id" value="{{session('item_after.user_id')}}">
		<button type="submit" class="btn btn-outline-dark btn-sm mb-2">はい</button>
	</form>
	<form action="{{route('ItemUpdate_bak',['user_id'=>$user_id])}}" method="post">
		@csrf
		<button type="submit" class="btn btn-outline-dark btn-sm mb-2">いいえ</button>
	</form>
</body>