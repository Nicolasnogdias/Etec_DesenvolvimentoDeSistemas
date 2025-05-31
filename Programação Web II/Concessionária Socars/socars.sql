-- Criação do banco de dados
CREATE DATABASE socars;
USE socars;

-- Tabela de Marcas
CREATE TABLE marca (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_marca VARCHAR(50) NOT NULL
);
-- Tabela de Categorias
CREATE TABLE categoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_categoria VARCHAR(50) NOT NULL
);
-- Tabela de Modelos
CREATE TABLE modelo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_modelo VARCHAR(50) NOT NULL,
    ano INT,
    cor VARCHAR(30),
    preco DECIMAL(10,2),
    motor VARCHAR(50),
    descricao TEXT,
    imagem VARCHAR(255),
    id_marca INT,
    id_categoria INT,
    FOREIGN KEY (id_marca) REFERENCES marca(id),
    FOREIGN KEY (id_categoria) REFERENCES categoria(id)
);
CREATE TABLE usuario (
	id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    email VARCHAR (100),
    senha VARCHAR(255) NOT NULL,
    acesso ENUM('cliente', 'admin') NOT NULL
);

-- Inserir Marcas
INSERT INTO marca (nome_marca) VALUES ('Volkswagen');
-- Inserir Categorias
INSERT INTO categoria (nome_categoria) VALUES ('Sedan');
-- Inserir Modelos
INSERT INTO modelo (nome_modelo, ano, cor, preco, status, descricao, id_marca, id_categoria)
VALUES ('Jetta', 2018, 'Preto', 50.00, 'Disponível', 'Carro legal', 1, 1);
-- Inserir Usuario
INSERT INTO usuario (nome, email, senha) 
VALUES ('Eduardo', 'eduardo@gmail.com', 12345678 );
-- Inserir Compra
INSERT INTO compra (id_usuario, id_modelo)
VALUES (1,1);

INSERT INTO marca (id, nome_marca) VALUES
(1, 'Volkswagen'),
(2, 'Honda'),
(3, 'Chevrolet'),
(4, 'Fiat'),
(5, 'Hyundai');

INSERT INTO categoria (id, nome_categoria) VALUES
(1, 'Sedan'),
(2, 'Hatch'),
(3, 'SUV');

INSERT INTO modelo (nome_modelo, ano, cor, preco, motor, descricao, imagem, id_marca, id_categoria) VALUES
('Jetta', 2025, 'Preto', 165000.00, '2.0 TSI Turbo', 'O Jetta 2025 entrega sofisticação, desempenho e tecnologia. Com motor 2.0 turbo, oferece uma condução esportiva aliada ao máximo conforto, além de um design elegante e imponente.', 'uploads/jetta.jpg', 1, 1),
('T-Cross', 2025, 'Cinza', 145000.00, '1.4 TSI', 'O T-Cross 2025 é o SUV ideal para quem busca tecnologia, conforto e versatilidade. Equipado com motor TSI, entrega ótima performance com economia, além de itens de segurança de última geração.', 'uploads/tcross.jpg', 1, 3),
('Polo', 2025, 'Vermelho', 120000.00, '1.0 TSI', 'O Polo 2025 chega renovado, com visual esportivo, motor turbo eficiente e excelente conectividade. Ideal para quem busca um hatch ágil, econômico e completo.', 'uploads/polo.jpg', 1, 2),

-- Honda
('Civic', 2025, 'Branco', 175000.00, '2.0 Flex', 'O Honda Civic 2025 combina sofisticação e esportividade. Com acabamento premium, tecnologias avançadas e desempenho robusto, é o sedã perfeito para quem não abre mão de conforto e segurança.', 'uploads/civic.jpg', 2, 1),
('HR-V', 2025, 'Prata', 160000.00, '1.5 Turbo', 'O novo HR-V 2025 oferece espaço, tecnologia e eficiência. Seu motor turbo garante performance ágil com baixo consumo, enquanto o interior proporciona conforto para toda a família.', 'uploads/hrv.jpg', 2, 3),
('Fit', 2025, 'Azul', 105000.00, '1.5 Flex', 'O Honda Fit 2025 é sinônimo de praticidade e versatilidade. Compacto por fora e espaçoso por dentro, perfeito para quem busca economia, conforto e muita funcionalidade no dia a dia.', 'uploads/fit.jpg', 2, 2),

-- Chevrolet
('Cruze', 2025, 'Prata', 155000.00, '1.4 Turbo', 'O Chevrolet Cruze 2025 se destaca pelo equilíbrio entre desempenho, tecnologia e conforto. Seu motor turbo oferece agilidade, enquanto os itens de segurança e conectividade garantem uma experiência premium.', 'uploads/cruze.jpg', 3, 1),
('Tracker', 2025, 'Preto', 145000.00, '1.2 Turbo', 'O Tracker 2025 é um SUV compacto, moderno e cheio de tecnologia. Com motor turbo eficiente, oferece ótimo desempenho aliado a conforto, segurança e amplo espaço interno.', 'uploads/tracker.jpg', 3, 3),
('Onix', 2025, 'Branco', 95000.00, '1.0 Turbo', 'O Onix 2025 chega com design renovado, alta conectividade e excelente consumo. Um hatch pensado para quem busca economia, praticidade e tecnologia no dia a dia.', 'uploads/onix.jpg', 3, 2),

-- Fiat
('Cronos', 2025, 'Prata', 95000.00, '1.3 Firefly', 'O Fiat Cronos 2025 é o sedã que une espaço, conforto e custo-benefício. Com linhas elegantes, motor eficiente e amplo porta-malas, é ideal para quem busca praticidade com estilo.', 'uploads/cronos.jpg', 4, 1),
('Pulse', 2025, 'Vermelho', 115000.00, '1.0 Turbo', 'O Fiat Pulse 2025 é o SUV compacto que surpreende. Com motor turbo, design arrojado e tecnologia embarcada, oferece uma condução prazerosa, segurança e muito estilo.', 'uploads/pulse.jpg', 4, 3),
('Argo', 2025, 'Azul', 85000.00, '1.3 Flex', 'O Argo 2025 é o hatch perfeito para quem quer economia e conforto. Com linhas modernas, interior bem acabado e tecnologias que facilitam o dia a dia, ele se destaca na categoria.', 'uploads/argo.jpg', 4, 2),

-- Hyundai
('HB20S', 2025, 'Prata', 98000.00, '1.0 Turbo', 'O Hyundai HB20S 2025 é um sedã compacto que combina design elegante, conforto e muita tecnologia. Perfeito para quem busca sofisticação e baixo consumo.', 'uploads/hb20s.jpg', 5, 1),
('Creta', 2025, 'Branco', 150000.00, '1.0 Turbo', 'O Creta 2025 oferece tudo o que um SUV moderno precisa: espaço interno, motor turbo eficiente, acabamento refinado e sistemas de segurança e conectividade de última geração.', 'uploads/creta.jpg', 5, 3),
('HB20', 2025, 'Prata', 87000.00, '1.0 Turbo', 'O HB20 2025 é o hatch ideal para quem busca economia, estilo e tecnologia. Com design marcante, motor turbo eficiente e itens de segurança avançados, é perfeito para a cidade.', 'uploads/hb20.jpg', 5, 2);


SELECT * FROM marca, categoria;
SELECT * FROM categoria;
SELECT * FROM usuario;

UPDATE usuario SET acesso = 'admin' WHERE id=7;











