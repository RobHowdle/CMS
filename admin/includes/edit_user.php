<?php
if(isset($_GET['edit_user'])){
    $the_user_id = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
    $select_users_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_users_query)) {
        $user_id = $row['user_id'];
        $user_username = $row['user_username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];
    }
    
}

    if(isset($_POST['edit_user'])) {
            $users_firstname = $_POST['user_firstname'];
            $users_lastname = $_POST['user_lastname'];
            $user_role = $_POST['user_role'];
            $users_username = $_POST['user_username'];
            $users_email = $_POST['user_email'];
            $users_password = $_POST['user_password'];

            $query = "SELECT randSalt FROM users";
            $select_randsalt_query = mysqli_query($connection, $query);
            if(!$select_randsalt_query) {
                die("Query Failed" . mysqli_error($connection));
            }
            $row = mysqli_fetch_assoc($select_randsalt_query);
            $salt = $row['randSalt'];
            $hashed_password = crypt($users_password, $salt);

            $query = "UPDATE users SET ";
            $query .= "user_firstname = '{$users_firstname}', ";
            $query .= "user_lastname = '{$users_lastname}', ";
            $query .= "user_role = '{$user_role}', ";
            $query .= "user_username = '{$users_username}', ";
            $query .= "user_email = '{$users_email}', ";
            $query .= "user_password = '{$hashed_password}' ";
            $query .= "WHERE user_id = {$the_user_id} ";

            
            $edit_user_query = mysqli_query($connection, $query);
   
            confirmQuery($edit_user_query);            


    }
?>

<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
        <label for="post_author">Firstname</label>
        <input type="text" class="form-control" value="<?php echo $user_firstname; ?>" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" class="form-control" value="<?php echo $user_lastname; ?>" name="user_lastname">
    </div>

    <!-- <div class="form-group">
        <label for="post_image">User Image</label>
        <input type="file" name="user_image">
    </div> -->

    <div class="form-group">
        <label for="user_role">Roles</label>
        <select class="form-control" name="user_role" id="">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
            <?php 

            if($user_role == 'admin'){
                echo "<option value='subscriber'>Subscriber</option>";
            } else {
                echo "<option value='admin'>Admin</option>";
            }
        
            ?>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" class="form-control" value="<?php echo $user_username; ?>" name="user_username">
    </div>

    <div class="form-group">
        <label for="post_content">Email</label>
        <input type="email" class="form-control" value="<?php echo $user_email; ?>" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-success" type="submit" name="edit_user" value="Edit User">
    </div>
</form>