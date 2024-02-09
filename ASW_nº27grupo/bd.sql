CREATE TABLE utilizador (
  nome varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  idade int(3) NOT NULL,
  email varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  gender varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  address varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  city varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  zip varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  phone int(9) NOT NULL,
  password varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (nome)
)

CREATE TABLE preferencias (
  nome varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
  categorias VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
  tamanhos VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
  marcas VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (nome)
);

CREATE TABLE comentarios (
  nome varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
  date date,
  comment text CHARACTER SET utf8 COLLATE utf8_general_ci
);

CREATE TABLE produtos (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  categoria varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  tamanho varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  marca varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  preco int(11) NOT NULL,
  PRIMARY KEY (id)
);	