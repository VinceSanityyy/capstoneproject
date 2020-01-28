<?php

header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, Accept, X-Requested-With, x-xsrf-token");
header("Content-Type: application/json; charset=utf-8");

include "library/dbconn.php";

$postjson = json_decode(file_get_contents('php://input'), true);
	


if($postjson["aksi"]=="getChecker"){


$query = mysqli_query($mysqli, "select * from checkers");
    
    if($query){
       
        $numrows = mysqli_num_rows($query);
        if($numrows>0){ 
            while($data = mysqli_fetch_array($query)){
                $datauser[] = array(
                    'id' => $data['id'],
					'schedule_id' => $data['schedule_id'],
					'user_id' => $data['user_id'],
					'remarks_id' => $data['remarks_id'],
					'status' => $data['status'],
					'created_at' => $data['created_at'],
					'updated_at	' => $data['updated_at'],
                );        
            }     
            $result = json_encode(array('success'=>true, 'result'=>$datauser));
        }
       
        }
        echo $result;
	
}
if($postjson["aksi"]=="getRounds"){


$query = mysqli_query($mysqli, "select * from rounds");
    
    if($query){
       
        $numrows = mysqli_num_rows($query);
        if($numrows>0){ 
            while($data = mysqli_fetch_array($query)){
                $datauser[] = array(
                    'id' => $data['id'],
					'checker_id' => $data['checker_id'],
					'round_no' => $data['round_no'],
					'remarks_id' => $data['remarks_id'],
					'status' => $data['status'],
					'time_check' => $data['time_check'],
					'created_at' => $data['created_at'],
					'updated_at	' => $data['updated_at'],
                );        
            }     
            $result = json_encode(array('success'=>true, 'result'=>$datauser));
        }
       
        }
        echo $result;
	
}if($postjson["aksi"]=="getCheckerDetails"){


$query = mysqli_query($mysqli, "select * from checker_details");
    
    if($query){
       
        $numrows = mysqli_num_rows($query);
        if($numrows>0){ 
            while($data = mysqli_fetch_array($query)){
                $datauser[] = array(
                    'id' => $data['id'],
					'round_id' => $data['round_id'],
					'violation_id' => $data['violation_id'],
					'created_at' => $data['created_at'],
					'updated_at	' => $data['updated_at'],
                );        
            }     
            $result = json_encode(array('success'=>true, 'result'=>$datauser));
        }
       
        }
        echo $result;
	
}


if($postjson["aksi"]=="teachers"){


$query = mysqli_query($mysqli, "select * from teachers");
    
    if($query){
       
        $numrows = mysqli_num_rows($query);
        if($numrows>0){ 
            while($data = mysqli_fetch_array($query)){
                $datauser[] = array(
                    'id' => $data['id'],
					'fullname' => $data['fullname'],
					'contact' => $data['contact'],
					'image' => $data['image'],
					'course' => $data['course'],
					'created_at' => $data['created_at'],
					'updated_at' => $data['updated_at'],
					'deleted_at' => $data['deleted_at']
                );        
            }     
            $result = json_encode(array('success'=>true, 'result'=>$datauser));
        }
       
        }
        echo $result;
	
}


