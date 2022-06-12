Hướng dẫn cài đặt: (Điều kiện: Đã cài đặt composer, php version của xampp phải ở 7.4.29)
1. add thư mục Web_sach_nhom10 vào htdocs
2. Khởi chạy xampp, mở phpmyadmin và import file web_sach_nhom10.sql nằm trong database để có dữ liệu
3. mở cmd, gõ cd + link thư mục Web_sach_nhom10 nằm trong htdocs ở ổ C (VD: cd C:\xampp\htdocs\Web_sach_nhom10)
4. chạy lệnh composer update để cập nhập dữ liệu vào composer
5. chạy lệnh php artisan serve, cop link http://127.0.0.1:8000 vào trình duyệt để chạy trang web
