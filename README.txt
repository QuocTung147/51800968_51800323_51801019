Đồ án cuối kỳ môn học Công nghệ phần mềm (502045)

1. Mô tả: Website quản lý trung tâm tin học

2. Danh sách thành viên
	- 51800323: Đỗ Vũ Quốc Tùng
	- 51800968: Phạm Văn Đức
	- 51801019: Nguyễn Liu Tiến Tài

3. Link đã deploy:
	

4. Cách chạy demo
	1. Copy nội dung trong thư mục 'source' vào trong 'htdocs' của XAMPP
	2. Vào file config.php điều chỉnh thông tin trong function getDB() cho phù hợp với cài đặt của máy hiện tại.
	3. Tiếp tục trong config.php chỉnh sửa trong sendResetEmail() và sendActivationEmail() đổi đường dẫn từ https://localhost:8080
		thành https://localhost: + số port XAMPP của máy hiện tại để đảm bảo việc active có thể thành công. 
	4. Import 'database.sql' vào phpMyAdmin
	5. Khởi động XAMPP và truy cập http://localhost
		Tài khoản admin: admin - 123456
		Tài khoản dev: duckvan - 123456
		Tài khoản user: nguyentranlc - 123456

5. Lưu Ý
	Mail gửi sau khi đăng ký tài khoản, quên mật khẩu có thể bị cho vào thư mục spam
