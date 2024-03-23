-- Create database if not exists
CREATE DATABASE IF NOT EXISTS ws_concours;

-- Switch to the created database
USE ws_concours;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    username VARCHAR(35) PRIMARY KEY,
    password VARCHAR(250) NOT NULL,
    role ENUM('admin', 'user') NOT NULL
);

-- Create categories table
CREATE TABLE IF NOT EXISTS categories (
    id_cat INT PRIMARY KEY AUTO_INCREMENT,
    nom_cat VARCHAR(50) NOT NULL
);

-- Create products table
CREATE TABLE IF NOT EXISTS products (
    ref_prod VARCHAR(30) PRIMARY KEY,
    nom_prod VARCHAR(50) NOT NULL,
    prix_prod DECIMAL(10,2) NOT NULL,
    qt_prod INT NOT NULL,
    desc_prod TEXT,
    image_prod VARCHAR(250),
    id_cat INT,
    CONSTRAINT fk_cat_prod FOREIGN KEY (id_cat) REFERENCES categories (id_cat)
);

