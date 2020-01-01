<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();
        $this->load->model('admin/Model_header');
        $this->load->model('admin/Model_project');
    }

	public function index()
	{
		$header['setting'] = $this->Model_header->get_setting_data();

		$data['project'] = $this->Model_project->show();

		$this->load->view('admin/view_header',$header);
		$this->load->view('admin/view_project',$data);
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

			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_rules('start', 'Project Start', 'required');
			$this->form_validation->set_rules('end', 'Project End', 'required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
				$next_id = $this->Model_project->get_auto_increment_id();
				foreach ($next_id as $row) {
		            $ai_id = $row['Auto_increment'];
		        }

		        $form_data = array(
					'name'           => $_POST['name'],
					'description'       => $_POST['description'],
					'start'       => $_POST['start'],
					'end'        => $_POST['end'],
					'status'       => $_POST['status'],
					'owner'        => $_POST['owner']
	            );
	            $this->Model_project->add($form_data);

		        $data['success'] = 'Project is added successfully!';

		        unset($_POST['name']);
				unset($_POST['description']);
				unset($_POST['start']);
				unset($_POST['end']);
				unset($_POST['status']);
				unset($_POST['owner']);
		    } 
		    else
		    {
		    	$data['error'] = $error;
		    }

		    //$data['all_role'] = $this->Model_user->get_role();
            $this->load->view('admin/view_header',$header);
			$this->load->view('admin/view_project_add',$data);
			$this->load->view('admin/view_footer');
            
        } else {
            //$data['all_role'] = $this->Model_user->get_role();
            $this->load->view('admin/view_header',$header);
			$this->load->view('admin/view_project_add',$data);
			$this->load->view('admin/view_footer');
        }
		
	}


	public function edit($id)
	{
		
    	// If there is no service in this id, then redirect
    	$tot = $this->Model_user->user_check($id);
    	if(!$tot) {
    		redirect(base_url().'admin/project');
        	exit;
    	}
       	
       	$header['setting'] = $this->Model_header->get_setting_data();
		$data['error'] = '';
		$data['success'] = '';
		$error = '';


		if(isset($_POST['form1'])) 
		{

			$valid = 1;

			$this->form_validation->set_rules('name', 'Project Name', 'trim|required');

			if($this->form_validation->run() == FALSE) {
				$valid = 0;
                $error .= validation_errors();
            }

		    if($valid == 1) 
		    {
		    	
		    	$data['team_member'] = $this->Model_user->getData($id);

		    	if($path == '') {
					/*
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
		            */
				}
				else {
		        $form_data = array(
					'name'           => $_POST['name'],
					'description'       => $_POST['description'],
					'start'       => $_POST['start'],
					'end'        => $_POST['end'],
					'status'       => $_POST['status'],
					'owner'        => $_POST['owner']
				);
		            $this->Model_project->update($id,$form_data);
				}				

				$data['success'] = 'Project is updated successfully';
		    }
		    else
		    {
		    	$data['error'] = $error;
		    }

            $this->load->view('admin/view_header',$header);
			$this->load->view('admin/view_project_edit',$data);
			$this->load->view('admin/view_footer');
           
		} else {
            $this->load->view('admin/view_header',$header);
			$this->load->view('admin/view_project_edit',$data);
			$this->load->view('admin/view_footer');
		}

	}


	public function delete($id) 
	{
        $data['user'] = $this->Model_project->getData($id);

        $this->Model_project->delete($id);
        redirect(base_url().'admin/project');
    }

 
}
