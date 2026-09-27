# 🌍 CholoGhuri - Tour & Travel Booking Management System

[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

**CholoGhuri** is a modern, responsive, and secure web-based Tour and Travel Booking Management System. Designed to make discovering and booking trips across Bangladesh seamless, it provides a user-friendly interface for travelers to explore destinations, view package details, and manage bookings, alongside a foundational admin panel for system oversight.

---

## 📑 Table of Contents
1. [Technology Stack](#-technology-stack)
2. [Key Features](#-key-features)
3. [Database Schema](#-database-schema)
4. [Project Directory Structure](#-project-directory-structure)
5. [Installation & Setup Guide](#️-installation--setup-guide-xampp)
6. [Default Credentials](#-default-credentials)
7. [Troubleshooting](#-troubleshooting)
8. [Future Enhancements](#-future-enhancements)
9. [License](#-license)

---

## 🛠️ Technology Stack

- **Frontend:** HTML5, CSS3 (Custom CSS with CSS Variables & Flexbox/Grid), Vanilla JavaScript
- **Backend:** PHP 8.x (MySQLi with Prepared Statements to prevent SQL injection)
- **Database:** MySQL 8.0
- **Local Server Environment:** XAMPP (Apache & MySQL)

---

## ✨ Key Features

### 👤 User Features
- **Secure Authentication:** User registration and login with secure password hashing (`password_hash` and `password_verify`).
- **Package Discovery:** Browse active tour packages featuring images, destinations, durations, and dynamic pricing.
- **Live Client-Side Search:** Real-time JavaScript filtering for tour packages by name or destination.
- **Dynamic Booking System:** Select future travel dates, specify the number of travelers, and auto-calculate total pricing.
- **Booking Management:** A dedicated "My Bookings" dashboard to view booking history, current statuses, and trip details.

### 🛡️ Admin Features
- **Dashboard Overview:** Real-time statistical insights into total tour packages, registered users, and total bookings.
- **Extensible Architecture:** Clean, modular code ready for CRUD operations (Add/Edit/Delete packages, booking approvals, user management).

---

## 🗄️ Database Schema

The system relies on three primary tables. *(This is automatically created when you import `database/chologhuri.sql`)*:

1. **`users`**
   - `id` (INT, Primary Key, Auto Increment)
   - `name` (VARCHAR)
   - `email` (VARCHAR, Unique)
   - `phone` (VARCHAR)
   - `password` (VARCHAR, Hashed)
   - `created_at` (TIMESTAMP)

2. **`tour_packages`**
   - `id` (INT, Primary Key, Auto Increment)
   - `title` (VARCHAR)
   - `destination` (VARCHAR)
   - `duration` (VARCHAR)
   - `price` (DECIMAL)
   - `image` (VARCHAR, URL or local path)
   - `description` (TEXT)
   - `status` (ENUM: 'active', 'inactive')
   - `created_at` (TIMESTAMP)

3. **`bookings`**
   - `id` (INT, Primary Key, Auto Increment)
   - `user_id` (INT, Foreign Key → `users.id`)
   - `package_id` (INT, Foreign Key → `tour_packages.id`)
   - `travel_date` (DATE)
   - `people` (INT)
   - `total_price` (DECIMAL)
   - `status` (ENUM: 'Pending', 'Confirmed', 'Cancelled')
   - `created_at` (TIMESTAMP)

---

## 📂 Project Directory Structure


chologhuri/
│
├── admin/ # Admin panel files (e.g., dashboard.php)
├── css/ # Stylesheets (style.css)
├── database/ # SQL dump files (chologhuri.sql)
├── images/ # Local assets (e.g., logo.png)
├── includes/ # Reusable PHP components
│ ├── db.php # Database connection configuration
│ ├── header.php # Global navigation and head metadata
│ └── footer.php # Global footer and script inclusions
├── js/ # Client-side scripts (script.js)
│
├── index.php # Homepage (Hero, Popular Picks, About, Contact)
├── packages.php # All tour packages listing with live search
├── package-details.php # Individual package details and booking prompt
├── booking.php # Secure booking form and server-side processing
├── my-bookings.php # User's personal booking history
├── login.php # User authentication
├── register.php # New user registration
└── logout.php # Session destruction and redirect



---

## ⚙️ Installation & Setup Guide (XAMPP)

Follow these exact steps to run the project locally on your machine:

1. **Install XAMPP:** Download and install XAMPP from [Apache Friends](https://www.apachefriends.org/).
2. **Place Project Files:** Copy the entire `chologhuri` folder into your XAMPP `htdocs` directory:  
   `C:\xampp\htdocs\chologhuri`
3. **Start Services:** Open the XAMPP Control Panel and click **Start** for both **Apache** and **MySQL**.
4. **Create Database:**
   - Open your browser and navigate to `http://localhost/phpmyadmin`
   - Click **New** in the left sidebar, name the database `chologhuri`, and click **Create**.
   - Select the new `chologhuri` database, go to the **Import** tab at the top.
   - Click **Choose File**, select `chologhuri/database/chologhuri.sql`, and click **Go** at the bottom.
5. **Configure Database Connection:**
   - Open `chologhuri/includes/db.php` in any text editor (VS Code, Notepad++).
   - Verify the credentials match your local environment. Default XAMPP settings are:
     ```php
     $host = 'localhost';
     $user = 'root';
     $pass = ''; // Leave empty for default XAMPP
     $dbname = 'chologhuri';
     ```
6. **Run the Application:** Open your browser and navigate to:  
   `http://localhost/chologhuri/`
7. **Test the System:**
   - Go to **Register**, create a new user account.
   - **Login** with your new credentials.
   - Browse **Packages**, select a tour, and complete a test booking.
   - Visit the **Admin Dashboard** at `http://localhost/chologhuri/admin/` to view system metrics.

---

## 🔑 Default Credentials

After importing the SQL file, you can use these credentials (if seeded) or create your own:
- **Admin Panel:** `http://localhost/chologhuri/admin/` *(Note: Ensure you add session role checks for production)*
- **User Panel:** Register a new account via `http://localhost/chologhuri/register.php`

---

## 🔧 Troubleshooting

| Issue | Solution |
| :--- | :--- |
| **"Headers already sent" error** | Ensure there are no spaces or blank lines before `<?php` or after `?>` in `includes/db.php`, `header.php`, or `footer.php`. |
| **"Database connection failed"** | Verify MySQL is running in XAMPP. Check `includes/db.php` for typos in `$dbname`, `$user`, or `$pass`. |
| **Images not loading (Broken icon)** | The project uses remote Unsplash URLs by default. Ensure you have an active internet connection, or update the `image` column in the database to point to local files (e.g., `images/tour1.jpg`). |
| **404 Not Found on subpages** | Ensure the folder name in `htdocs` is exactly `chologhuri` (case-sensitive on some OS) and URLs are typed as `http://localhost/chologhuri/...` |

---

## 🚀 Future Enhancements (Production Readiness)

Before deploying this system to a live production environment, the following enhancements are strongly recommended:

1. **Security:**
   - Implement **CSRF (Cross-Site Request Forgery) tokens** on all POST forms.
   - Add robust **server-side authorization middleware** (e.g., `if ($_SESSION['role'] !== 'admin')`) for all `/admin/` routes.
   - Use `.env` files (via a library like `vlucas/phpdotenv`) to manage database credentials securely.
2. **Features:**
   - Integrate a **Payment Gateway** (e.g., SSLCommerz, Stripe, or bKash) for real transactions.
   - Add an email notification system (e.g., PHPMailer) for booking confirmations and password resets.
   - Implement server-side pagination and advanced filtering for the packages list.
   - Build out full Admin CRUD interfaces for managing packages, users, and booking statuses.
3. **Performance:**
   - Enable output caching and optimize image sizes (convert to WebP format).
   - Minify CSS and JavaScript files for production.

---

## 📄 License

This project is developed for educational and portfolio purposes. Feel free to modify, extend, and use it for your own projects. 

---
*Developed with ❤️ for exploring beautiful Bangladesh.*
