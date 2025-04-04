@include('item.common.head')

<body>
	<h1>商品登録画面</h1>
	<h2>管理者ID：{{$user_id}}</h2>
	<body class="col-5">
		@if ($errors->any())
			<div>
				<ul>
					@foreach ($errors->all() as $error)
						<li class="text-danger">{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		{{-- old('*', session('item_after.*',0)のメモ --}}
		{{-- old()の第一引数はバリテーションエラーが生じた際に、元のページにリダイレクトするが --}}
		{{-- 入力した内容はold(*,)に保存されているので、それを取り出している --}}
		{{-- old()の第二引数は確認画面に遷移した後、この画面に戻った時に入力した内容が --}}
		{{-- session('item_after')に保存されているので、それを取り出している --}}
		{{-- 第三引数の0は、第一引数と第二引数が存在しない場合、すなわち一覧画面から登録画面に --}}
		{{-- 遷移したときの初期値を表している --}}
		<form action="{{ route('ItemRegisterCheck', $user_id) }}" method="post">
			@csrf
			<table>
				<tr>
					<td><label for="name">商品名</label></td>
					<td><input type="text" name="name" value="{{ old('name',session('item_register.name')) }}"></td>
				</tr>
				<tr>
					<td><label for="type">種別</label></td>
					<td>
						<select name="type" required>
							<option value="0" {{ old('type',session('item_register.type'),0) == 0 ? 'selected' : '' }}>---</option>
							<option value="1" {{ old('type',session('item_register.type')) == 1 ? 'selected' : '' }}>果物</option>
							<option value="2" {{ old('type',session('item_register.type')) == 2 ? 'selected' : '' }}>野菜</option>
							<option value="3" {{ old('type',session('item_register.type')) == 3 ? 'selected' : '' }}>きのこ</option>
							<option value="4" {{ old('type',session('item_register.type')) == 4 ? 'selected' : '' }}>穀類</option>
							<option value="5" {{ old('type',session('item_register.type')) == 5 ? 'selected' : '' }}>香辛料</option>
							<option value="6" {{ old('type',session('item_register.type')) == 6 ? 'selected' : '' }}>その他</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><label for="status">ステータス</label></td>
					<td>
						<select name="status" required>
							<option value="0" {{ old('status',session('item_register.status'),0) == 0 ? 'selected' : '' }}>無効</option>
							<option value="1" {{ old('status',session('item_register.status')) == 1 ? 'selected' : '' }}>有効</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><label for="detail">詳細</label></td>
					<td><textarea name="detail" rows="5" cols="40" maxlength="256">{{ old('detail',session('item_register.detail')) }}</textarea></td>
				</tr>
			</table>
			<button type="submit" class="btn btn-outline-dark btn-sm mb-2">登録</button>
		</form>


		<form action="{{route('ItemList',['user_id' => $user_id])}}">
			<button type="submit" class="btn btn-outline-dark btn-sm mb-2">戻る</button>
		</form>
	</body>
		
		
	</form>
</body>