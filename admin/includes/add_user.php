<?php
    if(isset($_POST['create_user'])) {
            $users_firstname = $_POST['user_firstname'];
            $users_lastname = $_POST['user_lastname'];
            $user_role = $_POST['user_role'];
            $users_username = $_POST['user_username'];
            $users_email = $_POST['user_email'];
            $users_password = $_POST['user_password'];
            $password = password_hash($users_password, PASSWORD_BCRYPT, array('cost' => 12));

            

            $query = "INSERT INTO users (user_firstname, user_lastname, user_role,
            user_username, user_email, user_password) ";
                        
            $query .= "VALUES('{$users_firstname}', '{$users_lastname}', '{$user_role}' ,
                   '{$users_username}', '{$users_email}', '{$password}') ";
                     
            $create_user_query = mysqli_query($connection, $query);
            
            confirmQuery($create_user_query);

            echo "User Created: " . " " . "<a href='users.php'></a> ";

    }
?>

<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
        <label for="post_author">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="user_role">Roles</label>
        <select class="form-control" name="user_role" id="">
            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" class="form-control" name="user_username">
    </div>

    <div class="form-group">
        <label for="post_content">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-success" type="submit" name="create_user" value="Add User">
    </div>
</form>