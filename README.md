## Quy trình chạy dự án

**Bước 1:**
clone dự án từ github

```bash
git clone https://github.com/Lethilinh2501/Booking_hotel.git
```

**Bước 2:**
cài đặt toàn bộ thư viện JS
```bash
# create node_moduels folder
npm i
```

**Bước 3:**
cài đặt toàn bộ thư viện PHP
```bash
composer update
```

**Bước 4:**
Tạo file biến môi trường `.env`
- copy file `.env.example` => `.env`
- cấu hình file `.env`

**Bước 5:**
Buil css, js qua thư mục public
```bash
npm run build
```

**Bước 6:**
tạo DB và tạo bảng trong DB
```bash
php artisan migrate
```

**Bước 7:**
Tạo dữ liệu mẫu
```bash
php artisan db:seed
```

**Bước 8:**
```bash
# APP_KEY
php artisan key:generate
```

**Bước 9:**
Khởi chạy dự án
- cách 1:
```bash
# chạy JS library
npm run dev
# chạy PHP serve
php artisan serve
```
- cách 2:
```bash
composer run dev
```