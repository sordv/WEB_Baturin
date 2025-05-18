CREATE TABLE items (
    id SERIAL PRIMARY KEY,
    parent_id INTEGER REFERENCES items(id),
    name VARCHAR(30) NOT NULL
);

INSERT INTO items (id, parent_id, name) VALUES
(1, NULL, 'Каталог товаров'),
(2, 1, 'Мойки'),
(3, 2, 'Ulgran'),
(4, 3, 'Smth'),
(5, 3, 'Smth'),
(6, 2, 'Vigro Mramor'),
(7, 2, 'Handmade'),
(8, 7, 'Smth'),
(9, 7, 'Smth'),
(10, 2, 'Vigro Glass'),
(11, 1, 'Фильтры'),
(12, 11, 'Ulgran'),
(13, 12, 'Smth'),
(14, 12, 'Smth'),
(15, 11, 'Vigro Mramor');