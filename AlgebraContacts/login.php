<?php

require_once 'core/init.php';

Helper::getHeader();


?>

<div class="row m-5"> 
    <div class="card col-lg-6 offset-lg-3">
        <h5 class="card-title pt-3">Log in</h5>
        <div class="card-body">
        
        <form>


            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Choose your password">
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>

            <div class="form-group">
            <button type="submit" class="btn btn-primary" style="float:right">Log in</button>
            <a href="index.php" class="btn btn-info">Home</a>
            </div>
            </form>
        </div>
    </div>
</div>


<?php


Helper::getFooter();


?>
