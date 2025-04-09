<?php include "includes/header.php"; ?>

<?php include 'Classes/User.php'?>

<?php include 'Classes/Post.php'; ?>


<?php 

if(isset($_POST['post_button'])) {


    $post = new Post($con, $userLoggedIn);
    $post->submitPost($_POST['post_text'], 'none');

   header('Location: index.php');



} else {


    echo "didn't clicked";
}

?>


<div class="left_sidebar">
    <div class="user_details column">
        <a href="<?php echo $userLoggedIn ?>"><img src="<?php echo $user['profile_pic'] ?>" alt=""></a>

        <div class="user_details_right">
            <a href="<?php echo $userLoggedIn ?>" class="profile_name"><?php echo $user['username']; ?></a> <!-- Username to the right of the image -->

            <p class="user_stats">
                <?php
                    echo "Post: " . $user['num_posts'] . "<br>";
                    echo "Likes: " . $user['num_likes'];
                ?>
            </p>
        </div>
    </div>
</div>



<div class="main_feed column">


<form action="index.php" class="post_form" method="POST">


<textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>

<input type="submit" name="post_button" value="POST">

<hr>

</form>


<?php 

$user = new User($con, $userLoggedIn);

echo $user->getUsername();

?>


</div>
</div>

<script src="assets/js/header.js"></script>

</body>

</html>