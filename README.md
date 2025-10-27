# 🏛️ Pelosok - E-Commerce Platform Produk Tradisional Indonesia

<div align="center">
  <img src="public/images/nusantara.jpg" alt="Pelosok Banner" width="100%">
  
  <p>
    <strong>Platform e-commerce modern untuk melestarikan dan mempromosikan produk tradisional Indonesia</strong>
  </p>

  ![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
  ![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
  ![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
  ![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

  [![GitHub Stars](https://img.shields.io/github/stars/kevinriedo-dev/pelosok-ecommerce?style=social)](https://github.com/kevinriedo-dev/pelosok-ecommerce/stargazers)
  [![GitHub Forks](https://img.shields.io/github/forks/kevinriedo-dev/pelosok-ecommerce?style=social)](https://github.com/kevinriedo-dev/pelosok-ecommerce/network/members)
</div>

---

## 📋 Tentang Project

**Pelosok** adalah platform e-commerce yang didedikasikan untuk para masyarakat yang memiliki kebutuhan akan berbagai jenis alat tradisional yang ada diseluruh provinsi di Indoensia, mulai dari baju adat, senjata tradisional, dan juga aksesoris tradisional.

Project ini dibuat sebagai **full-stack e-commerce solution** dengan fitur lengkap untuk customer dan admin panel yang powerful.

---

## ✨ Fitur Utama

### 👤 Customer Features
- 🏠 **Homepage Modern** - Hero section yang menarik dengan animasi smooth
- 🛍️ **Katalog Produk** - Filter berdasarkan kategori dan region
- 🔍 **Pencarian Cepat** - Search functionality yang akurat
- 🛒 **Shopping Cart** - Session-based cart management
- 💳 **Checkout System** - Proses checkout yang user-friendly
- 📦 **Order Tracking** - Lacak status pesanan
- 👨‍💼 **Profile Management** - Kelola profil dan alamat

### 🔐 Admin Features
- 📊 **Dashboard Analytics** - Statistik penjualan real-time
- 📦 **Product Management** - CRUD lengkap dengan multiple image upload
- 🗂️ **Category Management** - Kelola kategori produk
- 🌍 **Region Management** - Kelola region asal produk
- 🎯 **Order Management** - Kelola pesanan customer
- 📈 **Sales Reports** - Laporan penjualan detail

---

## 🛠️ Tech Stack

<table>
<tr>
<td>

**Backend**
- Laravel 10.x
- PHP 8.2
- MySQL 8.0
- Laravel Breeze
- Eloquent ORM

</td>
<td>

**Frontend**
- Bootstrap 5.3
- Font Awesome 6.4
- Google Fonts (Poppins)
- Vanilla JS + jQuery

</td>
</tr>
</table>

**Additional Tools:**
- Laravel Storage (File Upload)
- Laravel Session (Cart Management)
- Laravel Form Request (Validation)

---

## 📁 Struktur Database

### ERD Diagram

```
users
  ├─► orders
  │     └─► order_items ─► products
  │                           ├─► categories
  │                           ├─► regions
  │                           └─► product_images
  └─► (admin access)
```

### Tables
- `users` - User accounts (customer & admin)
- `categories` - Product categories (Pakaian Adat, Senjata, Aksesoris)
- `regions` - Indonesian regions (38 provinces)
- `products` - Product information
- `product_images` - Multiple images per product
- `orders` - Customer orders
- `order_items` - Order details
- `sessions` - Session management

---

## 🚀 Instalasi

### Prerequisites

Pastikan sistem Anda memiliki:
- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Node.js & NPM (optional)

### Setup Instructions

1. **Clone repository**
   ```bash
   git clone https://github.com/kevinriedo-dev/pelosok-ecommerce.git
   cd pelosok-ecommerce
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database configuration**
   
   Edit file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pelosok_db
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

5. **Create database**
   ```sql
   CREATE DATABASE pelosok_db;
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Create storage link**
   ```bash
   php artisan storage:link
   ```

8. **Seed database (optional)**
   ```bash
   php artisan db:seed
   ```

9. **Run development server**
   ```bash
   php artisan serve
   ```

10. **Access application**
    ```
    http://127.0.0.1:8000
    ```

---

## 👨‍💼 Default Admin Access

```
Email: admin@pelosokecommerce.com
Password: [Pelosok_ecom]
```

**Admin Panel:** `http://127.0.0.1:8000/admin/dashboard`

---

## 📸 Screenshots

### Homepage
<img width="1919" height="1020" alt="image" src="https://github.com/user-attachments/assets/1d1eeb39-3a91-46d1-8bc9-833434be5fcf" />
<img width="1919" height="1014" alt="image" src="https://github.com/user-attachments/assets/30f4e5fb-8142-4525-9742-d4e13848e3eb" />

*Modern homepage dengan hero section yang menarik*

### Product Catalog
<img width="1919" height="1014" alt="image" src="https://github.com/user-attachments/assets/f9df7673-e00c-4462-ac36-e4897769ae59" />

*Katalog produk dengan filter kategori dan region*

### Product Detail
<img width="1919" height="1017" alt="image" src="https://github.com/user-attachments/assets/3ff0f583-0633-4f64-a2c5-d73d07403349" />

*Halaman detail produk dengan multiple images*

### Shopping Cart
<img width="1919" height="1017" alt="image" src="https://github.com/user-attachments/assets/826fddd6-18ef-4e90-ab6f-543e81a66b6b" />

*Shopping cart dengan session management*

### Admin Dashboard
<img width="1919" height="1016" alt="image" src="https://github.com/user-attachments/assets/68ae9881-13c0-4ff3-8a27-d69812ed9b56" />
<img width="1919" height="1016" alt="image" src="https://github.com/user-attachments/assets/b90032f1-3ee6-4035-8051-5c9b32bff988" />
<img width="1914" height="1018" alt="image" src="https://github.com/user-attachments/assets/a343ae12-fc6e-4422-948c-7a88e96089d8" />
<img width="1919" height="1018" alt="image" src="https://github.com/user-attachments/assets/86389759-c063-4472-9873-b32a90eeaccb" />

*Admin panel dengan statistik penjualan*

---

## 🎨 Design Features

### UI/UX Highlights
- ✅ **Responsive Design** - Website-first approach
- ✅ **Modern Typography** - Clean & readable (Poppins font family)
- ✅ **Sophisticated Color Palette**
  - Primary: `#D9BCA6` (Warm Beige)
  - Secondary: `#8B7355` (Rich Brown)
  - Text: `#2C1810` (Deep Brown)
- ✅ **Smooth Animations** - Subtle hover effects & transitions
- ✅ **Accessibility** - Semantic HTML & ARIA labels
- ✅ **Professional Layout** - Clean grid system dengan generous whitespace

---

## 🔒 Security Features

- ✅ **CSRF Protection** - Laravel default security
- ✅ **SQL Injection Prevention** - Eloquent ORM parameterized queries
- ✅ **XSS Protection** - Blade templating engine
- ✅ **Password Hashing** - Bcrypt algorithm
- ✅ **Session Security** - Secure session management
- ✅ **Input Validation** - Form Request validation
- ✅ **Admin Middleware** - Role-based access control

---

## 📦 API Endpoints

### Public Endpoints
```http
GET  /                          # Homepage
GET  /shop                      # Product catalog
GET  /shop/{slug}               # Product detail page
GET  /cart                      # Shopping cart
POST /cart/add                  # Add product to cart
POST /cart/update               # Update cart quantity
POST /cart/remove               # Remove item from cart
```

### Protected Endpoints (Authentication Required)
```http
GET  /checkout                  # Checkout page
POST /checkout/process          # Process order
GET  /account/orders            # Order history
GET  /account/orders/{id}       # Order detail
GET  /account/profile           # User profile
PUT  /account/profile           # Update profile
```

### Admin Endpoints (Admin Only)
```http
GET  /admin/dashboard           # Admin dashboard
GET  /admin/products            # Product list
GET  /admin/products/create     # Create product form
POST /admin/products            # Store new product
GET  /admin/products/{id}/edit  # Edit product form
PUT  /admin/products/{id}       # Update product
DELETE /admin/products/{id}     # Delete product
GET  /admin/categories          # Category management
GET  /admin/regions             # Region management
GET  /admin/orders              # Order management
```

---

### Recommended Hosting Platforms

- **Railway.app** - Easy Laravel deployment with MySQL
- **DigitalOcean** - Professional VPS hosting
- **AWS** - Enterprise-grade cloud hosting
- **Heroku** - Simple deployment (with PostgreSQL)

---

## 👨‍💻 Author

**Kevin Riedo**

Full Stack Developer specializing in Laravel & Modern Web Development

- 🌐 Portfolio: [kevinriedo-dev.github.io](https://kevinriedo-dev.github.io)
- 💼 GitHub: [@kevinriedo-dev](https://github.com/kevinriedo-dev)
- 📧 Email: kevinriedowork@gmail.com
- 📱 Phone: +62 821-3161-8236
- 💼 LinkedIn: [Kevin Riedo](https://linkedin.com/in/kevinriedo)

---

## 🙏 Acknowledgments

Special thanks to:

- **Laravel Framework** - For the powerful PHP framework
- **Bootstrap Team** - For the responsive CSS framework
- **Font Awesome** - For the beautiful icon library
- **Indonesian Cultural Heritage** - For the inspiration
- **Open Source Community** - For the amazing tools and libraries

---

## 📞 Support & Contact

Jika Anda memiliki pertanyaan, saran, atau menemukan bug, jangan ragu untuk:

- 📧 Email: kevinriedowork@gmail.com
- 🐛 Open an issue: [GitHub Issues](https://github.com/kevinriedo-dev/pelosok-ecommerce/issues)
- 💬 Start a discussion: [GitHub Discussions](https://github.com/kevinriedo-dev/pelosok-ecommerce/discussions)

---

<div align="center">
  <p>
    <strong>Made with ❤️ for Indonesian Culture</strong>
  </p>
  <p>
    © 2025 Kevin Riedo. All rights reserved.
  </p>
  <p>
    <a href="https://github.com/kevinriedo-dev/pelosok-ecommerce">⭐ Star this repo if you find it helpful!</a>
  </p>
</div>
