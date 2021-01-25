<?php include "includes/admin-header.php";?>
<?php
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        $query = "SELECT * FROM users WHERE user_username = '{$username}' ";
        $select_user_profile_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_array($select_user_profile_query)) {

            $user_id = $row['user_id'];
            $user_username = $row['user_username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
        }
    }
?>

<?php
    if(isset($_POST['update_profile'])) {
        $users_firstname = $_POST['user_firstname'];
        $users_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $users_username = $_POST['user_username'];
        $users_email = $_POST['user_email'];
        $users_password = $_POST['user_password'];

        $query = "UPDATE users SET ";
        $query .= "user_firstname = '{$users_firstname}', ";
        $query .= "user_lastname = '{$users_lastname}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "user_username = '{$users_username}', ";
        $query .= "user_email = '{$users_email}', ";
        $query .= "user_password = '{$users_password}' ";
        $query .= "WHERE user_username = '{$username}' ";
        
        $update_profile_query = mysqli_query($connection, $query);
        confirmQuery($update_profile_query);            


}
?>
<div id="wrapper">

<?php include "includes/admin-navigation.php";?>


    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                <h1 class="page-header">
                    Blank Page
                    <small>Subheading</small>
                </h1>
                <?php
                    if(isset($_GET['source'])){
                        $source = $_GET['source'];
                    } else {
                        $source = '';
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

                        <div class="form-group">
                            <label for="user_role">Roles</label>
                            <select class="form-control" name="user_role" id="">
                                <option value="subscriber"><?php echo $user_role; ?></option>
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
                            <input type="password" class="form-control" value="<?php echo $user_password; ?>" name="user_password">
                        </div>

                        <div class="form-group">
                            <input class="btn btn-success" type="submit" name="update_profile" value="Update Profile">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include "includes/admin-footer.php";?>;