<?php
    session_start();
     include_once "config.php";
     $fname = mysqli_real_escape_string($conn, $_POST['fname']);
     $lname = mysqli_real_escape_string($conn, $_POST['lname']);
     $email = mysqli_real_escape_string($conn, $_POST['email']);
     $password = mysqli_real_escape_string($conn, $_POST['password']);

     if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
            //checking if email is valid or not
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){ //if email is valid
                //..Then checks if email is already in the database
                $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
                if(mysqli_num_rows($sql) >0){ //If the email truelly exixts...
                echo "$email - This email already exists!";
            }else{//If email does not exist.. go to the next statement...
                //Checking whether user aploaded a file or not.
                if(isset($_FILES['image'])){//If file is uploaded
                            $img_name = $_FILES['image']['name'];//getting user upload image name
                            $img_type = $_FILES['image']['type'];//this temporary name is used to save/move file in our folder
                            $tmp_name = $_FILES['image']['tmp_name'];
                        
                            //let's explode image and get the last extension like jpg png
                            $image_explode=explode('.', $img_name);
                            $img_ext = end($image_explode);//Gets extension of users uploadeed image file

                            $extensions=['png', 'jpeg', 'jpg'];//valid image extensions stored inside an array
                            if(in_array($img_ext, $extensions) === true){//if image uploaded matches already listed image extensions
                                $types = ["image/jpeg", "image/jpg", "image/png"];
                                if(in_array($img_type, $types) === true){
                                $time = time(); //will return current time
                                                //we need this so as to rename user's uploaded image with the current time
                                                //so all image files will have a unique name
                                //let's move the user uploaded file to our particular folder.
                                $new_img_name= $time.$img_name;//adds current time before name of uploaded file.

                            if( move_uploaded_file($tmp_name, "images/".$new_img_name)){//if user uploads img move to our folder successfully
                                        $ran_id = rand(time(), 10000000); //creating random id for user
                                        $status="Active now"; //Once user is signed up, his status will be active now
                                        //inserting all user data into a table
                                        
                                        $encrypt_pass = md5($password);
                                $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                VALUES ({$ran_id}, '{$fname}','{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')");
                                if($insert_query){
                                    $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                    if(mysqli_num_rows($select_sql2) > 0){
                                        $result = mysqli_fetch_assoc($select_sql2);
                                        $_SESSION['unique_id'] = $result['unique_id'];
                                        echo "success";                                   
                                                }else{
                                                    echo "This email address does not Exist!";
                                                }
                                    }else{
                                        echo "Something went wrong. Please try again!";
                                            }
                                        }
                                    }else{
                                        echo "Please upload an image file - jpeg, png, jpg";
                                    }
                                }else{
                                    echo "Please upload an image file - jpeg, png, jpg";
                                    }
                                }
                            }
                        }else{
                             echo"$email - OOPs! This is not a valid email!"; 
                    }
    }else{
            echo "All input fields are required!";
     }
?>