<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Edit Category</label>

    <?php
    if(isset($_GET['edit'])) {
        $cat_id = $_GET['edit'];

        $query = "SELECT * FROM categories WHERE id = $cat_id ";
        $select_categories_id = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_categories_id)) {
            $cat_id = $row['id']; 
            $cat_title = $row['cat_title'];
        ?>
        <input value="<?php if(isset($cat_title)){ echo $cat_title;} ?>" type="text" class="form-control" name="cat_title">
    <?php }} ?>

    <?php 
    // Update Query
    if(isset($_POST['update_category'])) {
        $category_title = $_POST['cat_title'];
        $query = "UPDATE categories SET cat_title = '{$category_title}' WHERE id = {$cat_id} ";
        $update_category_query = mysqli_query($connection, $query);

        if(!$update_category_query){
            die("There was an error updating this category" . mysqli_error($connection));
        }
        header("Location:categories.php");
    }
    ?>
    
    </div>
    <div class="form-group">
        <input type="submit" name="update_category" value="Update Category">
    </div>
</form>