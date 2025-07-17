-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.42 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
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
CREATE DATABASE IF NOT EXISTS `khachsan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `khachsan`;

-- Dumping structure for table khachsan.danh_gia
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

-- Dumping structure for table khachsan.dich_vu
CREATE TABLE IF NOT EXISTS `dich_vu` (
  `ma_dich_vu` int NOT NULL AUTO_INCREMENT,
  `ten_dich_vu` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` int NOT NULL,
  `trang_thai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hinh_anh` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`ma_dich_vu`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.dich_vu: ~0 rows (approximately)
INSERT INTO `dich_vu` (`ma_dich_vu`, `ten_dich_vu`, `gia`, `trang_thai`, `hinh_anh`) VALUES
	(1, 'Giặt ủi', 20000, 'hoat_dong', '68753cc9dc755_1752513737.jpg');

-- Dumping structure for table khachsan.hinh_anh
CREATE TABLE IF NOT EXISTS `hinh_anh` (
  `ma_hinh_anh` int NOT NULL AUTO_INCREMENT,
  `anh` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_phong` int NOT NULL,
  PRIMARY KEY (`ma_hinh_anh`),
  KEY `fk_hinhanh_phong` (`ma_phong`),
  CONSTRAINT `FK_hinh_anh_phong` FOREIGN KEY (`ma_phong`) REFERENCES `phong` (`ma_phong`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.hinh_anh: ~12 rows (approximately)
INSERT INTO `hinh_anh` (`ma_hinh_anh`, `anh`, `ma_phong`) VALUES
	(4, '6875395aa71e1_1752512858.jpeg', 1),
	(5, '68753962085b6_1752512866.jpeg', 1),
	(6, '68753965ba7ff_1752512869.jpeg', 1),
	(7, '6875396bd44ce_1752512875.jpeg', 1),
	(8, '68753b38bab31_1752513336.jpeg', 1),
	(9, '68753b38c142c_1752513336.jpeg', 1),
	(10, '68753b38c612f_1752513336.jpeg', 1),
	(11, '68753b38c8e0d_1752513336.jpeg', 1),
	(12, '68753b38cad7e_1752513336.jpeg', 1),
	(13, '68753b38d333f_1752513336.jpeg', 1),
	(15, '68753b38e1802_1752513336.jpeg', 1),
	(16, '68753b38e9640_1752513336.jpeg', 1);

-- Dumping structure for table khachsan.hoa_don_dich_vu
CREATE TABLE IF NOT EXISTS `hoa_don_dich_vu` (
  `ma_hd_dich_vu` int NOT NULL AUTO_INCREMENT,
  `ma_dich_vu` int NOT NULL,
  `ma_hoa_don` int DEFAULT NULL,
  `gia` int NOT NULL,
  `ma_hd_phong` int DEFAULT NULL,
  `thoi_gian` datetime NOT NULL,
  `so_luong` int DEFAULT '1',
  PRIMARY KEY (`ma_hd_dich_vu`) USING BTREE,
  KEY `fk_hdphuphi_phuphi` (`ma_dich_vu`) USING BTREE,
  KEY `fk_hdphuphi_phong` (`ma_hd_phong`) USING BTREE,
  KEY `Index 5` (`ma_hoa_don`),
  CONSTRAINT `FK_hoa_don_dich_vu_dich_vu` FOREIGN KEY (`ma_dich_vu`) REFERENCES `dich_vu` (`ma_dich_vu`),
  CONSTRAINT `FK_hoa_don_dich_vu_hoa_don_phong` FOREIGN KEY (`ma_hd_phong`) REFERENCES `hoa_don_phong` (`ma_hd_phong`),
  CONSTRAINT `FK_hoa_don_dich_vu_hoa_don_tong` FOREIGN KEY (`ma_hoa_don`) REFERENCES `hoa_don_tong` (`ma_hoa_don`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.hoa_don_dich_vu: ~6 rows (approximately)
INSERT INTO `hoa_don_dich_vu` (`ma_hd_dich_vu`, `ma_dich_vu`, `ma_hoa_don`, `gia`, `ma_hd_phong`, `thoi_gian`, `so_luong`) VALUES
	(1, 1, NULL, 20000, 1, '2025-07-14 18:20:31', 4),
	(2, 1, 9, 20000, 5, '2025-07-17 01:51:27', 1),
	(3, 1, 10, 20000, 6, '2025-07-17 01:56:25', 1),
	(4, 1, 10, 20000, NULL, '2025-07-17 01:56:25', 1),
	(5, 1, 11, 20000, NULL, '2025-07-17 01:56:33', 1),
	(6, 1, 13, 20000, NULL, '2025-07-17 10:50:51', 1);

-- Dumping structure for table khachsan.hoa_don_phong
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
  CONSTRAINT `FK_hoa_don_phong_hoa_don` FOREIGN KEY (`ma_hoa_don`) REFERENCES `hoa_don_tong` (`ma_hoa_don`),
  CONSTRAINT `FK_hoa_don_phong_phong` FOREIGN KEY (`ma_phong`) REFERENCES `phong` (`ma_phong`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.hoa_don_phong: ~8 rows (approximately)
INSERT INTO `hoa_don_phong` (`ma_hd_phong`, `check_in`, `check_out`, `ma_phong`, `gia`, `ma_hoa_don`) VALUES
	(1, '2025-07-15 10:00:00', '2025-07-15 15:00:00', 1, 599000, 3),
	(2, '2025-07-18 08:38:00', '2025-07-18 10:38:00', 1, 59000, 6),
	(3, '2025-07-18 08:38:00', '2025-07-18 10:38:00', 1, 59000, 7),
	(4, '2025-07-18 08:38:00', '2025-07-18 10:38:00', 1, 59000, 8),
	(5, '2025-07-18 08:38:00', '2025-07-18 10:38:00', 1, 59000, 9),
	(6, '2025-07-18 08:38:00', '2025-07-18 10:38:00', 1, 59000, 10),
	(7, '2025-07-18 08:38:00', '2025-07-18 10:38:00', 1, 59000, 11),
	(8, '2025-07-25 10:50:00', '2025-07-26 10:50:00', 1, 59000, 13);

-- Dumping structure for table khachsan.hoa_don_tong
CREATE TABLE IF NOT EXISTS `hoa_don_tong` (
  `ma_hoa_don` int NOT NULL AUTO_INCREMENT,
  `ma_nhan_vien` int DEFAULT NULL,
  `ma_khach_hang` int DEFAULT NULL,
  `thoi_gian_dat` datetime DEFAULT NULL,
  `trang_thai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tong_tien` float DEFAULT '0',
  `ghi_chu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`ma_hoa_don`),
  KEY `fk_hoadon_nhanvien` (`ma_nhan_vien`),
  KEY `fk_hoadon_khachhang` (`ma_khach_hang`),
  CONSTRAINT `FK_hoa_don_tai_khoan` FOREIGN KEY (`ma_nhan_vien`) REFERENCES `tai_khoan` (`ma_tai_khoan`),
  CONSTRAINT `FK_hoa_don_tai_khoan_2` FOREIGN KEY (`ma_khach_hang`) REFERENCES `tai_khoan` (`ma_tai_khoan`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.hoa_don_tong: ~11 rows (approximately)
INSERT INTO `hoa_don_tong` (`ma_hoa_don`, `ma_nhan_vien`, `ma_khach_hang`, `thoi_gian_dat`, `trang_thai`, `tong_tien`, `ghi_chu`) VALUES
	(3, 2, 6, '2025-07-14 18:20:31', 'cho_xu_ly', 599000, 'Diu dat phong'),
	(4, NULL, NULL, NULL, 'cho_xac_nhan', 18526000, '324'),
	(5, NULL, NULL, NULL, 'cho_xac_nhan', 0, '324'),
	(6, NULL, NULL, NULL, 'cho_xac_nhan', 0, ''),
	(7, NULL, NULL, NULL, 'cho_xac_nhan', 118000, ''),
	(8, NULL, NULL, NULL, 'cho_xac_nhan', 0, ''),
	(9, NULL, NULL, NULL, 'cho_xac_nhan', 138000, ''),
	(10, NULL, 6, '2025-07-17 01:56:25', 'da_huy', 158000, '\nHủy bởi khách hàng lúc: 17/07/2025 10:36:50'),
	(11, 2, 6, '2025-07-17 01:56:33', 'da_thanh_toan', 138000, ''),
	(12, NULL, 6, '2025-07-17 10:46:01', 'cho_xac_nhan', 0, ''),
	(13, NULL, 6, '2025-07-17 10:50:51', 'cho_xac_nhan', 1436000, '');

-- Dumping structure for table khachsan.lien_he
CREATE TABLE IF NOT EXISTS `lien_he` (
  `ma_lien_he` int NOT NULL AUTO_INCREMENT,
  `ho_ten` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_dien_thoai` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chu_de` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `noi_dung` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `trang_thai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'moi',
  `ngay_gui` datetime DEFAULT CURRENT_TIMESTAMP,
  `ngay_phan_hoi` datetime DEFAULT NULL,
  `noi_dung_phan_hoi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `ma_nhan_vien_phan_hoi` int DEFAULT NULL,
  PRIMARY KEY (`ma_lien_he`),
  KEY `fk_lien_he_nhan_vien` (`ma_nhan_vien_phan_hoi`),
  CONSTRAINT `fk_lien_he_nhan_vien` FOREIGN KEY (`ma_nhan_vien_phan_hoi`) REFERENCES `tai_khoan` (`ma_tai_khoan`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.lien_he: ~6 rows (approximately)
INSERT INTO `lien_he` (`ma_lien_he`, `ho_ten`, `email`, `so_dien_thoai`, `chu_de`, `noi_dung`, `trang_thai`, `ngay_gui`, `ngay_phan_hoi`, `noi_dung_phan_hoi`, `ma_nhan_vien_phan_hoi`) VALUES
	(1, 'Nguyễn Văn An', 'an.nguyen@email.com', '0901234567', 'dich_vu', 'Chào anh/chị,\n\nTôi muốn hỏi về dịch vụ spa tại khách sạn. Khách sạn có những dịch vụ spa nào và giá cả như thế nào?\n\nCảm ơn!', 'dang_xu_ly', '2024-12-15 09:30:00', NULL, NULL, NULL),
	(2, 'Trần Thị Bình', 'binh.tran@email.com', '0912345678', 'dat_phong', 'Xin chào,\n\nTôi muốn đặt 2 phòng cho gia đình vào cuối tuần này (25-26/12). Khách sạn còn phòng loại VIP không ạ? Và có ưu đãi gì cho gia đình có trẻ em không?\n\nXin cảm ơn!', 'da_dong', '2024-12-14 14:20:00', '2025-07-16 08:45:36', '5', 2),
	(3, 'Lê Minh Cường', 'cuong.le@email.com', '0923456789', 'gop_y', 'Chào khách sạn,\n\nTôi vừa ở khách sạn tuần trước và rất hài lòng với dịch vụ. Tuy nhiên tôi có một vài góp ý:\n1. Âm thanh từ phòng bên cạnh hơi to\n2. Wifi hơi chậm vào buổi tối\n\nHi vọng khách sạn sẽ cải thiện. Cảm ơn!', 'da_dong', '2024-12-13 16:45:00', '2025-07-16 08:50:43', 'rewrwe', 2),
	(4, 'Phạm Thu Hà', 'ha.pham@email.com', '0934567890', 'khieu_nai', 'Xin chào,\n\nTôi muốn khiếu nại về việc đặt phòng. Tôi đã đặt phòng nhưng khi đến thì không có phòng trống. Đây là lần thứ 2 xảy ra tình trạng này. Mong khách sạn giải quyết và bồi thường.\n\nCảm ơn!', 'dang_xu_ly', '2024-12-15 11:15:00', NULL, NULL, NULL),
	(5, 'Hoàng Minh Tuấn', 'tuan.hoang@email.com', '0945678901', 'su_kien', 'Chào admin,\n\nCông ty chúng tôi dự định tổ chức tiệc cuối năm cho 50 người vào ngày 30/12. Khách sạn có không gian và dịch vụ tổ chức sự kiện không? Giá cả như thế nào?\n\nVui lòng báo giá chi tiết. Cảm ơn!', 'dang_xu_ly', '2024-12-14 20:30:00', NULL, NULL, NULL),
	(6, 'Võ Thị Mai', 'mai.vo@email.com', NULL, 'khac', 'Xin chào,\n\nTôi là nhà báo, muốn viết bài về khách sạn của các anh chị. Có thể sắp xếp một cuộc phỏng vấn với ban lãnh đạo không?\n\nCảm ơn và chờ phản hồi!', 'da_phan_hoi', '2024-12-15 08:00:00', '2025-07-16 09:05:40', 'OK\r\n', 2);

-- Dumping structure for table khachsan.loai_phong
CREATE TABLE IF NOT EXISTS `loai_phong` (
  `ma_loai_phong` int NOT NULL AUTO_INCREMENT,
  `hinh_anh` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `ten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `mo_ta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `trang_thai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ma_loai_phong`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.loai_phong: ~3 rows (approximately)
INSERT INTO `loai_phong` (`ma_loai_phong`, `hinh_anh`, `ten`, `mo_ta`, `trang_thai`) VALUES
	(1, '687538cd0f143_1752512717.jpeg', 'VIP', '', 'hoat_dong'),
	(2, '687538df370cd_1752512735.jpeg', 'Cao cấp', '', 'hoat_dong'),
	(3, '687538f8506bd_1752512760.jpeg', 'Phổ thông', '', 'hoat_dong');

-- Dumping structure for table khachsan.phong
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.phong: ~0 rows (approximately)
INSERT INTO `phong` (`ma_phong`, `ten_phong`, `mo_ta`, `trang_thai`, `gia`, `ma_loai_phong`) VALUES
	(1, 'Phòng A101', 'Phòng cao cấp view bãi biển cực đẹp, không khí mát mẻ êm dịu', 'Còn trống', 59000, 2);

-- Dumping structure for table khachsan.tai_khoan
CREATE TABLE IF NOT EXISTS `tai_khoan` (
  `ma_tai_khoan` int NOT NULL AUTO_INCREMENT,
  `ho_ten` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_cccd` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdt` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mat_khau` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phan_quyen` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `trang_thai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ma_tai_khoan`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.tai_khoan: ~2 rows (approximately)
INSERT INTO `tai_khoan` (`ma_tai_khoan`, `ho_ten`, `so_cccd`, `sdt`, `mail`, `mat_khau`, `phan_quyen`, `trang_thai`, `ngay_tao`) VALUES
	(2, 'Lê Duyên', '122122122', '0987654321', 'ltduyenn@gmail.com', '$2y$12$UzXHbgRAWGlgIazAwnEVouf.DyMUoIhARKzDRE8lshC26Yi/9pFbW', 'Quản lý', NULL, NULL),
	(6, 'Cao Thị Dịu', '123123123', '0123123123', 'ctdiu@gmail.com', '$2y$12$6AAp4iW8v0IuA0zgFxG1e.YC2BdzOq1E0PWzmEa0WClIMH7fD3soG', 'Khách hàng', NULL, '2025-07-14 18:19:26');

-- Dumping structure for table khachsan.tin_tuc
CREATE TABLE IF NOT EXISTS `tin_tuc` (
  `ma_tin_tuc` int NOT NULL AUTO_INCREMENT,
  `ma_tai_khoan` int NOT NULL,
  `noi_dung` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngay_dang` datetime NOT NULL,
  `trang_thai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tieu_de` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anh_dai_dien` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `luot_xem` int DEFAULT NULL,
  PRIMARY KEY (`ma_tin_tuc`),
  KEY `fk_tintuc_taikhoan` (`ma_tai_khoan`),
  CONSTRAINT `FK_tin_tuc_tai_khoan` FOREIGN KEY (`ma_tai_khoan`) REFERENCES `tai_khoan` (`ma_tai_khoan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table khachsan.tin_tuc: ~0 rows (approximately)
INSERT INTO `tin_tuc` (`ma_tin_tuc`, `ma_tai_khoan`, `noi_dung`, `ngay_dang`, `trang_thai`, `tieu_de`, `anh_dai_dien`, `luot_xem`) VALUES
	(2, 2, 'Khám phá các điểm đến hàng đầu theo cách bạn thích ở Việt Nam', '2025-07-16 01:35:56', 'published', 'Điểm đến phổ biến với du khách từ Việt Nam', '687701fc42022_1752629756.jpg', 14);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
