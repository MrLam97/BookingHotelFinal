<?php 
	class Test extends MY_Controller
	{

	 	function __construct()
	 	{
	 		parent::__construct();
	 		$this->load->model('hotel_model');
	 	}

	 	function test()
	 	{
	 		// $query="SELECT * FROM `transaction` WHERE 1542236404>check_in and 1542236404<check_out";
	 		// $query1='SELECT count(id) as id FROM hotel WHERE  status = 2 AND type_id = 11 AND provinces = 17 AND price <= 1200000 AND price >= 100000 AND id not in( select hotel_id from transaction where (check_in <= 1552950000 AND check_out >= 1552950000) or (check_in <= 1553122800 AND check_out >= 1553122800) )';
	 		// $total = $this->hotel_model->query($query1);
	 	// 	foreach ($total as $row)
			// {
			//         echo $total->id;
			// }

			$input=array();
			$dk='status = 2 AND type_id = 11 AND provinces = 17 AND price <= 1200000 AND price >= 100000 AND id not in( select hotel_id from transaction where (check_in <= 1552950000 AND check_out >= 1552950000) or (check_in <= 1553122800 AND check_out >= 1553122800) )';
			$input['where']=$dk;
			$result = $this->hotel_model->get_total($input);


	 		// $data=$this->order_model->query($query);
	 		// $data1=$this->hotel_model->get_total();
	 		// pre($result);
	 		echo $result;

	 		$dk='status = 2 '. $room_type_data .$provinces_data .$price_to_data .$price_from_data .' AND id not in( select hotel_id from transaction where (check_in <= '.$date_from.' AND check_out >= '.$date_from.') or (check_in <= '.$date_to.' AND check_out >= '.$date_to.') )';
			$input['where']=$dk;
			$total = $this->hotel_model->get_total($dk);

			$this->data['total'] = $total;

			$list=$this->hotel_model->get_list($dk);	
			$this->data['list']=$list;

		 }
	}

?>