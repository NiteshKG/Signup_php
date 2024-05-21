<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h2 {
            margin-top: 0;
            color: #333;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .signup-link {
            text-decoration: none;
            color: #4CAF50;
        }
        .signup-link:hover {
            text-decoration: underline;
        }
        /* Modal styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 300px; 
            border-radius: 10px;
            text-align: center;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .modal-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <!-- <form id="signupForm" action="signup_process.php" method="post"> -->
        <form id="signupForm" action="signup_process.php" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
            <input type="text" id="name" name="name" placeholder="Name" required>            
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="text" id="phone" name="phone" placeholder="Phone Number"onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="10" required">
            <label for="photo">Upload Your Photo:</label><br>
    <input type="file" id="photo" name="profile_pic" accept="image/*" required><br><br>
            <input type="date" id="dob" name="dob" placeholder="Date of Birth" required>                        
            <input type="password" id="password" name="password" placeholder="Password" required>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
            <label for="generatedpassword">Generated Password:</label><br>
            <input type="text" id="generatedpassword" name="generatedpassword" readonly><br>
            <button type="button" onclick="openPasswordModal()">Generate Password</button><br><br>
            <button type="submit" value="Sign Up"class="btn" name="signUp-btn">Sign Up </button>
        </form>
        <p>Already have an account? <a href="login.php" class="signup-link">Login here</a>.</p>
    </div>

    <!-- The Modal -->
    <div id="passwordModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Your new generated password is:</p>
            <p id="generatedPasswordText" style="font-weight: bold;"></p>
            <button class="modal-button" onclick="generatePassword()">Generate Password</button>
            <button class="modal-button" onclick="copyPassword()">Copy Password</button>
            <button class="modal-button" onclick="useGeneratedPassword()">Use this password</button>
            <button class="modal-button" onclick="closeModal()">Cancel</button>
        </div>
    </div>

    <script>
        function openPasswordModal() {
            document.getElementById("passwordModal").style.display = "block";
            document.getElementById("generatedPasswordText").innerText = "";
        }

        function generatePassword() {
            var upperChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            var lowerChars = "abcdefghijklmnopqrstuvwxyz";
            var digits = "0123456789";
            var specialChars = "!@#$%^&*()_+[]{}|;:,.<>?";
            var allChars = upperChars + lowerChars + digits + specialChars;

            var password = "";
            password += upperChars.charAt(Math.floor(Math.random() * upperChars.length));
            password += lowerChars.charAt(Math.floor(Math.random() * lowerChars.length));
            password += digits.charAt(Math.floor(Math.random() * digits.length));
            password += specialChars.charAt(Math.floor(Math.random() * specialChars.length));

            for (var i = 4; i < 16; i++) {
                password += allChars.charAt(Math.floor(Math.random() * allChars.length));
            }

            if (!/[A-Z]/.test(password.charAt(0))) {
                password = upperChars.charAt(Math.floor(Math.random() * upperChars.length)) + password.slice(1);
            }

            password = shuffle(password);
            document.getElementById("generatedPasswordText").innerText = password;
        }

        function shuffle(string) {
            var array = string.split('');
            var currentIndex = array.length, temporaryValue, randomIndex;

            while (0 !== currentIndex) {
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex -= 1;
                temporaryValue = array[currentIndex];
                array[currentIndex] = array[randomIndex];
                array[randomIndex] = temporaryValue;
            }

            return array.join('');
        }

        function useGeneratedPassword() {
            var password = document.getElementById("generatedPasswordText").innerText;
            if (password) {
                var hasUpper = /[A-Z]/.test(password);
                var hasLower = /[a-z]/.test(password);
                var hasDigit = /[0-9]/.test(password);
                var hasSpecial = /[!@#$%^&*()_+\[\]{}|;:,.<>?]/.test(password);

                if (hasUpper && hasLower && hasDigit && hasSpecial && /^[A-Z]/.test(password)) {
                    document.getElementById("generatedpassword").value = password;
                    document.getElementById("password").value = password;
                    document.getElementById("confirm_password").value = password;
                    closeModal();
                } else {
                    alert("Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and the first character must be an uppercase letter.");
                }
            } else {
                alert("Please generate a password first.");
            }
        }

        function copyPassword() {
            var passwordText = document.getElementById("generatedPasswordText").innerText;
            if (passwordText) {
                var tempInput = document.createElement("input");
                tempInput.value = passwordText;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand("copy");
                document.body.removeChild(tempInput);
                alert("Password copied to clipboard!");
            } else {
                alert("Please generate a password first.");
            }
        }

        function closeModal() {
            document.getElementById("passwordModal").style.display = "none";
        }

        window.onclick = function(event) {
            var modal = document.getElementById("passwordModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function validateForm() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var phone = document.getElementById("phone").value;
            var dob = document.getElementById("dob").value;
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;

            if (!name || !email || !phone || !dob || !password || !confirmPassword) {
                alert("All fields are required.");
                return false;
            }

            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            var phonePattern = /^\d{10}$/;
            if (!phonePattern.test(phone)) {
                alert("Please enter a valid 10-digit phone number.");
                return false;
            }

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }

            if (!/^[A-Z]/.test(password)) {
                alert("The first character of the password must be an uppercase letter.");
                return false;
            }

            if (!/[a-z]/.test(password) || !/[A-Z]/.test(password) || !/[0-9]/.test(password) || !/[!@#$%^&*()_+\[\]{}|;:,.<>?]/.test(password)) {
                alert("Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>