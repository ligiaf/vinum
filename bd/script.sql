CREATE TABLE tipo_vinho(
ID_tipo int not null auto_increment,
nome varchar(50) not null,
primary key (ID_tipo)
) ENGINE=InnoDB ;

CREATE TABLE estilo(
ID_estilo int not null auto_increment,
nome varchar(50) not null,
primary key (ID_estilo)
)ENGINE=InnoDB;

CREATE TABLE comida(
ID_comida int not null auto_increment,
nome varchar(50) not null,
primary key (ID_comida)
)ENGINE=InnoDB;

CREATE TABLE uva(
ID_uva int not null auto_increment,
tipo varchar(50) not null,
primary key (ID_uva)
)ENGINE=InnoDB;

CREATE TABLE regiao(
ID_regiao int not null auto_increment,
nome varchar(50) not null,
primary key (ID_regiao)
)ENGINE=InnoDB;

CREATE TABLE vinho(
ID_vinho int not null auto_increment,
nome varchar(50) not null,
rotulo varchar(100) not null,
produtor varchar(50) not null,
regiao varchar(100) not null,
preco decimal not null,
ID_regiao int not null,
ID_tipo int not null,
ID_estilo int not null,
ID_uva int not null,
primary key (ID_vinho),
foreign key(ID_regiao) references regiao(ID_regiao) ON DELETE CASCADE,
foreign key(ID_tipo) references tipo_vinho(ID_tipo) ON DELETE CASCADE,
foreign key(ID_estilo) references estilo(ID_estilo) ON DELETE CASCADE,
foreign key(ID_uva) references uva(ID_uva) ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE usuario(
ID_usuario int not null auto_increment primary key,
email varchar(100) not null unique,
nome varchar(100) not null,
foto varchar (100),
senha varchar(20) not null
)ENGINE=InnoDB;

CREATE TABLE vinho_comida(
ID_vinho int,
ID_comida int,
foreign key(ID_vinho) references vinho(ID_vinho) ON DELETE CASCADE,
foreign key(ID_comida) references comida(ID_comida) ON DELETE CASCADE,
primary key(ID_comida, ID_vinho)
)ENGINE=InnoDB;

CREATE TABLE resenha(
resenha varchar(500) not null,
datahora datetime not null,
ID_usuario int not null,
ID_vinho int not null,
foreign key(ID_usuario) references usuario(ID_usuario) ON DELETE CASCADE,
foreign key(ID_vinho) references vinho(ID_vinho) ON DELETE CASCADE,
primary key(ID_usuario, ID_vinho)
)ENGINE=InnoDB;

CREATE TABLE usuario_vinhos(
ID_usuario int,
ID_vinho int,
rotulo varchar(50) not null,
foreign key(ID_usuario) references usuario(ID_usuario) ON DELETE CASCADE,
foreign key(ID_vinho) references vinho(ID_vinho) ON DELETE CASCADE,
primary key(ID_usuario, ID_vinho)
)ENGINE=InnoDB;

CREATE TABLE avaliacao(
nota int not null,
ID_usuario int,
ID_vinho int,
foreign key(ID_usuario) references usuario(ID_usuario) ON DELETE CASCADE,
foreign key(ID_vinho) references vinho(ID_vinho) ON DELETE CASCADE,
primary key(ID_usuario, ID_vinho)
)ENGINE=InnoDB;


-- INSERTS --

INSERT INTO tipo_vinho VALUES
('', 'Tinto'), ('', 'Branco'), 
('', 'Rosé'), ('', 'Espumante'), 
('', 'Doce'), ('', 'Fortificado');

INSERT INTO estilo VALUES
('', 'Pinot Noir'), ('', 'Pinot Gris'), ('', 'Pinot Blanc'),
('', 'Rioja Red'), ('', 'Rioja White'), ('', 'Malbec'),
('', 'Sauvignon'), ('', 'Cabernet'), ('', 'Riesling');

INSERT INTO comida VALUES
('', 'Queijos'), ('', 'Carne bovina'), ('', 'Aperitivo'),
('', 'Vitela'), ('', 'Comida apimentada'), ('', 'Peixes'),
('', 'Carne de porco'), ('', 'Cordeiro'), ('', 'Massa'),
('', 'Sobremesas doces'), ('', 'Sobremesas frutadas'),
('', 'Comida vegetariana'), ('', 'Cogumelos');

INSERT INTO uva VALUES
('', 'Cabernet Sauvignon'), ('', 'Merlot'), ('', 'Malbec'),
('', 'Carménère'), ('', 'Pinot Noir'), ('', 'Syrah'),
('', 'Tannat'), ('', 'Tempranillo'), ('', 'Chardonnay'),
('', 'Sauvignon Blanc'), ('', 'Blend');

INSERT INTO regiao VALUES
('', 'Brasil'), ('', 'Chile'), ('', 'Argentina'),
('', 'França'), ('', 'Canadá'), ('', 'Alemanha'),
('', 'Áustria'), ('', 'Portugal'), ('', 'Espanha'),
('', 'Estados Unidos'), ('', 'Itália'), ('', 'México');

INSERT INTO vinho VALUES 
('', 'Chanteau Lafit Rothschild', '1.jpg', 'Almadén', 'Valle de Colchagua', 250, 4, 1, 1, 1), 
('', 'Chablis Grand', '2.jpg', 'Cave Geisse', 'Alentejano', 150.50, 5, 2, 5, 2), 
('', 'Cepparello', '3.jpg', 'Domno', 'Serra Gaúcha', 78, 1, 3, 4, 2),
('', 'Heras Cordon', '4.jpg', 'Hermann', 'Valle del Maipo', 689, 3, 1, 1, 2),
('', 'Bourgogne', '5.jpg', 'Laurentia', 'Douro', 93.70, 2, 1, 7, 5),
('', 'Granbussia', '6.jpg', 'Mioranza', 'Primitivo di Manduria', 135.65, 2, 4, 8, 6),
('', 'Fairview', '7.jpg', 'Almadén', 'Terre Siciliane', 420.50, 2, 5, 6, 7),
('', 'Ciclos', '8.jpg', 'Mioranza', 'Almeirim', 890, 2, 6, 3, 11);

INSERT INTO usuario VALUES
('', 'joao@live.com', 'João', '', '12345'),
('', 'maria@gmail.com', 'Maria', '', '12345'),
('', 'julia@live.com', 'Júlia', '', '12345'),
('', 'flavio@gmail.com', 'Flávio Mota', '4.jpg', '12345'),
('', 'raffael@gmail.com', 'Raffael Carvalho', '', '12345'),
('', 'ligia@hotmail.com', 'Lígia Fernandes', '', '12345'),
('', 'jonas@hotmail.com', 'Jonas Henrique', '7.jpg', '12345');

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
(1, 2, '1-2.jpg'),
(1, 3, '1-3.jpg'),
(2, 4, '2-4.jpg'),
(2, 2, '2-2.jpg'),
(2, 5, '2-5.jpg'),
(4, 7, '4-7.jpg'),
(4, 8, '4-8.jpg'),
(4, 1, '4-1.jpg'),
(3, 3, '3-3.jpg'),
(3, 4, '3-4.jpg'),
(5, 8, '5-8.jpg'),
(5, 6, '5-6.jpg'),
(6, 8, '6-8.jpg'),
(6, 3, '6-3.jpg');

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
(5, 5, 3),
(3, 5, 8),
(4, 5, 6),
(5, 6, 3),
(3, 6, 8);

INSERT INTO resenha VALUES
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', '17-09-05 00:00:00', 1, 3),
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', '17-09-06 00:00:00', 4, 8),
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', '17-09-04 00:00:00', 3, 3),
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', '17-10-04 00:00:00', 4, 7),
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', '17-11-04 00:00:00', 1, 2),
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', '17-09-12 00:00:00', 2, 2),
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', '17-09-22 00:00:00', 5, 8),
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', '17-05-24 00:00:00', 2, 5),
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', '17-11-04 00:00:00', 2, 4),
('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.', '17-09-14 00:00:00', 5, 6);

