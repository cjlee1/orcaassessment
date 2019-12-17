<?php
 
$msg = '';
$result = false;
 
if(isset($_POST['submit'])){
 
 require_once 'dbconfig.php';
 
 $dsn = "mysql:host=$host;dbname=$db";
 try {
 // create database connection
 $dbh = new PDO($dsn, $username, $password);
 
 // add horse
 $result = addHorseToDatabase($vars);
 
 } catch (PDOException $e) {
 echo $e->getMessage();
 }
}

/**
 * validate horse
 * @return horse data on success or false on failure
 */
function validate_horse(){
    global $msg;
    $filter_options = array( 
    'options' => array( 'min_range' => 0) 
);
    
    $horse_name = $_POST['name'];
    $horse_breed = $_POST['breed'];
    $horse_height = $_POST['height'];
    $horse_weight = $_POST['weight'];
    $horse_age = $_POST['age'];


    if($horse_name != '' or $horse_breed != ''){
    $horse_name = filter_var($horse_name,FILTER_SANITIZE_STRING);
    $horse_breed = filter_var($horse_breed,FILTER_SANITIZE_STRING);
  
    }else{
    $msg =  'Please enter the proper data';
    $horse_name= false;
    }
    if (is_numeric($horse_height)  && $horse_height > 1){
        $horse_height = filter_var($horse_height,FILTER_SANITIZE_INT,);
    }
    if (is_numeric($horse_weight) && $horse_weight > 1){
        $horse_weight = filter_var($horse_weight,FILTER_SANITIZE_INT);
    }
    if (is_numeric($horse_age) && $horse_age > 1){
        $horse_age = filter_var($horse_age,FILTER_SANITIZE_INT);
    }
    return array($horse_name,$horse_breed, $horse_height, $horse_weight, $horse_age)
   }
 

	
/**
 * insert a new horse table
 * @param string $horse_name horse name
 * @return boolean return true on success or false on failure
 */
function insert_dept($horse_name,$horse_breed, $horse_height, $horse_weight, $horse_age){
 global $dbh, $msg;
 // construct SQL insert statement
 $sql_insert = "INSERT INTO HORSE(Name,Breed,Height,Weight,Age)
    VALUES('$horse_name','$horse_breed', $horse_height, $horse_weight, $horse_age)";
 
 if($dbh->exec($sql_insert) === false){
 $msg = 'Error inserting the horse info.';
 return false;
 }else{
 $msg = "The new horse $horse_name is created";
 return true;
 }
}
/**
 * insert new horse
 * @param string $msg message 
 * @return boolean return true on success, false on failure
 */
function addHorseToDatabase($vars){
    // validate department
    $horse_info = validate_horse();
    
    $horse_name = $horse_info[0];
    $horse_breed = $horse_info[1];
    $horse_height = $horse_info[2];
    $horse_weight = $horse_info[3];
    $horse_age = $horse_info[4];

    if($horse_name){
    insert_dept($horse_name,$horse_breed, $horse_height, $horse_weight, $horse_age);
    }
    return false;
   }

   ?> 