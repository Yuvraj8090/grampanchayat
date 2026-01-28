# Gram Panchayat Management System

A comprehensive Digital Panchayat System built with **Laravel 12** and **Jetstream**. This application allows for the management of village councils (Gram Panchayats), including their geographic hierarchy, administrative users, and public-facing websites containing galleries, tourist spots, and official messages.

## 🚀 Features

### 🌍 Public Portal
* **Dynamic Panchayat Websites:** Each Panchayat gets a dedicated public page.
* **Pradhan's Message:** Digital desk for the Village Head's message.
* **Tourism Management:** Showcase local tourist spots with descriptions and locations.
* **Multimedia Gallery:** Support for both **Photo Galleries** and **YouTube Video** integration.

### 🔐 Admin Panel (Dashboard)
* **Role-Based Access Control (RBAC):** Manage Users and Roles securely.
* **Geographic Management:**
    * State Management
    * District Management
    * Block Management
    * Panchayat Management
* **CMS Capabilities:**
    * Manage Website Details (Contact info, Maps, About text).
    * Upload and Manage Tourist Places.
    * Bulk Upload for Galleries (Images) and Video Links.
* **Dashboard Analytics:** Real-time statistics on total districts, blocks, panchayats, and users.

---

## 🛠️ Technology Stack

### Backend
| Technology | Version | Description |
| :--- | :--- | :--- |
| **Laravel** | ^12.0 | Core PHP Framework |
| **Jetstream** | ^5.4 | Application Scaffolding (Livewire stack) |
| **Sanctum** | ^4.0 | API Authentication |
| **Yajra DataTables** | ^12.0 | Server-side DataTables for massive datasets |
| **PHP** | ^8.2 | Server-side Scripting |

### Frontend
| Technology | Version | Description |
| :--- | :--- | :--- |
| **Vite** | ^6.0 | Build Tool |
| **Tailwind CSS** | ^4.0 | Utility-first CSS framework |
| **Bootstrap** | ^5.3 | Used for Admin UI Components |
| **DataTables.net** | ^2.0 | Advanced table controls |
| **FontAwesome** | ^6.5 | Icon sets |

---

## ⚙️ Installation Guide

Follow these steps to set up the project locally.

### 1. Clone the Repository
```bash
git clone [https://github.com/Yuvraj8090/grampanchayat.git](https://github.com/Yuvraj8090/grampanchayat.git)
cd grampanchayat
2. Install Backend Dependencies
Bash
composer install
3. Install Frontend Dependencies
Bash
npm install
4. Environment Configuration
Copy the example environment file and configure your database credentials.

Bash
cp .env.example .env
Open .env and update your database settings:

Ini, TOML
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
5. Generate Application Key
Bash
php artisan key:generate
6. Run Migrations
Create the database tables.

Bash
php artisan migrate
7. Link Storage
Crucial for viewing uploaded Gallery images and Tourist Place photos.

Bash
php artisan storage:link
8. Build Assets
Bash
npm run build
🖥️ Usage
Local Development Server
To start the application, run the following command in your terminal:

Bash
php artisan serve
And in a separate terminal (for Vite hot-reloading):

Bash
npm run dev
Accessing the System
Home/Public: http://127.0.0.1:8000/

Admin Login: http://127.0.0.1:8000/login

Public Panchayat View: http://127.0.0.1:8000/{id}/panchayat

📂 Project Structure (Key Routes)
Public Routes
GET /{id}/panchayat - Main Panchayat Home

GET /{id}/pradhan-message - Pradhan's Desk

GET /{id}/tourist-places - Tourist Spots List

GET /{id}/gallery - Photo Gallery

GET /{id}/video - Video Gallery

Admin Routes (/admin)
Geographic: /districts, /blocks, /panchayats, /states

User Management: /users, /roles

Content Management:

{panchayat}/manage-website - Edit basic details

{panchayat}/places - Manage tourist spots

{panchayat}/gallery - Manage photos & videos

🤝 Contributing
Fork the repository.

Create a new feature branch (git checkout -b feature/AmazingFeature).

Commit your changes (git commit -m 'Add some AmazingFeature').

Push to the branch (git push origin feature/AmazingFeature).

Open a Pull Request.

📝 License
This project is open-sourced software licensed under the MIT license.

Developed by Yuvraj Kohli