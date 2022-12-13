<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// Load library and url helper
		$this->load->library('facebook');
		$this->load->helper('url');
	}

	// ------------------------------------------------------------------------

	/**
	 * Index page
	 */
	public function index()
	{
		$this->load->view('examples/start');
	}

	// ------------------------------------------------------------------------

	/**
	 * Web redirect login example page
	 */
	public function web_login()
	{
		$data['user'] = array();

		// $uid = 100426509578648;
		// Check if user is logged in
		if ($token = $this->facebook->is_authenticated())
		{
			// User logged in, get user details
			$user = $this->facebook->request('get', '/me?fields=id,name,email,picture{url}');
			if (!isset($user['error']))
			{
				$data['user'] = $user;
			}

			//get accounts linked with fb
			$account_details = $this->facebook->request('get', 'me/accounts');
			if (!isset($account_details['error']))
			{
				// var_dump($account_details['data'][0]['name']);
				// $data['account'] = $account_details['data'];
				$data['account'] = $account_details['data'][0];
				$pageId = $account_details['data'][0]['id'];
			}

			if(!($account_details['data'][0]['id'])){
				var_dump($account_details['data']);exit;
			}

			//get instagram business id account from pageid fetched above
			$str = $pageId . '?fields=instagram_business_account';
			$igAccounts = $account_details = $this->facebook->request('get', $str);

			// var_dump($igAccounts['instagram_business_account']);
			if (!isset($igAccounts['error'])){
				$igAccId = $igAccounts['instagram_business_account']['id'];
			}
			
			//get instagram profile from the id fetched above
			$str = $igAccId . '?fields=followers_count,username,name,ig_id,profile_picture_url';
			$ig_Account = $this->facebook->request('get', $str);
			// var_dump($ig_Account);
			if (!isset($ig_Account['error'])){
				$data['igProfileData'] = $ig_Account;
			}
		}

		// display view
		$this->load->view('examples/web', $data);
	}

	// ------------------------------------------------------------------------

	/**
	 * JS SDK login example
	 */
	public function js_login()
	{
		// Load view
		$this->load->view('examples/js');
	}

	// ------------------------------------------------------------------------

	/**
	 * AJAX request method for positing to facebook feed
	 */
	public function post()
	{
		header('Content-Type: application/json');

		$result = $this->facebook->request(
			'post',
			'/me/feed',
			['message' => $this->input->post('message')]
		);

		echo json_encode($result);
	}

	// ------------------------------------------------------------------------

	/**
	 * Logout for web redirect example
	 *
	 * @return  [type]  [description]
	 */
	public function logout()
	{
		$this->facebook->destroy_session();
		redirect('example/web_login', redirect);
	}
}
