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

	function index()
	{
		//lấy số luong danh sach phong
 		$total = $this->order_model->get_total();
		$this->data['total'] = $total;

		//load thu vien phan trang
 		$this->load->library('pagination');
 		
 		$config['base_url'] = admin_url('order/index'); //link hien thi ra danh sach phong
 		$config['total_rows'] = $total; //tong số luong danh sach phong
 		$config['per_page'] = 10; //so luong hien thi tren 1 trang
 		$config['uri_segment'] = 4;
 		//khoi tao cau hinh phan trang
 		$this->pagination->initialize($config);
 		
 		$segment=$this->uri->segment(4);
 		$segment=intval($segment);
 		$input = array();
 		$input['limit']=array($config['per_page'],$segment);

 		$id=$this->input->get('id');
 		if($id>0)
 		{
 			$input['where']['id']=$id;
 		}

 		$payment=$this->input->get('payment');
 		if($payment)
 		{
 			$input['where']['payment']=$payment;
 		}

 		$user=$this->input->get('user');
 		if($user)
 		{
 			$input['like']=array('name',$user);
 		}

 		$status=$this->input->get('status');
 		if($status>0)
 		{
 			$input['where']['status']=$status;
 		}

 		$created=$this->input->get('created');
 		if($created)
 		{
	 		$created = date_create($created);
			$created = date_timestamp_get($created);
 			$input['where']['created>=']=$created;
 		}
 		$created_to=$this->input->get('created_to');
 		if($created_to)
 		{
	 		$created_to = date_create($created_to);
			$created_to = date_timestamp_get($created_to);
 			$input['where']['created<=']=$created_to;
 		}


		$list=$this->order_model->get_list($input);
		$this->data['list']=$list;


		// lấy nội dung cũa biến message
 		$message=$this->session->flashdata('message');
 		$this->data['message']=$message;

 		$this->data['temp'] = 'admin/order/index';
 		$this->load->view('admin/main',$this->data);
	}

	function view()
	{
		//lay id don dat
		$id=$this->uri->segment(4);

		//lay thong tin don dat
		$order=$this->order_model->get_info($id);
		$this->data['order']=$order;

		//thong tin phong
		$this->load->model('hotel_model');
		$hotel=$this->hotel_model->get_info($order->hotel_id);
		$this->data['hotel']=$hotel;

		//thong tin loai
		$this->load->model('room_type_model');
		$room_type=$this->room_type_model->get_info($hotel->type_id);
		$this->data['room_type']=$room_type;

		//Lấy danh sách thanh pho, quan huyen
 		$this->load->model('provinces_model');
 		$this->load->model('wards_model');
 		$provinces=$this->provinces_model->get_list();
 		$wards=$this->wards_model->get_list();
 		$this->data['provinces']=$provinces;
 		$this->data['wards']=$wards;

 		$this->load->view('admin/order/view', $this->data);
	}

	function pay_50()
	{
		//lay id don dat
		$id=$this->uri->segment(4);
		//lay thong tin don dat
		$order=$this->order_model->get_info($id);
		if($order->status==1)
		{
			$data=array();
			$data['status']=2;
			$this->order_model->update($id,$data);
			$this->session->set_flashdata('message', 'Thành công trả trước 50% tiền phòng.');
			redirect(admin_url('order'));
		}

	}

	function pay_100()
	{
		//lay id don dat
		$id=$this->uri->segment(4);
		//lay thong tin don dat
		$order=$this->order_model->get_info($id);
		if($order->payment=='dat-50')
		{
			if($order->status==2)
			{
				$data=array();
				$data['status']=3;
				$this->order_model->update($id,$data);
				$this->session->set_flashdata('message', 'Thành công trả trước 100% tiền phòng.');
				redirect(admin_url('order'));
			}
		}
		else
		{
			$data=array();
			$data['status']=3;
			$this->order_model->update($id,$data);
			$this->session->set_flashdata('message', 'Thành công 100% tiền phòng.');
			redirect(admin_url('order'));
		}
		$this->session->set_flashdata('message', 'Phải trả trước 50% tiền phòng.');
		redirect(admin_url('order'));
	}

	function check_out()
	{
		//lay id don dat
		$id=$this->uri->segment(4);
		//lay thong tin don dat
		$order=$this->order_model->get_info($id);
		//Tính ngày
		$days = ($order->check_out - time()) / (60 * 60 * 24);
		if($days<=0)
		{
			$this->load->model('hotel_model');
			$hotel=$this->hotel_model->get_info($order->hotel_id);
			$data=array();
			$data['status']=2;
			if($this->hotel_model->update($hotel->id,$data))
			{
				$data_status=array();
				$data_status['status']=4;
				$this->order_model->update($id,$data_status);
				$this->session->set_flashdata('message', 'Trả phòng thành công.');
				redirect(admin_url('order'));
			}
		}
		else
		{
			$this->session->set_flashdata('message', 'Chưa hết thời gian trả phòng.');
			redirect(admin_url('order'));
		}
	}
} ?>