@include('item.common.head')
@include('item.common.common')
<body>
	<h1>商品削除確認画面</h1>
	<div class="col-5 ml-3">
		以下のアイテムを削除しますか？
		<table border=0 class="table">
			<tr>
				<th>ID</th>
				<th>商品名</th>
				<th>種別</th>
				<th>ステータス</th>
				<th>詳細</th>
				<th>登録者</th>
			</tr>
			<tr>
				<td>{{$item->id}}</td>
				<td style="white-space: pre-wrap; word-break: break-word; width:20%">{{$item->name}}</td>
				<td>{{getTypeName($item->type)}}</td>
				<td >{{getStatus($item->status)}}</td>
				<td style="white-space: pre-wrap; word-break: break-word; width:20%">{{$item->detail}}</td>
				<td>{{$item->user_id}}</td>
			</tr>
		</table>

		<form action="{{route('deleteItemDB',['id'=>$item->id,'user_id'=>$user_id])}}" method="post">
			@csrf
			<button type="submit" class="btn btn-outline-dark btn-sm mb-2">はい</button>
		</form>
		<form action="{{route('ItemList',$user_id)}}">
			@csrf
			<button type="submit" class="btn btn-outline-dark btn-sm mb-2">いいえ</button>
		</form>

	</div>
</body>