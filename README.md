# code-camp 🎓

Welcome to the **code-camp** project! This is an educational repository designed to help students learn web development step-by-step, from basic HTML/PHP to advanced full-stack systems.

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

## 📁 Project Structure

Currently, the project is organized into lessons:
- **[lesson-01/](./lesson-01/)**: Basic HTML Forms & PHP Grading Logic.
- **[lesson-02/](./lesson-02/)**: Multi-Subject Grading (Arrays & Loops).
- **[lesson-03/](./lesson-03/)**: Classroom Grading System (Nested Loops & Dynamic Forms).
  - `index.html`: Dynamic form to add/remove multiple students.
  - `process.php`: Nested loops to process results for an entire class.
- **[lesson-04/](./lesson-04/)**: Modular Grading System (Functions & Includes).
  - `functions.php`: Reusable functions for grading and calculations.
  - `index.html`: Input form with comma-separated mark parsing.
  - `process.php`: Modular backend using `include` to call external functions.

---

## 🚀 How to Use

To run this project locally, you need a PHP environment (like XAMPP, WAMP, or the built-in PHP server).

1. **Option A: Using built-in PHP server (Quickest)**
   - Open your terminal in the `code-camp` folder.
   - Run the command: `php -S localhost:8000`
   - Open your browser and go to: `http://localhost:8000/lesson-01/index.html`

2. **Option B: Using XAMPP/WAMP**
   - Copy the `code-camp` folder into your `htdocs` (XAMPP) or `www` (WAMP) directory.
   - Start Apache from the XAMPP/WAMP control panel.
   - Open your browser and go to: `http://localhost/code-camp/lesson-01/index.html`

---

## 🛠️ Git Instructions: How to Pull the Project

If you want to download or update this project on your machine, follow these steps:

### 1. Initial Setup (Clone)
If you don't have the project folder yet:
- Open your terminal.
- Run: `git clone <https://github.com/ShanukaDilan/code-camp.git>` 
- Move into the folder: `cd code-camp`

### 2. Getting Latest Updates (Pull)
If you already have the project and want the latest lessons:
- Open your terminal inside the `code-camp` folder.
- Run: `git pull origin main`

