CREATE TABLE IF NOT EXISTS orderhistory (
  id int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  userid varchar(255) NOT NULL,
  total double(10,2) NOT NULL,
  des text NOT NULL
);