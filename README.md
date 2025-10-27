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

**Pelosok** adalah platform e-commerce yang didedikasikan untuk melestarikan warisan budaya Indonesia melalui produk tradisional autentik. Platform ini memungkinkan pengrajin lokal untuk menjual produk mereka secara online, sekaligus memberikan kemudahan bagi pembeli untuk menemukan dan membeli produk tradisional berkualitas tinggi.

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
Email: kvnriedo@gmail.com
Password: [Your Admin Password]
```

**Admin Panel:** `http://127.0.0.1:8000/admin/dashboard`

---

## 📸 Screenshots

### Homepage
![Homepage](docs/screenshots/homepage.png)
*Modern homepage dengan hero section yang menarik*

### Product Catalog
![Product Catalog](docs/screenshots/shop.png)
*Katalog produk dengan filter kategori dan region*

### Product Detail
![Product Detail](docs/screenshots/product-detail.png)
*Halaman detail produk dengan multiple images*

### Shopping Cart
![Shopping Cart](docs/screenshots/cart.png)
*Shopping cart dengan session management*

### Admin Dashboard
![Admin Dashboard](docs/screenshots/admin-dashboard.png)
*Admin panel dengan statistik penjualan*

---

## 🎨 Design Features

### UI/UX Highlights
- ✅ **Responsive Design** - Mobile-first approach
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

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test --filter ProductTest

# Run with coverage
php artisan test --coverage
```

---

## 🚀 Deployment

### Production Checklist

- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Configure production database credentials
- [ ] Run optimization commands:
  ```bash
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  php artisan optimize
  ```
- [ ] Set proper file permissions (755 for directories, 644 for files)
- [ ] Configure web server (Apache/Nginx)
- [ ] Enable HTTPS with SSL certificate
- [ ] Setup automated backups
- [ ] Configure error monitoring (Sentry, Bugsnag)

### Recommended Hosting Platforms

- **Railway.app** - Easy Laravel deployment with MySQL
- **DigitalOcean** - Professional VPS hosting
- **AWS** - Enterprise-grade cloud hosting
- **Heroku** - Simple deployment (with PostgreSQL)

---

## 🤝 Contributing

Contributions are welcome! If you'd like to contribute, please:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Coding Standards

- Follow PSR-12 coding standards
- Write meaningful commit messages
- Add comments for complex logic
- Write tests for new features
- Update documentation as needed

---

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

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