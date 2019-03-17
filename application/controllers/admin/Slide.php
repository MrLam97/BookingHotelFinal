<?php 
/**
  * 
  */
 class Slide extends MY_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		//Load model
 		$this->load->model('slide_model');
 	}

 	//Hiển thị danh sách
 	function index()
 	{
 		//lấy số luong danh sach slide
 		$total = $this->slide_model->get_total();
		$this->data['total'] = $total;
 		

 		//Lấy danh sách slide
 		$list = $this->slide_model->get_list();
 		$this->data['list']=$list;

 		// lấy nội dung cũa biến message
 		$message=$this->session->flashdata('message');
 		$this->data['message']=$message;

 		$this->data['temp'] = 'admin/slide/index';
 		$this->load->view('admin/main',$this->data);
 	}

 	// Thêm slide
 	function add()
 	{

 		$this->load->library('form_validation');
 		$this->load->helper('form');

 		//Nếu có dữ liệu post lên thì kiểm tra
 		if($this->input->post())
 		{
 			$this->form_validation->set_rules('name','Tên slide','required');	
 			//Nhập chính xác
 			if($this->form_validation->run())
 			{
 				//Láy tên file ảnh minh họa
 				$this->load->library('upload_library');
 				$upload_path='./upload/slide';
 				$upload_data=$this->upload_library->upload($upload_path,'image');
 				
				$image_link='';
				if(isset($upload_data['file_name']))
				{
					$image_link=$upload_data['file_name'];
				}

 				$data=array(
 					'name'=>$this->input->post('name'),
 					'link'=>$this->input->post('link'),
 					'info'=>$this->input->post('info'),
 					'sort_order'=>$this->input->post('sort_order'),
 					'image_link'=>$image_link,
 				);

 				if($this->slide_model->create($data))
 				{
 					$this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
 				}
 				else
 				{
 					$this->session->set_flashdata('message', 'Thêm mới dữ liệu thất bại');
 				}
 				//chuyển đến trang danh sách QTV
 				redirect(admin_url('slide'));


 			}
 		}

 		$this->data['temp'] = 'admin/slide/add';
 		$this->load->view('admin/main',$this->data);

 	}

 	//chỉnh sũa
 	function edit()
 	{
 		$id=$this->uri->rsegment(3);
 		$slide = $this->slide_model->get_info($id);
 		if(!$slide)
 		{
 			$this->session->set_flashdata('message', 'Không tồn tại slide này.');
 			redirect(admin_url('slide'));
 		}
 		$this->data['slide']=$slide;

 		$this->load->library('form_validation');
 		$this->load->helper('form');

 		//Nếu có dữ liệu post lên thì kiểm tra
 		if($this->input->post())
 		{
 			$this->form_validation->set_rules('name','Tên slide','required');	
 			//Nhập chính xác
 			if($this->form_validation->run())
 			{
 				//lấy tên file ảnh
 				$this->load->library('upload_library');
 				$upload_path='./upload/slide';
 				$upload_data=$this->upload_library->upload($upload_path,'image');
 				
 				$image_link='';
 				if(isset($upload_data['file_name']))
 				{
 					$image_link=$upload_data['file_name'];
 				}


 				$data=array(
 					'name'=>$this->input->post('name'),
 					'link'=>$this->input->post('link'),
 					'info'=>$this->input->post('info'),
 					'sort_order'=>$this->input->post('sort_order'),
 					
 				);
 				if($image_link!='')
 				{
 					$image_old='./upload/slide/'.$slide->image_link;
 					if(file_exists($image_old))
						{
							unlink($image_old);
						}
				 				
 					$data['image_link']=$image_link;
 				}

 				if($this->slide_model->update($id,$data))
 				{
 					$this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
 				}
 				else
 				{
 					$this->session->set_flashdata('message', 'Cập nhật dữ liệu thất bại');
 				}
 				//chuyển đến trang danh sách 
 				redirect(admin_url('slide'));


 			}
 		}

 		$this->data['temp'] = 'admin/slide/edit';
 		$this->load->view('admin/main',$this->data);
 	}

 	//Xóa phòng
 	function del()
 	{
 		$id=$this->uri->rsegment(3);
 		$this->_del($id);
		$this->session->set_flashdata('message', 'Đã xóa slide này.');
		redirect(admin_url('slide'));


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
 		$slide = $this->slide_model->get_info($id);
 		if(!$slide)
 		{
 			$this->session->set_flashdata('message', 'Không tồn tại slide này.');
 			redirect(admin_url('slide'));
 		}
 		$this->data['slide']=$slide;

 		//Thực hiện xóa
 		$this->slide_model->delete($id);
 		//xóa ảnh đại diện
 		$image_link='./upload/slide/'.$slide->image_link;
		if(file_exists($image_link))
		{
			unlink($image_link);
		}
		//xóa ảnh kèm theo
		$image_list=json_decode($slide->image_list);
		if (is_array($image_list)) {
			foreach ($image_list as $img) {
				$image_link='./upload/slide/'.$img;
				if(file_exists($image_link))
				{
					unlink($image_link);
				}
			}
		}
 	}
 } ?>