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
			'store_kass' => '01',
			'num_fiskal' => '1000000002',
			'num_factory' => '1000000003',
			'num_id' => '10000004',
			'num_tax' => '100000000005'
		];
	}
}