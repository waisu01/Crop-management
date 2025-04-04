@include('item.common.head')
@include('item.common.common')

<body>
	以下の情報を登録します。よろしいですか？
	<table border=0 class="table col-4" style="width:80%">
		<thead>
			<th></th>
			<th></th>
		</thead>
		<tbody>
			<tr>
				<td><label for="name">商品名</label></td>
				<td style="white-space: pre-wrap; word-break: break-word;">{{session('item_register.name')}}</td>
			</tr>

			<tr>
				<td><label for="type">種別</label></td>
				<td>{{getTypeName(session('item_register.type'))}}</td>
			</tr>
			<tr>
				<td><label for="status">ステータス</label></td>
				<td>{{getStatus(session('item_register.status'))}}</td>
			</tr>
			<tr>
				<td><label for="detail">詳細</label></td>
				<td style="white-space: pre-wrap; word-break: break-word;">{{session('item_register.detail')}}</td>
			</tr>

			<tr>
				<td><label for="user_id">登録者</label></td>
				<td>{{$user_id}}</td>
			</tr>

		</tbody>
	</table>

	<form action="{{route('registerItemDB',['user_id' => $user_id])}}" method="post">
		@csrf
		<input type="hidden" name="name" value="{{session('item_register.name')}}">
		<input type="hidden" name="type" value="{{session('item_register.type')}}">
		<input type="hidden" name="status" value="{{session('item_register.status')}}">
		<input type="hidden" name="detail" value="{{session('item_register.detail')}}">
		<input type="hidden" name="user_id" value="{{$user_id}}">
		<button type="submit" class="btn btn-outline-dark btn-sm mb-2">はい</button>
	</form>
	
	<form action="{{route('ItemRegister',['from'=>'0','user_id'=>$user_id])}}" method="post">
		@csrf
		<button type="submit" class="btn btn-outline-dark btn-sm mb-2">いいえ</button>
	</form>
</body>