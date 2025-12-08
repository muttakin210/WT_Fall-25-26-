<!DOCTYPE html>
<html>
<head>
    <title>AIUB-student notes and slides Platform</title>
    <style>
        body {
            font-family: Arial;
            background: #e6f2ff;
            margin: 0;
            padding: 0;
        }
        
        .header {
            background: #0066cc;
            color: white;
            padding: 20px;
            text-align: center;
        }
        
        .menu {
            background: #004d99;
            padding: 10px;
            text-align: center;
        }
        
        .menu a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            padding: 8px 15px;
            background: #0066cc;
            border-radius: 5px;
        }
        
        .menu a:hover {
            background: #0052a3;
        }
        
        .main {
            padding: 20px;
            max-width: 1000px;
            margin: auto;
        }
        
        .box {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        .feature {
            background: #f0f8ff;
            padding: 15px;
            margin: 10px 0;
            border-left: 5px solid #0066cc;
        }
        
        .notes {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .note {
            background: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            width: 200px;
        }
        
        .button {
            background: #0066cc;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin: 5px;
        }
        
        .button:hover {
            background: #0052a3;
        }
        
        .form {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        
        .footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }
        
        h2 {
            color: #0066cc;
            border-bottom: 2px solid #0066cc;
            padding-bottom: 5px;
        }
        
        .login-box {
            max-width: 400px;
            margin: 50px auto;
        }
        
        .alert {
            background: #ffebee;
            color: #c62828;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            border-left: 5px solid #c62828;
        }
        
        .success {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            border-left: 5px solid #2e7d32;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <h1>AIUB-student notes and slides Platform</h1>
        <p>Simple way to share and get notes for AIUB students</p>
    </div>

    <!-- Menu -->
    <div class="menu">
        <a href="#home">Home</a>
        <a href="#notes"> Notes</a>
        <a href="#upload"> Upload</a>
        <a href="#login"> Login</a>
        <a href="#register"> Register</a>
    </div>

    <!-- Main Content -->
    <div class="main">
        
        <!-- Welcome Section -->
        <div class="box">
            <h2>Welcome to AIUB Notes!</h2>
            <p>This is a simple platform where AIUB students can share their class notes with each other. Free and easy to use!</p>
            
            <div style="text-align: center; margin: 20px 0;">
                <a href="#upload" class="button"> Upload Your Notes</a>
                <a href="#notes" class="button"> Download Notes</a>
                <a href="#register" class="button"> Create Account</a>
            </div>
        </div>

      

        <!-- Login Form -->
        <div class="box" id="login">
            <h2> Student Login</h2>
            <div class="form">
                <input type="text" placeholder="Enter Student ID" id="studentId">
                <input type="password" placeholder="Enter Password" id="password">
                <button class="button" onclick="login()">Login Now</button>
                <p style="margin-top: 10px;">
                    <a href="#forgot" style="color: #0066cc;">Forgot password?</a> | 
                    <a href="#register" style="color: #0066cc;">New user? Register here</a>
                </p>
            </div>
        </div>

        <!-- Register Form -->
        <div class="box" id="register">
            <h2> Create New Account</h2>
            <div class="form">
                <input type="text" placeholder="Full Name">
                <input type="text" placeholder="AIUB Student ID">
                <input type="email" placeholder="Email Address">
                <input type="password" placeholder="Password">
                <select>
                    <option>Select Faculty</option>
                    <option>Faculty of Science & Technology</option>
                    <option>Faculty of Business Administration</option>
                    <option>Faculty of Arts & Social Sciences</option>
                    <option>Faculty of Engineering</option>
                </select>
                <button class="button">Create Account</button>
            </div>
        </div>

        <!-- Upload Notes -->
        <div class="box" id="upload">
            <h2> Upload Notes</h2>
            <div class="form">
                <input type="text" placeholder="Note Title (e.g., CSE 101 Final Notes)">
                <select>
                    <option>Select Course</option>
                    <option>CSE 101 - Programming Language I</option>
                    <option>MAT 120 - Calculus I</option>
                    <option>ENG 101 - English Fundamentals</option>
                    <option>PHY 107 - Physics I</option>
                    <option>CSE 102 - Programming Language II</option>
                </select>
                <select>
                    <option>Select File Type</option>
                    <option>PDF File</option>
                    <option>Word Document</option>
                    <option>Image (JPG/PNG)</option>
                    <option>PowerPoint</option>
                </select>
                <input type="file">
                <button class="button">Upload Now</button>
            </div>
        

       
            </div>
            
            <div style="text-align: center; margin-top: 20px;">
                <a href="#more" class="button">See All Notes</a>
            </div>
        </div>

  

    </div>


        
        
      
       
       
        
   

</body>
</html>