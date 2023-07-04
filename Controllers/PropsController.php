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
			'num_fiskal' => '3000314138',
			'num_factory' => 'КП00004338/3',
			'num_id' => '40720198',
			'num_tax' => '407201926538'
		];
	}
}