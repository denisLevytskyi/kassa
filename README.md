This project was made thanks to the support and love of my beloved and the best Sun. I love you Vika, thank you for believing in me <3!

=== KEYS OF SUPER-GLOBAL ARRAYS ===

$_SESSION
	['auth']
		['id']
		['name']
		['login']
		['role']
**
	['product']
		['id']
		['group']
		['article']
		['code']
		['name']
		['description']
		['photo']
		['auth_id']
		['price']
**
	['product_list']
		[(key)]
			['id']
			['article']
			['name']
			['photo']
**
	['price_list']
		[(key)]
			['id']
			['article']
			['price']
			['timestamp']
			['auth_id']
			['time']
**
	['unika']
		['sum']
		['list']
			[(key)]
				['id']
				['group']
				['article']
				['code']
				['name']
				['description']
				['photo']
				['auth_id']
				['price']
				['amount']
				['sum']
**
	['check']
		['id']
		['z_id']
		['auth_id']
		['auth_name']
		['timestamp']
		['organization_name']
		['store_name']
		['store_address']
		['store_kass']
		['num_fiskal']
		['num_factory']
		['num_id']
		['num_tax']
		['type']
		['body']
		['received_cash']
		['received_card']
		['change']
		['sum_cash']
		['sum_card']
		['sum']
		['sum_a']
		['sum_b']
		['sum_v']
		['sum_g']
		['sum_m']
		['sum_tax_a']
		['sum_tax_b']
		['sum_tax_v']
		['sum_tax_g']
		['sum_tax_m']
		['time']
		['main']
		  [(key)]
			['id']
			['group']
			['article']
			['code']
			['name']
			['description']
			['photo']
			['auth_id']
			['price']
			['amount']
			['sum']
**
	['check_list']
		[(key)]
			['id']
			['z_id']
			['auth_id']
			['auth_name']
			['timestamp']
			['type']
			['sum']
			['time']
**
	['branch']
		['id']
		['z_id']
		['auth_id']
		['auth_name']
		['timestamp']
		['organization_name']
		['store_name']
		['store_address']
		['store_kass']
		['num_fiskal']
		['num_factory']
		['num_id']
		['num_tax']
		['type']
		['sum']
		['time']
**
	['balance']
		['id']
		['auth_id']
		['auth_name']
		['timestamp']
		['organization_name']
		['store_name']
		['store_address']
		['store_kass']
		['num_fiskal']
		['num_factory']
		['num_id']
		['num_tax']
		['staff_in']
		['staff_out']
		['null_id_first']
		['null_id_last']
		['null_timestamp_first']
		['null_timestamp_last']
		['null_checks']
		['sale_id_first']
		['sale_id_last']
		['sale_timestamp_first']
		['sale_timestamp_last']
		['sale_checks']
		['sale_received_cash']
		['sale_received_card']
		['sale_change']
		['sale_sum_cash']
		['sale_sum_card']
		['sale_sum']
		['sale_round_plus']
		['sale_round_minus']
		['sale_sum_a']
		['sale_sum_b']
		['sale_sum_v']
		['sale_sum_g']
		['sale_sum_m']
		['sale_sum_tax_a']
		['sale_sum_tax_b']
		['sale_sum_tax_v']
		['sale_sum_tax_g']
		['sale_sum_tax_m']
		['sale_sum_tax']
		['return_id_first']
		['return_id_last']
		['return_timestamp_first']
		['return_timestamp_last']
		['return_checks']
		['return_received_cash']
		['return_received_card']
		['return_change']
		['return_sum_cash']
		['return_sum_card']
		['return_sum']
		['return_round_plus']
		['return_round_minus']
		['return_sum_a']
		['return_sum_b']
		['return_sum_v']
		['return_sum_g']
		['return_sum_m']
		['return_sum_tax_a']
		['return_sum_tax_b']
		['return_sum_tax_v']
		['return_sum_tax_g']
		['return_sum_tax_m']
		['return_sum_tax']
		['sum_cash']
		['sum_card']
		['sum']
		['balance_open']
		['balance_close']
		['time']
		['sale_time_first']
		['sale_time_last']
		['return_time_first']
		['return_time_last']
		['type']
**
	['staff']
		['balances']
			[(key)]
				['id']
				['auth_id']
				['auth_name']
				['timestamp']
				['sum']
				['time']
		['branches']
			[(key)]
				['id']
				['z_id']
				['auth_id']
				['auth_name']
				['timestamp']
				['type']
				['sum']
				['time']
		['balance']
**
	['ksef']
		[(key)]
**
	['admin']
		[(key)]
			['id']
			['login']
			['password']
			['name']
			['role']
$_COOKIE
	['auth_id']
$_GET
	['auth_delete']
	['auth_disconnect']
	['check_id']
	['check_data']
	['product_code']
	['product_id']
	['product_delete']
	['unika_del']
	['staff_balance']
	['branch_id']
	['balance_id']
$_POST
	['admin_id']
	['admin_login']
	['admin_password']
	['admin_name']
	['admin_role']
**
	['add_product_art']
	['add_product_code']
	['add_product_name']
	['add_product_description']
	['add_product_group']
	['add_product_photo']
**
	['edit_auth_id']
	['edit_auth_name']
	['edit_auth_login']
	['edit_auth_password_1']
	['edit_auth_password_2']
**
	['login_login']
	['login_password']
	['login_remember']
**
	['edit_product_id']
	['edit_product_art']
	['edit_product_code']
	['edit_product_name']
	['edit_product_desc']
	['edit_product_photo']
	['edit_product_old_photo']
**
	['reset_login']
**
	['sign_name']
	['sign_login']
	['sign_password_1']
	['sign_password_2']
	['sign_pin_1']
	['sign_pin_2']
	['sign_1']
	['sign_2']
**
	['price_setter_article']
	['price_setter_price']
**
	['unika_add']
	['unika_amount_val']
	['unika_amount_key']
	['unika_pay']
	['unika_cash']
	['unika_return']
	['unika_null']
**
	['staff_branch_sum']
	['staff_periodical_f']
	['staff_periodical_l']