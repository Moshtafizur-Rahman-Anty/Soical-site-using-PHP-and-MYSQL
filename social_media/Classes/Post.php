<?php

class Post
{

    private $user_obj;
    private $con;

    public function __construct($con, $user_name)
    {

        $this->con      = $con;
        $this->user_obj = new User($con, $user_name);

    }

    public function submitPost($body, $user_to)
    {

        $body = strip_tags($body);
        $body = mysqli_real_escape_string($this->con, $body);
        $body = str_replace('\r\n', '\n', $body);
        $body = nl2br($body);

        if (trim($body != "")) {

            //current date and time
            $date_added = date("Y-m-d H:i:s");

            //get username
            $added_by = $this->user_obj->getUsername();

            //if user is in his own profile, user_to is none

            if ($user_to === $added_by) {
                $user_to = "none";
            }

            //insert post

            $query = mysqli_query($this->con,
                "INSERT INTO posts (body, added_by, user_to, date_added, user_closed, deleted, likes)
         VALUES ('$body', '$added_by', '$user_to', '$date_added', 'no', 'no', '0')");

            //update post count for user

            $num_posts = $this->user_obj->getNumPosts();

            $num_posts++;

            $update_query = mysqli_query($this->con, "UPDATE users SET num_posts='$num_posts' WHERE username='$added_by'");

        }

    }


    

}
