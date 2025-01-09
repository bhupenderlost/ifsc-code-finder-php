# IFSC Code Finder

IFSC Code Finder is a simple web application built using **Core PHP**, **HTML**, **CSS**, and **MySQL**. It allows users to search for Indian Financial System Code (IFSC) details of banks and branches.

> **Disclaimer:** This project was developed in 2019 while I was learning web development. The code may have vulnerabilities and outdated practices. Please use it for educational purposes only and avoid deploying it in a production environment without proper security improvements.

## Features
- Search for IFSC codes by bank and branch.
- Displays branch details such as address, contact number, and other relevant information.
- Simple and clean user interface built with HTML and CSS.

## Technologies Used
- **Frontend:** HTML, CSS
- **Backend:** PHP
- **Database:** MySQL

## Potential Vulnerabilities
This project was written in 2019 and may contain vulnerabilities such as:
- **SQL Injection:** Ensure all database queries are parameterized.
- **Cross-Site Scripting (XSS):** Sanitize all user inputs and outputs.
- **Unsecured Credentials:** Avoid storing sensitive credentials directly in the code.
- **Outdated Practices:** Modern best practices, such as using prepared statements or ORM tools, were not followed.

Before deploying the application, it is highly recommended to:
- Conduct a thorough security review.
- Update the code to use modern PHP practices (e.g., PDO or MySQLi for database interactions).
- Implement proper input validation and sanitization.
- Use HTTPS for secure communication.

## Contribution
This repository is open for contributions! If you'd like to improve the code or fix vulnerabilities, feel free to:
1. Fork the repository.
2. Create a new branch.
3. Make your changes.
4. Submit a pull request.

