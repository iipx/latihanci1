<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_header');
        $this->load->model('admin/Model_user');
    }

	public function index()
	{
		$header['setting'] = $this->Model_header->get_setting_data();

		$data['user'] = $this->Model_user->show();

		$this->load->view('admin/view_header',$header);
		$this->load->view('admin/view_user',$data);
		$this->load->view('admin/view_footer');
	}

	public function add()
	{
		$header['setting'] = $this->Model_header->get_setting_data();

		$data['error'] = '';
		$data['success'] = '';
		$error = '';

		if(isset($_POST['form1'])) {

			$valid = 1;

			$this->form_validation->set_rules('full_name', 'Name', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

            $path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];

		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_header->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error .= 'You must have to upload jpg, jpeg, gif or png file for featured photo<br>';
		        }
		    } else {
		    	$valid = 0;
		        $error .= 'You must have to select a photo for featured photo<br>';
		    }

		    if($valid == 1) 
		    {
				$next_id = $this->Model_user->get_auto_increment_id();
				foreach ($next_id as $row) {
		            $ai_id = $row['Auto_increment'];
		        }

		        $final_name = 'user-'.$ai_id.'.'.$ext;
		        move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

		        $form_data = array(
					'full_name'           => $_POST['full_name'],
					'email' => $_POST['email'],
					'photo'          => $final_name,
					'phone'       => $_POST['phone'],
					'role'        => $_POST['role'],
					'status'       => $_POST['status'],
					'token'        => $_POST['token'],
					'password'     => password_hash($_POST['password'], PASSWORD_BCRYPT)
	            );
	            $this->Model_user->add($form_data);

		        $data['success'] = 'User is added successfully!';

		        unset($_POST['full_name']);
				unset($_POST['email']);
				unset($_POST['photo']);
				unset($_POST['role']);
				unset($_POST['status']);
				unset($_POST['token']);
				unset($_POST['password']);
		    } 
		    else
		    {
		    	$data['error'] = $error;
		    }

		    $data['all_role'] = $this->Model_user->get_role();
            $this->load->view('admin/view_header',$header);
			$this->load->view('admin/view_user_add',$data);
			$this->load->view('admin/view_footer');
            
        } else {
            $data['all_role'] = $this->Model_user->get_role();
            $this->load->view('admin/view_header',$header);
			$this->load->view('admin/view_user_add',$data);
			$this->load->view('admin/view_footer');
        }
		
	}


	public function edit($id)
	{
		
    	// If there is no service in this id, then redirect
    	$tot = $this->Model_user->user_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/user');
        	exit;
    	}
       	
       	$header['setting'] = $this->Model_header->get_setting_data();
		$data['error'] = '';
		$data['success'] = '';
		$error = '';


		if(isset($_POST['form1'])) 
		{

			$valid = 1;

			$this->form_validation->set_rules('full_name', 'Name', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

            $path = $_FILES['photo']['name'];
		    $path_tmp = $_FILES['photo']['tmp_name'];

		    if($path!='') {
		        $ext = pathinfo( $path, PATHINFO_EXTENSION );
		        $file_name = basename( $path, '.' . $ext );
		        $ext_check = $this->Model_header->extension_check_photo($ext);
		        if($ext_check == FALSE) {
		            $valid = 0;
		            $error .= 'You must have to upload jpg, jpeg, gif or png file for featured photo<br>';
		        }
		    }

		    if($valid == 1) 
		    {
		    	$data['team_member'] = $this->Model_user->getData($id);

		    	if($path == '') {
		    		$form_data = array(
					'full_name'     => $_POST['full_name'],
					'email' 		=> $_POST['email'],
					'photo'			=> $final_name,
					'phone'       	=> $_POST['phone'],
					'role'        	=> $_POST['role'],
					'status'       => $_POST['status'],
					'token'        => $_POST['token'],
					'password'     => password_hash($_POST['password'], PASSWORD_BCRYPT)
		            );
		            $this->Model_team_member->update($id,$form_data);
				}
				else {
					unlink('./public/uploads/'.$data['user']['photo']);

					$final_name = 'user-'.$id.'.'.$ext;
		        	move_uploaded_file( $path_tmp, './public/uploads/'.$final_name );

		        	$form_data = array(
					'full_name'     => $_POST['full_name'],
					'email' 		=> $_POST['email'],
					'photo'			=> $final_name,
					'phone'       	=> $_POST['phone'],
					'role'        	=> $_POST['role'],
					'status'       => $_POST['status'],
					'token'        => $_POST['token'],
					'password'     => password_hash($_POST['password'], PASSWORD_BCRYPT)
		            );
		            $this->Model_user->update($id,$form_data);
				}				

				$data['success'] = 'User is updated successfully';
		    }
		    else
		    {
		    	$data['error'] = $error;
		    }

		    $data['user'] = $this->Model_user->getData($id);
		    $data['all_role'] = $this->Model_user->get_role();
            $this->load->view('admin/view_header',$header);
			$this->load->view('admin/view_user_edit',$data);
			$this->load->view('admin/view_footer');
           
		} else {
			$data['user'] = $this->Model_user->getData($id);
			$data['all_role'] = $this->Model_user->get_role();
            $this->load->view('admin/view_header',$header);
			$this->load->view('admin/view_user_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}


	public function delete($id) 
	{
		// If there is no team member in this id, then redirect
    	$tot = $this->Model_user->user_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/user');
        	exit;
    	}

        $data['user'] = $this->Model_user->getData($id);
        if($data['user']) {
            unlink('./public/uploads/'.$data['user']['photo']);
        }

        $this->Model_user->delete($id);
        redirect(base_url().'admin/user');
    }

 
}
