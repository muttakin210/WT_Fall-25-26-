<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Metadata -->
    <title>My Portfolio - Computer Science Student</title>
    <meta name="author" content="Your Name">
    <meta name="description" content="Personal portfolio webpage for internship preparation.">
    <meta name="keywords" content="portfolio, computer science, student, internship, HTML5">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f5f5f5;
        }
        header, footer {
            background: #333;
            color: white;
            padding: 20px;
        }
        nav a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
        }
        main {
            padding: 20px;
        }
        table {
            border-collapse: collapse;
            width: 60%;
        }
        table, th, td {
            border: 1px solid #333;
            padding: 10px;
        }
        form input, form textarea {
            display: block;
            margin-bottom: 10px;
            width: 300px;
            padding: 8px;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <header>
        <h1>Your Name</h1>
        <nav>
            <a href="#bio">Biography</a>
            <a href="#education">Education</a>
            <a href="#contact">Contact</a>
        </nav>
    </header>

    <!-- MAIN CONTENT -->
    <main>

        <!-- BIO SECTION -->
        <section id="bio">
            <h2>About Me</h2>
            <p>
                I am a computer science student passionate about software development, 
                web technologies, and building real-world applications. I am currently 
                preparing for internship opportunities.
            </p>
        </section>

        <!-- EDUCATION TABLE -->
        <section id="education">
            <h2>Educational Qualifications</h2>
            <table>
                <tr>
                    <th>Degree</th>
                    <th>Institution</th>
                    <th>Year</th>
                </tr>
                <tr>
                    <td>BSc Computer Science</td>
                    <td>Example University</td>
                    <td>2022–2026</td>
                </tr>
                <tr>
                    <td>High School</td>
                    <td>Example High School</td>
                    <td>2020</td>
                </tr>
            </table>
        </section>

        <!-- CONTACT FORM -->
        <section id="contact">
            <h2>Contact Me</h2>
            <form>
                <label>Name:</label>
                <input type="text" required>

                <label>Email:</label>
                <input type="email" required>

                <label>Message:</label>
                <textarea rows="4" required></textarea>

                <button type="submit">Send</button>
            </form>
        </section>

    </main>

    <!-- FOOTER -->
    <footer>
        <p>&copy; 2025 Your Name. All Rights Reserved.</p>
    </footer>

</body>
</html>
