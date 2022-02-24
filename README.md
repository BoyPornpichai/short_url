Installation: 
Install Xammp สำหรับสร้าง server และ DB Mysql 
(https://www.apachefriends.org/index.html)
Install NGROK สำหรับจำลอง host ที่เครื่องตัวเอง  (URL ที่ได้มาจะทำการเปลี่ยนทุกครั้งเมื่อมีการปิดหรือเปิดใช้งาน Ngrok)
(https://medium.com/linedevth/%E0%B8%97%E0%B8%B3-php-line-webhook-%E0%B8%87%E0%B9%88%E0%B8%B2%E0%B8%A2%E0%B9%86-%E0%B9%84%E0%B8%A1%E0%B9%88%E0%B8%95%E0%B9%89%E0%B8%AD%E0%B8%87%E0%B8%87%E0%B9%89%E0%B8%AD-server-%E0%B8%94%E0%B9%89%E0%B8%A7%E0%B8%A2-ngrok-ep-7-596c34f298c2)


Create a database with a user and run this sql 

`CREATE TABLE IF NOT EXISTS `url_shorten` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `url` varchar(255)NOT NULL,
 `short_code` varchar(255) NOT NULL,
 `hits` int(11) NOT NULL,
 `added_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
`
วิธีทำ
1.สร้าง input url สำหรับผู้ใช้ใส่เว็บ ที่ต้อง short url
2.เมื่อผู้ใช้กด submit ระบบจะทำการ แปลง ลิ้งโดยการสุ่ม 4 หลัก  และจัดเก็บใน ฐานข้อมูล( MYSQL) และได้มีการนำ .htaccess มาใช้สำหรับ  RewriteRule redirect ของ  short url
 EX.Input --> https://www.youtube.com/watch?v=MNHN_BxkfYU
    Output --> https://Domain web/2250 (ผมใช้ NGROK ทำให้ domain web ไม่แน่นอนครับ)
3.QR Code ใช้ googleapi สำหรับ generate QR เมื่อ ผู้ทำการ สแกน QR Code จะเห็นเป็นลิ้ง ของ short url แต่เวลาเข้าเว็บ จะเป็นเว็บจริง
4.ผู้ใช้สามารถตรวจสอบ รายการประวัติการสร้าง Short URL ได้
