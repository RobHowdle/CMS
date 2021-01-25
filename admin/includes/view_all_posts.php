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
            <th>Post ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Dates</th>
            <th>View</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

    <?php 
        $query = "SELECT * FROM posts ORDER BY post_date DESC";
        $select_posts = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_posts)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];

        echo "<tr>";?>
            <td><input value='<?php echo $post_id; ?>' name='checkBoxArray[]' class="form-check-input checkBoxes" type='checkbox'></td>
            <?php 
            echo "<td>{$post_id}</td>";
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_title}</td>";

            $query = "SELECT * FROM categories WHERE id = {$post_category_id} ";
            $select_categories_id = mysqli_query($connection, $query);
    
            while($row = mysqli_fetch_assoc($select_categories_id)) {
                $cat_id = $row['id'];
                $cat_title = $row['cat_title'];
            
            echo "<td>{$cat_title}</td>";
        }
        
            echo "<td>{$post_status}</td>";
            echo "<td><img src='../images/{$post_image}' width='200'></td>";
            echo "<td>{$post_tags}</td>";
            echo "<td>{$post_comment_count}</td>";
            echo "<td>{$post_date}</td>";
            echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo "</tr>";
        }

        if(isset($_GET['delete'])) {
            $the_post_id = $_GET['delete'];
            $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
            $delete_query = mysqli_query($connection, $query);
        }
    ?>

    </tbody>
</table>
</form>