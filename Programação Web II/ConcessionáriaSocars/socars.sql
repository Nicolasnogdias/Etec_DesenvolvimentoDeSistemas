-- Criação do banco de dados
CREATE DATABASE socars;
USE socars;


-- Tabela de Marcas
CREATE TABLE marca (
    id_marca INT AUTO_INCREMENT PRIMARY KEY,
    nome_marca VARCHAR(50) NOT NULL
);
-- Tabela de Categorias
CREATE TABLE categoria (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nome_categoria VARCHAR(50) NOT NULL,
    id_marca INT,
    FOREIGN KEY (id_marca) REFERENCES marca(id_marca)
);
-- Tabela de Modelos
CREATE TABLE modelo (
    id_modelo INT AUTO_INCREMENT PRIMARY KEY,
    nome_modelo VARCHAR(50) NOT NULL,
    ano INT,
    cor VARCHAR(30),
    preco DECIMAL(10,2),
    status ENUM('Disponível', 'Vendido', 'Reservado') DEFAULT 'Disponível',
    descricao VARCHAR(50),
    id_categoria INT,
    FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria)
);

-- Inserir Marcas
INSERT INTO marca (nome_marca) VALUES ('Volkswagen');
-- Inserir Categorias
INSERT INTO categoria (nome_categoria, id_marca) VALUES ('Sedan', 1);
-- Inserir Modelos
INSERT INTO modelo (nome_modelo, ano, cor, preco, status, descricao, id_categoria)
VALUES ('Jetta', 2018, 'Preto', 50.00, 'Disponível', 'Carro legal', 1);


SELECT
    ma.nome_marca AS Marca,
    c.nome_categoria AS Categoria,
    mo.nome_modelo AS Modelo,
    mo.ano,
    mo.cor,
    mo.preco,
    mo.status,
    mo.descricao
FROM
    modelo mo
INNER JOIN
    categoria c ON mo.id_categoria = c.id_categoria
INNER JOIN
    marca ma ON c.id_marca = ma.id_marca;

ALTER TABLE modelo MODIFY descricao TEXT;
SELECT * FROM modelo