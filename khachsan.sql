-- --------------------------------------------------------
-- Máy chủ:                      127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Phiên bản:           12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for khachsan
DROP DATABASE IF EXISTS `khachsan`;
CREATE DATABASE IF NOT EXISTS `khachsan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `khachsan`;

-- Dumping structure for table khachsan.danh_gia
DROP TABLE IF EXISTS `danh_gia`;
CREATE TABLE IF NOT EXISTS `danh_gia` (
  `ma_danh_gia` int NOT NULL AUTO_INCREMENT,
  `ma_phong` int NOT NULL,
  `ma_khach_hang` int NOT NULL,
  `noi_dung` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `diem_danh_gia` float NOT NULL,
  `ngay_gui` datetime NOT NULL,
  PRIMARY KEY (`ma_danh_gia`),
  KEY `Index 2` (`ma_phong`),
  KEY `Index 3` (`ma_khach_hang`),
  CONSTRAINT `FK_danh_gia_phong` FOREIGN KEY (`ma_phong`) REFERENCES `phong` (`ma_phong`),
  CONSTRAINT `FK_danh_gia_tai_khoan` FOREIGN KEY (`ma_khach_hang`) REFERENCES `tai_khoan` (`ma_tai_khoan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.danh_gia: ~0 rows (approximately)

