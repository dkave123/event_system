<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cUser extends CI_Controller {

	public function __Construct(){
      parent::__Construct ();
      $this->load->database(); // load database
      $this->load->model('user/MUser');
      $this->load->model('user/MEvent');
      $this->load->model('MCardLoad');
      $this->load->library('session');
     	
  	}

  	public function redeemCode(){
		
		$code = $this->input->post('ccode');
		$card = $this->MCardLoad->read_where( array('card_code' => $code ));
		if($card != 0){
			$card = json_decode(json_encode($card));
			echo $card[0]->card_amount;
			$u =  $this->MUser->read($this->session->userdata['userSession']->userID);
			$cardNew = $u[0]->load_amt + $card[0]->card_amount;
			
			$res = $this->MUser->update($this->session->userdata["userSession"]->userID,array('load_amt'=>$cardNew));

			if($res){
				$res1 = $this->MCardLoad->update($code, array('card_active' => '0'));
				redirect("event/cEvent/viewEvents");
			}
		}else{
			redirect("event/cEvent/viewEvents");
		}
	}
	public function index()
	{
		$this->data['custom_js']= '<script type="text/javascript">
                              $(function(){
                              	$("#user").addClass("active");
                              });
                        </script>';

        $data['users'] = $this->MUser->getAllUsers();

		$this->load->view('imports/vHeader');
		$this->load->view('user/vUser',$data);
		$this->load->view('imports/vFooter',$this->data);
	}

	public function signuppage()
	{
		
		$this->load->view('user/vSignup.php');
		
	}


	public function signup()
	{
		$user = new MUser();

		$now = NEW DateTime(NULL, new DateTimeZone('UTC'));

		$data = array('user_name' => $this->input->post('uname'), 
					  'password' => $this->input->post('password'),
					  'first_name' => $this->input->post('fname'),
					  'last_name' => $this->input->post('lname'),
					  'middle_initial' => $this->input->post('miname'),
					  'email' => $this->input->post('email'),
					  'birthdate' => $this->input->post('bdate'),
					  'gender' => $this->input->post('gender'),					  
					  'contact_no' => $this->input->post('contact'),
					  'user_type' => 'Regular',
					  'date_account_created' => $now->format('Y-m-d H:i:s')	
					);
	
		
		$res = $this->MUser->read_where(array('user_name' => $data['user_name']));
		$res1 = $this->MUser->read_where(array('email' => $data['email']));

    	if($res){
    			redirect('user/cUser/viewSignUp');
				//echo "INVALID, EXISTING USERNAME, PLS TRY AGAIN";

		}else if($res1){
				redirect('user/cUser/viewSignUp');
				//echo "INVALID, EXISTING EMAIL, PLS TRY AGAIN";
				
		}else{

			$result = $user->insert($data);

			if($result){
			//$this->index();
			redirect('event/cEvent/viewEvents');
		}

		}

		# code...
	}

	public function eventregister()
	{
		$this->load->view('imports/vHeader');
		$this->load->view('user/vEventRegistration.php');
		$this->load->view('imports/vFooter');
	}

	public function displayEvent()
	{

		$data['events'] = $this->MEvent->getAllEvents();
		$this->load->view('imports/vHeader');
		$this->load->view('user/vListEvents.php', $data);
		$this->load->view('imports/vFooter');
		# code...
	}

	public function displayEventDetails($id)
	{
		
		$uid = null;
		
		$data1 ['events']= $this->MEvent->loadEventDetails($id);
		$gID = $this->MEvent->loadEventDetails($id);
		foreach ($gID as $k) {
			$uid = $k->user_id;
		}
		// print_r($uid);
		$data2['users']	= $this->MUser->loadUserDetails($uid);

		$data = array_merge($data1,$data2);
		// print_r($data);
		$this->load->view('imports/vHeader');
		$this->load->view('user/vEventRegistration.php', $data);
		$this->load->view('imports/vFooter');
		# code...
	}

	public function search(){
		$data['events'] = $this->MEvent->getAllEvents();
		$this->load->view('imports/vHeader');
		$this->load->view('user/vSearch.php');
		// $this->load->view('user/vListEvents.php', $data);
		$this->load->view('imports/vFooter');
	}
	public function viewSignUp()
	{
		$this->load->view('imports/vHeaderSignUpPage');
		$this->load->view('vSignUp');
		$this->load->view('imports/vFooterLandingPage');
	}
}
