
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css">

</head>

<?php 
// write your code 
$url = "https://jsonplaceholder.typicode.com/posts";
$data_array = array(
                                'name' => 'Naiem',
                                'job' => 'Web Developer',
                                

                              );
   $data = http_build_query($data_array);                           
$ch = curl_init();
	
         curl_setopt($ch, CURLOPT_URL, $url);            
         curl_setopt($ch, CURLOPT_POST, true);         
         curl_setopt($ch, CURLOPT_POSTFIELDS, $data);     
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);         
		 $resp =    curl_exec($ch);
		 if($e = curl_error($ch))
		 {
				echo $e;
		 }
		 else{
				$decode = json_decode($resp);
        print_r($resp );
				foreach( $decode as $key => $val)
        {
          echo $key . ': ' . $val . '<br>';
        }
        
		 }

?>


<body>

<div class="container">
  <h2>Basic test</h2>    


 <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">ID </th>
      <th class="th-sm">User ID </th>
      <th class="th-sm">Title </th>
      <th class="th-sm">Action </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>test</td>
      <td>ads adasdasd asd</td>
      <td>
      <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Details
</button>
</td>
    </tr>
	<!-- wirte your code -->

  </tbody>
   
</table>
   
  
   
	<div class="box pagination"></div>
 
  
</div>

</body>



<div class="modal fade" id="exampleModalCenter" tabindex="-1"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Details of information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body" id="modal_details_data">
        Please wait...
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close </button>
      </div>
    </div>
  </div>
</div>
  <!-- Modal -->



</html>
 
<script>

// write your js code

</script>