if($postjson["aksi"]=="students"){


$query = mysqli_query($mysqli, "select * from users where id <> 0");
    
    if($query){
       
        $numrows = mysqli_num_rows($query);
        if($numrows>0){ 
            while($data = mysqli_fetch_array($query)){
                $datauser[] = array(
                    'id' => $data['id'],
					'name' => $data['name'],
					'id_number' => $data['id_number'],
					'password' => $data['password'],
					'created_at' => $data['created_at'],
					'updated_at' => $data['updated_at'],
					'deleted_at' => $data['deleted_at']
                );        
            }     
            $result = json_encode(array('success'=>true, 'result'=>$datauser));
        }
       
        }
        echo $result;
	
}if($postjson["aksi"]=="rooms"){


$query = mysqli_query($mysqli, "select * from rooms");
    
    if($query){
       
        $numrows = mysqli_num_rows($query);
        if($numrows>0){ 
            while($data = mysqli_fetch_array($query)){
                $datauser[] = array(
                    'id' => $data['id'],
					'room_desc' => $data['room_desc'],
					'bldg' => $data['bldg'],
					'created_at' => $data['created_at'],
					'updated_at' => $data['updated_at'],
					'deleted_at' => $data['deleted_at']
                );        
            }     
            $result = json_encode(array('success'=>true, 'result'=>$datauser));
        }
       
        }
        echo $result;
	
}if($postjson["aksi"]=="subjects"){


$query = mysqli_query($mysqli, "select * from subject_codes");
    
    if($query){
       
        $numrows = mysqli_num_rows($query);
        if($numrows>0){ 
            while($data = mysqli_fetch_array($query)){
                $datauser[] = array(
                    'id' => $data['id'],
					'subject_code' => $data['subject_code'],
					'subject_description' => $data['subject_description'],
					'created_at' => $data['created_at'],
					'updated_at' => $data['updated_at'],
					'deleted_at' => $data['deleted_at']
                );        
            }     
            $result = json_encode(array('success'=>true, 'result'=>$datauser));
        }
       
        }
        echo $result;
	
}if($postjson["aksi"]=="schedules"){


$query = mysqli_query($mysqli, "select * from schedules");

    if($query){
       
        $numrows = mysqli_num_rows($query);
        if($numrows>0){ 
            while($data = mysqli_fetch_array($query)){
                $datauser[] = array(
                    'id' => $data['id'],
					'subject_code_id' => $data['subject_code_id'],
					'teacher_id' => $data['teacher_id'],
					'room_id' => $data['room_id'],
					'start_time' => $data['start_time'],
					'end_time' => $data['end_time'],
					'school_year' => $data['school_year'],
					'semester' => $data['semester'],
					'term' => $data['term'],
					'day' => $data['day'],
					'created_at' => $data['created_at'],
					'updated_at' => $data['updated_at'],
					'deleted_at' => $data['deleted_at']
                );        
            }     
            $result = json_encode(array('success'=>true, 'result'=>$datauser));
        }
       
        }
        echo $result;
	
}if($postjson["aksi"]=="forwardChecker"){
	
	
//$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';

$check = $postjson["check"];


foreach($check as $k){
$sched_id =  $k["sched_id"];
$id =  $k["id"];
$user_id =  $k["user_id"];
$remarks_id =  $k["remarks_id"];
$status =  $k["status"];
$created_at =  $k["created_at"];


$updated_at =  '';

		$query0 = mysqli_query($mysqli, "Truncate table checkers");
		
		//echo  "INSERT  INTO checkers VALUES($id,$sched_id,$user_id,$remarks_id,strval($status),strval($created_at),'','')";
	 $query = mysqli_query($mysqli, "INSERT  INTO checkers VALUES($id,$sched_id,$user_id,$remarks_id,'$status','$created_at','','')");
        
        if($query){
            $result = json_encode(array('success'=>true,'msg'=>'Registered Successfully !'));
        }
		
        else{
            $result = json_encode(array('success'=>false,'msg'=>'Something went Wrong !'));
        }  
   echo $result;
}






	
}if($postjson["aksi"]=="forwardRound"){
	
	
//$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';

$round = $postjson["rounds"];


foreach($round as $k){

   $id =  $k["id"];
   $checker_id =  $k["checker_id"];
   $round_no =  $k["round_no"];
   $remarks_id =  $k["remarks_id"];
   $status =  $k["status"];
   $time_check =  $k["time_check"];
   $created_at =  $k["created_at"];
    $updated_at =  $k["updated_at"];
	
		$query0 = mysqli_query($mysqli, "Truncate table rounds");
		
		echo  "INSERT  INTO rounds VALUES($id,$checker_id,$round_no,$remarks_id,'$status','$time_check','$created_at','','')";
	 $query = mysqli_query($mysqli, "INSERT  INTO rounds VALUES($id,$checker_id,$round_no,$remarks_id,'$status','$time_check','$created_at','','')");
        
        if($query){
            $result = json_encode(array('success'=>true,'msg'=>'Registered Successfully !'));
        }
		
        else{
            $result = json_encode(array('success'=>false,'msg'=>'Something went Wrong !'));
        }  
   echo $result;
}
}
if($postjson["aksi"]=="forwardCD"){
	
	
//$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';

$cd = $postjson["cd"];


foreach($cd as $k){

   $id =  $k["id"];
   $round_id =  $k["round_id"];
   $others_id =  $k["others_id"];
   $created_at =  $k["created_at"];
    $updated_at =  $k["updated_at"];
	
		$query0 = mysqli_query($mysqli, "Truncate table checker_details");
		
		echo  "INSERT  INTO checker_details VALUES($id,$round_id,$others_id,'$created_at','','')";
	 $query = mysqli_query($mysqli, "INSERT  INTO checker_details VALUES($id,$round_id,$others_id,'$created_at','','')");
        
        if($query){
            $result = json_encode(array('success'=>true,'msg'=>'Registered Successfully !'));
        }
		
        else{
            $result = json_encode(array('success'=>false,'msg'=>'Something went Wrong !'));
        }  
   echo $result;
}






	
}
	
?>