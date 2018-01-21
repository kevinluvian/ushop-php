CREATE TABLE IF NOT EXISTS customeraccount (
  id int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(255) NOT NULL,
  email varchar(50) NOT NULL,
  password varchar(50) NOT NULL,
  telephone int(10) NOT NULL
);
