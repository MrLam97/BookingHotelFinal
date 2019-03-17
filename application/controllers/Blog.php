<?php 
/**
  * 
  */
 class Blog extends MY_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('blog_model');
 	}

 	function list_blog()
 	{

 		//lấy số luong danh sach phong
 		$total = $this->blog_model->get_total();
		$this->data['total'] = $total;

 		//load thu vien phan trang
 		$this->load->library('pagination');
 		
 		$config['base_url'] = base_url('blog/list_blog'); //link hien thi ra danh sach phong
 		$config['total_rows'] = $total; //tong số luong danh sach phong
 		$config['per_page'] = 9; //so luong hien thi tren 1 trang
 		$config['uri_segment'] = 3;
 		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
 		//khoi tao cau hinh phan trang
 		$this->pagination->initialize($config);
 		
 		// echo $this->pagination->create_links();
 		$segment=$this->uri->segment(3);
 		$segment=intval($segment);
 		$input=array();
 		$input['limit']=array($config['per_page'],$segment);

 		$list=$this->blog_model->get_list($input);
 		$this->data['list']=$list;

 		$this->load->model('admin_model');
 		$admin_list=$this->admin_model->get_list();
 		$this->data['admin_list']=$admin_list;


 		$this->data['title']='Danh sách bài viết';
 		$this->data['temp']='site/blog/list';
		$this->load->view('site/layout', $this->data);
 	}

 	function view()
 	{
 		$id=$this->uri->segment(3);
 		$blog=$this->blog_model->get_info($id);
 		$this->data['blog']=$blog;

 		$this->load->model('admin_model');
 		$admin_list=$this->admin_model->get_list();
 		$this->data['admin_list']=$admin_list;

 		//cập nhật lượt xem
		$data=array();
		$data['view']=$blog->view + 1;
		$this->blog_model->update($id,$data);
 		
 		//Lấy danh sách bài viết;
 		$input=array();
 		$input['limit'] = array('3' ,'0');
 		$blog_list=$this->blog_model->get_list($input);
 		$this->data['blog_list']=$blog_list;

 		$this->data['title']='Chi tiết bài viết';
 		$this->data['temp']='site/blog/view';
		$this->load->view('site/layout', $this->data);
 	}
 } ?>