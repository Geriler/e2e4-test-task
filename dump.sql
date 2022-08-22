create table currencies
(
    id      integer generated always as identity
        constraint id
            primary key,
    name    varchar(100) not null,
    code    varchar(3)   not null,
    nominal integer      not null
);

create table exchange_rates
(
    id          integer generated always as identity
        constraint primary_key_id
            primary key,
    value       double precision not null,
    date        varchar(10)      not null,
    currency_id integer          not null
        constraint currency_id_currencies_id
            references currencies
);
