# CVE_Data_viewer

The CVE Data Viewer is a web application designed to retrieve and display Common Vulnerabilities and Exposures (CVE) data from the National Vulnerability Database (NVD) API. This project utilizes a combination of technologies including HTML, CSS, JavaScript, PHP, and MySQL to create a seamless user experience. The application fetches CVE data from the NVD API, stores it in a MySQL database, and presents it in a structured table format for easy viewing and analysis. Users can run the fetch_cve.php script to populate the database with the latest CVE information, and the data can be accessed through a user-friendly interface provided by index.html. The project serves as a practical example of full-stack web development, showcasing the integration of front-end and back-end technologies. It is an essential tool for security professionals and developers who need to stay informed about vulnerabilities in software and systems. The application is set up to run locally using XAMPP, making it easy to deploy and test on any machine.

Install XAMPP:

Download and install XAMPP from Apache Friends.
Start XAMPP:

Open the XAMPP Control Panel and start the Apache and MySQL services.
Create the Database:

Open phpMyAdmin by navigating to http://localhost/phpmyadmin.
Create a new database named cve_db.
Run the following SQL command to create the cve_data table:
CREATE TABLE cve_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cve_id VARCHAR(255) NOT NULL,
    description TEXT,
    score FLOAT,
    last_modified DATETIME
);

Place the Project Files:

Copy the project files into the C:\xampp\htdocs\cve_project directory.
Fetch CVE Data:

Open your web browser and navigate to http://localhost/cve_project/fetch_cve.php to fetch and store CVE data in the database.
View the Application:

Open index.html in your web browser by navigating to http://localhost/cve_project/index.html.



Usage
The application will display a table of CVE data retrieved from the NVD API.
You can refresh the data by running the fetch_cve.php script again.