-- Dumping structure for table khachsan.danh_muc
DROP TABLE IF EXISTS `danh_muc`;
CREATE TABLE IF NOT EXISTS `danh_muc` (
  `ma_danh_muc` int NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ma_danh_muc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.danh_muc: ~0 rows (approximately)

-- Dumping structure for table khachsan.danh_muc_phong
DROP TABLE IF EXISTS `danh_muc_phong`;
CREATE TABLE IF NOT EXISTS `danh_muc_phong` (
  `ma_danh_muc` int NOT NULL,
  `ma_phong` int NOT NULL,
  PRIMARY KEY (`ma_danh_muc`,`ma_phong`),
  UNIQUE KEY `Index 4` (`ma_danh_muc`,`ma_phong`),
  KEY `fk_danhmucphong_phong` (`ma_phong`),
  KEY `Index 3` (`ma_danh_muc`),
  CONSTRAINT `FK_danh_muc_phong_danh_muc` FOREIGN KEY (`ma_danh_muc`) REFERENCES `danh_muc` (`ma_danh_muc`),
  CONSTRAINT `FK_danh_muc_phong_phong` FOREIGN KEY (`ma_phong`) REFERENCES `phong` (`ma_phong`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.danh_muc_phong: ~0 rows (approximately)

-- Dumping structure for table khachsan.dich_vu
DROP TABLE IF EXISTS `dich_vu`;
CREATE TABLE IF NOT EXISTS `dich_vu` (
  `ma_dich_vu` int NOT NULL AUTO_INCREMENT,
  `ten_dich_vu` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` int NOT NULL,
  PRIMARY KEY (`ma_dich_vu`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.dich_vu: ~0 rows (approximately)
REPLACE INTO `dich_vu` (`ma_dich_vu`, `ten_dich_vu`, `gia`) VALUES
	(1, '12321', 0);

-- Dumping structure for table khachsan.hinh_anh
DROP TABLE IF EXISTS `hinh_anh`;
CREATE TABLE IF NOT EXISTS `hinh_anh` (
  `ma_hinh_anh` int NOT NULL AUTO_INCREMENT,
  `anh` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_phong` int NOT NULL,
  PRIMARY KEY (`ma_hinh_anh`),
  KEY `fk_hinhanh_phong` (`ma_phong`),
  CONSTRAINT `FK_hinh_anh_phong` FOREIGN KEY (`ma_phong`) REFERENCES `phong` (`ma_phong`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.hinh_anh: ~0 rows (approximately)

-- Dumping structure for table khachsan.hoa_don
DROP TABLE IF EXISTS `hoa_don`;
CREATE TABLE IF NOT EXISTS `hoa_don` (
  `ma_hoa_don` int NOT NULL AUTO_INCREMENT,
  `ma_nhan_vien` int DEFAULT NULL,
  `ma_khach_hang` int DEFAULT NULL,
  `thoi_gian_dat` datetime NOT NULL,
  PRIMARY KEY (`ma_hoa_don`),
  KEY `fk_hoadon_nhanvien` (`ma_nhan_vien`),
  KEY `fk_hoadon_khachhang` (`ma_khach_hang`),
  CONSTRAINT `FK_hoa_don_tai_khoan` FOREIGN KEY (`ma_nhan_vien`) REFERENCES `tai_khoan` (`ma_tai_khoan`),
  CONSTRAINT `FK_hoa_don_tai_khoan_2` FOREIGN KEY (`ma_khach_hang`) REFERENCES `tai_khoan` (`ma_tai_khoan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.hoa_don: ~0 rows (approximately)

-- Dumping structure for table khachsan.hoa_don_dich_vu
DROP TABLE IF EXISTS `hoa_don_dich_vu`;
CREATE TABLE IF NOT EXISTS `hoa_don_dich_vu` (
  `ma_hd_dich_vu` int NOT NULL AUTO_INCREMENT,
  `ma_dich_vu` int NOT NULL,
  `gia` int NOT NULL,
  `ma_hd_phong` int NOT NULL,
  `thoi_gian` datetime NOT NULL,
  PRIMARY KEY (`ma_hd_dich_vu`) USING BTREE,
  KEY `fk_hdphuphi_phuphi` (`ma_dich_vu`) USING BTREE,
  KEY `fk_hdphuphi_phong` (`ma_hd_phong`) USING BTREE,
  CONSTRAINT `FK_hoa_don_dich_vu_dich_vu` FOREIGN KEY (`ma_dich_vu`) REFERENCES `dich_vu` (`ma_dich_vu`),
  CONSTRAINT `FK_hoa_don_dich_vu_hoa_don_phong` FOREIGN KEY (`ma_hd_phong`) REFERENCES `hoa_don_phong` (`ma_hd_phong`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.hoa_don_dich_vu: ~0 rows (approximately)

-- Dumping structure for table khachsan.hoa_don_phong
DROP TABLE IF EXISTS `hoa_don_phong`;
CREATE TABLE IF NOT EXISTS `hoa_don_phong` (
  `ma_hd_phong` int NOT NULL AUTO_INCREMENT,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL,
  `ma_phong` int NOT NULL,
  `gia` int NOT NULL,
  `ma_hoa_don` int NOT NULL,
  PRIMARY KEY (`ma_hd_phong`) USING BTREE,
  KEY `fk_hdphong_phong` (`ma_phong`),
  KEY `fk_hdphong_hoadon` (`ma_hoa_don`),
  CONSTRAINT `FK_hoa_don_phong_hoa_don` FOREIGN KEY (`ma_hoa_don`) REFERENCES `hoa_don` (`ma_hoa_don`),
  CONSTRAINT `FK_hoa_don_phong_phong` FOREIGN KEY (`ma_phong`) REFERENCES `phong` (`ma_phong`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.hoa_don_phong: ~0 rows (approximately)

-- Dumping structure for table khachsan.loai_phong
DROP TABLE IF EXISTS `loai_phong`;
CREATE TABLE IF NOT EXISTS `loai_phong` (
  `ma_loai_phong` int NOT NULL AUTO_INCREMENT,
  `hinh_anh` text COLLATE utf8mb4_unicode_ci,
  `ten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `mo_ta` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`ma_loai_phong`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.loai_phong: ~0 rows (approximately)
REPLACE INTO `loai_phong` (`ma_loai_phong`, `hinh_anh`, `ten`, `mo_ta`) VALUES
	(1, NULL, 'Deluxe', NULL),
	(2, NULL, 'Deluxe', NULL);

-- Dumping structure for table khachsan.phong
DROP TABLE IF EXISTS `phong`;
CREATE TABLE IF NOT EXISTS `phong` (
  `ma_phong` int NOT NULL AUTO_INCREMENT,
  `ten_phong` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `trang_thai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` int NOT NULL,
  `ma_loai_phong` int DEFAULT NULL,
  PRIMARY KEY (`ma_phong`),
  KEY `ma_loai_phong` (`ma_loai_phong`),
  CONSTRAINT `FK_phong_loai_phong` FOREIGN KEY (`ma_loai_phong`) REFERENCES `loai_phong` (`ma_loai_phong`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.phong: ~0 rows (approximately)

-- Dumping structure for table khachsan.tai_khoan
DROP TABLE IF EXISTS `tai_khoan`;
CREATE TABLE IF NOT EXISTS `tai_khoan` (
  `ma_tai_khoan` int NOT NULL AUTO_INCREMENT,
  `ho_ten` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_cccd` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdt` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mat_khau` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phan_quyen` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ma_tai_khoan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.tai_khoan: ~0 rows (approximately)
REPLACE INTO `tai_khoan` (`ma_tai_khoan`, `ho_ten`, `so_cccd`, `sdt`, `mail`, `mat_khau`, `phan_quyen`) VALUES
	(1, 'Trần Văn Thinh', '123123123', '0123123123', 'tranthinh.own@gmail.com', '$2y$12$q9xO5o7ZGClAl/V4aNUww.9DqXAzmvjHtpf4tjY4qsaRShUgfiL.e', 'Quản lý'),
	(2, 'Lê Duyên', '122122122', '0987654321', 'ltduyenn@gmail.com', '$2y$12$UzXHbgRAWGlgIazAwnEVouf.DyMUoIhARKzDRE8lshC26Yi/9pFbW', 'Quản lý');

-- Dumping structure for table khachsan.tin_tuc
DROP TABLE IF EXISTS `tin_tuc`;
CREATE TABLE IF NOT EXISTS `tin_tuc` (
  `ma_tin_tuc` int NOT NULL AUTO_INCREMENT,
  `ma_tai_khoan` int NOT NULL,
  `noi_dung` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngay_dang` datetime NOT NULL,
  `trang_thai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tieu_de` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anh_dai_dien` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`ma_tin_tuc`),
  KEY `fk_tintuc_taikhoan` (`ma_tai_khoan`),
  CONSTRAINT `FK_tin_tuc_tai_khoan` FOREIGN KEY (`ma_tai_khoan`) REFERENCES `tai_khoan` (`ma_tai_khoan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.tin_tuc: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
