CREATE TABLE sellers (
	id_seller Int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	fastname varchar(255) NOT NULL,
    lastname varchar(255) NOT NULL,
    idcard varchar(13) NOT NULL,
    phone varchar(10) NOT NULL,
    gender varchar(255) NOT NULL,
    birthday DATE NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    role varchar(255) NOT NULL DEFAULT 'seller'
    ) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE shops (
	id_shop Int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_seller Int(11) NOT NULL,
    id_area Int(11) NOT NULL,
    nameshop varchar(255) NOT NULL,
    lat varchar(255) NOT NULL,
    lon varchar(255) NOT NULL,
    regdate timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_seller) REFERENCES sellers(id_seller)

    ) ENGINE=INNODB DEFAULT CHARSET=utf8;


CREATE TABLE products (
    id_products int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_shop int(11) NOT NULL,
    name varchar (255) NOT NULL,
    description varchar(255) NOT NULL,
    category varchar(255) NOT NULL,
    price  FLOAT NOT NULL,
    imgUrl varchar(255) NOT NULL,
    regdate timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_shop) REFERENCES shops(id_shop)
)ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE admins (
	id_admin Int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	fastname varchar(255) NOT NULL,
    lastname varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    role varchar(255) NOT NULL DEFAULT 'admin'
    ) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE managers (
	id_manager Int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	fastname varchar(255) NOT NULL,
    lastname varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    role varchar(255) NOT NULL DEFAULT 'manager'
    ) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE promotion (
	id_promotion Int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    imgUrl varchar(255) NOT NULL,
    regdate timestamp NULL DEFAULT CURRENT_TIMESTAMP
    
    ) ENGINE=INNODB DEFAULT CHARSET=utf8;