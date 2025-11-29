<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Admission Form</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 60%;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        fieldset {
            margin-bottom: 20px;
            border: 2px solid #333;
            padding: 15px;
            border-radius: 8px;
        }
        legend {
            font-weight: bold;
            padding: 0 10px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input, select, textarea {
            margin-top: 5px;
            width: 60%;
            padding: 8px;
        }
        button {
            padding: 10px 20px;
            margin-right: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <h1>University Admission Form</h1>

    <form>

        <!-- PERSONAL INFO -->
        <fieldset>
            <legend>Personal Information</legend>

            <label>Full Name:</label>
            <input type="text" name="fullname" maxlength="50" required>

            <label>Email Address:</label>
            <input type="email" name="email" required>

            <label>Date of Birth:</label>
            <input type="date" name="dob" required>

            <label>Gender:</label>
            <input type="radio" name="gender" value="male" required> Male
            <input type="radio" name="gender" value="female"> Female
            <input type="radio" name="gender" value="other"> Other
        </fieldset>

        <!-- ACADEMIC INFO -->
        <fieldset>
            <legend>Academic Information</legend>

            <label>Previous School / College:</label>
            <input type="text" name="school" maxlength="100" required>

            <label>Interests (select all that apply):</label>
            <input type="checkbox" name="interests" value="sports"> Sports
            <input type="checkbox" name="interests" value="coding"> Coding
            <input type="checkbox" name="interests" value="music"> Music
            <input type="checkbox" name="interests" value="art"> Art

            <label>Preferred Department:</label>
            <select name="department" required>
                <option value="">-- Select Department --</option>
                <option value="cs">Computer Science</option>
                <option value="business">Business Administration</option>
                <option value="engineering">Engineering</option>
                <option value="arts">Arts & Humanities</option>
            </select>
        </fieldset>

        <!-- DOCUMENTS UPLOAD -->
        <fieldset>
            <legend>Required Documents</legend>

            <label>Upload Transcript:</label>
            <input type="file" name="transcript" required>

            <label>Upload Resume (Optional):</label>
            <input type="file" name="resume">
        </fieldset>

        <!-- BUTTONS -->
        <button type="submit">Submit</button>
        <button type="reset">Reset</button>

    </form>

</body>
</html>
