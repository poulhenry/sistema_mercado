CREATE DATABASE mercado_softexpert;

CREATE TABLE public.product_tax (
  id serial NOT NULL,
  name character varying(255) NOT NULL,
  tax numeric NOT NULL
);

ALTER TABLE public.product_tax ADD CONSTRAINT product_tax_pkey PRIMARY KEY (id);

insert into "public"."product_tax" ("id", "name", "tax") values (1, 'ICMS', '0.18');
insert into "public"."product_tax" ("id", "name", "tax") values (2, 'IPI', '0.1');
insert into "public"."product_tax" ("id", "name", "tax") values (3, 'COFINS', '0.076');
insert into "public"."product_tax" ("id", "name", "tax") values (4, 'PIS', '0.0165');

CREATE TABLE public.product_type (
  id serial NOT NULL,
  name character varying(255) NOT NULL,
  id_product_tax integer NULL
);

ALTER TABLE public.product_type ADD CONSTRAINT product_type_pkey PRIMARY KEY (id);

insert into "public"."product_type" ("id_product_tax", "name") values (1, 'Eletrônicos');
insert into "public"."product_type" ("id_product_tax", "name") values (2, 'Roupas');
insert into "public"."product_type" ("id_product_tax", "name") values (3, 'Alimentos');
insert into "public"."product_type" ("id_product_tax", "name") values (4, 'Livros');

CREATE TABLE public.products (
  id serial NOT NULL,
  name character varying(255) NULL,
  description character varying(255) NULL,
  price numeric NULL,
  id_product_tax integer NULL,
  id_product_type integer NULL,
  created_at timestamp without time zone NOT NULL DEFAULT now()
);

ALTER TABLE public.products ADD CONSTRAINT products_pkey PRIMARY KEY (id);

insert into "public"."products" ("created_at", "description", "id_product_tax", "id_product_type", "name", "price") values ('2024-03-01 00:00:00', 'Modelo top de linha', 1, 1, 'Smartphone', '1500.00');
insert into "public"."products" ("created_at", "description", "id_product_tax", "id_product_type", "name", "price") values ('2024-03-02 00:00:00', 'Camiseta de algodão', 2, 2, 'Camiseta', '29.99');
insert into "public"."products" ("created_at", "description", "id_product_tax", "id_product_type", "name", "price") values ('2024-03-03 00:00:00', 'Arroz branco', 3, 3, 'Arroz', '10.00');
insert into "public"."products" ("created_at", "description", "id_product_tax", "id_product_type", "name", "price") values ('2024-03-04 00:00:00', 'Best-seller do ano', 4, 4, 'Livro', '39.90');
insert into "public"."products" ("created_at", "description", "id_product_tax", "id_product_type", "name", "price") values ('2024-03-05 00:00:00', 'Tablet com tela HD', 1, 1, 'Tablet', '600.00');
insert into "public"."products" ("created_at", "description", "id_product_tax", "id_product_type", "name", "price") values ('2024-03-06 00:00:00', 'Calça jeans masculina', 2, 2, 'Calça Jeans', '79.99');
insert into "public"."products" ("created_at", "description", "id_product_tax", "id_product_type", "name", "price") values ('2024-03-07 00:00:00', 'Feijão carioca', 3, 3, 'Feijão', '8.50');
insert into "public"."products" ("created_at", "description", "id_product_tax", "id_product_type", "name", "price") values ('2024-03-08 00:00:00', 'Edição especial', 4, 4, 'HQ', '49.90');
insert into "public"."products" ("created_at", "description", "id_product_tax", "id_product_type", "name", "price") values ('2024-03-09 00:00:00', 'Notebook de última geração', 1, 1, 'Notebook', '2000.00');
insert into "public"."products" ("created_at", "description", "id_product_tax", "id_product_type", "name", "price") values ('2024-03-10 00:00:00', 'Vestido estampado', 2, 2, 'Vestido', '59.99');


CREATE TABLE public.sales (
  id serial NOT NULL,
  created_at timestamp without time zone NOT NULL DEFAULT now(),
  id_product integer NOT NULL,
  quantity integer NULL,
  price_total numeric NULL
);

ALTER TABLE public.sales ADD CONSTRAINT sales_pkey PRIMARY KEY (id);

insert into "public"."sales" ("created_at", "id_product", "price_total", "quantity") values ('2024-03-01 00:00:00', 1, '3000.00', 2);
insert into "public"."sales" ("created_at", "id_product", "price_total", "quantity") values ('2024-03-02 00:00:00', 2, '50.00', 5);
insert into "public"."sales" ("created_at", "id_product", "price_total", "quantity") values ('2024-03-03 00:00:00', 3, '600.00', 1);
insert into "public"."sales" ("created_at", "id_product", "price_total", "quantity") values ('2024-03-04 00:00:00', 4, '25.50', 3);
insert into "public"."sales" ("created_at", "id_product", "price_total", "quantity") values ('2024-03-05 00:00:00', 5, '2000.00', 1);
insert into "public"."sales" ("created_at", "id_product", "price_total", "quantity") values ('2024-03-06 00:00:00', 6, '120.00', 2);
insert into "public"."sales" ("created_at", "id_product", "price_total", "quantity") values ('2024-03-07 00:00:00', 7, '199.60', 4);
insert into "public"."sales" ("created_at", "id_product", "price_total", "quantity") values ('2024-03-08 00:00:00', 8, '39.99', 1);
insert into "public"."sales" ("created_at", "id_product", "price_total", "quantity") values ('2024-03-09 00:00:00', 9, '10.50', 3);
insert into "public"."sales" ("created_at", "id_product", "price_total", "quantity") values ('2024-03-10 00:00:00', 10, '20.00', 2);
insert into "public"."sales" ("created_at", "id_product", "price_total", "quantity") values ('2024-03-11 00:00:00', 1, '59.99', 1);
insert into "public"."sales" ("created_at", "id_product", "price_total", "quantity") values ('2024-03-12 00:00:00', 2, '150.00', 3);
insert into "public"."sales" ("created_at", "id_product", "price_total", "quantity") values ('2024-03-13 00:00:00', 3, '79.99', 1);
insert into "public"."sales" ("created_at", "id_product", "price_total", "quantity") values ('2024-03-14 00:00:00', 4, '20.00', 2);
insert into "public"."sales" ("created_at", "id_product", "price_total", "quantity") values ('2024-03-15 00:00:00', 5, '80.00', 4);
insert into "public"."sales" ("created_at", "id_product", "price_total", "quantity") values ('2024-03-16 00:00:00', 6, '12.00', 1);
insert into "public"."sales" ("created_at", "id_product", "price_total", "quantity") values ('2024-03-17 00:00:00', 7, '600.00', 2);
insert into "public"."sales" ("created_at", "id_product", "price_total", "quantity") values ('2024-03-18 00:00:00', 8, '60.00', 3);
insert into "public"."sales" ("created_at", "id_product", "price_total", "quantity") values ('2024-03-19 00:00:00', 9, '10.00', 1);
insert into "public"."sales" ("created_at", "id_product", "price_total", "quantity") values ('2024-03-20 00:00:00', 10, '59.80', 2);

