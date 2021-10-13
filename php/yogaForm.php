<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athleap: Yoga Form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
    <link href="../bootstrap-5.1.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../css/yogaStyle.css" rel="stylesheet">
</head>

<body>
    <?php
    $durationErr = "";
    $yogaErr = "";
    $duration = "";
    $rating = "";
    $yoga = "";
    if (isset($_POST["save"])) {
        if (empty($_POST["duration"])) {
            // echo "<span style='color:red;'>Duration cannot be empty</span><br>";
            $durationErr = "Duration cannot be empty";
        } else if (preg_match("/^[a-zA-Z]*$/", $_POST["duration"])) {
            // echo "<span style='color:red;'>Duration cannot be letter</span><br>";
            $durationErr = "Duration cannot be letter";
        } else if ((int)($_POST["duration"]) <= 0) {
            $durationErr = "Duration should be greater than 0";
        } else {
            $duration = $_POST["duration"];
        }
        if (empty($_POST["yogaAsan"])) {
            $yogaErr = "Please select an Asana";
        } else {
            $yoga = $_POST["yogaAsan"];
        }
        $rating = $_POST["exerciseRate"];
    }
    ?>
    <div class="top-section">
        <a href="#" class="back"><i class="fas fa-bars fa-lg" style="color:white"></i></a>
        <h2 class="header">Today's Workout</h2>
    </div>
    <div class="form-container">
        <div class="form-div mt-5 pt-5">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="pt-2">
                <div class="row form-group">
                    <label for="yogaAsan" class="col-4 mx-5">Select Yoga Asan: </label>
                    <div class="col-5 mx-5">
                        <select class="form-select" name="yogaAsan">
                            <option value="">SELECT</option>
                            <option value="SIRSASANA">HEADSTAND - SIRSASANA</option>
                            <option value="HALASANA">PLOUGH - HALASANA</option>
                            <option value="MATSYASANA">FISH - MATSYASANA</option>
                        </select>
                        <?php
                        if ($durationErr != "") {
                            echo '<small id="durationHelp" class="form-text" style="color: #FF2226">' . $yogaErr . '</small>';
                        }
                        ?>
                    </div>
                </div>
                <div class="row form-group my-3">
                    <label for="duration" class="col-4 mx-5">Duration of exercise: </label>
                    <div class="col-5 mx-5">
                        <input type="text" id="duration" name="duration" class="form-control  form-control-sm">
                        <?php
                        if ($durationErr != "") {
                            echo '<small id="durationHelp" class="form-text" style="color: #FF2226">' . $durationErr . '</small>';
                        } else {
                            echo '<small id="durationHelp" class="form-text text-dark">in minutes</small>';
                        }
                        ?>
                        <!-- <small id="durationHelp" class="form-text text-dark">
                            in minutes
                        </small> -->
                    </div>
                </div>
                <div class="row form-group my-3">
                    <label for="exerciseRate" class="col-4 mx-5">Rate your Exercise: </label>
                    <div class="col-5 mx-5">
                        <div class="row">
                            <div class="col-1">
                                0
                            </div>
                            <div class="col-10">
                                <input type="range" class="form-range" min="0" max="5" step="1" id="exerciseRate" name="exerciseRate">
                            </div>
                            <div class="col-1">
                                5
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-center my-5">
                    <div class="col"></div>
                    <div class="col">
                        <button class="btn btn-md submit-btn" name="save">Submit</button>
                    </div>
                    <div class="col"></div>
                </div>
                <div class="text-center row align-center my-5">
                    <div class="col"></div>
                    <div class="col">
                        <?php
                        if ($duration && $yoga && $rating) {
                            echo '<span> Duration: ' . $duration . " mins<br>Yoga: " . $yoga . "<br>Rating: " . $rating . '<br></span>';
                        } else {
                            echo '<span> Invalid Inputs Entered </span>';
                        }
                        ?>
                    </div>
                    <div class="col"></div>
                </div>
            </form>
        </div>
    </div>
    <script src="../bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>