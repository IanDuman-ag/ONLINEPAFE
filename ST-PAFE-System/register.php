<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Process registration if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => ''];
    
// Database connection
$host    = 'localhost';
$db      = 'societree';
$user    = 'phpmyadmin_user';
$pass    = 'socieTree@12345';
$charset = 'utf8mb4';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Get form data
        $userId = $_POST['userId'] ?? '';
        $firstname = $_POST['firstname'] ?? '';
        $lastname = $_POST['lastname'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirmPassword'] ?? '';
        $role = $_POST['role'] ?? '';

        // Validate inputs
        if (empty($userId) || empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirmPassword) || empty($role)) {
            $response['message'] = 'All fields are required';
        } elseif ($password !== $confirmPassword) {
            $response['message'] = 'Passwords do not match';
        } else {
            // Check if email already exists
            $stmt = $conn->prepare("SELECT * FROM pafe_acc WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->rowCount() > 0) {
                $response['message'] = 'Email already exists';
            } else {
                // Check if student ID already exists
                $stmt = $conn->prepare("SELECT * FROM pafe_acc WHERE id = ?");
                $stmt->execute([$userId]);
                if ($stmt->rowCount() > 0) {
                    $response['message'] = 'Student ID already exists';
                } else {
                    // Hash the password
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    // Insert into database
                    $stmt = $conn->prepare("INSERT INTO pafe_acc (id, firstname, lastname, email, password, role) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$userId, $firstname, $lastname, $email, $hashedPassword, $role]);
                    
                    $response['success'] = true;
                    $response['message'] = 'Registration successful! Redirecting...';
                    
                    // Output JSON and exit (don't redirect here for AJAX)
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    exit;
                }
            }
        }
    } catch(PDOException $e) {
        $response['message'] = 'Database error: ' . $e->getMessage();
    }
    
    // If we get here, there was an error - output as JSON for AJAX
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAFE - Registration</title>
    <link rel="icon" href="#"/>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    * {
        font-family: "Poppins", sans-serif;
        font-weight: 400;
    }
    
    body {
        background: linear-gradient(135deg, rgba(57, 66, 77, 0.5) 0%, rgba(6, 73, 117, 0.9) 100%), url('#');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    
    .box-area {
    width: 90%;
    max-width: 1200px;
    }

    .log-txt {
        color: #fff;
        font-size: 40px;
        font-weight: 700;
    }
    
    .welcome-txt {
        color: #fff;
        font-weight: 500;
    }
    
    .form-control {
        border-radius: 5px;
    }
    
    .register-btn {
        font-weight: 700;
        background: linear-gradient(to right, rgb(105, 161, 194) 0%, rgb(26, 21, 123) 100%);
    }
    
    .login-link {
        transition: all 0.3s ease;
    }
    
    .login-link:hover {
        color: crimson !important;
        text-decoration: underline !important;
        transform: translateX(3px);
    }
    
    .error-message {
        min-height: 2em;
        width: 100%;
        color: #fff;
        visibility: hidden;
        transition: visibility 0.3s ease;
    }
    
    .error-message.visible {
        background-color: #DC143C;
        visibility: visible;
    }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area" style="max-width: 900px;">
            
            <!-- Right Box (Registration Form) -->
<div class="col-md-12 rounded-4 right-box" style="background: linear-gradient(140deg, rgba(33, 25, 72, 1) 25%, rgba(249, 166, 2, 1) 60%, rgba(187, 201, 189, 1) 80%);">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-8">
            <div class="header-text mb-4 text-center">
                <h1 class="log-txt py-3">REGISTER</h1>
                <h5 class="welcome-txt">Create your UNIVERSITY STUDENT GOVERNMENT Account</h5>
            </div>
            
            <form id="registerForm" action="" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="text" id="userId" name="userId" class="form-control form-control-lg bg-light fs-6" placeholder="Student ID" required>
                        </div>
                        
                        <div class="input-group mb-3">
                            <input type="text" id="firstname" name="firstname" class="form-control form-control-lg bg-light fs-6" placeholder="First Name" required>
                        </div>
                        
                        <div class="input-group mb-3">
                            <input type="text" id="lastname" name="lastname" class="form-control form-control-lg bg-light fs-6" placeholder="Last Name" required>
                        </div>
                        
                        <div class="input-group mb-3">
                            <select id="role" name="role" class="form-select form-control-lg bg-light fs-6" required>
                                <option value="" selected disabled>Select Role</option>
                                <option value="student">Student</option>
                                <option value="officer">Officer</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="email" id="email" name="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email Address" required>
                        </div>
                        
                        <div class="input-group mb-3">
                            <input type="password" id="password" name="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" required>
                        </div>
                        
                        <div class="input-group mb-3">
                            <input type="password" id="confirmPassword" name="confirmPassword" class="form-control form-control-lg bg-light fs-6" placeholder="Confirm Password" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <button type="submit" id="registerBtn" class="btn btn-lg btn-primary w-100 fs-5 register-btn">REGISTER</button>
                        </div>
                        
                        <div id="registerError" class="alert alert-danger text-center d-none mb-3" role="alert"></div>
                        
                        <div class="text-center mb-3">
                           <span class="text-light">Already have an account? </span>
                           <a href="Login.php" class="text-primary fw-bold login-link" style="text-decoration: none;">
                               <i class="bi bi-person-plus"></i> Login Here
                           </a>
                       </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.getElementById('registerForm');
    const registerBtn = document.getElementById('registerBtn');
    const registerError = document.getElementById('registerError');
    
    registerForm.addEventListener('submit', function(e) {
        e.preventDefault();
        registerError.textContent = '';
        registerError.classList.add('d-none');
        
        // Validate password match
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        
        if (password !== confirmPassword) {
            registerError.textContent = 'Passwords do not match!';
            registerError.classList.remove('d-none');
            return;
        }
        
        // Validate role is selected
        const role = document.getElementById('role').value;
        if (!role) {
            registerError.textContent = 'Please select a role!';
            registerError.classList.remove('d-none');
            return;
        }
        
        registerBtn.disabled = true;
        
        // Create FormData object from the form
        const formData = new FormData(registerForm);
        
        fetch('', {
            method: 'POST',
            body: new URLSearchParams(formData),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data); // Debug log
            if (data.success) {
                window.location.href = 'Login.php?registration=success';
            } else {
                registerError.textContent = data.message || 'Registration failed. Please try again.';
                registerError.classList.remove('d-none');
            }
        })
        .catch(error => {
            console.error('Error:', error); // Debug log
            registerError.textContent = 'An error occurred: ' + error.message;
            registerError.classList.remove('d-none');
        })
        .finally(() => {
            registerBtn.disabled = false;
        });
    });
});
</script>
</body>
</html>