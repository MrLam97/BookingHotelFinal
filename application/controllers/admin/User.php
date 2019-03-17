<?php /**
 * 
 */
class User extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	function index()
	{
		$input = array();
 		$list = $this->user_model->get_list($input);
 		$this->data['list'] = $list;

 		$total = $this->user_model->get_total();
		$this->data['total'] = $total;

		// lấy nội dung cũa biến message
 		$message=$this->session->flashdata('message');
 		$this->data['message']=$message;

 		$this->data['temp'] = 'admin/user/index';
 		$this->load->view('admin/main',$this->data);
	}

	//Chỉnh sửa thông tin thành viên
 	function edit()
 	{
 		$this->load->library('form_validation');
 		$this->load->helper('form');
 		//Lấy id admin cần chỉnh sữa
 		$id = $this->uri->rsegment(3);
 		$id = intval($id);

 		//Lấy thông tin của admin
 		$info = $this->user_model->get_info($id);
 		if(!$info)
 		{
 			$this->session->set_flashdata('message', 'Không tồn tại quản trị viên này');
 			redirect(admin_url('user'));
 		}

 		$this->data['info']=$info;

 		if($this->input->post())
 		{
 			$this->form_validation->set_rules('name','Tên','min_length[8]');
 			$this->form_validation->set_rules('phone','Điện thoại','numeric|min_length[10]|max_length[10]');
 			

 			$password=$this->input->post('password');
 			if($password)
 			{
 				$this->form_validation->set_rules('password', 'Mật khẩu', 'min_length[6]');
 				$this->form_validation->set_rules('re-password', 'Nhập lại mật khẩu', 'matches[password]');
 			}

 			if ($this->form_validation->run()) {
 				//Thêm vào csdl
 				$name=$this->input->post('name');
 				$phone = $this->input->post('phone');

 				$data=array(
 					'name'=>$name,
 					'phone'=>$phone
 				);
 				//nếu thay đổi mật khẩu thì mới gắn csdl
 				if($password)
 				{
 					$data['password']=md5($password);
 				}
 				
 				if($this->user_model->update($id,$data))// thực hiện update
 				{
 					// nội dung thông báo
 					$this->session->set_flashdata('message', 'Cập nhật dữ liệu thành công');
 				}
 				else
 				{
 					$this->session->set_flashdata('message', 'Cập nhật dữ liệu thất bại');
 				}
 				//chuyển tới trang danh sách quản trị viên
 				redirect(admin_url('user'));
 			} else {
 				# code...
 			}
 		}


 		$this->data['temp']='admin/user/edit';
 		$this->load->view('admin/main', $this->data);
 	}

 	//xóa 1 quan tri vien
 	function delete()
 	{
 		//Lấy id admin cần chỉnh sữa
 		$id = $this->uri->rsegment(3);
 		$id = intval($id);

 		//Lấy thông tin của admin
 		$info = $this->user_model->get_info($id);
 		if(!$info)
 		{
 			$this->session->set_flashdata('message', 'Không tồn tại thành viên này');
 			redirect(admin_url('user'));
 		}
 		//thực hiện xóa
 		$this->admin_model->delete($id);

 		$this->session->set_flashdata('message', 'Xóa dữ liệu thành công');
 		redirect(admin_url('user'));
 	}
} ?>