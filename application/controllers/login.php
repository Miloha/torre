<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('session','form_validation'));
		$this->load->helper(array('url','form'));
		
        $this->pbase = array(0,1,2,3,4,5,6,7,8,9);
        $this->pbasep = array('00','11','22','33','44','55','66','77','88','99');
        $this->tciclos = 0;
        $this->presultado = array(0);
        
	}

	public function index($limit = 6)
	{
		

		for ($i = 1; $i <= $limit; $i++) {

			$this->creap($i);


		}

			$data['palindrome'] = $this->presultado;
			$data['total_palindrome'] = count($this->presultado); 
			$data['cycles'] = $this->tciclos;
			$data['digits'] = $limit;


			header('Content-Type: application/json');
    		echo json_encode( $data );


			
	}


	public function creap($j){

		
		if( $j % 2 == 0 ){
			$plocalbase = $this->pbasep;
			
		}else{
			$plocalbase = $this->pbase;
		}
		$pnuevabase = array();

		if($j == 1 || $j == 2){
			foreach ($plocalbase as $key => $value) {
				$this->tciclos++;
				array_push($pnuevabase,$value);
				$palibin = decbin($value);
				if($palibin == strrev($palibin) && $value != '00'){
					array_push($this->presultado,$value); 

				}

			
			}
				

		}else{
			foreach ($plocalbase as $key => $value) {
				for($i=1; $i<=9; $i++){
					$this->tciclos++;
					$nuevop = intval($i . $value . $i);
					array_push($pnuevabase,$nuevop);

					$palibin = decbin($nuevop);
					if($palibin == strrev($palibin)){
						array_push($this->presultado,$nuevop); 
						//echo " * " . $value . " - " . $nuevop;
					} 

					


				}
				

			
			}

				
		}


		
		if( $j % 2 == 0 ){
			$this->pbasep = $pnuevabase; 
			
		}else{
			$this->pbase = $pnuevabase;
		}


	}

	
}
