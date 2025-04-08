<?php
class Post
{

    private $con;
    private $user_data;

    public function __construct($con, $user)
    {
        $this->con       = $con;
        $this->user_data = new User($con, $user);
    }

    public function submitPost($body, $user_to)
    {
        $body        = strip_tags($body);
        $body        = mysqli_real_escape_string($this->con, $body);

        if (trim($body) != "") {

            //current data and time
            $data_added = date("Y-m-d H:i:s");

            //get username
            $added_by = $this->user_data->getUsername();

            if ($user_to === $added_by) {
                $user_to = "none";
            }

          //insert post
        $query = 
    

        }

    }
}
