# Timetable Management System

A simple PHP-based web application to manage timetables. It uses MySQL to store data such as class schedules and faculty. 


## Technologies Used
- **PHP**: Backend logic and server-side processing
- **MySQL**: Database for storing timetable data
- **Bootstrap**: Frontend framework for responsive design

## Installation

1. Clone or download the repository.
2. Set up a local server (e.g., XAMPP) and place the project in the `htdocs` folder.
3. Create a `.env` file in the root directory of the project with the following content:
   
   ```bash
   # Database configuration
   db_hostname=your_host
   db_username=your_database_username
   db_password=your_database_password
   db=your_database_name
   db_port=your_port

   # Admin credentials
   username=your_admin_username
   password=your_admin_password

4. **Create the MySQL database and the timetable table by following these steps:**

   - Open phpMyAdmin (or any MySQL client) and log in.
   - **Create a new database:**
     ```sql
     CREATE DATABASE your_database_name;
     ```
   - **Select the newly created database:**
     ```sql
     USE your_database_name;
     ```
   - **Create the `timetable` table:**
     ```sql
     CREATE TABLE timetable (
         id INT AUTO_INCREMENT PRIMARY KEY,
         day VARCHAR(20) NOT NULL,
         class VARCHAR(20) NOT NULL,
         faculty VARCHAR(20) NOT NULL,
         time VARCHAR(20) NOT NULL
     );
     ```

5.Access the application via your local server by visiting http://localhost/your_project_name/
