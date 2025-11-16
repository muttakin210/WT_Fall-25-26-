<!Doctype html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Festival</title>
    <style>
        body{
            background-color: #e6f2ff;
        }
        h1{
            text-align: center;
            margin-top: 50px;
            color: #003366;
        }
        form{
            background-color: #ffffff;
            padding: 20px;
            width: 400px;
            margin: 0 auto;
            border-radius: 10px;
        }
        button {
            background-color: #003366;
            color: white;
            cursor: pointer;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
        }
        .a{
            font-size: 20px;
            text-align: center;
            color: #003366;
            margin-top: 20px;  
 
 
        }
        table{
            width: 100%;
        }
        td{
            padding: 10px;
        }
        .b{
            font-size: 16px;
            padding: 10px;
 
 
        }
        input{
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
 
    </style>
</head>
<body>
    <center>
        <div class="container">
        <h2>Student Registration</h2>
        <table>
        <form onsubmit="return validateForm();">
 
        <tr>
           <td> <label>FULL Name:</label></td>
            <td><input type="text" id="name" oninput="resetErrors()">
            <div class="error" id="name-error"></div></td>
        </tr>
 
        <tr>
           <td> <label>Email:</label></td>
            <td><input type="text" id="email" oninput="resetErrors()">
            <div class="error" id="email-error"></div></td>
        </tr>

 
        <tr>
           <td> <label>Password:</label></td>
            <td><input type="password" id="password" oninput="resetErrors()">
            <div class="error" id="password-error"></div></td>
        </tr>
 
        <tr>
           <td> <label>Confirm Password:</label></td>
            <td><input type="password" id="cpass" oninput="resetErrors()">
            <div class="error" id="cpass-error"></div></td>
        </tr>
 
        </table>
        <button type="submit">Submit</button>
        </form>
       
        <!-- Success message element -->
        <div id="success-message"></div>
        </div>
    </center>
      <form onsubmit="return handelSubmit1()">
        <table>
            <tr>
                <td class = "a">
                    <center>Course Registration</center>
                </td>
            </tr>
            <tr>
                <td class="b">
                    Course Name:<input type="text" name="coursename">
                </td>
            </tr>
        </table>
    </form>
    <div id = "error"></div>
    <div id = "output"></div>
 
    <script>
        function validateForm() {
            const name = document.getElementById("name").value;
            const email = document.getElementById("email").value;
            const phone = document.getElementById("phone").value;
            const pass = document.getElementById("password").value;
            const cpass = document.getElementById("cpass").value;
 
            const nEr = document.getElementById("name-error");
            const eEr = document.getElementById("email-error");
            const phEr = document.getElementById("phone-error");
            const pEr = document.getElementById("password-error");
            const cEr = document.getElementById("cpass-error");
 
            // Clear previous errors
            nEr.textContent = "";
            eEr.textContent = "";
            phEr.textContent = "";
            pEr.textContent = "";
            cEr.textContent = "";
 
            let valid = true;
 
            // -------- NAME --------
            if (name === "") {
                nEr.textContent = "Name cannot be empty.";
                valid = false;
            } else if (/\d/.test(name)) {
                nEr.textContent = "Name cannot contain numbers.";
                valid = false;
            } else if (!/^[A-Za-z ]+$/.test(name)) {
                nEr.textContent = "Name must contain only letters.";
                valid = false;
            }
 
        
            if (email === "") {
                eEr.textContent = "Email cannot be empty.";
                valid = false;
            } else if (!email.includes("@")) {
                eEr.textContent = "Email must contain @ symbol.";
                valid = false;
            }
 
           
 
            // -------- PASSWORD VALIDATION --------
            if (pass === "") {
                pEr.textContent = "Password cannot be empty.";
                valid = false;
            }
 
            if (cpass === "") {
                cEr.textContent = "Confirm your password.";
                valid = false;
            } else if (pass !== cpass) {
                cEr.textContent = "Passwords do not match.";
                valid = false;
            }
 
            // -------- FINAL SUBMISSION --------
            if (!valid) return false;
 
            // Show success message
            const box = document.getElementById("success-message");
            box.style.display = "block";
            box.innerHTML = `
                <strong>Registration Successful!</strong><br><br>
                <b>Name:</b> ${name}<br>
                <b>Email:</b> ${email}<br>
                
            `;
 
            return false; // Prevent page reload
        }
 
        // Clear errors on typing
        function resetErrors() {
            document.getElementById("name-error").textContent = "";
            document.getElementById("email-error").textContent = "";
            document.getElementById("password-error").textContent = "";
            document.getElementById("cpass-error").textContent = "";
        }
    </script>
</body>
</html>
 