This project was made thanks to the support and love of my beloved and the best Sun. I love you Vika, thank you for believing in me <3!

=== KEYS OF SUPERGLOBAL ARRAYS ===

$_SESSION
	['auth']
		['id']
		['name']
		['login']
**
	['product']
		['id']
		['group']
		['article']
		['code']
		['name']
		['description']
		['foto']
		['auth_id']
		['price']
**
	['product_list']
		[(key)]
			['id']
			['article']
			['name']
			['foto']
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
		['summ']
		['list']
			[(key)]
				['id']
				['group']
				['article']
				['code']
				['name']
				['description']
				['foto']
				['auth_id']
				['price']
				['amount']
				['summ']
**
	['check']
		['id']
		['z_id']
		['auth_id']
		['auth_name']
		['timestamp']
		['type']
		['body']
		['received_cash']
		['received_card']
		['change']
		['summ']
		['summ_a']
		['summ_b']
		['summ_v']
		['summ_g']
		['summ_m']
		['summ_tax_a']
		['summ_tax_b']
		['summ_tax_v']
		['summ_tax_g']
		['summ_tax_m']
		['time']
		['main']
		  [(key)]
			['id']
			['group']
			['article']
			['code']
			['name']
			['description']
			['foto']
			['auth_id']
			['price']
			['amount']
			['summ']
**
	['check_list']
		[(key)]
			['id']
			['z_id']
			['auth_id']
			['auth_name']
			['timestamp']
			['type']
			['summ']
			['time']
**
	['branch']
		['id']
		['z_id']
		['auth_id']
		['auth_name']
		['timestamp']
		['type']
		['summ']
		['time']
**
	['balance']
		['id']
		['auth_id']
		['auth_name']
		['timestamp']
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
		['sale_summ_cash']
		['sale_summ_card']
		['sale_summ']
		['sale_summ_a']
		['sale_summ_b']
		['sale_summ_v']
		['sale_summ_g']
		['sale_summ_m']
		['sale_summ_tax_a']
		['sale_summ_tax_b']
		['sale_summ_tax_v']
		['sale_summ_tax_g']
		['sale_summ_tax_m']
		['sale_summ_tax']
		['return_id_first']
		['return_id_last']
		['return_timestamp_first']
		['return_timestamp_last']
		['return_checks']
		['return_received_cash']
		['return_received_card']
		['return_change']
		['return_summ_cash']
		['return_summ_card']
		['return_summ']
		['return_summ_a']
		['return_summ_b']
		['return_summ_v']
		['return_summ_g']
		['return_summ_m']
		['return_summ_tax_a']
		['return_summ_tax_b']
		['return_summ_tax_v']
		['return_summ_tax_g']
		['return_summ_tax_m']
		['return_summ_tax']
		['summ_cash']
		['summ_card']
		['summ']
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
				['summ']
				['time']
		['branches']
			[(key)]
				['id']
				['z_id']
				['auth_id']
				['auth_name']
				['timestamp']
				['type']
				['summ']
				['time']
**
	['ksef']
		[(key)]
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
	['add_product_art']
	['add_product_code']
	['add_product_name']
	['add_product_description']
	['add_product_group']
	['add_product_foto']
	['add_product_1']
**
	['edit_auth_id']
	['edit_auth_name']
	['edit_auth_login']
	['edit_auth_password_1']
	['edit_auth_password_2']
	['edit_auth_1']
**
	['login_login']
	['login_password']
	['login_remember']
**
	['edit_product_art']
	['edit_product_code']
	['edit_product_name']
	['edit_product_desc']
	['edit_product_1']
**
	['reset_login']
**
	['sing_name']
	['sing_login']
	['sing_password_1']
	['sing_password_2']
	['sing_pin_1']
	['sing_pin_2']
	['sing_1']
	['sing_2']
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
**
	['staff_branch_summ']
	['staff_periodical_f']
	['staff_periodical_l']