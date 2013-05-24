<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends App_Controller
{
	public function index()
	{
		$this->authenticate=TRUE;
		
		$this->data['state_options']=array(
			''=>'(select a state)',
			'AL'=>'Alabama',  
			'AK'=>'Alaska',  
			'AZ'=>'Arizona',  
			'AR'=>'Arkansas',  
			'CA'=>'California',  
			'CO'=>'Colorado',  
			'CT'=>'Connecticut',  
			'DE'=>'Delaware',  
			'DC'=>'District Of Columbia',  
			'FL'=>'Florida',  
			'GA'=>'Georgia',  
			'HI'=>'Hawaii',  
			'ID'=>'Idaho',  
			'IL'=>'Illinois',  
			'IN'=>'Indiana',  
			'IA'=>'Iowa',  
			'KS'=>'Kansas',  
			'KY'=>'Kentucky',  
			'LA'=>'Louisiana',  
			'ME'=>'Maine',  
			'MD'=>'Maryland',  
			'MA'=>'Massachusetts',  
			'MI'=>'Michigan',  
			'MN'=>'Minnesota',  
			'MS'=>'Mississippi',  
			'MO'=>'Missouri',  
			'MT'=>'Montana',
			'NE'=>'Nebraska',
			'NV'=>'Nevada',
			'NH'=>'New Hampshire',
			'NJ'=>'New Jersey',
			'NM'=>'New Mexico',
			'NY'=>'New York',
			'NC'=>'North Carolina',
			'ND'=>'North Dakota',
			'OH'=>'Ohio',  
			'OK'=>'Oklahoma',  
			'OR'=>'Oregon',  
			'PA'=>'Pennsylvania',  
			'RI'=>'Rhode Island',  
			'SC'=>'South Carolina',  
			'SD'=>'South Dakota',
			'TN'=>'Tennessee',  
			'TX'=>'Texas',  
			'UT'=>'Utah',  
			'VT'=>'Vermont',  
			'VA'=>'Virginia',  
			'WA'=>'Washington',  
			'WV'=>'West Virginia',  
			'WI'=>'Wisconsin',  
			'WY'=>'Wyoming',
		);
	}
	
	public function login()
	{
		if($this->form_validation->run('site/login')!==false && $this->user->log_in())
			redirect('dashboard');
	}
	
	public function logout()
	{
		$this->user->log_out();
		redirect('login');
	}
}

/* End of file site.php */
/* Location: ./application/controllers/site.php */