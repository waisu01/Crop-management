<?php

if (!function_exists('getTypeName')) {
	function getTypeName($type_num){
		$type_Name = [
			0 => '---',
			1 => '果物',
			2 => '野菜',
			3 => 'きのこ',
			4 => '穀類',
			5 => '香辛料',
			6 => 'その他'
		];

		return $type_Name[$type_num];
	}
}

if (!function_exists('getStatus')) {
	function getStatus($status_num){
		$status_Name = [
			0 => '無効',
			1 => '有効'
		];
		return $status_Name[$status_num];
	}
}