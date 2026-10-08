CREATE TABLE hall_bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  hall_name VARCHAR(50),
 event_name VARCHAR(100),
   event_purpose TEXT,
  organizer_name VARCHAR(100),
    booking_date DATE,
   time_slot VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- first above step create table


-- step second below  give query for event record store

1.SELECT hall_name, booking_date, time_slot
FROM hall_bookings
ORDER BY booking_date DESC;

2.SELECT hall_name, COUNT(*) AS total
FROM hall_bookings
GROUP BY hall_name;

3.SELECT hall_name, COUNT(*) AS total
FROM hall_bookings
GROUP BY hall_name
ORDER BY total DESC
LIMIT 1;



-- step third
ALTER TABLE hall_bookings 
ADD status VARCHAR(20) DEFAULT 'Booked';




-- for review card run this in sql



CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hall_name VARCHAR(50),
    organizer_name VARCHAR(100),
    rating INT,
    comments TEXT,
    feedback_date DATETIME DEFAULT CURRENT_TIMESTAMP
);



-- for user login table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role ENUM('admin','user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



INSERT INTO users (name, email, password, role)
VALUES (
  'Admin',
  'admin@college.com',
  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
  'admin'
);


-- for approval request of user
ALTER TABLE users 
ADD status ENUM('pending','approved','denied') DEFAULT 'pending';



ALTER TABLE users 
ADD status ENUM('pending','approved','denied') DEFAULT 'pending';





-- pass with admin email 

INSERT INTO users (name, email, password, role, status)
VALUES
('Joshi',  'joshi@college.com',   'HASH_FOR_bcs@123',      'admin', 'approved'),
('Ghadge', 'ghadge@college.com',  'HASH_FOR_arts@123',    'admin', 'approved'),
('Shinde', 'shinde@college.com',  'HASH_FOR_pass@123',    'admin', 'approved'),
('Kashid', 'kashid@college.com',  'HASH_FOR_pass@123',    'admin', 'approved'),
('Kakade', 'kakade@college.com',  'HASH_FOR_vijay@123',   'admin', 'approved'),
('Dhane',  'dhane@college.com',   'HASH_FOR_bca@123',     'admin', 'approved'),
('Devkar', 'devkar@college.com',  'HASH_FOR_commerce@123','admin', 'approved');


-- to see record in sqp hall booking->users
SELECT name, email, role, status FROM users WHERE role='admin';




-- steps to set password and email in database  of admin
-- Step 1: Create hash file
-- Create a file: hash.php
-- Copy code
-- Php
-- <?php
-- echo password_hash("bcs@123", PASSWORD_DEFAULT);
-- Change "bcs@123" to any password you want.
-- Step 2: Run it in browser
-- Open:
-- Copy code

-- http://localhost/hall_booking/hash.php
-- You’ll see something like:
-- Copy code

-- $2y$10$k7P1E5YHjQJYFvT3sJvFRe0mXK...
-- 📌 Copy FULL hash (from $ to end)
-- Step 3: Update database (phpMyAdmin)
-- Open phpMyAdmin
-- Select database: hall_booking
-- Open SQL tab
-- Paste this (example for joshi):
-- Copy code
-- Sql
-- UPDATE users 
-- SET password = '$2y$10$PASTE_FULL_HASH_HERE'
-- WHERE email = 'joshi@college.com';
-- Click Go
-- ✔ You should see:
-- Copy code

-- 1 row affected
-- Step 4: Test login
-- Copy code

-- Email: joshi@college.com
-- Password: bcs@123
-- ✅ Login will work
-- ✅ METHOD 2 (phpMyAdmin – NO SQL)
-- Open phpMyAdmin → users table
-- Click Edit on the user
-- Paste hash into password field
-- Click Save
-- ✔ Done


for user pass and username insertion 
INSERT INTO users (name, email, password, role, status) VALUES
('Prachi', 'prachi@gmail.com', '$2y$10$bA41Z49yfZ2k6H3a77UFS.FsoMPyHVUosxdpoKYzLBk.2dmzskB4i', 'user', 'pending');


all password admis

joshi@college.com =>bcs@123
dhane@college.com =>bca@123
ghadge@college.com =>arts@123
shinde@college.com => pass@123
kashid@college.com =>pass@123
devkar@college.com =>commerce@123
kakade@college.com =>eledept@123

pass of users 

shraddhahole12
#sanjivani12
prachi123


if user or admin pass wants to change then copy this

UPDATE users 
SET name = 'shraddha'
WHERE email = 'shraddha3609@gmail.com'; 