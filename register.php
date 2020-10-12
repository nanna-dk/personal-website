<?php

    include realpath(__DIR__.'/includes/db.php');
    // if (isset($_POST['register'])) {
    $user_name = '';
    $password = '';
    $email = 'nanna@e-nanna.dk';

        $sql = 'INSERT INTO users (username, password, email) VALUES (:user_name, :password, :email)';

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(':user_name', $param_user_name, PDO::PARAM_STR);
            $stmt->bindParam(':password', $param_password, PDO::PARAM_STR);
            $stmt->bindParam(':email', $param_email, PDO::PARAM_STR);

            $param_user_name = $user_name;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_email = $email;

            if ($stmt->execute()) {
                $alert = 'Your account has been created.';
                echo "<script type='text/javascript'>alert('$alert');</script>";
            } else {
                $alert = 'I am sorry! There was some error. Try again please.';
                echo "<script type='text/javascript'>alert('$alert');</script>";
            }
        }

// }

?>


<!DOCTYPE html>
<html>
<head>
    <title>Simple PDO Registration</title>
</head>
<body>


<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">


    <p><input type="text" name="username" placeholder="Enter your username"></p>
    <p><input type="email" name="email" placeholder="Enter email"></p>
    <p><input type="password" name="password" placeholder="Enter password"></p>

    <button type="submit" name="register">Register</button>



</form>
</body>
</html>
