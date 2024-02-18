<?php
namespace Controllers;
use Views;
use Models;

class PropsController {
	public static function get_data () {
		return [
			'organization_name' => 'ТОВ "LVZ"',
			'store_name' => 'Магазин "LVZ STORE"',
			'store_address' => 'Україна, Волинська обл., м. Луцьк,<br>пр. Волі, буд. 22',
			'store_kass' => 'T2',
			'num_fiskal' => 'У3001057325/2',
			'num_factory' => 'КП20240218/4',
			'num_id' => 'У33170637/2',
			'num_tax' => 'У33170630188/2'
		];
	}
}