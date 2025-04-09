<?php

class User
{

    private $con;
    private $user_data;

    public function __construct($con, $user_name)
    {
        $this->con         = $con;
        $mysqli_query_info = mysqli_query($con, "SELECT * FROM users WHERE username='$user_name'");
        $this->user_data   = mysqli_fetch_array($mysqli_query_info);
    }

    public function getUsername() {

        return ($this->user_data['username']);
    }

    
    public function getNumPosts() {

        return ($this->user_data['num_posts']);
    }

    public function getFirstAndLastName()
    {
        return ($this->user_data['first_name'] . " " . $this->user_data['last_name']);
    }

}
