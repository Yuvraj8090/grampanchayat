<<<<<<< HEAD
# 🏛️ Gram Panchayat Management System

![Laravel](https://img.shields.io/badge/Laravel-12-red?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2-blue?logo=php)
![Tailwind](https://img.shields.io/badge/Tailwind_CSS-4-38B2AC?logo=tailwindcss)
![License](https://img.shields.io/badge/License-MIT-green)

<img src="https://placehold.co/1000x400" alt="Project Demo" />
=======
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).
>>>>>>> parent of 79ad67ab (Update README.md)

Laravel is accessible, powerful, and provides tools required for large, robust applications.

<<<<<<< HEAD
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
=======
## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.
>>>>>>> parent of 79ad67ab (Update README.md)

## Laravel Sponsors

<<<<<<< HEAD
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
=======
We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
>>>>>>> parent of 79ad67ab (Update README.md)
