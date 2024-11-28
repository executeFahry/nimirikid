
-- Create database
CREATE DATABASE IF NOT EXISTS pengelolaan_pengiriman_paket;
USE pengelolaan_pengiriman_paket;

-- Create table Pelanggan
CREATE TABLE pelanggan (
    id_pelanggan INT AUTO_INCREMENT PRIMARY KEY,
    nama_pelanggan VARCHAR(100) NOT NULL,
    alamat TEXT NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    no_hp VARCHAR(15) NOT NULL
);

-- Create table Kurir
CREATE TABLE kurir (
    id_kurir INT AUTO_INCREMENT PRIMARY KEY,
    nama_kurir VARCHAR(100) NOT NULL,
    no_hp VARCHAR(15) NOT NULL,
    area_pengiriman VARCHAR(100) NOT NULL,
    status ENUM('Aktif', 'Tidak Aktif') NOT NULL
);

-- Create table Paket
CREATE TABLE paket (
    id_paket INT AUTO_INCREMENT PRIMARY KEY,
    id_pengirim INT NOT NULL,
    id_penerima INT NOT NULL,
    id_kurir INT NOT NULL,
    status ENUM('Pending', 'Diambil', 'Dalam Pengiriman', 'Terkirim') NOT NULL,
    tanggal_pengiriman DATE NOT NULL,
    FOREIGN KEY (id_pengirim) REFERENCES pelanggan(id_pelanggan) ON DELETE CASCADE,
    FOREIGN KEY (id_penerima) REFERENCES pelanggan(id_pelanggan) ON DELETE CASCADE,
    FOREIGN KEY (id_kurir) REFERENCES kurir(id_kurir) ON DELETE CASCADE
);

-- Create table Status Pengiriman
CREATE TABLE status_pengiriman (
    id_status INT AUTO_INCREMENT PRIMARY KEY,
    id_paket INT NOT NULL,
    status ENUM('Diambil', 'Dalam Pengiriman', 'Terkirim', 'Gagal') NOT NULL,
    waktu_status DATETIME NOT NULL,
    catatan TEXT,
    FOREIGN KEY (id_paket) REFERENCES paket(id_paket) ON DELETE CASCADE
);
