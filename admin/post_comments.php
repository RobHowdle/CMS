<?php include "includes/admin-header.php";?>


<div id="wrapper">
    <?php include "includes/admin-navigation.php";?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to Comments
                    <small>Author</small>
                </h1>

<?php
    if(isset($_POST['checkBoxArray'])) {
        foreach($_POST['checkBoxArray'] as $postValueId ){

            $bulk_options = $_POST['bulk_options'];
            switch($bulk_options) {

                case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                $update_to_publish = mysqli_query($connection, $query);
                confirmQuery($update_to_publish);
                break;

                case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                $update_to_draft = mysqli_query($connection, $query);
                confirmQuery($update_to_draft);
                break;

                case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
                $update_to_delete = mysqli_query($connection, $query);
                confirmQuery($update_to_delete);
                break;

                case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = {$postValueId} ";
                $select_post_query = mysqli_query($connection, $query);
                

                while($row = mysqli_fetch_assoc($select_post_query)) {
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_date = $row['post_date'];
                    $post_author = $row['post_author'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                }

                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
                $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";

                $copy_query = mysqli_query($connection, $query);
                if(!$copy_query) {
                    die("Query Failed " . mysqli_error($connection));
                }
                break;
            }
        };
    }
?>

<form action="" method="post">
<table class="table">
<div class="col-md-4">

    <div id="bulkOptionsContainer">
        <select class="form-control" name="bulk_options" id="">
            <option value="">Select Option</option>
            <option value="draft">Draft</option>
            <option value="published">Publish</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
        </select>
    </div>
</div>
<div class="col-md-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a class="btn btn-primary" href="posts.php?source=add_post">Add New Post</a>
</div>

    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

    <?php 

$query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($connection,$_GET['id']). " ";
$select_comments = mysqli_query($connection,$query);  

while($row = mysqli_fetch_assoc($select_comments)) {
    $comment_id         = $row['comment_id'];
    $comment_post_id    = $row['comment_post_id'];
    $comment_author     = $row['comment_author'];
    $comment_content    = $row['comment_content'];
    $comment_email      = $row['comment_email'];
    $comment_status     = $row['comment_status'];
    $comment_date       = $row['comment_date'];


        echo "<tr>";?>
            <td><input value='<?php echo $post_id; ?>' name='checkBoxArray[]' class="form-check-input checkBoxes" type='checkbox'></td>
            <?php 
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";        
            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_status}</td>";
            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
            $select_post_id_query = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($select_post_id_query)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
                
                echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            }

            echo "<td>{$comment_date}</td>";
            echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
            echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";    
            echo "<td><a href='post_comments.php?delete=$comment_id&id=" . $_GET['id'] ."'>Delete</a></td>";

        echo "</tr>";
        }

        if(isset($_GET['delete'])) {
            $the_post_id = $_GET['delete'];
            $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
            $delete_query = mysqli_query($connection, $query);
            header("Location: post_comments.php?id=". $_GET['id'] ."");
        }
    ?>

    </tbody>
</table>
</form>
</div>
</div>
</div>
</div>
<?php include "includes/admin-footer.php";?>