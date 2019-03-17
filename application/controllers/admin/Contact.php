<?php 
/**
  * 
  */
 class Contact extends MY_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('contact_model');
 	}

 	function index()
 	{
 		//lấy số luong danh sach contact
 		$total = $this->contact_model->get_total();
		$this->data['total'] = $total;

 		//load thu vien phan trang
 		$this->load->library('pagination');
 		
 		$config['base_url'] = admin_url('contact/index'); //link hien thi ra danh sach contact
 		$config['total_rows'] = $total; //tong số luong danh sach contact
 		$config['per_page'] = 10; //so luong hien thi tren 1 trang
 		$config['uri_segment'] = 4;
 		//khoi tao cau hinh phan trang
 		$this->pagination->initialize($config);
 		
 		// echo $this->pagination->create_links();
 		$segment=$this->uri->segment(4);
 		$segment=intval($segment);
 		$input = array();
 		$input['limit']=array($config['per_page'],$segment);
 		

 		//Lấy danh sách contact
 		$list = $this->contact_model->get_list($input);
 		$this->data['list']=$list;

 		// lấy nội dung cũa biến message
 		$message=$this->session->flashdata('message');
 		$this->data['message']=$message;

 		$this->data['temp'] = 'admin/contact/index';
 		$this->load->view('admin/main',$this->data);
 	}

 	function view()
 	{
 		$id=$this->uri->segment(4);

 		$contact = $this->contact_model->get_info($id);
 		$this->data['contact']=$contact;
 		$this->load->view('admin/contact/view', $this->data);
 
 	}

 	//Xóa phòng
 	function del()
 	{
 		$id=$this->uri->rsegment(3);
 		$this->_del($id);
		$this->session->set_flashdata('message', 'Đã xóa contact này.');
		redirect(admin_url('contact'));


 	}


 	//xóa nhiều phòng
 	function del_all()
 	{
 		$ids = $this->input->post('ids');
 		foreach ($ids as $id) {
 			$this->_del($id);
 		}
 	}

 	//xóa 
 	function _del($id)
 	{
 		$contact = $this->contact_model->get_info($id);
 		if(!$contact)
 		{
 			$this->session->set_flashdata('message', 'Không tồn tại contact này.');
 			redirect(admin_url('contact'));
 		}
 		$this->data['contact']=$contact;

 		//Thực hiện xóa
 		$this->contact_model->delete($id);
 	}
 } ?>