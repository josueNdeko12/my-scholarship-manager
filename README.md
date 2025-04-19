# my-scholarship-manager

A simple PHP and MySQL web application that allows users to register, log in, and manage their own list of scholarships. Built as a practical tool to organize and track scholarship opportunities in one place.

---
## 🖼️ Demo 

![image](https://github.com/user-attachments/assets/b25e6dc4-ebf9-446f-9cc0-0ee2da969b4c)

![image](https://github.com/user-attachments/assets/fa82fc79-f355-4bc5-a74e-cd545ed21fe7)

![image](https://github.com/user-attachments/assets/13c378d7-b152-4cc1-90b0-77d79b3600f5)

---

## ✨ Features

- 🔐 User registration and login
- 📝 Add, edit, and delete scholarships
- 🔍 Private user dashboard — users only see their own saved scholarships
- ✅ Flash messages for feedback (e.g., success and error alerts)
- 📅 Track scholarship name, amount, deadline, URL, and notes

---

## 🛠️ Tech Stack

- **PHP** 
- **MySQL**
- **HTML**
- **CSS**

---

## 📂 Folder Structure

```bash
my-scholarship-manager/
│
├── db.php
├── login.php
├── register.php
├── logout.php
├── index.php
├── add.php
├── edit.php
├── delete.php
├── styles.css
└── README.md
```

## 🧪 How to Run Locally (Using XAMPP)

1. **Start Apache and MySQL** in the XAMPP Control Panel.

2. **Place the project folder** in the `htdocs` directory:  
   `C:\xampp\htdocs\my-scholarship-manager`

3. **Import the database**:
   - Open [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
   - Create a new database named: `scholarship_tracker`
   - Create 2 tables using scholarship_tracker.sql

4. **Access your app** in the browser:  
   [http://localhost/my-scholarship-manager/register.php](http://localhost/my-scholarship-manager/register.php)
