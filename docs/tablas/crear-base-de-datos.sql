create database curso_bd character set utf8;

# Crear el usuario
create user userdb@'localhost' identified by '1234qwer!A';
grant all on curso_bd.* to 'userdb'@'localhost';
flush privileges;