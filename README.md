# 📝 Task Management System

Hệ thống quản lý công việc đơn giản sử dụng **Laravel** và **Tailwind CSS**, hỗ trợ quản lý công việc, xem lịch trình và theo dõi trạng thái công việc một cách trực quan.

## 🚀 Tính năng chính

- 👋 **Quản lý công việc:** Tạo, sửa, xóa công việc với mô tả, ngày hết hạn và trạng thái.
- 🎨 **Giao diện trực quan:** Hiển thị danh sách công việc với màu sắc phân biệt theo trạng thái.
- 📅 **Trang Lịch:** Hiển thị công việc trên lịch FullCalendar, giúp dễ dàng theo dõi.
- 📊 **Dashboard:** Thống kê nhanh số lượng công việc theo trạng thái.
- 🔍 **Tìm kiếm & Lọc:** Hỗ trợ tìm kiếm theo tên công việc và lọc theo trạng thái.
- 🔒 **Xác thực người dùng:** Sử dụng Laravel Breeze để xử lý đăng nhập & đăng ký.

---

## 🛠️ Cài đặt

### 1️⃣ Yêu cầu hệ thống

- PHP `>= 8.1`
- Composer
- Node.js & npm
- MySQL hoặc SQLite

### 2️⃣ Clone repository
```sh
git clone https://github.com/namthanhit/TaskManagement.git
cd task-management
```

### 3️⃣ Cài đặt dependencies
```sh
composer install
npm install
```

### 4️⃣ Cấu hình môi trường
```sh
cp .env.example .env
php artisan key:generate
```
**Cập nhật thông tin kết nối database trong `.env`**  
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5️⃣ Chạy migration & seed dữ liệu
```sh
php artisan migrate --seed
```

### 6️⃣ Build frontend & khởi chạy server
```sh
npm run build
npm run dev
php artisan serve
```
Mở trình duyệt và truy cập: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🎨 Hướng dẫn sử dụng

### **1. Đăng nhập**
- Đăng ký tài khoản nếu chưa có.
- Đăng nhập để bắt đầu sử dụng hệ thống.

### **2. Quản lý công việc**
- Nhấn **"Thêm công việc"** để tạo task mới.
- Nhấn **"Sửa"** để chỉnh sửa task.
- Nhấn **"Xóa"** để xóa task.

### **3. Sử dụng lịch**
- Vào mục **"Lịch"** để xem công việc theo ngày.
- Nhấn vào sự kiện trên lịch để xem chi tiết.

### **4. Dashboard**
- Xem thống kê số lượng công việc theo trạng thái.

---

## ⚙️ Cấu trúc thư mục chính
```
💚 task-management
🗂️ app/Http/Controllers      # Controllers xử lý logic
🗂️ app/Models                # Mô hình dữ liệu (Eloquent)
🗂️ database/migrations       # Các file migration database
🗂️ resources/views           # Blade templates
🗂️ public                    # Assets (CSS, JS, images)
🗂️ routes                    # Định tuyến Laravel
🗂️ resources/js              # Mã nguồn frontend (Vue/Tailwind)
📂 .env                      # Cấu hình môi trường
```



