create database edificio;
use edificio;

create table documento(
id int auto_increment,
descripcion varchar(100),
primary key (id)
);
create table visitante(
id int auto_increment,
nombres varchar(100),
apellidos varchar(100),
tipoDocumento int,
numeroDocumento varchar(20),
motivoVisita varchar(300),
primary key (id),
foreign key (tipoDocumento) references documento(id)
);

insert into documento(descripcion) values ('Cédula de ciudadanía');
insert into visitante(nombres,apellidos,tipoDocumento,numeroDocumento,motivoVisita) values ('Laura Sofía','Sarmiento Molina',1,'1032497924','Pruebas de NYGSoft');
