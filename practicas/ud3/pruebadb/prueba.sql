drop table if exists depart cascade;

create table depart (
    id bigserial primary key,
    denom varchar(255) not null,
    localidad varchar(255)
);

drop table if exists emple cascade;

create table emple (
    id bigserial primary key,
    nombre varchar(255) not null,
    fecha_alt timestamp,
    salario numeric(6, 2),
    depart_id bigint not null references depart(id)
);

drop function if exists preparar(text)  cascade;
create function preparar(cadena text) returns text
language plpgsql as $$
begin
    return translate(lower(cadena), 'áéíóú', 'aeiou');
end;$$;

insert into
    depart (denom, localidad)
values
    ('Contabilidad', 'Sanlucar'),
    ('Informática', 'Jerez'),
    ('Inglés', 'Londres'),
    ('Matemáticas', 'Trebujena'),
    ('Cibernética', 'Chipiona');


insert into
    emple (nombre, fecha_alt, salario, depart_id)
values
    ('Manolo', '2019-12-04 17:00:00', 2340.75, 2),
    ('Rosa', '2020-04-05 14:00:00', 2874.99, 4);
