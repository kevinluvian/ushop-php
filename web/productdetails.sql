CREATE TABLE IF NOT EXISTS productdetails (
  id int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(255) NOT NULL,
  image text NOT NULL,
  stock int(8) NOT NULL,
  price double(10,2) NOT NULL
);

INSERT INTO productdetails (id, name, image, stock, price) VALUES
(1, 'Grey Classic Tee', 'img/apparels/apparels1.png', 50, 12.00),
(2, 'Red Classic Tee', 'img/apparels/apparels2.png', 50, 12.00),
(3, 'Black Classic Tee', 'img/apparels/apparels3.png', 50, 12.00),
(4, 'White Classic Tee', 'img/apparels/apparels4.png', 50, 12.00),
(5, 'Box Classic Tee', 'img/apparels/apparels5.png', 50, 15.00),
(6, 'Graphic Design Tee', 'img/apparels/apparels6.png', 50, 15.00),
(7, 'Short Raglan Tee', 'img/apparels/apparels7.png', 50, 15.00),
(8, 'Long Raglan Tee', 'img/apparels/apparels8.png', 50, 17.50),
(9, 'Grey Hoodie (Pullover)', 'img/apparels/apparels9.png', 50, 30.00),
(10, 'Navy Hoodie (Pullover)', 'img/apparels/apparels10.png', 50, 30.00),
(11, 'Black Dry-Fit Singlet', 'img/apparels/apparels11.png', 50, 15.00),
(12, 'Red Dry-Fit Singlet', 'img/apparels/apparels12.png', 50, 15.00),
(13, 'White Dry-Fit Singlet', 'img/apparels/apparels13.png', 50, 15.00),
(14, 'Navy Dry-Fit Singlet', 'img/apparels/apparels14.png', 50, 15.00),
(15, 'Grey Dry-Fit Singlet', 'img/apparels/apparels15.png', 50, 15.00),
(16, 'White Baseball Cap', 'img/accessories/accessories1.png', 50, 16.00),
(17, 'Beige Baseball Cap', 'img/accessories/accessories2.png', 50, 16.00),
(18, 'Black Baseball Cap', 'img/accessories/accessories3.png', 50, 16.00),
(19, 'Navy Baseball Cap', 'img/accessories/accessories4.png', 50, 16.00),
(20, 'Clear NTU Mug', 'img/accessories/accessories5.png', 50, 10.00),
(21, 'Red NTU Mug', 'img/accessories/accessories6.png', 50, 10.00),
(22, 'Navy NTU Mug', 'img/accessories/accessories7.png', 50, 10.00),
(23, 'Twin Mug Pack', 'img/accessories/accessories8.png', 50, 18.50),
(24, 'Lyon Flashdrive (32GB)', 'img/accessories/accessories9.png', 50, 20.00),
(25, 'Lyon Key Chain', 'img/accessories/accessories10.png', 50, 5.00),
(26, 'Hive Key Chain', 'img/accessories/accessories11.png', 50, 6.00),
(27, 'NTU Lanyard', 'img/accessories/accessories12.png', 50, 5.00),
(28, 'Blue NTU Umbrella', 'img/accessories/accessories13.png', 50, 15.00),
(29, 'Grey NTU Umbrella', 'img/accessories/accessories14.png', 50, 15.00),
(30, 'Black NTU Umbrella', 'img/accessories/accessories15.png', 50, 15.00),
(31, 'Twin Pack Umbrella', 'img/accessories/accessories16.png', 50, 28.00);
