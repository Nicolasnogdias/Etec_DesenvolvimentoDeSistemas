-- Cria o banco de dados
CREATE DATABASE IF NOT EXISTS livraria;
USE livraria;

-- Cria tabela de Autores
CREATE TABLE autores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    nacionalidade VARCHAR(50)
);

-- Cria tabela de Editoras
CREATE TABLE editoras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    pais VARCHAR(50)
);

-- Cria tabela de Livros
CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    autor_id INT,
    editora_id INT,
    ano_publicacao INT,
    preco DECIMAL(10,2),
    FOREIGN KEY (autor_id) REFERENCES autores(id),
    FOREIGN KEY (editora_id) REFERENCES editoras(id)
);

-- Cria tabela de Vendas
CREATE TABLE vendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    livro_id INT,
    data_venda DATE,
    quantidade INT,
    preco_unitario DECIMAL(10,2),
    FOREIGN KEY (livro_id) REFERENCES livros(id)
);

-- Insere Autores
INSERT INTO autores (nome, nacionalidade) VALUES
('Machado de Assis', 'Brasileira'),
('Clarice Lispector', 'Brasileira'),
('J.K. Rowling', 'Britânica'),
('George Orwell', 'Britânica'),
('Agatha Christie', 'Britânica'),
('Gabriel García Márquez', 'Colombiana'),
('Haruki Murakami', 'Japonesa'),
('Stephen King', 'Americana'),
('J.R.R. Tolkien', 'Britânica'),
('Toni Morrison', 'Americana');

-- Insere Editoras
INSERT INTO editoras (nome, pais) VALUES
('Companhia das Letras', 'Brasil'),
('Editora Rocco', 'Brasil'),
('Penguin Random House', 'EUA'),
('HarperCollins', 'Reino Unido'),
('Editora 34', 'Brasil');

-- Insere Livros (20 livros)
INSERT INTO livros (titulo, autor_id, editora_id, ano_publicacao, preco) VALUES
('Dom Casmurro', 1, 1, 1899, 45.90),
('A Hora da Estrela', 2, 1, 1977, 39.90),
('Harry Potter e a Pedra Filosofal', 3, 2, 1997, 69.90),
('1984', 4, 3, 1949, 55.00),
('Assassinato no Expresso do Oriente', 5, 4, 1934, 60.00),
('Cem Anos de Solidão', 6, 3, 1967, 65.50),
('Norwegian Wood', 7, 2, 1987, 75.00),
('O Iluminado', 8, 3, 1977, 70.00),
('O Senhor dos Anéis', 9, 4, 1954, 89.90),
('Amada', 10, 3, 1987, 58.00),
('Memórias Póstumas de Brás Cubas', 1, 1, 1881, 42.50),
('A Metamorfose', 4, 3, 1915, 35.00),
('Crime e Castigo', 4, 4, 1866, 49.90),
('1Q84', 7, 2, 2009, 85.00),
('It: A Coisa', 8, 2, 1986, 79.90),
('O Hobbit', 9, 4, 1937, 67.50),
('Sobrevivendo no Inferno', 1, 5, 1997, 30.00),
('O Conto da Aia', 10, 3, 1985, 62.00),
('O Estrangeiro', 6, 1, 1942, 40.00),
('Orgulho e Preconceito', 5, 4, 1813, 37.90);

-- Insere Vendas (20 vendas)
INSERT INTO vendas (livro_id, data_venda, quantidade, preco_unitario) VALUES
(1, '2023-01-15', 2, 45.90),
(3, '2023-02-20', 1, 69.90),
(5, '2023-03-10', 3, 60.00),
(7, '2023-04-05', 1, 75.00),
(2, '2023-05-12', 2, 39.90),
(4, '2023-06-18', 1, 55.00),
(6, '2023-07-22', 4, 65.50),
(8, '2023-08-30', 1, 70.00),
(10, '2023-09-05', 2, 58.00),
(9, '2023-10-10', 1, 89.90),
(12, '2023-11-11', 3, 35.00),
(15, '2023-12-25', 2, 79.90),
(17, '2024-01-05', 5, 30.00),
(19, '2024-02-14', 1, 40.00),
(11, '2024-03-08', 2, 42.50),
(13, '2024-04-01', 1, 49.90),
(16, '2024-05-05', 3, 67.50),
(18, '2024-06-10', 2, 62.00),
(14, '2024-07-15', 1, 85.00),
(20, '2024-08-20', 4, 37.90);

-- Cria índices para melhorar performance
CREATE INDEX idx_autor ON livros(autor_id);
CREATE INDEX idx_editora ON livros(editora_id);
CREATE INDEX idx_data_venda ON vendas(data_venda);

/*estou selecionando titulo da tabela livros definido por 'l', 
falei que quero a informação nome da tabela 'a' (autor) e a informação 
nome da tabela 'e' (editora)' 
vou selecionar isso tudo da tablea Livros que é o 'l'
depois eu junto as tabelas e busca o que me referi anteriormente para 
colocar a informação que quero */
SELECT l.titulo, a.nome AS autor, e.nome AS editora 
FROM livros l 
JOIN autores a ON l.autor_id = a.id 
JOIN editoras e ON l.editora_id = e.id;

-- mostrar o valor total de vendas por livro do maior pro menor
SELECT l.titulo, 
SUM(v.quantidade*v.preco_unitario) AS total_vendas
FROM vendas v
JOIN livros l ON v.livro_id = l.id
GROUP BY l.titulo
ORDER BY total_vendas DESC;

-- Encontrar autores com mais de 1 livro publicado
SELECT a.nome, COUNT(l.id) AS total_livros
FROM autores a JOIN livros l ON a.id = l.autor_id
GROUP BY a.nome
HAVING total_livros > 1;

SELECT l.titulo, 
SUM(v.quantidade) AS total_vendas
FROM vendas v
JOIN livros l ON v.livro_id = l.id
GROUP BY l.titulo
ORDER BY total_vendas DESC;

-- Selecione todos os livros onde a nacionalidade do autor Britânica (nome do livro, nome do autor e nacionalidade do autor)
SELECT l.titulo, a.nome AS nome_Autor, a.nacionalidade AS pais_Origem
FROM livros l
JOIN autores a ON l.autor_id = a.id
WHERE a.nacionalidade = "Britânica"
ORDER BY l.preco DESC;
-- -------------------------------------------------------------------------------------------------------------------------
-- 1
SELECT l.titulo, SUM(v.quantidade) AS total_vendas, v.preco_unitario
FROM vendas v
JOIN livros l ON v.livro_id = l.id
GROUP BY l.titulo
ORDER BY quantidade DESC;

-- 2
SELECT l.titulo, SUM(v.quantidade * v.preco_unitario) AS faturamento
FROM vendas v
JOIN livros l ON v.livro_id = l.id
GROUP BY l.titulo
ORDER BY faturamento DESC;

-- 3
SELECT l.titulo, SUM(v.quantidade) AS total_vendas, v.preco_unitario, v.data_venda
FROM vendas v
JOIN livros l ON v.livro_id = l.id
WHERE v.data_venda BETWEEN '2023-01-01' AND '2023-12-31'
GROUP BY l.titulo
ORDER BY quantidade DESC;

-- 4
SELECT l.titulo, SUM(v.quantidade * v.preco_unitario) AS faturamento, v.data_venda 
FROM vendas v
JOIN livros l ON v.livro_id = l.id
WHERE v.data_venda BETWEEN '2023-01-01' AND '2023-12-31'
GROUP BY l.titulo
ORDER BY faturamento DESC;
