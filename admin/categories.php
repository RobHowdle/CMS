<?php include "includes/admin-header.php";?>

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
                    <div class="col-xs-6">

                    <?php
                        insert_categories();            
                    ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label>Category Title</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" value="Add Category">
                            </div>
                        </form>

                        <?php 
                        // Update and Include Query

                            if(isset($_GET['edit'])) {
                                $cat_id = $_GET['edit'];

                                include "edit_categories.php";
                            }
                        ?>
                    </div>
                    <div class="col-xs-6">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Title</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php findAllCategories();?>

                        <?php deleteCategories();?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include "includes/admin-footer.php";?>