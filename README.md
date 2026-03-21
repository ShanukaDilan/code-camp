# Code Camp 🚀

Welcome to the Code Camp! This repository contains step-by-step lessons to help you learn full-stack web development, starting from HTML, CSS, and PHP, and eventually building a complete system.

## Prerequisites
To run this project on your local machine, you will need:
1. **Git:** To clone and pull updates.
2. **Local Web Server:** Install [XAMPP](https://www.apachefriends.org/), WAMP, or MAMP to run PHP.
3. **Code Editor:** VS Code is highly recommended.

## How to Install and Run Locally
1. **Start your local server:** Open XAMPP and start the **Apache** module.
2. **Navigate to the web root:** - Windows: Go to `C:\xampp\htdocs`
   - Mac: Go to `/Applications/MAMP/htdocs`
3. **Clone the repository:** Open your terminal or command prompt in that folder and run:
   ```bash
   git clone [https://github.com/ShanukaDilan/code-camp.git](https://github.com/ShanukaDilan/code-camp.git)

4. **View the project: Open your web browser and go to http://localhost/code-camp/

##How to Get the Latest Lessons
As the course progresses, new lessons will be added. To update your local code with the newest lessons, open your terminal inside the code-camp folder and run:
`git pull origin main`
---

### 2. Lesson 01: HTML Form & PHP Validation
Create a new folder in your repository called `lesson-01`. Inside it, create the following two files.

**File 1: `index.html` (The Frontend)**
This creates a simple user interface with basic CSS for styling.

```html
<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesson 01 - Student Grading System</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 50px; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-width: 400px; margin: auto; }
        h2 { text-align: center; color: #333; }
        label { font-weight: bold; display: block; margin-top: 10px; }
        input[type="text"], input[type="number"] { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 4px; margin-top: 15px; cursor: pointer; }
        button:hover { background-color: #218838; }
    </style>
</head><body>
<div class="container">
    <h2>Enter Student Marks</h2>
    <form action="process.php" method="POST">
        <label for="student_name">Student Name:</label>
        <input type="text" id="student_name" name="student_name" required>

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>

        <label for="mark">Mark (0 - 100):</label>
        <input type="number" id="mark" name="mark" min="0" max="100" required>

        <button type="submit">Calculate Grade</button>
    </form>
</div></body></html>
```
**File 2: `process.php` (The Backend Logic)**
This script captures the form data, validates it according to your exact rules, and displays the result.
```<?php
// Check if the form was actually submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = htmlspecialchars($_POST['student_name']);
    $subject = htmlspecialchars($_POST['subject']);
    $mark = intval($_POST['mark']);
    $grade = "";
    // Validation and Grading Logic
    if ($mark >= 0 && $mark <= 100) {
        if ($mark >= 75) {
            $grade = "A";
        } elseif ($mark >= 65) {
            $grade = "B";
        } elseif ($mark >= 55) {
            $grade = "C";
        } elseif ($mark >= 35) {
            $grade = "S";
        } else {
            $grade = "W";
        }
    } else {
        $grade = "Invalid Mark (Must be between 0 and 100)";
    }
    // Output the results
    echo "<div style='font-family: Arial; max-width: 400px; margin: 50px auto; padding: 20px; background: #e9ecef; border-radius: 8px;'>";
    echo "<h2>Results</h2>";
    echo "<p><strong>Student Name:</strong> " . $name . "</p>";
    echo "<p><strong>Subject:</strong> " . $subject . "</p>";
    echo "<p><strong>Mark:</strong> " . $mark . "</p>";
    echo "<p><strong>Grade:</strong> <span style='color: #d9534f; font-size: 1.2em; font-weight: bold;'>" . $grade . "</span></p>";
    echo "<br><a href='index.html' style='text-decoration: none; color: #007bff;'>&larr; Go Back</a>";
    echo "</div>";
} else {
    // If someone tries to access process.php directly without submitting the form
    echo "Error: Please submit the form first.";
}
?>
```

