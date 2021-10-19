drop table if exists depart cascade;

create table depart
(
    id          bigserial       primary key,
    nombre      varchar(255)    not null,
    localidad   varchar(255)
);

insert into depart (nombre, localidad)
values  ('Contabilidad', 'Sanlucar'),
        ('Informática', 'Jerez'),
        ('Inglés', 'Londres'),
        ('Matemáticas', 'Trebujena'),
        ('Cibernética', 'Chipiona');
