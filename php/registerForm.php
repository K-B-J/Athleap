<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athleap: Register</title>
    <link rel="icon" type="image/png" href="../assets/icons/favicon-32x32.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <link href="../bootstrap-5.1.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/registerForm.css" rel="stylesheet">
    <link rel="preload" as="image" href="../assets/icons/Home.svg">
    <link rel="preload" as="image" href="../assets/icons/Home selected.svg">
    <link rel="preload" as="image" href="../assets/icons/Yoga.svg">
    <link rel="preload" as="image" href="../assets/icons/Yoga selected.svg">
    <link rel="preload" as="image" href="../assets/icons/Running.svg">
    <link rel="preload" as="image" href="../assets/icons/Running selected.svg">
    <link rel="preload" as="image" href="../assets/icons/Workout.svg">
    <link rel="preload" as="image" href="../assets/icons/Workout selected.svg">
</head>

<body>
    <?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    session_start();
    if (isset($_SESSION["email"])) {
        header("Location: index.php");
    }
    $error_name = "";
    $error_email = "";
    $error_phone = "";
    $error_password = "";
    $error_height = "";
    $error_weight = "";
    $error_gender = "";
    $error_dob = "";

    if (isset($_POST["save"])) {
        function is_adult($dob)
        {
            date_default_timezone_set("Indian/Mahe");
            $today = date("d/m/Y");
            $today_day = (int)substr($today, 0, 2);
            $today_month = (int)substr($today, 3, 2);
            $today_year = (int)substr($today, 6, 4);
            $year = (int)substr($dob, 0, 4);
            $month = (int)substr($dob, 5, 2);
            $day = (int)substr($dob, 8, 2);
            if (($today_year - 18 > $year) || (($today_year - 18 == $year) && (($today_month > $month) || (($today_month == $month) && ($today_day >= $day))))) {
                return true;
            } else {
                return false;
            }
        }
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirm-password"];
        $height = $_POST["height"];
        $weight = $_POST["weight"];
        $gender = $_POST["gender"];
        $dob = $_POST["dob"];
        $error = false;
        if ($name == "") {
            $error_name = "Invalid input!";
            $error = true;
        }
        if (preg_match("{[a-zA-Z0-9_\.\+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-\.]}", $email) == 0) {
            $error_email = "Invalid input!";
            $error = true;
        }
        if (preg_match("{\d{10}}", $phone) == 0) {
            $error_phone = "Invalid input! (Enter 10 digit phone number)";
            $error = true;
        }
        if ($password != $confirmPassword) {
            $error_password = "Passwords don't match!";
            $error = true;
        }
        if ($height <= 0) {
            $error_height = "That can't be your height! :O";
            $error = true;
        }
        if ($weight <= 0) {
            $error_weight = "That can't be your weight! :O";
            $error = true;
        }
        if ($gender == "") {
            $error_gender = "Select an input!";
            $error = true;
        }
        if ($dob == "" || preg_match("{[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])}", $dob) == 0) {
            $error_dob = "Invalid input!";
            $error = true;
        }
        if ($error_dob == "" && !is_adult($dob)) {
            $error_dob = "Sorry, only adults can register!";
            $error = true;
        }
        if (!$error) {
            require '../vendor/autoload.php';
            $ATLAS_CREDENTIALS = getenv("ATLAS_CREDENTIALS");
            $connection = new MongoDB\Client($ATLAS_CREDENTIALS);
            $db = $connection->Athleap;
            $collection = $db->Users;
            $result = $collection->find(["email" => $email])->toArray();
            if (empty($result)) {
                $dob = substr($dob, 8, 2) . "/" . substr($dob, 5, 2) . "/" . substr($dob, 0, 4);
                $collection->insertOne(["email" => $email, "password" => $password, "name" => $name, "phone" => $phone, "dob" => $dob, "height" => $height, "weight" => $weight, "gender" => $gender, "fcoins" => 0]);
                $_SESSION["registered"] = true;
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAutoTLS = false;
                $mail->Host = 'smtp.gmail.com';
                $mail->Username = getenv("EMAIL_USERNAME");
                $mail->Password = getenv("EMAIL_PASSWORD");
                $mail->Port = 587;
                $mail->setFrom('athleapfitness@gmail.com', 'Athleap No Reply');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Athleap: Registered successfully!';
                $mail->Body = file_get_contents("../html/registeredEmail.html");
                $mail->send();
                header("Location: index.php");
            } else {
                $error_email = "The following email is already registered!";
            }
        }
    }
    ?>

    <nav class="navbar my-navbar">
        <div class="container-fluid" style="justify-content: space-around;">
            <a class="my-brand navbar-brand" href="">REGISTER</a>
        </div>
    </nav>

    <div class="form-container my-5">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : ""; ?>" required>
            </div>
            <?php
            if ($error_email != "") {
                echo "<p class='small invalid-input'>" . $error_email . "</p>";
            }
            ?>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="confirm-password" class="form-label">Confirm Password:</label>
                <input type="password" name="confirm-password" id="confirm-password" class="form-control" required>
            </div>
            <?php
            if ($error_password != "") {
                echo "<p class='small invalid-input'>" . $error_password . "</p>";
            }
            ?>
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo (isset($_POST['name'])) ? $_POST['name'] : ""; ?>" required>
            </div>
            <?php
            if ($error_name != "") {
                echo "<p class='small invalid-input'>" . $error_name . "</p>";
            }
            ?>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone number:</label>
                <input type="number" name="phone" id="phone" class="form-control" value="<?php echo (isset($_POST['phone'])) ? $_POST['phone'] : ""; ?>" required>
            </div>
            <?php
            if ($error_phone != "") {
                echo "<p class='small invalid-input'>" . $error_phone . "</p>";
            }
            ?>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth:</label>
                <input type="date" name="dob" id="dob" class="form-control" value="<?php echo (isset($_POST['dob'])) ? $_POST['dob'] : ""; ?>" required>
            </div>
            <?php
            if ($error_dob != "") {
                echo "<p class='small invalid-input'>" . $error_dob . "</p>";
            }
            ?>
            <div class="mb-3">
                <label for="height" class="form-label">Height:</label>
                <div class="input-group">
                    <input type="number" name="height" id="height" class="form-control" value="<?php echo (isset($_POST['height'])) ? $_POST['height'] : ""; ?>" required>
                    <span class="input-group-text" id="basic-addon2">cm</span>
                </div>
            </div>
            <?php
            if ($error_height != "") {
                echo "<p class='small invalid-input'>" . $error_height . "</p>";
            }
            ?>
            <div class="mb-3">
                <label for="weight" class="form-label">Weight:</label>
                <div class="input-group">
                    <input type="number" name="weight" id="weight" class="form-control" value="<?php echo (isset($_POST['weight'])) ? $_POST['weight'] : ""; ?>" required>
                    <span class="input-group-text" id="basic-addon2">kg</span>
                </div>
            </div>
            <?php
            if ($error_weight != "") {
                echo "<p class='small invalid-input'>" . $error_weight . "</p>";
            }
            ?>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <div class="input-group">
                    <div class="form-check me-5">
                        <input class="form-check-input" type="radio" name="gender" id="gender1" value="male" <?php echo ((isset($_POST['gender'])) && ($_POST['gender'] == 'male')) ? 'checked="checked"' : ''; ?>>
                        <label class="form-check-label" for="gender1">
                            Male
                        </label>
                    </div>
                    <div class="form-check me-5">
                        <input class="form-check-input" type="radio" name="gender" id="gender2" value="female" <?php echo ((isset($_POST['gender'])) && ($_POST['gender'] == 'female')) ? 'checked="checked"' : ''; ?>>
                        <label class="form-check-label" for="gender2">
                            Female
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gender3" value="other" <?php echo ((isset($_POST['gender'])) && ($_POST['gender'] == 'other')) ? 'checked="checked"' : ''; ?>>
                        <label class="form-check-label" for="gender3">
                            Other
                        </label>
                    </div>
                </div>
            </div>
            <?php
            if ($error_gender != "") {
                echo "<p class='small invalid-input'>" . $error_gender . "</p>";
            }
            ?>
            <div class="submission">
                <button type="submit" class="submit" name="save">Register</button>
            </div>
        </form>
    </div>

    <script src="../bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>