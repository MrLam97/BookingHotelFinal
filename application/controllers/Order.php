<?php /**
 * 
 */
class Order extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('order_model');
	}

	function checkout()
	{
		//Lấy dữ liệu
		$hotel_id = $this->input->post('hotel_id');
		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');
		$people = $this->input->post('people');
		$price = $this->input->post('price');

		$dk='((check_in<='.strtotime($date_from).' and check_out>='.strtotime($date_from).') or (check_in<='.strtotime($date_to).' and check_out>='.strtotime($date_to).')) and hotel_id='.$hotel_id;
		$input['where']=$dk;
		$data=$this->order_model->get_total($input);
		
		if($data>0){
			$this->session->set_flashdata('message', 'Trong khoảng thời gian từ: '.$date_from.' đến '.$date_to.' đã có người đặt phòng này. Vui lòng chọn ngày khác hoặc phòng khác.');
			redirect('hotel/view/'.$hotel_id);
		}

		$this->data['date_from']=$date_from;
		$this->data['date_to']=$date_to;
		$this->data['people']=$people;
		$this->data['price']=$price;
		$time=time();
		$days = (strtotime($date_to) - strtotime($date_from)) / (60 * 60 * 24);
		if(strtotime($date_from)<$time || $days<=0){
			$this->session->set_flashdata('message', 'Kiểm tra ngày trả phải sau ngày nhận và ngày nhận phải sau thời điểm hiện tại');
			redirect('hotel/view/'.$hotel_id);
		}
		// pre($days);
		$this->data['days']=$days;
		if($days>0)
		{
			if($days>30)
			{
				$this->session->set_flashdata('message', 'Không thuê quá 30 ngày');
				redirect();
			}
		}

		
		//Lay thong tin hotel
		$this->load->model('hotel_model');
		$hotel_info=$this->hotel_model->get_info($hotel_id);
		$this->data['hotel_info']=$hotel_info;


		//lấy thông tin loai phong
		$this->load->model('room_type_model');
		$room_type=$this->room_type_model->get_info($hotel_info->type_id);
		$this->data['room_type']=$room_type;
		
		// Lấy danh sách thành phố
 		$this->load->model('provinces_model');
 		$list_provinces = $this->provinces_model->get_list();
 		$this->data['list_provinces']=$list_provinces;


 		$this->load->library('form_validation');
 		$this->load->helper('form');

 		//Nếu có dữ liệu post lên thì kiểm tra
 		if($this->input->post())
 		{
 			$this->form_validation->set_rules('name','Họ tên','required|min_length[8]');
 			$this->form_validation->set_rules('address','Đường','required');
 			$this->form_validation->set_rules('provinces','Thành phố','required');
 			$this->form_validation->set_rules('wards','Quận/Huyện','required');
 			$this->form_validation->set_rules('CMND','CMND','numeric|required|min_length[9]|max_length[9]');
 			$this->form_validation->set_rules('phone','Điện thoại','numeric|required|min_length[10]|max_length[10]');
 			$this->form_validation->set_rules('payment','Phương thức thanh toán','required');

 			//Nhập chính xác
 			if($this->form_validation->run())
 			{
 				$check_in=$this->input->post('date_from');
 				$check_in = date_create($check_in);
				$check_in = date_timestamp_get($check_in);
				$check_out=$this->input->post('date_to');
				$check_out = date_create($check_out);
				$check_out = date_timestamp_get($check_out);

				if($this->session->userdata('user_id_login'))
		 		{
		 			$user_id=$this->session->userdata('user_id_login');
		 		}
		 		else
		 		{
		 			$user_id=0;
		 		}
 				//Thêm vào CSDL
 				$data=array(
 					'name'=>$this->input->post('name'),
 					'phone'=>$this->input->post('phone'),
 					'email'=>$this->input->post('email'),
 					'CMND'=>$this->input->post('CMND'),
 					'provinces'=>$this->input->post('provinces'),
 					'wards'=>$this->input->post('wards'),
 					'address'=>$this->input->post('address'),
 					'payment'=>$this->input->post('payment'),
 					'hotel_id'=>$this->input->post('hotel_id'),
 					'check_in'=>$check_in,
 					'check_out'=>$check_out,
 					'user_id'=>$user_id,
 					'amount'=>$this->input->post('amout'),
 					'status'=>1,
 					'created'=>time(),
 					'people'=>$this->input->post('people'),

 				);

 				if($this->order_model->create($data))
 				{
 					//cập nhật lượt xem
					$data_hotel=array();
					$data_hotel['ordered']=$hotel_info->ordered + 1;
					$this->hotel_model->update($hotel_id,$data_hotel);
 					$this->session->set_flashdata('message', 'Thuê phòng thành công');
 				}
 				else
 				{
 					$this->session->set_flashdata('message', 'Thuê phòng thất bại');
 				}
 				//chuyển đến trang danh sách QTV
 				redirect(site_url('order/confirm'));

 			}
 		}
		

		$this->data['title']='Đặt phòng';
 		$this->data['temp']='site/order/checkout';
		$this->load->view('site/layout', $this->data);
	}

	function confirm()
	{
		if($this->session->userdata('user_id_login'))
 		{
 			$user_id=$this->session->userdata('user_id_login');
 			$input=array();
 			$input['where']['user_id']=$user_id;
 			$order_list=$this->order_model->get_list($input);
 			$this->data['order']=$order_list[0];

 			$this->load->model('hotel_model');
 			$hotel=$this->hotel_model->get_info($order_list[0]->hotel_id);
 			$this->data['hotel']=$hotel;

 			//lấy thông tin loai phong
			$this->load->model('room_type_model');
			$room_type=$this->room_type_model->get_info($hotel->type_id);
			$this->data['room_type']=$room_type;
 		}
 		else
 		{
 			$input=array();
 			$input['where']['user_id']=0;
 			$order_list=$this->order_model->get_list($input);
 			$this->data['order']=$order_list[0];

 			$this->load->model('hotel_model');
 			$hotel=$this->hotel_model->get_info($order_list[0]->hotel_id);
 			$this->data['hotel']=$hotel;

 			//lấy thông tin loai phong
			$this->load->model('room_type_model');
			$room_type=$this->room_type_model->get_info($hotel->type_id);
			$this->data['room_type']=$room_type;
 		}


 		//Lấy danh sách thanh pho, quan huyen
 		$this->load->model('provinces_model');
 		$this->load->model('wards_model');
 		$provinces=$this->provinces_model->get_list();
 		$wards=$this->wards_model->get_list();
 		$this->data['provinces']=$provinces;
 		$this->data['wards']=$wards;


		$this->data['title']='Xác nhận';
 		$this->data['temp']='site/order/confirm';
		$this->load->view('site/layout', $this->data);
	}

	function wards()
 	{
 		//Lấy danh sách quận huyện theo id thanh pho
 		$provinces_id = $this->input->post('provinces_id');
 		$this->load->model('wards_model');
 		$input=array();
 		$input['where']['province_id']=$provinces_id;
 		$list_wards=$this->wards_model->get_list($input);
 		// select * from wards where province_id = $provinces_id
 		$rs='';
 		// $rs.='<select class="selectpicker country search-fields" name="wards">';
 		$rs.='<option value="0">Lựa chọn quận/huyện</option>';
 		foreach ($list_wards as $row) {
 			$rs.="<option value='".$row->id."'>".$row->title."</option>"; 		
 		}
 		// $rs.='</select>';
 		echo $rs;
 	}
} ?>