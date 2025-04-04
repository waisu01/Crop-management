@include('item.common.head')
@include('item.common.common')
@include('parts.navi')
<body>
	<h1>商品一覧画面</h1>

	@if (session('success'))
	<div class="alert alert-success">
		{{session('success')}}
	</div>

	@elseif(session('error'))
	<div class="alert alert-error">
		{{session('error')}}
	</div>
	
	@endif
	
	<!-- 登録ボタン -->
	<div >
		<form action="{{ route('ItemRegister', ['from'=>'1','user_id' => $user_id]) }}" method="post">
			@csrf
			<button type="submit" class="btn btn-outline-dark btn-sm mb-2">商品登録</button>
		</form>
	</div>

	<!-- 会員一覧 -->
	<div class="col-10">
		<table border="1" table class="table" >
			<thead>
				<tr>
					<th>ID</th>
					<th>商品名</th>
					<th>種別</th>
					<th>ステータス</th>
					<th>登録者</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($items as $item)
				@if($item->status == 1)
				<tr>
					<td>{{$item->id}}</td>
					<td>{{$item->name}}</td>
					<td >{{getTypeName($item->type)}}</td>
					<td >{{getStatus($item->status)}}</td>
					<td>{{$item->user_id}}</td>
					<td><form action="{{ route('ItemUpdate', ['item' => $item, 'user_id' => $user_id]) }}" method="POST">
						@csrf
						<input type="hidden" name="id" value={{$item->id}}>
						<input type="hidden" name="name" value={{$item->name}}>
						<input type="hidden" name="type" value={{$item->type}}>
						<input type="hidden" name="status" value={{$item->status}}>
						<input type="hidden" name="detail" value={{$item->detail}}>
						<input type="hidden" name="user_id" value={{$item->user_id}}>
						<button type="submit" class="btn btn-outline-dark btn-sm">更新</button>
						</form>
					</td>
					
					<td><form action="{{ route('ItemDelete', ['item' => $item, 'user_id' => $user_id]) }}" method="POST">
						@csrf
						<button type="submit" class="btn btn-outline-dark btn-sm">削除</button>
						</form>
					</td>
				</tr>
				</tr>
				@else
				<tr class="table-secondary">
					<td>{{$item->id}}</td>
					<td>{{$item->name}}</td>
					<td >{{getTypeName($item->type)}}</td>
					<td >{{getStatus($item->status)}}</td>
					<td>{{$item->user_id}}</td>
					<td><form action="{{ route('ItemUpdate', ['item' => $item, 'user_id' => $user_id]) }}" method="POST">
						@csrf
						<input type="hidden" name="id" value={{$item->id}}>
						<input type="hidden" name="name" value={{$item->name}}>
						<input type="hidden" name="type" value={{$item->type}}>
						<input type="hidden" name="status" value={{$item->status}}>
						<input type="hidden" name="detail" value={{$item->detail}}>
						<input type="hidden" name="user_id" value={{$item->user_id}}>
						<button type="submit" class="btn btn-outline-dark btn-sm">更新</button>
						</form>
					</td>
					
					<td><form action="{{ route('ItemDelete', ['item' => $item, 'user_id' => $user_id]) }}" method="POST">
						@csrf
						<button type="submit" class="btn btn-outline-dark btn-sm">削除</button>
						</form>
					</td>
				</tr>
				@endif
				@endforeach
			</tbody>
		</table>

		<div class="pagination">
			{{ $items->links() }}
		</div>

</body>
</html>