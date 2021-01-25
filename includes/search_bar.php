<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="post">
    <div class="input-group">
        <input type="text" name="search" class="form-control">
        <span class="input-group-btn">
            <button name="submit" class="btn btn-default" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form>
    <!-- /.input-group -->

    <h4>Login</h4>
    <form action="includes/login.php" method="post">
    <div class="form-group">
        <input type="text" name="username" class="form-control" placeholder="Enter Username">
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Enter Password">
    </div>
    <div class="form-group">
        <button type= "submit" name="login" class="btn btn-success">Login</button>
    </div>
    </form>
</div>