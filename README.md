# 🏛️ Gram Panchayat Management System

![Laravel](https://img.shields.io/badge/Laravel-12-red?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2-blue?logo=php)
![Tailwind](https://img.shields.io/badge/Tailwind_CSS-4-38B2AC?logo=tailwindcss)
![License](https://img.shields.io/badge/License-MIT-green)

<img src="https://placehold.co/1000x400" alt="Project Demo" />

---

## 📌 Introduction

The **Gram Panchayat Management System** is a comprehensive **Digital Panchayat Platform** designed to modernize village governance.  
It enables **administrative management**, **role-based control**, and **public-facing Panchayat websites** for transparency, communication, and tourism promotion.

This system is ideal for managing:
- Village councils & officials
- Panchayat-level content and announcements
- Public information access through dynamic websites

---

## 🚀 Features

### 🌐 Public Portal
- 🏘️ Dynamic Panchayat Websites
- 🗣️ Pradhan's Message Desk
- 🧭 Tourism Management (Places & Attractions)
- 🖼️ Multimedia Gallery  
  - Photo Gallery  
  - YouTube Video Gallery

### 🛠️ Admin Panel
- 🔐 Role-Based Access Control (RBAC)
- 🌍 Geographic Management  
  *(State → District → Block → Panchayat)*
- 🧩 CMS for Content, Gallery & Tourist Places
- 📊 Dashboard Analytics & Insights

---

## 🧰 Tech Stack

### Backend | Frontend Overview:
| Technology | Version |
|------------|---------|
| Laravel | ^12.0 |
| Jetstream | ^5.4 |
| Sanctum | ^4.0 |
| Yajra DataTables | ^12.0 |
| PHP | ^8.2 |
| Vite | ^6.0 |
| Tailwind CSS | ^4.0 |
| Bootstrap | ^5.3 |
| Fancybox | v5 |
| FontAwesome | ^6.5 |

---

## ⚙️ Installation Guide
1️⃣ Clone the Repository:
```bash
git clone https://github.com/Yuvraj8090/grampanchayat.git
git cd grampanchayat```
2️⃣ Install Backend Dependencies:
d composer install 
d npm install 
d cp .env.example .env 
d # Configure your database in .env:
d DB_DATABASE=gram_panchayat_db 
d php artisan key:generate 
d php artisan migrate 
d php artisan storage:link 
d npm run build 
def Run the Application:
def php artisan serve 
def npm run dev 
def Application URLs:
home: `/`
admn login: `/login`
panchayat page: `/{id}/panchayat`
tourist message route: `/{id}/pradhan-message`
tourist places route: `/{id}/tourist-places`
gallery route: `/{id}/gallery`
videos route: `/{id}/video`
admin routes:
a `/admin/users`
a `/admin/panchayats`
a `/admin/{panchayat}/gallery`
a `/admin/{panchayat}/places`
and footer:
p `<p align="center"> Developed with ❤️ by <a href="https://github.com/Yuvraj8090" target="_blank"> <b>Yuvraj Kohli</b> </a> </p>`