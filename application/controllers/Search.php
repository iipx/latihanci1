<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	function __construct() 
	{
        parent::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_search');
    }

	public function index()
	{
		$header['setting'] = $this->Model_common->get_setting_data();
		$header['page'] = $this->Model_common->get_page_data();
		$header['comment'] = $this->Model_common->get_comment_code();
		$header['social'] = $this->Model_common->get_social_data();
		$header['language'] = $this->Model_common->get_language_data();
		$header['latest_news'] = $this->Model_common->get_latest_news();
		$header['popular_news'] = $this->Model_common->get_popular_news();

		if(isset($_POST['search_string'])) {

			$data['search_string'] = $_POST['search_string'];
			$data['result'] = $this->Model_search->search($_POST['search_string']);
			$data['total'] = $this->Model_search->search_total($_POST['search_string']);

			$this->load->view('view_header',$header);
			$this->load->view('view_search',$data);
			$this->load->view('view_footer');

		} else {
			redirect(base_url());
            exit;
		}

		
	}
}
