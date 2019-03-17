<?php 
/**
  * 
  */
 class Hotel extends MY_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		//Load model
 		$this->load->model('hotel_model');
 	}

 	//Hiển thị danh sách
 	function index()
 	{
 		//lấy số luong danh sach phong
 		$total = $this->hotel_model->get_total();
		$this->data['total'] = $total;

 		//load thu vien phan trang
 		$this->load->library('pagination');
 		
 		$config['base_url'] = admin_url('hotel/index'); //link hien thi ra danh sach phong
 		$config['total_rows'] = $total; //tong số luong danh sach phong
 		$config['per_page'] = 10; //so luong hien thi tren 1 trang
 		$config['uri_segment'] = 4;
 		//khoi tao cau hinh phan trang
 		$this->pagination->initialize($config);
 		
 		// echo $this->pagination->create_links();
 		$segment=$this->uri->segment(4);
 		$segment=intval($segment);
 		$input = array();
 		$input['limit']=array($config['per_page'],$segment);

 		//kiem tra thuc hien chuc nang loc
 		$id= $this->input->get('id');
 		$id=intval($id);
 		$input['where']=array();
 		if($id>0)
 		{
			$input['where']['id']=$id;
 		}
 		$name= $this->input->get('name');
 		if($name)
 		{
 			$input['like']=array('name',$name);
 		}
 		$type_id= $this->input->get('room_type');
 		$type_id=intval($type_id);
 		if($type_id>0)
 		{
 			$input['where']['type_id']=$type_id;
 		}
 		$status=$this->input->get('status');
 		if($status)
 		{
 			$input['where']['status']=$status;
 		}

 		//Lấy danh sách sản phẩm
 		$list = $this->hotel_model->get_list($input);
 		$this->data['list']=$list;

 		//Lấy danh sách loại phòng
 		$this->load->model('room_type_model');
 		$list_type = $this->room_type_model->get_list();
 		$this->data['list_type']=$list_type;	

 		// lấy nội dung cũa biến message
 		$message=$this->session->flashdata('message');
 		$this->data['message']=$message;

 		$this->data['temp'] = 'admin/hotel/index';
 		$this->load->view('admin/main',$this->data);
 	}

 	// Thêm phòng khách sạn
 	function add()
 	{
 		// Lấy danh sách thành phố
 		$this->load->model('provinces_model');
 		$list_provinces = $this->provinces_model->get_list();
 		$this->data['list_provinces']=$list_provinces;

 		//Lấy danh sách loại phòng
 		$this->load->model('room_type_model');
 		$list_type = $this->room_type_model->get_list();
 		$this->data['list_type']=$list_type;

 		$this->load->library('form_validation');
 		$this->load->helper('form');

 		//Nếu có dữ liệu post lên thì kiểm tra
 		if($this->input->post())
 		{
 			$this->form_validation->set_rules('name','Tên khách sạn','required');
 			$this->form_validation->set_rules('room_type','Loại phòng','required');
 			$this->form_validation->set_rules('price','Giá phòng','required');
 			$this->form_validation->set_rules('provinces','Thành phố','required');
 			$this->form_validation->set_rules('wards','Quận huyện','required');
 			$this->form_validation->set_rules('address','Tên đường','required');
 			$this->form_validation->set_rules('email','Email','valid_email|required');
 			$this->form_validation->set_rules('phone','Điện thoại','numeric|required|min_length[10]|max_length[10]');
 			//Nhập chính xác
 			if($this->form_validation->run())
 			{
 				//Láy tên file ảnh minh họa
 				$this->load->library('upload_library');
 				$upload_path='./upload/hotel_room';
 				$upload_data=$this->upload_library->upload($upload_path,'image');
 				
				$image_link='';
				if(isset($upload_data['file_name']))
				{
					$image_link=$upload_data['file_name'];
				}

				//upload các ảnh kèm theo
				$image_list=array();
				$upload_path='./upload/hotel_room';
 				$image_list=$this->upload_library->upload_file($upload_path,'image_list');
 				$image_list=json_encode($image_list);


 				$data=array(
 					'name'=>$this->input->post('name'),
 					'price'=>str_replace(',', '', $this->input->post('price')),
 					'type_id'=>$this->input->post('room_type'),
 					'provinces'=>$this->input->post('provinces'),
 					'wards'=>$this->input->post('wards'),
 					'address'=>$this->input->post('address'),
 					'email'=>$this->input->post('email'),
 					'phone'=>$this->input->post('phone'),
 					'intro'=>$this->input->post('intro'),
 					'description'=>$this->input->post('content'),
 					'created'=>time(),
 					'image_link'=>$image_link,
 					'image_list'=>$image_list,
 					'status'=>2,
 					'alias'=>to_slug($this->input->post('name'))


 				);

 				if($this->hotel_model->create($data))
 				{
 					$this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
 				}
 				else
 				{
 					$this->session->set_flashdata('message', 'Thêm mới dữ liệu thất bại');
 				}
 				//chuyển đến trang danh sách QTV
 				redirect(admin_url('hotel'));


 			}
 		}

 		$this->data['temp'] = 'admin/hotel/add';
 		$this->load->view('admin/main',$this->data);

 	}

 	//chỉnh sũa
 	function edit()
 	{
 		$id=$this->uri->rsegment(3);
 		$hotel = $this->hotel_model->get_info($id);
 		if(!$hotel)
 		{
 			$this->session->set_flashdata('message', 'Không tồn tại phòng khách sạn này.');
 			redirect(admin_url('hotel'));
 		}
 		$this->data['hotel']=$hotel;


 		// Lấy danh sách thành phố
 		$this->load->model('provinces_model');
 		$list_provinces = $this->provinces_model->get_list();
 		$this->data['list_provinces']=$list_provinces;

 		$this->load->model('wards_model');
 		$list_wards = $this->wards_model->get_list();
 		$this->data['list_wards']=$list_wards;


 		//Lấy danh sách loại phòng
 		$this->load->model('room_type_model');
 		$list_type = $this->room_type_model->get_list();
 		$this->data['list_type']=$list_type;

 		$this->load->library('form_validation');
 		$this->load->helper('form');

 		//Nếu có dữ liệu post lên thì kiểm tra
 		if($this->input->post())
 		{
 			$this->form_validation->set_rules('name','Tên khách sạn','required');
 			$this->form_validation->set_rules('room_type','Loại phòng','required');
 			$this->form_validation->set_rules('price','Giá phòng','required');
 			$this->form_validation->set_rules('provinces','Thành phố','required');
 			$this->form_validation->set_rules('wards','Quận huyện','required');
 			$this->form_validation->set_rules('address','Tên đường','required');
 			$this->form_validation->set_rules('email','Email','valid_email|required');
 			$this->form_validation->set_rules('phone','Điện thoại','numeric|required|min_length[10]|max_length[10]');
 			//Nhập chính xác
 			if($this->form_validation->run())
 			{
 				//lấy tên file ảnh
 				$this->load->library('upload_library');
 				$upload_path='./upload/hotel_room';
 				$upload_data=$this->upload_library->upload($upload_path,'image');
 				
 				$image_link='';
 				if(isset($upload_data['file_name']))
 				{
 					$image_link=$upload_data['file_name'];
 				}
 				//upload ảnh kèm theo
 				$image_list=array();
 				$upload_data=$this->upload_library->upload_file($upload_path,'image_list');
 				$image_list=json_encode($upload_data);


 				$data=array(
 					'name'=>$this->input->post('name'),
 					'price'=>str_replace(',', '', $this->input->post('price')),
 					'type_id'=>$this->input->post('room_type'),
 					'provinces'=>$this->input->post('provinces'),
 					'wards'=>$this->input->post('wards'),
 					'address'=>$this->input->post('address'),
 					'email'=>$this->input->post('email'),
 					'phone'=>$this->input->post('phone'),
 					'intro'=>$this->input->post('intro'),
 					'description'=>$this->input->post('content'),
 					'updated'=>time(),
 					'alias'=>to_slug($this->input->post('name'))
 					


 				);
 				if($image_link!='')
 				{
 					$image_old='./upload/hotel_room/'.$hotel->image_link;
 					if(file_exists($image_old))
						{
							unlink($image_old);
						}
				 				
 					$data['image_link']=$image_link;
 				}
 				if(!empty($upload_data))
 				{
 					$image_old_list=json_decode($hotel->image_list);
					if(is_array($image_old_list))
					{
						foreach ($image_old_list as $img) {
							$image_old_list='./upload/hotel_room/'.$img;
							if(file_exists($image_old_list))
							{
								unlink($image_old_list);
							}
						}
					}
 					$data['image_list']=$image_list;
 				}

 				if($this->hotel_model->update($id,$data))
 				{
 					$this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
 				}
 				else
 				{
 					$this->session->set_flashdata('message', 'Thêm mới dữ liệu thất bại');
 				}
 				//chuyển đến trang danh sách QTV
 				redirect(admin_url('hotel'));


 			}
 		}

 		$this->data['temp'] = 'admin/hotel/edit';
 		$this->load->view('admin/main',$this->data);
 	}

 	function view()
 	{

 		$id=$this->uri->rsegment(3);
 		$hotel = $this->hotel_model->get_info($id);
 		if(!$hotel)
 		{
 			$this->session->set_flashdata('message', 'Không tồn tại phòng khách sạn này.');
 			redirect(admin_url('hotel'));
 		}
 		$this->data['hotel']=$hotel;

 		//Lấy  loại phòng
 		$this->load->model('room_type_model');
 		$room_type = $this->room_type_model->get_info($hotel->type_id);
 		$this->data['room_type']=$room_type;

 		//Lấy danh sách thanh pho, quan huyen
 		$this->load->model('provinces_model');
 		$this->load->model('wards_model');
 		$provinces=$this->provinces_model->get_list();
 		$wards=$this->wards_model->get_list();
 		$this->data['provinces']=$provinces;
 		$this->data['wards']=$wards;

 		$this->load->view('admin/hotel/view', $this->data);
 	}

 	//Xóa phòng
 	function del()
 	{
 		$id=$this->uri->rsegment(3);
 		$this->_del($id);
		$this->session->set_flashdata('message', 'Đã xóa phòng khách sạn này.');
		redirect(admin_url('hotel'));


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
 		$hotel = $this->hotel_model->get_info($id);
 		if(!$hotel)
 		{
 			$this->session->set_flashdata('message', 'Không tồn tại phòng khách sạn này.');
 			redirect(admin_url('hotel'));
 		}
 		$this->data['hotel']=$hotel;

 		//Thực hiện xóa
 		$this->hotel_model->delete($id);
 		//xóa ảnh đại diện
 		$image_link='./upload/hotel_room/'.$hotel->image_link;
		if(file_exists($image_link))
		{
			unlink($image_link);
		}
		//xóa ảnh kèm theo
		$image_list=json_decode($hotel->image_list);
		if (is_array($image_list)) {
			foreach ($image_list as $img) {
				$image_link='./upload/hotel_room/'.$img;
				if(file_exists($image_link))
				{
					unlink($image_link);
				}
			}
		}
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
 		$rs.='<option value="0">Lựa chọn quận/huyện</option>';
 		foreach ($list_wards as $row) {
 			$rs.="<option value='".$row->id."'>".$row->title."</option>"; 		
 		}
 		echo $rs;
 	}	


 	function fix()
 	{
 		//id phong
 		$id = $this->uri->rsegment(3);
 		//lay thog tin phong
 		//lay thong tin don dat
		$hotel=$this->hotel_model->get_info($id);
		if($hotel->status!=3)
		{
			$data=array();
			$data['status']=3;
			$this->hotel_model->update($id,$data);
			$this->session->set_flashdata('message', 'Tiến hành sửa chữa phòng.');
			redirect(admin_url('hotel'));
		}
 	}

 	function fixed()
 	{
 		//id phong
 		$id = $this->uri->rsegment(3);
 		//lay thog tin phong
 		//lay thong tin don dat
		$hotel=$this->hotel_model->get_info($id);
		if($hotel->status==3)
		{
			$data=array();
			$data['status']=2;
			$this->hotel_model->update($id,$data);
			$this->session->set_flashdata('message', 'Tiến hành sửa chữa phòng.');
			redirect(admin_url('hotel'));
		}
 	}
 } ?>