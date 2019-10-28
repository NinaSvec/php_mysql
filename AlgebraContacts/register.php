<?php

require_once 'core/init.php';

Helper::getHeader();

$validation = new Validation();

if (Input::exists()){
   
    $validation->check([
        'name'    => [
            'required' => true,
            'min'  => 2,
            'max'  => 30,

        ],
        'username'  => [
            'required' => true,
            'min'    => 2,
            'max'    => 30,
            'unique' =>'users'
        ],
        'password'    => [
            'required' => true,
            'min'      => 7,
            'pattern'  => true 
        ],
        'password_confirmation' => [
            'required' => true,
            'matches'  => 'password'
        ]
    ]);


if (Input::exists()){
    DB::getInstance()->insert('users',[
        'name'    => Input::get('name'),
        'username'=> Input::get('username'),
        'password'=> Input::get('password'),
        'role_id '=> 3,
        'salt'    => uniqid(32)
    ]);
}
}

?>

<div class="row m-5"> 
    <div class="card col-lg-6 offset-lg-3">
        <h5 class="card-title pt-3">Create an account</h5>
        <div class="card-body">
        
        <form method="POST">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name">
                <?php echo $validation->hasError('name') ? '<p class=text-danger>'. $validation->hasError('name') . '</p>': '' ;?>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
                <?php echo $validation->hasError('username') ? '<p class=text-danger>'. $validation->hasError('username') . '</p>': '' ;?>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Choose your password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmationa" placeholder="Confirm your password">
            </div>

            <div class="form-group">
            <button type="submit" name="create" class="btn btn-primary" style="float:right">Create an Account</button>
            <a href="index.php" class="btn btn-info">Home</a>
            </div>
            </form>
        </div>
    </div>
</div>


<?php


Helper::getFooter();


?>