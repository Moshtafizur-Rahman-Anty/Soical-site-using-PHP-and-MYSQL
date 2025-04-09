<?php 

class User {


    private $user_data;
    private $con;

    public function construct ($con, $username) {

        $this->con = $con;
        $user_data = mysqli_fetch_array(mysqli_query($this->con, "SELECT * FROM users WHERE username = '$username'"));

    }

    public function getUsername() {
        return $this->user_data['username'];
    }

    public function getNumPosts() {
        return $this->user_data['num_posts'];
    }

}





?>