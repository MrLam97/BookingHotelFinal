<?php 
/**
  * 
  */
 class Blog extends MY_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		//Load model
 		$this->load->model('blog_model');
 	}

 	//Hiển thị danh sách
 	function index()
 	{
 		//lấy số luong danh sach blog
 		$total = $this->blog_model->get_total();
		$this->data['total'] = $total;

 		//load thu vien phan trang
 		$this->load->library('pagination');
 		
 		$config['base_url'] = admin_url('blog/index'); //link hien thi ra danh sach blog
 		$config['total_rows'] = $total; //tong số luong danh sach blog
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
 		$title= $this->input->get('title');
 		if($title)
 		{
 			$input['like']=array('title',$title);
 		}
 		

 		//Lấy danh sách blog
 		$list = $this->blog_model->get_list($input);
 		$this->data['list']=$list;

 		// lấy nội dung cũa biến message
 		$message=$this->session->flashdata('message');
 		$this->data['message']=$message;

 		$this->data['temp'] = 'admin/blog/index';
 		$this->load->view('admin/main',$this->data);
 	}

 	// Thêm blog
 	function add()
 	{

 		$this->load->library('form_validation');
 		$this->load->helper('form');

 		//Nếu có dữ liệu post lên thì kiểm tra
 		if($this->input->post())
 		{
 			$this->form_validation->set_rules('title','Tiêu đề bài viết','required');
 			$this->form_validation->set_rules('content','Nội dung bài viết','required');	
 			//Nhập chính xác
 			if($this->form_validation->run())
 			{
 				//Láy tên file ảnh minh họa
 				$this->load->library('upload_library');
 				$upload_path='./upload/blog';
 				$upload_data=$this->upload_library->upload($upload_path,'image');
 				
				$image_link='';
				if(isset($upload_data['file_name']))
				{
					$image_link=$upload_data['file_name'];
				}

 				$data=array(
 					'title'=>$this->input->post('title'),
 					'intro'=>$this->input->post('intro'),
 					'content'=>$this->input->post('content'),
 					'created'=>time(),
 					'user_id'=>1,
 					'alias'=>$this->input->post('alias'),
 					'image_link'=>$image_link,


 				);

 				if($this->blog_model->create($data))
 				{
 					$this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
 				}
 				else
 				{
 					$this->session->set_flashdata('message', 'Thêm mới dữ liệu thất bại');
 				}
 				//chuyển đến trang danh sách QTV
 				redirect(admin_url('blog'));


 			}
 		}

 		$this->data['temp'] = 'admin/blog/add';
 		$this->load->view('admin/main',$this->data);

 	}

 	//chỉnh sũa
 	function edit()
 	{
 		$id=$this->uri->rsegment(3);
 		$blog = $this->blog_model->get_info($id);
 		if(!$blog)
 		{
 			$this->session->set_flashdata('message', 'Không tồn tại phòng khách sạn này.');
 			redirect(admin_url('blog'));
 		}
 		$this->data['blog']=$blog;

 		$this->load->library('form_validation');
 		$this->load->helper('form');

 		//Nếu có dữ liệu post lên thì kiểm tra
 		if($this->input->post())
 		{
 			$this->form_validation->set_rules('title','Tiêu đề bài viết','required');
 			$this->form_validation->set_rules('content','Nội dung bài viết','required');	
 			//Nhập chính xác
 			if($this->form_validation->run())
 			{
 				//lấy tên file ảnh
 				$this->load->library('upload_library');
 				$upload_path='./upload/blog';
 				$upload_data=$this->upload_library->upload($upload_path,'image');
 				
 				$image_link='';
 				if(isset($upload_data['file_name']))
 				{
 					$image_link=$upload_data['file_name'];
 				}


 				$data=array(
 					'title'=>$this->input->post('title'),
 					'intro'=>$this->input->post('intro'),
 					'content'=>$this->input->post('content'),
 					'created'=>time(),
 					'user_id'=>1,
 					'alias'=>$this->input->post('alias'),
 				);
 				
 				// cập nhật sẽ xóa ảnh cũ
 				if($image_link!='')
 				{
 					$image_old='./upload/blog/'.$blog->image_link;
 					if(file_exists($image_old))
						{
							unlink($image_old);
						}
				 				
 					$data['image_link']=$image_link;
 				}

 				if($this->blog_model->update($id,$data))
 				{
 					$this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
 				}
 				else
 				{
 					$this->session->set_flashdata('message', 'Cập nhật dữ liệu thất bại');
 				}
 				//chuyển đến trang danh sách 
 				redirect(admin_url('blog'));


 			}
 		}

 		$this->data['temp'] = 'admin/blog/edit';
 		$this->load->view('admin/main',$this->data);
 	}

 	//Xóa phòng
 	function del()
 	{
 		$id=$this->uri->rsegment(3);
 		$this->_del($id);
		$this->session->set_flashdata('message', 'Đã xóa blog này.');
		redirect(admin_url('blog'));


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
 		$blog = $this->blog_model->get_info($id);
 		if(!$blog)
 		{
 			$this->session->set_flashdata('message', 'Không tồn tại blog này.');
 			redirect(admin_url('blog'));
 		}
 		$this->data['blog']=$blog;

 		//Thực hiện xóa
 		$this->blog_model->delete($id);
 		//xóa ảnh đại diện
 		$image_link='./upload/blog/'.$blog->image_link;
		if(file_exists($image_link))
		{
			unlink($image_link);
		}
		//xóa ảnh kèm theo
		$image_list=json_decode($blog->image_list);
		if (is_array($image_list)) {
			foreach ($image_list as $img) {
				$image_link='./upload/blog/'.$img;
				if(file_exists($image_link))
				{
					unlink($image_link);
				}
			}
		}
 	}
 } ?>