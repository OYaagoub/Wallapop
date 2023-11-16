create database wallapop;
use wallapop;
create table users(
    id int not null AUTO_INCREMENT primary key,
    email varchar(100) unique,
    password varchar(255),
    logcode varchar(500) null unique,
    fullname varchar(30) not null,
    phone varchar(20) not null,
    poblacion varchar(20) not null,
    photo varchar(255) not null,


    
);
create table anuncios(
    id int not null AUTO_INCREMENT primary key,
    title varchar(100) not null,
    description varchar(255),
    price varchar(20) not null,
    image varchar(255) not null,
    id_user int not null,
    FOREIGN KEY(id_user) references users(id)


    
);
create table images(
    id int not null AUTO_INCREMENT primary key,
    image varchar(255) not null,
    id_ano int not null,
    FOREIGN KEY(id_ano) references anuncios(id)
    
    
);