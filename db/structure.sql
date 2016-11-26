create table if NOT EXISTS p_user (
    user_id integer not null primary key auto_increment,
    user_name varchar(50) not null,
    user_password varchar(88) not null,
    user_salt varchar(23) not null,
    user_mail varchar(50) not null,
    user_role varchar(50) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

