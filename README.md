# Access Control Vulnerability Lab

A PHP/MySQL-based training environment designed to demonstrate practical flaws in Access Control mechanisms, specifically focusing on Privilege Escalation (Vertical) and Insecure Direct Object References (IDOR / Horizontal).

## Setup & Installation

### Prerequisites
* XAMPP Server (Apache & MySQL)
* PHP 7.4+

### Installation Steps
1. Move the project folder into your XAMPP web root:
   C:\xampp\htdocs\access-control-lab\
   
Open phpMyAdmin (http://localhost/phpmyadmin) and create a new database named lab_db.

Go to the SQL tab in phpMyAdmin, paste the SQL code provided in the Database Schema section below, and execute it to create the tables and inject the sample data.

Access the application via your browser:
http://localhost/access-control-lab/


Lab Scenarios & Vulnerability Breakdown
1. Vertical Access Control (Privilege Escalation)
This scenario simulates a flaw where administrative functionalities are exposed to unauthenticated or low-privileged users due to missing server-side role validation.

Hardcoded Admin Credentials:
Email: admin@lab.com
Password: admin123

The Flaw: While the user interface restricts regular accounts from seeing administrative links, the backend fails to validate whether the current session belongs to an admin role on restricted endpoints. An attacker can bypass UI restrictions and view sensitive admin logs simply by navigating directly to the dashboard path.

Target Endpoint: /admin/dashboard.php (or your specific admin panel path).


2. Horizontal Access Control (IDOR)
This scenario demonstrates how an attacker can access resources belonging to other users of the same privilege level by manipulating input identifiers.

The Flaw: The application fetches user-specific notes from the notes table using a parameter (e.g., view_note.php?id=3). Because the backend only verifies the parameter's existence rather than ensuring the requested id belongs to the currently logged-in user_id session, parameter tampering allows any user to view private notes belonging to others (e.g., switching from ID 3 to 4).

Target Parameters: Modifying resource identifier variables within the application dashboard.

Database Schema
Run the following SQL script inside your lab_db database to automatically generate the structure and populate it with the lab's users and notes:

SQL
-- Create Users Table
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(50) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert Users Dummy Data
INSERT INTO `users` (`id`, `email`, `password`, `role`) VALUES
(1, 'admin@lab.com', 'admin123', 'admin'),
(2, '0xhanthala@gmail.com', '12345678', 'user'),
(3, 'adel158074@gmail.com', '12345678', 'user');

-- Create Notes Table
CREATE TABLE IF NOT EXISTS `notes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `note_text` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert Notes Dummy Data
INSERT INTO `notes` (`id`, `user_id`, `note_text`) VALUES
(3, 2, 'عاش يا عدول'),
(4, 3, 'يا مزاجي');
