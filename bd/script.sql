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

CREATE TABLE vinho(
ID_vinho int not null auto_increment,
nome varchar(50) not null,
rotulo longblob not null,
produtor varchar(50) not null,
regiao varchar(50) not null,
ID_tipo int not null,
ID_estilo int not null,
primary key (ID_vinho),
foreign key(ID_tipo) references tipo_vinho(ID_tipo) ON DELETE CASCADE,
foreign key(ID_estilo) references estilo(ID_estilo) ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE usuario(
ID_usuario int not null auto_increment primary key,
email varchar(100) not null,
nome varchar(100) not null,
foto longblob,
senha varchar(20) not null
)ENGINE=InnoDB;

CREATE TABLE vinho_comida(
ID_vinho int,
ID_comida int,
foreign key(ID_vinho) references vinho(ID_vinho) ON DELETE CASCADE,
foreign key(ID_comida) references comida(ID_comida) ON DELETE CASCADE,
primary key(ID_comida, ID_vinho)
)ENGINE=InnoDB;

CREATE TABLE vinho_uva(
ID_vinho int,
ID_uva int,
foreign key(ID_vinho) references vinho(ID_vinho) ON DELETE CASCADE,
foreign key(ID_uva) references uva(ID_uva) ON DELETE CASCADE,
primary key(ID_uva, ID_vinho)
)ENGINE=InnoDB;

CREATE TABLE resenha(
titulo varchar(50) not null,
resenha varchar(500) not null,
datahora datetime not null,
ID_usuario int not null,
ID_vinho int not null,
foreign key(ID_usuario) references usuario(ID_usuario) ON DELETE CASCADE,
foreign key(ID_vinho) references vinho(ID_vinho) ON DELETE CASCADE,
primary key(ID_usuario, ID_vinho, datahora)
)ENGINE=InnoDB;

CREATE TABLE meus_vinhos(
ID_usuario int,
ID_vinho int,
foreign key(ID_usuario) references usuario(ID_usuario) ON DELETE CASCADE,
foreign key(ID_vinho) references vinho(ID_vinho) ON DELETE CASCADE,
primary key(ID_usuario, ID_vinho)
)ENGINE=InnoDB;

CREATE TABLE avaliacao(
nota enum('1','2','3','4','5') not null,
ID_usuario int,
ID_vinho int,
foreign key(ID_usuario) references usuario(ID_usuario) ON DELETE CASCADE,
foreign key(ID_vinho) references vinho(ID_vinho) ON DELETE CASCADE,
primary key(ID_usuario, ID_vinho, nota)
)ENGINE=InnoDB;