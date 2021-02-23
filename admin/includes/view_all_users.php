<table class="table">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>User Role</th>
        </tr>
    </thead>
    <tbody>

        <?php 
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['user_id'];
        $user_username = $row['user_username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];


        echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$user_username}</td>";
            echo "<td>{$user_firstname}</td>";        
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";
            // $query = "SELECT * FROM posts WHERE post_id = $user_post_id ";
            // $select_post_id = mysqli_query($connection, $query);
            // while($row = mysqli_fetch_assoc($select_post_id)){
            //     $post_id = $row['post_id'];
            //     $post_title = $row['post_title'];
            //     echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            // }

            echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
            echo "<td><a href='users.php?change_to_subscriber={$user_id}'>Subscriber</a></td>";

            echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
        echo "</tr>";
        }


    ?>

    </tbody>
</table>
<?php

    if(isset($_GET['change_to_admin'])) {
        $the_user_id = $_GET['change_to_admin'];

        $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = {$the_user_id} ";
        $admin_user_query = mysqli_query($connection, $query);
        header("Location: users.php");
    }

    if(isset($_GET['change_to_subscriber'])) {
        $the_user_id = $_GET['change_to_subscriber'];

        $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = {$the_user_id} ";
        $subscriber_user_query = mysqli_query($connection, $query);
        header("Location: users.php");    }

    if(isset($_GET['delete'])) {
        if(isset($_SESSION['user_role'])) {
            if($_SESSION['user_role'] == 'admin') {
                $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);

                $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
                $delete_user_query = mysqli_query($connection, $query);
                header("Location: users.php");

            }
        }
    }

?>