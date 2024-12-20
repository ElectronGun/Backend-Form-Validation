<?php

// Check if POST when submitted
// Initialize message to empty
// Initialize array of error(s) if POST request
$message = '';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];

    // Sanitize and Validate first name
    // PHP function to check $first_name does not match pattern > 2 letters
    // Error - place in array
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    if (!preg_match("/^[a-zA-Z]{2,20}$/", $first_name)) {
        $errors[] = "First name must be between 2-20 characters in length.";
    }

    // Sanitize and Validate last name
    // PHP function to check $last_name does not match pattern > 2 letters
    // Error - place in array
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    if (!preg_match("/^[a-zA-Z]{2,20}$/", $last_name)) {
        $errors[] = "Last name must be between 2-20 characters in length.";
    }

    // Sanitize and Validate health card number
    // PHP function to check $health_card_number does not match pattern XXXX-XXX-XXX AA
    // Error - place in array
    $health_card_number = filter_input(INPUT_POST, 'health_card_number', FILTER_SANITIZE_STRING);
    if (!preg_match("/^\d{4}-\d{3}-\d{3} [A-Z]{2}$/", $health_card_number)) {
        $errors[] = "Health Care Number format invalid.";
    }

    // Sanitize and Validate date of birth
    // DOB must not be in future, otherwise error
    // Error - place in array
    $dob = new DateTime(filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING));
    $now = new DateTime();
    if ($dob > $now) {
        $errors[] = "The date year must be before the current year 2024.";
    }

    // Check for validation errors, display error or success message
    // Array of error(s), display as unordered list
    if (empty($errors)) {
        $message = "<p>Patient Data Entered Correctly</p>";
    } else {
        $message = "<ul>";
        foreach ($errors as $error) {
            $message .= "<li>$error</li>";
        }
        $message .= "</ul>";
    }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Data Entry</title>
    
    <!-- Link Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Link jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!-- Bootstrap for better spacing, padding, and color scheme -->
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
            width: 35%;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        #result-message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            background-color: #f8f9fa;
            width: 35%;
        }
        h1 {
            margin-bottom: 15px;
            width: 35%;
        }
    </style>
</head>

<body>
    <h1>Patient Data Entry</h1>
    <form method="post" action="patient.php">
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>
        <div class="form-group">
            <label for="health_card_number">Health Card Number (XXXX-XXX-XXX AA)</label>
            <input type="text" class="form-control" id="health_card_number" name="health_card_number" required>
        </div>
        <!-- Date Picker - Input -->
        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" required>
        </div>

        <!-- Buttons -->
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" id="random" class="btn btn-secondary">Random</button>
    </form>

    <!-- Display the result message below buttons -->
    <div id="result-message">
        <?php echo $message; ?>
    </div>

    <!-- When random clicked send get request to random.php, expect json response, update form when returned from server -->
    <!-- jQuery - success callback function for successful AJAX request -->
    <!-- Update html elements with server responses from random.php -->
    <script>
    $(document).ready(function() {
        $("#random").click(function() {
            $.ajax({
                url: "random.php",
                type: "get",
                dataType: "json",
                success: function(data) {
                    $("#first_name").val(data.first_name);
                    $("#last_name").val(data.last_name);
                    $("#health_card_number").val(data.health_card_number);
                    $("#dob").val(data.dob);
                }
            });
        });
    });
    </script>
</body>
</html>