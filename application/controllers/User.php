<?php 
/**
  * 
  */
 class User extends MY_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('user_model');
 	}


 	/*
 	* Kiểm email đã tồn tại chưa
 	*/
 	function check_email()
 	{
 		$email=$this->input->post('email');
 		$where=array('email'=>$email);
 		//kiểm tra email đã tồn tại chưa
 		if($this->user_model->check_exists($where))
 		{
 			// trả về thông báo lỗi
 			$this->form_validation->set_message(__FUNCTION__,'Eamil đã tồn tại');
 			return false;
 		}
 		return true;
 	}

 	//đăng kí user
 	function register()
 	{
 		$this->load->library('form_validation');
 		$this->load->helper('form');

 		//Nếu có dữ liệu post lên thì kiểm tra
 		if($this->input->post())
 		{
 			$this->form_validation->set_rules('name','Tên','required|min_length[8]');
 			$this->form_validation->set_rules('password','Mật khẩu','required|min_length[8]');
 			$this->form_validation->set_rules('confirm_Password','Nhập lại mật khẩu','matches[password]');
 			$this->form_validation->set_rules('email','Email đăng nhập','valid_email|required|callback_check_email');
 			$this->form_validation->set_rules('phone','Điện thoại','numeric|required|min_length[10]|max_length[10]');
 			//Nhập chính xác
 			if($this->form_validation->run())
 			{
 				//Thêm vào CSDL
 				$name = $this->input->post('name');
 				$password = $this->input->post('password');
 				$email = $this->input->post('email');
 				$phone = $this->input->post('phone');

 				$data=array(
 					'name'=>$name,
 					'password'=>md5($password),
 					'email'=>$email,
 					'phone'=>$phone,
 					'created'=>time()
 				);

 				if($this->user_model->create($data))
 				{
 					$this->session->set_flashdata('message', 'Đăng kí thành công');
 				}
 				else
 				{
 					$this->session->set_flashdata('message', 'Đăng kí thất bại');
 				}
 				//chuyển đến trang danh sách QTV
 				redirect(site_url());

 			}
 		}

 		$this->data['title']='Đăng kí';
 		$this->data['temp']='site/user/register';
		$this->load->view('site/layout', $this->data);
 	}

 	//đăng nhập
 	function login()
 	{
 		$this->load->library('form_validation');
 		$this->load->helper('form');
 		if($this->input->post())
 		{
 			$this->form_validation->set_rules('email','Email đăng nhập','valid_email|required');
 			$this->form_validation->set_rules('login','login','callback_check_login');
 			if($this->form_validation->run())
 			{
 				$user = $this->_get_user_info();
 				$this->session->set_userdata('user_id_login',$user->id);
 				
 				$this->session->set_flashdata('message', 'Đăng nhập thành công');
 				redirect();
 			}

 		}

 		$this->data['title']='Đăng nhập';
 		$this->data['temp']='site/user/login';
		$this->load->view('site/layout', $this->data);
 	}

 	//Kiểm tra email va password co chinhxac ko

 	function check_login()
 	{
 		$user = $this->_get_user_info();
 		if($this->user_model->check_exists($user))
 		{
 			return true;
 		}
 		$this->form_validation->set_message(__FUNCTION__,'Không đăng nhập thành công');
 		return false;
 	}

 	//Lay thong tin thanh vien
 	private function _get_user_info()
 	{
 		$email=$this->input->post('email');
 		$password=$this->input->post('password');
 		$password=md5($password);

 		
 		$where = array('email' =>$email,'password'=>$password);
 		$user=$this->user_model->get_info_rule($where);
 		return $user;
 	}

 	//Thông tin thành viên
 	function index()
 	{

 		$this->data['title']='Thông tin';
 		$this->data['temp']='site/user/index';
		$this->load->view('site/layout', $this->data);
 	}

 	//doi mật khẩu
 	function change_pwd()
 	{
 		$this->load->library('form_validation');
 		$this->load->helper('form');
 		if($this->input->post())
 		{
 			$this->form_validation->set_rules('password','Mật khẩu cũ','required');
 			$this->form_validation->set_rules('password_new','Mật khẩu mới','required|min_length[8]');
 			$this->form_validation->set_rules('re_password','Nhập lại mật khẩu mới','matches[password_new]|required');
 			$this->form_validation->set_rules('chk_pwd','chk_pwd','callback_check_pwd');
 			if($this->form_validation->run())
 			{
 				$id=$this->input->post('id');
				$user=$this->user_model->get_info($id);
 				
				$data=array(
					'password'=>md5($this->input->post('password_new')),
				);
				if($this->user_model->update($user->id,$data))
				{
					$this->session->set_flashdata('message', 'Đổi mật khẩu thành công');
				}
				else
				{
					$this->session->set_flashdata('message', 'Đổi mật khẩu thành công');
				}
				redirect(site_url());
 			}

 		}

 		$this->data['title']='Đổi mật khẩu';
 		$this->data['temp']='site/user/change_pwd';
		$this->load->view('site/layout', $this->data);
 	}

 	function check_pwd()
 	{
 		$pwd=$this->input->post('password');
		$id=$this->input->post('id');
		$user=$this->user_model->get_info($id);

		if($user->password==md5($pwd))
		{
			return true;
		}
		$this->form_validation->set_message(__FUNCTION__,'Mật khẩu không chính xác.');
		return false;
 	}

 	//cap nhat
 	function edit()
 	{
 		$id=$this->input->post('id');
		$user=$this->user_model->get_info($id);
 				
		$data=array(
			'name'=>$this->input->post('name'),
			'phone'=>$this->input->post('phone'),
		);
		if($this->user_model->update($user->id,$data))
		{
			$this->session->set_flashdata('message', 'Cập nhật thành công');
		}
		else
		{
			$this->session->set_flashdata('message', 'Cập nhật thành công');
		}
		redirect(site_url());


 		$this->data['title']='Đổi mật khẩu';
 		$this->data['temp']='site/user/edit';
		$this->load->view('site/layout', $this->data);
 	}

 	// thực hiện đăng xuất
 	function logout()
 	{
 		if($this->session->userdata('user_id_login'))
 		{
 			$this->session->unset_userdata('user_id_login');
 		}
 		$this->session->set_flashdata('message', 'Đăng xuất thành công');
 		redirect();
 	}
 } ?>