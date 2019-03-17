<?php 
/**
  * 
  */
 class Upload_library
 {
    
    var $CI='';
    function __construct()
    {
        $this->CI =& get_instance();
    }
    /*
    * upload file
    *$upload_path: đường dẫn lưu file
    *$file_name: tên thẻ input upload file
    */
    function upload($upload_path='',$file_name)
    {
        //lấy thông tin cấu hình
        $config=$this->config($upload_path);
        $this->CI->load->library('upload', $config);
        //thực hiện upload
        if($this->CI->upload->do_upload($file_name))
        {
            $data=$this->CI->upload->data();
        }
        else
        {
            //upload thất bại
            $data=$this->CI->upload->display_errors();
        }
        return $data;
    }

    /*
    * upload nhiều file
    *$upload_path: đường dẫn lưu file
    *$file_name: tên thẻ input upload file
    */
    function upload_file($upload_path='',$file_name)
    {
        //lấy thông tin cấu hình
        $config=$this->config($upload_path);
        
        //lưu biến môi trường khi thực hiện upload
        $file  = $_FILES['image_list'];
        $count = count($file['name']);//lấy tổng số file được upload

        $image_list=array();
        for($i=0; $i<=$count-1; $i++) {
              
              $_FILES['userfile']['name']     = $file['name'][$i];  //khai báo tên của file thứ i
              $_FILES['userfile']['type']     = $file['type'][$i]; //khai báo kiểu của file thứ i
              $_FILES['userfile']['tmp_name'] = $file['tmp_name'][$i]; //khai báo đường dẫn tạm của file thứ i
              $_FILES['userfile']['error']    = $file['error'][$i]; //khai báo lỗi của file thứ i
              $_FILES['userfile']['size']     = $file['size'][$i]; //khai báo kích cỡ của file thứ i
              //load thư viện upload và cấu hình
              $this->CI->load->library('upload', $config);
              //thực hiện upload từng file
              if($this->CI->upload->do_upload())
              {
                  //nếu upload thành công thì lưu toàn bộ dữ liệu
                  $data = $this->CI->upload->data();
                  //in cấu trúc dữ liệu của các file
                 $image_list[]=$data['file_name'];
              }     
         }
         return $image_list;
    }

    /*
    * cấu hình upload file
    */
    function config($upload_path='')
    {
        //Khai bao bien cau hinh
         $config = array();
         //thuc mục chứa file
         $config['upload_path']   = $upload_path;
         //Định dạng file được phép tải
         $config['allowed_types'] = 'jpg|png|gif';
         //Dung lượng tối đa
         $config['max_size']      = '1200';
         //Chiều rộng tối đa
         $config['max_width']     = '2200';
         //Chiều cao tối đa
         $config['max_height']    = '1200';

         return $config;
    }

 /*
 * rezise thumbnail
 */
  function resizeImage($file_name)
   {
      $source_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/images/' . $filename;
      $target_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/thumbnail/';
      $config_manip = array(
          'image_library' => 'gd2',
          'source_image' => $source_path,
          'new_image' => $target_path,
          'maintain_ratio' => TRUE,
          'create_thumb' => TRUE,
          'thumb_marker' => '_thumb',
          'width' => 150,
          'height' => 150
      );


      $this->load->library('image_lib', $config_manip);
      if (!$this->image_lib->resize()) {
          echo $this->image_lib->display_errors();
      }


      $this->image_lib->clear();
   } 
 }


 ?>