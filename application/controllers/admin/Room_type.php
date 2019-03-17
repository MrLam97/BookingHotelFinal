<?php 
/**
 * 
 */
class Room_type extends MY_Controller
{
	
	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('room_type_model');
 	}

 	//Lấy ra danh sách loại phòng
 	function index()
 	{
 		$list = $this->room_type_model->get_list();
 		$this->data['list']=$list;

 		$total = $this->room_type_model->get_total();
		$this->data['total'] = $total;

		// lấy nội dung cũa biến message
 		$message=$this->session->flashdata('message');
 		$this->data['message']=$message;

 		$this->data['temp'] = 'admin/room_type/index';
 		$this->load->view('admin/main',$this->data);
 	}


 	function add()
 	{
 		$this->load->library('form_validation');
 		$this->load->helper('form');
 		//Nếu có dữ liệu post lên thì kiểm tra
 		if($this->input->post())
 		{
 			$this->form_validation->set_rules('name','Loại phòng','required');
 			$this->form_validation->set_rules('qty','Số lượng người','numeric|required');
 			$this->form_validation->set_rules('room_qty','Số lượng phòng','numeric|required');
 			if($this->form_validation->run())
 			{
 				//Láy tên file ảnh minh họa
 				$this->load->library('upload_library');
 				$upload_path='./upload/room_type';
 				$upload_data=$this->upload_library->upload($upload_path,'image');
 				
				$image_link='';
				if(isset($upload_data['file_name']))
				{
					$image_link=$upload_data['file_name'];
				}

	 			$data=array(
	 					'name'=>$this->input->post('name'),
	 					'qty'=>$this->input->post('qty'),
	 					'alias'=>$this->input->post('alias'),
	 					'image_link'=>$image_link,
	 					'room_qty'=>$this->input->post('room_qty'),
	 				);
	 			if($this->room_type_model->create($data))
	 			{
	 				$this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
	 			}
	 			else
	 			{
	 				$this->session->set_flashdata('message', 'Cập nhật dữ liệu thất bại');
	 			}
	 			redirect(admin_url('room_type'));
	 		}
	 		
 				
 		}


 		$this->data['temp'] = 'admin/room_type/add';
 		$this->load->view('admin/main',$this->data);
 	}


 	function edit()
 	{
 		$this->load->library('form_validation');
 		$this->load->helper('form');

 		//Lấy id admin cần chỉnh sữa
 		$id = $this->uri->rsegment(3);
 		$id = intval($id);

 		//Lấy thông tin của admin
 		$info = $this->room_type_model->get_info($id);
 		if(!$info)
 		{
 			$this->session->set_flashdata('message', 'Không tồn tại quản trị viên này');
 			redirect(admin_url('admin'));
 		}

 		$this->data['info']=$info;


 		if($this->input->post())
 		{
 			$this->form_validation->set_rules('name','Loại phòng','required');
 			$this->form_validation->set_rules('qty','Số lượng người','numeric|required');
 			$this->form_validation->set_rules('room_qty','Số lượng phòng','numeric|required');
 			if($this->form_validation->run())
 			{
 				//lấy tên file ảnh
 				$this->load->library('upload_library');
 				$upload_path='./upload/room_type';
 				$upload_data=$this->upload_library->upload($upload_path,'image');
 				
 				$image_link='';
 				if(isset($upload_data['file_name']))
 				{
 					$image_link=$upload_data['file_name'];
 				}

	 			$data=array(
	 					'name'=>$this->input->post('name'),
	 					'qty'=>$this->input->post('qty'),
	 					'alias'=>$this->input->post('alias'),
	 					'room_qty'=>$this->input->post('room_qty'),
	 					
	 				);

	 			// cập nhật sẽ xóa ảnh cũ
 				if($image_link!='')
 				{
 					$image_old='./upload/room_type/'.$info->image_link;
 					if(file_exists($image_old))
						{
							unlink($image_old);
						}
				 				
 					$data['image_link']=$image_link;
 				}

	 			if($this->room_type_model->update($id,$data))
	 			{
	 				$this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công');
	 			}
	 			else
	 			{
	 				$this->session->set_flashdata('message', 'Thêm mới dữ liệu thất bại');
	 			}
	 			redirect(admin_url('room_type'));
	 		}
	 		
 				
 		}

 		$this->data['temp'] = 'admin/room_type/edit';
 		$this->load->view('admin/main',$this->data);
 	}

 	function delete()
 	{
 		//Lấy id admin cần chỉnh sữa
 		$id = $this->uri->rsegment(3);
 		$id = intval($id);

 		$this->_del($id);

 		$this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
 		redirect(admin_url('room_type'));
 	}


 	//xóa nhiều 
 	function del_all()
 	{
 		$ids = $this->input->post('ids');
 		foreach ($ids as $id) {
 			$this->_del($id,false);
 		}
 	}

 	//xóa 

 	private function _del($id,$redirect=true)
 	{
 		$info=$this->room_type_model->get_info($id);
 		if(!$info)
 		{
 			// tạo nội dung thông báo
 			$this->session->set_flashdata('message','Không tồn tại loại phòng này');
 			if($redirect)
 			{
	 			redirect(admin_url('room_type'));
	 		}else{
	 			return false;
	 		}
 		}
 		//kiểm tra xem danh mục này có phong ko
 		$this->load->model('hotel_model');
 		$product=$this->hotel_model->get_info_rule(array('type_id'=>$id),'id');
 		if($product)
 		{
 			// tạo nội dung thông báo
 			$this->session->set_flashdata('message','loại phòng '.$info->name.' có chứa phòng khách sạn, phải xóa phòng khách sạn trước khi xóa danh mục này.');
 			if($redirect)
 			{
	 			redirect(admin_url('room_type'));
	 		}else{
	 			return false;
	 		}
 		}

 		//xóa dữ liệu
 		$this->room_type_model->delete($id);
 	}

}
 ?>