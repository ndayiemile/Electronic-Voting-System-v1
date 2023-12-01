<?php
session_start();
$errors=array();
$org_comm_name="";
$email="";
$db=mysqli_connect('localhost','root','','evs');
if(mysqli_connect_error()){
    echo "there was an error on connecting to the database";
    echo "please try ahain later";
}

if(isset($_POST['sinup_admin'])){  
$org_comm_name=$_POST['org_comm_name'];
$email=$_POST['email'];
$password_1=$_POST['password_1'];
$password_2=$_POST['password_2'];
$n_voters=$_POST['n_voters'];
//form validation for errors
if(empty($org_comm_name)){array_push($errors,"*organisation/community name is missing.");}
if(empty($email)){array_push($errors,"*email is missing.");}
if(empty($n_voters)){array_push($errors,"*number of voters to not exceed is needed.");}
if(empty($password_1)){array_push($errors,"*password is required.");}
if($password_1!=$password_2){array_push($errors,"*the passwords are not matching.");}
if($n_voters<=1){array_push($errors,"*voters should be more than one.");}
  //check in the database
  $org_check_query = "SELECT * FROM admins WHERE org_comm_name='$org_comm_name' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $org_check_query);
  $org = mysqli_fetch_assoc($result);
  
  if ($org) { // if user exists
    if ($org['org_comm_name'] === $org_comm_name) {
      array_push($errors, "organisation/community name already exists");
    }

    if ($org['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }
  if(count($errors)==0){ 
    //CREATE THE TABLE IN DATABASE
    $n=md5($email);
    // sql to create table
    $sql = "CREATE TABLE $n (
    id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
     cd_name VARCHAR(100) NOT NULL,
     cd_age INT(2) NOT NULL,
     cd_position VARCHAR(100) NOT NULL,
     cd_id VARCHAR(100) NOT NULL,
     cd_gender VARCHAR(100) NOT NULL,
     cd_email VARCHAR(100) NOT NULL,
     cd_comment VARCHAR(1000) NOT NULL,
     n_candidates INT(3) NOT NULL,
     votes INT(100) NOT NULL,
     voters_id VARCHAR(100) NOT NULL,
     n_voters INT(10) NOT NULL,
     session_state VARCHAR(10) NOT NULL,
     vote_checker VARCHAR(10) NOT NULL
     )";

    mysqli_query($db,$sql);
   //register the community if no error found
    $admin_password_1=md5($password_1);//password encryption
    $admin_password=md5($admin_password_1);
    $query="INSERT INTO admins(org_comm_name,email,admin_password) VALUES ('$org_comm_name','$email','$admin_password')";
    mysqli_query($db,$query);
    $_SESSION['n_voters']=$n_voters;
    $_SESSION['email']=md5($email);
    header("location:register_election.php");
    }
    }

//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''//
//login  the admin
if(isset($_POST['login_admin'])){  
    $email=$_POST['email'];
    $password=$_POST['password'];
    //form validation for errors
    if(empty($email)){array_push($errors,"*email is missing.");}
    if(empty($password)){array_push($errors,"*password is missing.");}
    //login the user if no error found
    if (count($errors) == 0) {
        $password_a =md5($password);
        $password=md5($password_a);
        $query = "SELECT * FROM admins WHERE email='$email' AND admin_password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['email']=md5($email);
          header('location:admins_dash.php');
        }else {
          array_push($errors, "Wrong email/password combination");
        }
      }
    }

?>