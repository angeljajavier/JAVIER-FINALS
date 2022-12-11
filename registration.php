<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>

<div>

    <?php
    if(isset($_POST['create'])){
    }
    ?>

</div>

<div>
    <form action="registration.php" method="post"></form>
        <div class = "container">
            <h1>Registration</h1>
            <p>Please fill up this form</p>
            <label for="firstname">First Name</b></label>
            <input type="text" name="firstname" required>

            <label for="lastname">Last Name</b></label>
            <input type="text" name="lastname" required>
            
            <label for="email">Email Address</b></label>
            <input type="email" name="email" required>

            <label for="phonenumber">Phone Number</b></label>
            <input type="text" name="phonenumber" required>

            <label for="password">Password</b></label>
            <input type="password" name="password" required>

            <input type="submit" name="create" value="Sign Up"><br>
            <a href="index.php" class="btn btn-danger btn-lg"><i class="fa fa-arrow-left"></i> Cancel / Go Back</a>


        </div>
</div>



    
</body>
</html>