<?php 
/**
  * 
  */
 class Home extends MY_Controller
 {
 	
 	function index()
 	{

 		$this->load->model('admin_model');
 		$admin_list=$this->admin_model->get_list();
 		
 		// lấy nội dung cũa biến message        
        $message=$this->session->flashdata('message');
        $this->data['message']=$message;
 		
 		//Lấy danh sách thanh pho, quan huyen
 		$this->load->model('provinces_model');
 		$this->load->model('wards_model');
 		$provinces=$this->provinces_model->get_list();
 		$wards=$this->wards_model->get_list();

 		//Lấy danh sách bài viết
 		$this->load->model('blog_model');
 		$input=array();
 		$input['limit'] = array('3' ,'0');
 		$blog_list=$this->blog_model->get_list($input);


 		//Lấy danh sách loại phòng
 		$this->load->model('room_type_model');
 		$type_list=$this->room_type_model->get_list();

 		//Lấy danh sách slide
 		$this->load->model('slide_model');
 		$slide_list=$this->slide_model->get_list();

 		//Lấy danh sách phòng khách sạn
 		$this->load->model('hotel_model');
 		//Danh sách phòng được xem nhiều nhất
 		$input=array();
 		$input['order']=array('view','DESC');
 		$input['limit'] = array('8' ,'0');
 		$input['where']['status']=2;
 		$hotel_list=$this->hotel_model->get_list($input);
 		//Danh sách phòng được đặt nhiều nhất
 		$input=array();
 		$input['order']=array('ordered','DESC');
 		$input['limit'] = array('8' ,'0');
 		$input['where']['status']=2;
 		$hotel_list_order=$this->hotel_model->get_list($input);


 		//Lấy phòng có số view lớn nhất
 		for ($i=0; $i < count($hotel_list) ; $i++) { 
 			$view[]=$hotel_list[$i]->view;
 		}

 		$data = array();
 		$data['admin_list']=$admin_list;
 		$data['type_list']=$type_list;
 		$data['slide_list']=$slide_list;
 		$data['hotel_list']=$hotel_list;
 		$data['hotel_list_order']=$hotel_list_order;
 		$data['provinces']=$provinces;
 		$data['wards']=$wards;
 		// $data['view']=$view;
 		$data['blog_list']=$blog_list;
 		$data['title'] = 'Trang chủ';
 		$data['temp'] = 'site/home/index';
 		$this->load->view('site/layout',$data);
 	}
 } ?>