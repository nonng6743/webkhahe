CREATE TABLE users (
	id_user Int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	firstname varchar(255) NOT NULL,
    lastname varchar(255) NOT NULL,
    phone varchar(10) NOT NULL,
    gender varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    role varchar(255) NOT NULL DEFAULT 'user'
    image varchar(255) NOT NULL DEFAULT 'proflie.jpg'
    ) ENGINE=INNODB DEFAULT CHARSET=utf8;



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

CREATE TABLE categorys (
	id_categorys Int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    namecategory varchar(255) NOT NULL,
    imgUrl varchar(255) NOT NULL,
    regdate timestamp NULL DEFAULT CURRENT_TIMESTAMP
    
    ) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE actionclickuser (
	id_actionclickuser Int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_user Int(11) NOT NULL,
    id_products int(11) NOT NULL,
    regdate timestamp NULL DEFAULT CURRENT_TIMESTAMP
    
    ) ENGINE=INNODB DEFAULT CHARSET=utf8;


CREATE TABLE area (
	id_area Int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_seller Int(11) NOT NULL DEFAULT 0  ,
    namearea varchar(255) NOT NULL,
    image varchar(255) NOT NULL,
    lat varchar(255) NOT NULL,
    lng varchar(255) NOT NULL,
    regdate timestamp NULL DEFAULT CURRENT_TIMESTAMP
    

    ) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE reserve_area (
	id_reserve_area Int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_seller Int(11) NOT NULL ,
    id_area Int(11) NOT NULL,
    regdate timestamp NULL DEFAULT CURRENT_TIMESTAMP
    

    ) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE reports (
	id_report Int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_user Int(255) ,
    message varchar(255) NOT NULL,
    regdate timestamp NULL DEFAULT CURRENT_TIMESTAMP
    

    ) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE reserve_area (
	id_reserve_area Int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_seller Int(11) ,
    id_area Int(11) ,
    regdate timestamp NULL DEFAULT CURRENT_TIMESTAMP
    

    ) ENGINE=INNODB DEFAULT CHARSET=utf8;


CREATE TABLE chart (
	id_chart Int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    message varchar(255), 
    id_user Int(11) ,
    id_seller Int(11) ,
    status varchar(255),
    regdate timestamp NULL DEFAULT CURRENT_TIMESTAMP
    

    ) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE chatmanager (
	id_chatmanager Int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    message varchar(255), 
    manager Int(11) DEFAULT '1' ,
    id_seller Int(11) ,
    status varchar(255),
    regdate timestamp NULL DEFAULT CURRENT_TIMESTAMP
    

    ) ENGINE=INNODB DEFAULT CHARSET=utf8;

root
?BnG]A7c/<r7seJn