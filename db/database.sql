




CREATE TABLE `product`
(
 `id`      bigint NOT NULL AUTO_INCREMENT ,
 `name`    varchar(45) NOT NULL ,
 `price` float NOT NULL ,
 `rate`  float NOT NULL ,

PRIMARY KEY (`id`)
);
CREATE TABLE `user`
(
 `id`       bigint NOT NULL AUTO_INCREMENT ,
 `name`     varchar(45) NOT NULL ,
 `password` varchar(45) NOT NULL ,
 `balance`  float NOT NULL ,
 `email`    varchar(45) NOT NULL,
 UNIQUE (`email`),

PRIMARY KEY (`id`)
);

CREATE TABLE `rate`
(
 `id`         bigint NOT NULL AUTO_INCREMENT ,
 `product_id` bigint NOT NULL ,
 `user_id`    bigint NOT NULL ,
 `value`      float NOT NULL ,

PRIMARY KEY (`id`),
KEY `fkIdx_29` (`product_id`),
CONSTRAINT `FK_28` FOREIGN KEY `fkIdx_29` (`product_id`) REFERENCES `Product` (`id`),
KEY `fkIdx_32` (`user_id`),
CONSTRAINT `FK_31` FOREIGN KEY `fkIdx_32` (`user_id`) REFERENCES `User` (`id`)
);


insert into product (name,price,rate) value ('apple', 0.3,0);
insert into product (name,price,rate) value ('beer', 2,0);
insert into product (name,price,rate) value ('water', 1,0);