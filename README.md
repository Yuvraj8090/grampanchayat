# 🏛️ Gram Panchayat Management System

![Laravel](https://img.shields.io/badge/Laravel-12-red?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2-blue?logo=php)
![Tailwind](https://img.shields.io/badge/Tailwind_CSS-4-38B2AC?logo=tailwindcss)
![License](https://img.shields.io/badge/License-MIT-green)

<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" alt="Project Demo" />

---

## 📌 Introduction

The **Gram Panchayat Management System** is a comprehensive **Digital Panchayat Platform** designed to modernize village governance.

It enables **administrative management**, **role-based access control**, and **public-facing Panchayat websites** to ensure transparency, efficient communication, and tourism promotion.

This system is ideal for managing:

* 🏘️ Village councils & officials
* 📢 Panchayat-level announcements & notices
* 🌍 Public information through dynamic websites

---

## 🚀 Features

### 🌐 Public Portal

* 🏘️ Dynamic Panchayat Websites
* 🗣️ Pradhan's Message Desk
* 🧭 Tourism Management (Places & Attractions)
* 🖼️ Multimedia Gallery

  * Photo Gallery
  * YouTube Video Gallery

### 🛠️ Admin Panel

* 🔐 Role-Based Access Control (RBAC)
* 🌍 Geographic Hierarchy Management
  *(State → District → Block → Panchayat)*
* 🧩 CMS for Content, Gallery & Tourist Places
* 📊 Dashboard Analytics & Insights

---

## 🧰 Tech Stack

### Backend

| Technology       | Version |
| ---------------- | ------- |
| Laravel          | ^12.0   |
| Jetstream        | ^5.4    |
| Sanctum          | ^4.0    |
| Yajra DataTables | ^12.0   |
| PHP              | ^8.2    |

### Frontend

| Technology   | Version |
| ------------ | ------- |
| Vite         | ^6.0    |
| Tailwind CSS | ^4.0    |
| Bootstrap    | ^5.3    |
| Fancybox     | v5      |
| FontAwesome  | ^6.5    |

---

## ⚙️ Installation Guide

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/Yuvraj8090/grampanchayat.git
cd grampanchayat
```

### 2️⃣ Install Backend Dependencies

```bash
composer install
```

### 3️⃣ Install Frontend Dependencies

```bash
npm install
```

### 4️⃣ Environment Setup

```bash
cp .env.example .env
```

Configure your database in the `.env` file:

```env
DB_DATABASE=gram_panchayat_db
```

### 5️⃣ Generate Application Key

```bash
php artisan key:generate
```

### 6️⃣ Run Migrations

```bash
php artisan migrate
```

### 7️⃣ Create Storage Symlink (Important)

```bash
php artisan storage:link
```

### 8️⃣ Build Frontend Assets

```bash
npm run build
```

---

## ▶️ Usage & Access Points

### Run the Application

```bash
php artisan serve
npm run dev
```

### Application URLs

| Page           | URL               |
| -------------- | ----------------- |
| Home           | `/`               |
| Admin Login    | `/login`          |
| Panchayat Page | `/{id}/panchayat` |

---

## 🛣️ Key Routes

### 🌍 Public Routes

* `/{id}/pradhan-message`
* `/{id}/tourist-places`
* `/{id}/gallery`
* `/{id}/video`

### 🔐 Admin Routes

* `/admin/users`
* `/admin/panchayats`
* `/admin/{panchayat}/gallery`
* `/admin/{panchayat}/places`

---

## 📜 License

This project is licensed under the **MIT License**.

---

## ❤️ Footer

<p align="center">
  Developed with ❤️ by <a href="https://github.com/Yuvraj8090" target="_blank"><b>Yuvraj Kohli</b></a>
</p>
