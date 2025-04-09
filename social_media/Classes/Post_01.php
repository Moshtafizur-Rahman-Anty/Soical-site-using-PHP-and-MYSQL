<?php 

class Post {


    private $con;
    private $user_obj;

    public function construct($con, $username) {
        $this->con = $con;
        $this->user_obj = new User($con, $username);
    }

    public function submitPost ($body, $user_to) {
        $body = strip_tags($body);
        $body = mysqli_real_escape_string($this->con, $body);

        if(trim($body) != "") {

            //date
            $date_added = date("Y-m-d H:i:s");

           //username
           $username = $this->user_obj->getUsername();

           if($user_to == $username) {
                $user_to = "none";
           }

           $query = mysqli_query($this->con, "INSERT INTO posts VALUES('', '$body', '$username', '$date_added', 'no', 'no', '0' )");

           //update the post column of the user in the users table

           $total_posts= $this->user_obj->getNumPosts();
           $total_posts++;
           
           $update_query = mysqli_query($this->con, "UPDATE users SET num_posts='$total_posts' WHERE username='$username'");


        }
    }


}



?>