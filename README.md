## Laravel

api/users/{user}/ward

для получения информации о подопечном

## PostgreSql

#### -- Создание таблицы users

CREATE TABLE users (
id SERIAL PRIMARY KEY,
name VARCHAR(255) NOT NULL
);

#### -- Создание таблицы carts с внешним ключом на users

CREATE TABLE carts (
id SERIAL PRIMARY KEY,
user_id INTEGER REFERENCES users(id) ON DELETE CASCADE -- Каскадное удаление корзины при удалении пользователя
);

#### -- Создание таблицы items

CREATE TABLE items (
id SERIAL PRIMARY KEY,
name VARCHAR(255) NOT NULL
);

#### -- Создание таблицы orders с внешними ключами на users, carts и items

CREATE TABLE orders (
id SERIAL PRIMARY KEY,
user_id INTEGER REFERENCES users(id) ON DELETE CASCADE, -- Каскадное удаление заказов при удалении пользователя
cart_id INTEGER REFERENCES carts(id) ON DELETE CASCADE, -- Каскадное удаление заказов при удалении корзины
item_id INTEGER REFERENCES items(id),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

#### -- Добавление тестовых данных в таблицу users

INSERT INTO users (name) VALUES
('Alice'),
('Bob'),
('Charlie');

#### -- Добавление тестовых данных в таблицу items

INSERT INTO items (name) VALUES
('Item 1'),
('Item 2'),
('Item 3');

#### -- Добавление тестовых данных в таблицу carts

INSERT INTO carts (user_id) VALUES
(1), -- пример привязки корзины к пользователю с id = 1
(2);

INSERT INTO carts (user_id) VALUES
(1), -- пример привязки корзины к пользователю с id = 1
(1);

#### -- Добавление тестовых данных в таблицу orders

INSERT INTO orders (user_id, cart_id, item_id, created_at) VALUES
(1, 1, 1, '2024-10-15 10:00:00'), -- пример заказа
(1, 2, 1, '2024-10-15 10:05:00'),
(2, 2, 2, '2024-10-15 11:00:00');

SELECT
users.id AS user_id,
users.name AS user_name,
orders.id AS order_id,
items.id AS item_id,
items.name AS item_name,
orders.created_at
FROM
orders
JOIN
users ON orders.user_id = users.id
JOIN
items ON orders.item_id = items.id;

DELETE FROM users WHERE id = 1;

SELECT
users.id AS user_id,
users.name AS user_name,
orders.id AS order_id,
items.id AS item_id,
items.name AS item_name,
orders.created_at
FROM
orders
JOIN
users ON orders.user_id = users.id
JOIN
items ON orders.item_id = items.id;
