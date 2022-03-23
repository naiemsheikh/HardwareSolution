<?php
class API {
  // Properties 
  private $apiUrl;



		function __construct($arg) {
			if($arg){
				$this->apiUrl = $arg;
			}
			
		  }

		  // Methods
		  function setter($arg) {			 
			$this->apiUrl = $arg;
		  }
		  
		  
		  function getter() {			  
			 return $this->apiUrl;
		  }
		  		  
		  
		function  getApiData()
		{
		// write your code	
		$ch = curl_init();
		$url = "https://jsonplaceholder.typicode.com/posts";
         curl_setopt($ch, CURLOPT_URL, $url);            
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);         
		 $resp =    curl_exec($ch);
		 if($e = curl_error($ch))
		 {
				echo $e;
		 }
		 else{
				$decode = json_decode($resp);
				print_r($decode);
		 }
		  
		}

  
  
}




?>