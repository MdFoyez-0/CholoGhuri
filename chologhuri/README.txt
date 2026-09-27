======================================================================
CHOLOGHURI - TOUR & TRAVEL BOOKING MANAGEMENT SYSTEM
======================================================================

CholoGhuri is a modern, responsive, and secure web-based Tour and Travel 
Booking Management System. Designed to make discovering and booking trips 
across Bangladesh seamless, it provides a user-friendly interface for 
travelers to explore destinations, view package details, and manage 
bookings, alongside a foundational admin panel for system oversight.

----------------------------------------------------------------------
TECHNOLOGY STACK
----------------------------------------------------------------------
- Frontend: HTML5, CSS3 (Custom CSS with CSS Variables), Vanilla JS
- Backend:  PHP 8.x (MySQLi with Prepared Statements)
- Database: MySQL 8.0
- Server:   XAMPP (Apache & MySQL)

----------------------------------------------------------------------
KEY FEATURES
----------------------------------------------------------------------
USER FEATURES:
- Secure Authentication: Registration and login with password hashing.
- Package Discovery: Browse active tours with images, pricing, and details.
- Live Search: Real-time JavaScript filtering for tour packages.
- Dynamic Booking: Select dates, specify travelers, and auto-calculate price.
- Booking Management: Dashboard to view booking history and statuses.

ADMIN FEATURES:
- Dashboard Overview: Statistics for packages, users, and bookings.
- Extensible Architecture: Ready for CRUD operations and user management.

----------------------------------------------------------------------
DATABASE SCHEMA
----------------------------------------------------------------------
1. users
   - id, name, email (unique), phone, password (hashed), created_at

2. tour_packages
   - id, title, destination, duration, price, image, description, 
     status (active/inactive), created_at

3. bookings
   - id, user_id, package_id, travel_date, people, total_price, 
     status (Pending/Confirmed/Cancelled), created_at

----------------------------------------------------------------------
PROJECT DIRECTORY STRUCTURE
----------------------------------------------------------------------
chologhuri/
 ├── admin/                  Admin panel files (dashboard.php)
 ├── css/                    Stylesheets (style.css)
 ├── database/               SQL dump files (chologhuri.sql)
 ├── images/                 Local assets (logo.png)
 ├── includes/               Reusable PHP (db.php, header.php, footer.php)
 ├── js/                     Client-side scripts (script.js)
 │
 ├── index.php               Homepage
 ├── packages.php            Tour packages listing with live search
 ├── package-details.php     Individual package details
 ├── booking.php             Secure booking form and processing
 ├── my-bookings.php         User's booking history
 ├── login.php               User authentication
 ├── register.php            New user registration
 └── logout.php              Session destruction

----------------------------------------------------------------------
INSTALLATION & SETUP GUIDE (XAMPP)
----------------------------------------------------------------------
1. Install XAMPP from https://www.apachefriends.org/
2. Copy the 'chologhuri' folder to C:\xampp\htdocs\chologhuri
3. Open XAMPP Control Panel and start 'Apache' and 'MySQL'.
4. Open browser and go to http://localhost/phpmyadmin
5. Create a new database named 'chologhuri'.
6. Select the database, click 'Import', and upload database/chologhuri.sql
7. Open includes/db.php and verify credentials:
   $host = 'localhost';
   $user = 'root';
   $pass = '';
   $dbname = 'chologhuri';
8. Visit http://localhost/chologhuri/ in your browser.
9. Register a user, login, and test the booking system.
10. Visit http://localhost/chologhuri/admin/ for the admin dashboard.

----------------------------------------------------------------------
TROUBLESHOOTING
----------------------------------------------------------------------
- "Headers already sent" error:
  Ensure no spaces or blank lines before <?php or after ?> in PHP files.
  
- "Database connection failed":
  Verify MySQL is running in XAMPP. Check includes/db.php for typos.
  
- Images not loading:
  The project uses remote Unsplash URLs. Ensure internet access, or 
  update the 'image' column in the database to local file paths.
  
- 404 Not Found on subpages:
  Ensure the folder name in htdocs is exactly 'chologhuri' and URLs 
  are typed correctly (e.g., http://localhost/chologhuri/).

----------------------------------------------------------------------
FUTURE ENHANCEMENTS (PRODUCTION READINESS)
----------------------------------------------------------------------
- Security: Add CSRF tokens, server-side admin authorization, and use 
  .env files for database credentials.
- Features: Integrate payment gateways (SSLCommerz/bKash), add email 
  notifications (PHPMailer), and build full Admin CRUD interfaces.
- Performance: Optimize images (WebP), enable caching, and minify assets.

----------------------------------------------------------------------
LICENSE
----------------------------------------------------------------------
This project is developed for educational and portfolio purposes. 
Feel free to modify, extend, and use it for your own projects.

Developed with <3 for exploring beautiful Bangladesh.
======================================================================
