<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
	//protected $table = 'Item';


	/**メモ：$fillableに書かれたカラムに対して、値を書き込んだりできる
	 * 		これがないと、値が書き込めないエラーが生じる
	 */
	protected $fillable = [
		'user_id',
		'name',
		'type',
		'status',
		"detail",
	];

	/**メモ：create_atなどのカラムがテーブルにない場合は無効化が必要
	 *		無効化しないとcreate_atがないというエラーが出力される
	 */
	public $timestamps = true;
}
