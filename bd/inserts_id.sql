-- INSERTS --

INSERT INTO tipo_vinho VALUES
('1', 'Tinto'), ('2', 'Branco'), 
('3', 'Rosé'), ('4', 'Espumante'), 
('5', 'Doce'), ('6', 'Fortificado');

INSERT INTO estilo VALUES
('1', 'Pinot Noir'), ('2', 'Pinot Gris'), ('3', 'Pinot Blanc'),
('4', 'Rioja Red'), ('5', 'Rioja White'), ('6', 'Malbec'),
('7', 'Sauvignon'), ('8', 'Cabernet'), ('9', 'Riesling');

INSERT INTO comida VALUES
('1', 'Queijos'), ('2', 'Carne bovina'), ('3', 'Aperitivo'),
('4', 'Vitela'), ('5', 'Comida apimentada'), ('6', 'Peixes'),
('7', 'Carne de porco'), ('8', 'Cordeiro'), ('9', 'Massa'),
('10', 'Sobremesas doces'), ('11', 'Sobremesas frutadas'),
('12', 'Comida vegetariana'), ('13', 'Cogumelos');

INSERT INTO uva VALUES
('1', 'Cabernet Sauvignon'), ('2', 'Merlot'), ('3', 'Malbec'),
('4', 'Carménère'), ('5', 'Pinot Noir'), ('6', 'Syrah'),
('7', 'Tannat'), ('8', 'Tempranillo'), ('9', 'Chardonnay'),
('10', 'Sauvignon Blanc'), ('11', 'Blend');

INSERT INTO regiao VALUES
('1', 'Brasil'), ('2', 'Chile'), ('3', 'Argentina'),
('4', 'França'), ('5', 'Canadá'), ('6', 'Alemanha'),
('7', 'Áustria'), ('8', 'Portugal'), ('9', 'Espanha'),
('10', 'Estados Unidos'), ('11', 'Itália'), ('12', 'México');

INSERT INTO vinho VALUES 
('1', 'Chanteau Lafit Rothschild', 'LOAD_FILE("C:/xampp/htdocs/vinum/images/vinho1.jpg")', 'Almadén', 250, 4, 1, 1, 1), 
('2', 'Chablis Grand', 'LOAD_FILE("C:/xampp/htdocs/vinum/images/vinho2.jpg")', 'Cave Geisse', 150.50, 5, 2, 5, 2), 
('3', 'Cepparello', 'LOAD_FILE("C:/xampp/htdocs/vinum/images/vinho3.jpg")', 'Domno', 78, 1, 3, 4, 2),
('4', 'Heras Cordon', 'LOAD_FILE("C:/xampp/htdocs/vinum/images/vinho4.jpg")', 'Hermann', 689, 3, 1, 1, 2),
('5', 'Bourgogne', 'LOAD_FILE("C:/xampp/htdocs/vinum/images/vinho5.jpg")', 'Laurentia', 93.70, 2, 1, 7, 5),
('6', 'Granbussia', 'LOAD_FILE("C:/xampp/htdocs/vinum/images/vinho6.jpg")', 'Mioranza', 135.65, 2, 4, 8, 6),
('7', 'Fairview', 'LOAD_FILE("C:/xampp/htdocs/vinum/images/vinho7.jpg")', 'Almadén', 420.50, 2, 5, 6, 7),
('8', 'Ciclos', 'LOAD_FILE("C:/xampp/htdocs/vinum/images/vinho8.jpg")', 'Mioranza', 890, 2, 6, 3, 11);

INSERT INTO usuario VALUES
('1', 'joao@live.com', 'João', '', '12345'),
('2', 'maria@gmail.com', 'Maria', '', '12345'),
('3', 'julia@live.com', 'Júlia', '', '12345'),
('4', 'flavio@gmail.com', 'Flávio Mota', '', '12345'),
('5', 'raffael@gmail.com', 'Raffael Carvalho', '', '12345'),
('6', 'ligia@hotmail.com', 'Lígia Fernandes', '', '12345');

INSERT INTO vinho_comida VALUES 
(1, 2),
(1, 3),
(1, 5),
(1, 10),
(2, 6),
(2, 7),
(3, 8),
(3, 9),
(4, 1),
(4, 2),
(4, 4),
(5, 1),
(5, 5),
(6, 7),
(6, 9),
(7, 1),
(7, 3),
(8, 8);

INSERT INTO usuario_vinhos VALUES
(1, 2),
(1, 3),
(2, 4),
(2, 2),
(2, 5),
(4, 7),
(4, 8),
(4, 1),
(3, 3),
(3, 4),
(5, 8),
(5, 6),
(6, 8),
(6, 3);

INSERT INTO avaliacao VALUES
(4, 1, 2),
(4, 1, 3),
(5, 2, 4),
(3, 2, 2),
(5, 2, 5),
(4, 3, 4),
(4, 3, 3),
(3, 4, 8),
(4, 4, 1),
(5, 5, 6),
(3, 5, 8),
(4, 5, 6),
(5, 6, 3),
(3, 6, 8);

INSERT INTO resenha VALUES
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', '17-09-04', 1, 3),
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', '17-09-04', 4, 8),
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', '17-09-04', 3, 3),
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', '17-09-04', 4, 7),
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', '17-09-04', 1, 2),
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', '17-09-04', 2, 2),
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', '17-09-04', 5, 8),
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', '17-09-04', 2, 5),
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', '17-09-04', 2, 4),
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', '17-09-04', 5, 6);