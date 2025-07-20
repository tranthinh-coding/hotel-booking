/*
 Navicat Premium Data Transfer

 Source Server         : LOCAL
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3306
 Source Schema         : khachsan

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 20/07/2025 16:09:31
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for danh_gia
-- ----------------------------
DROP TABLE IF EXISTS `danh_gia`;
CREATE TABLE `danh_gia`  (
  `ma_danh_gia` int NOT NULL AUTO_INCREMENT,
  `ma_hoa_don` int NOT NULL,
  `ma_phong` int NOT NULL,
  `ma_khach_hang` int NOT NULL,
  `noi_dung` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `diem_danh_gia` float NOT NULL,
  `ngay_gui` datetime NOT NULL,
  PRIMARY KEY (`ma_danh_gia`) USING BTREE,
  INDEX `Index 2`(`ma_phong` ASC) USING BTREE,
  INDEX `Index 3`(`ma_khach_hang` ASC) USING BTREE,
  INDEX `Index 4`(`ma_hoa_don` ASC) USING BTREE,
  CONSTRAINT `FK_danh_gia_hoa_don_tong` FOREIGN KEY (`ma_hoa_don`) REFERENCES `hoa_don_tong` (`ma_hoa_don`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_danh_gia_phong` FOREIGN KEY (`ma_phong`) REFERENCES `phong` (`ma_phong`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_danh_gia_tai_khoan` FOREIGN KEY (`ma_khach_hang`) REFERENCES `tai_khoan` (`ma_tai_khoan`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of danh_gia
-- ----------------------------
INSERT INTO `danh_gia` VALUES (1, 10, 2, 7, 'ewe dsaf ds fds', 1, '2025-07-19 21:08:07');
INSERT INTO `danh_gia` VALUES (2, 10, 1, 7, ' fd f', 5, '2025-07-19 21:33:10');

-- ----------------------------
-- Table structure for dich_vu
-- ----------------------------
DROP TABLE IF EXISTS `dich_vu`;
CREATE TABLE `dich_vu`  (
  `ma_dich_vu` int NOT NULL AUTO_INCREMENT,
  `ten_dich_vu` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` int NOT NULL,
  `trang_thai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `hinh_anh` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`ma_dich_vu`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dich_vu
-- ----------------------------
INSERT INTO `dich_vu` VALUES (1, 'Giặt ủi', 20000, 'hoat_dong', '68753cc9dc755_1752513737.jpg');

-- ----------------------------
-- Table structure for hinh_anh
-- ----------------------------
DROP TABLE IF EXISTS `hinh_anh`;
CREATE TABLE `hinh_anh`  (
  `ma_hinh_anh` int NOT NULL AUTO_INCREMENT,
  `anh` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_phong` int NOT NULL,
  PRIMARY KEY (`ma_hinh_anh`) USING BTREE,
  INDEX `fk_hinhanh_phong`(`ma_phong` ASC) USING BTREE,
  CONSTRAINT `FK_hinh_anh_phong` FOREIGN KEY (`ma_phong`) REFERENCES `phong` (`ma_phong`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hinh_anh
-- ----------------------------
INSERT INTO `hinh_anh` VALUES (4, '6875395aa71e1_1752512858.jpeg', 1);
INSERT INTO `hinh_anh` VALUES (7, '6875396bd44ce_1752512875.jpeg', 1);
INSERT INTO `hinh_anh` VALUES (8, '68753b38bab31_1752513336.jpeg', 1);
INSERT INTO `hinh_anh` VALUES (9, '68753b38c142c_1752513336.jpeg', 1);
INSERT INTO `hinh_anh` VALUES (10, '68753b38c612f_1752513336.jpeg', 1);
INSERT INTO `hinh_anh` VALUES (11, '68753b38c8e0d_1752513336.jpeg', 1);
INSERT INTO `hinh_anh` VALUES (12, '68753b38cad7e_1752513336.jpeg', 1);
INSERT INTO `hinh_anh` VALUES (13, '68753b38d333f_1752513336.jpeg', 1);
INSERT INTO `hinh_anh` VALUES (15, '68753b38e1802_1752513336.jpeg', 1);
INSERT INTO `hinh_anh` VALUES (16, '68753b38e9640_1752513336.jpeg', 1);
INSERT INTO `hinh_anh` VALUES (17, '687b9d80c2aab_1752931712.jpg', 2);
INSERT INTO `hinh_anh` VALUES (19, '687c854458d67_1752991044.png', 3);
INSERT INTO `hinh_anh` VALUES (20, '687c9c51386f0_1752996945.jpeg', 3);
INSERT INTO `hinh_anh` VALUES (21, '687c9c513abef_1752996945.jpeg', 3);
INSERT INTO `hinh_anh` VALUES (22, '687c9c513c190_1752996945.jpeg', 3);

-- ----------------------------
-- Table structure for hoa_don_dich_vu
-- ----------------------------
DROP TABLE IF EXISTS `hoa_don_dich_vu`;
CREATE TABLE `hoa_don_dich_vu`  (
  `ma_hd_dich_vu` int NOT NULL AUTO_INCREMENT,
  `ma_dich_vu` int NOT NULL,
  `ma_hoa_don` int NULL DEFAULT NULL,
  `gia` int NOT NULL,
  `ma_hd_phong` int NULL DEFAULT NULL,
  `thoi_gian` datetime NOT NULL,
  `so_luong` int NULL DEFAULT 1,
  PRIMARY KEY (`ma_hd_dich_vu`) USING BTREE,
  INDEX `fk_hdphuphi_phuphi`(`ma_dich_vu` ASC) USING BTREE,
  INDEX `fk_hdphuphi_phong`(`ma_hd_phong` ASC) USING BTREE,
  INDEX `Index 5`(`ma_hoa_don` ASC) USING BTREE,
  CONSTRAINT `FK_hoa_don_dich_vu_dich_vu` FOREIGN KEY (`ma_dich_vu`) REFERENCES `dich_vu` (`ma_dich_vu`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_hoa_don_dich_vu_hoa_don_phong` FOREIGN KEY (`ma_hd_phong`) REFERENCES `hoa_don_phong` (`ma_hd_phong`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_hoa_don_dich_vu_hoa_don_tong` FOREIGN KEY (`ma_hoa_don`) REFERENCES `hoa_don_tong` (`ma_hoa_don`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hoa_don_dich_vu
-- ----------------------------
INSERT INTO `hoa_don_dich_vu` VALUES (1, 1, NULL, 20000, 1, '2025-07-14 18:20:31', 4);
INSERT INTO `hoa_don_dich_vu` VALUES (2, 1, 3, 20000, NULL, '2025-07-18 01:16:25', 1);
INSERT INTO `hoa_don_dich_vu` VALUES (6, 1, 12, 20000, NULL, '2025-07-20 15:54:08', 1);
INSERT INTO `hoa_don_dich_vu` VALUES (7, 1, 12, 20000, NULL, '2025-07-20 15:57:29', 1);
INSERT INTO `hoa_don_dich_vu` VALUES (8, 1, 13, 20000, 10, '2025-07-20 16:04:05', 2);

-- ----------------------------
-- Table structure for hoa_don_phong
-- ----------------------------
DROP TABLE IF EXISTS `hoa_don_phong`;
CREATE TABLE `hoa_don_phong`  (
  `ma_hd_phong` int NOT NULL AUTO_INCREMENT,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL,
  `ma_phong` int NOT NULL,
  `gia` int NOT NULL,
  `ma_hoa_don` int NOT NULL,
  PRIMARY KEY (`ma_hd_phong`) USING BTREE,
  INDEX `fk_hdphong_phong`(`ma_phong` ASC) USING BTREE,
  INDEX `fk_hdphong_hoadon`(`ma_hoa_don` ASC) USING BTREE,
  CONSTRAINT `FK_hoa_don_phong_hoa_don` FOREIGN KEY (`ma_hoa_don`) REFERENCES `hoa_don_tong` (`ma_hoa_don`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_hoa_don_phong_phong` FOREIGN KEY (`ma_phong`) REFERENCES `phong` (`ma_phong`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hoa_don_phong
-- ----------------------------
INSERT INTO `hoa_don_phong` VALUES (1, '2025-07-15 10:00:00', '2025-07-15 15:00:00', 1, 59000, 3);
INSERT INTO `hoa_don_phong` VALUES (2, '2025-07-16 20:31:00', '2025-07-16 22:31:00', 1, 59000, 7);
INSERT INTO `hoa_don_phong` VALUES (3, '2025-07-18 01:56:00', '2025-07-18 03:58:00', 1, 59000, 8);
INSERT INTO `hoa_don_phong` VALUES (4, '2025-08-05 20:18:00', '2025-08-06 20:18:00', 1, 59000, 9);
INSERT INTO `hoa_don_phong` VALUES (5, '2025-07-30 20:28:00', '2025-07-30 21:28:00', 1, 59000, 10);
INSERT INTO `hoa_don_phong` VALUES (6, '2025-08-01 21:29:00', '2025-08-01 21:33:00', 2, 40000, 10);
INSERT INTO `hoa_don_phong` VALUES (7, '2025-08-04 23:25:00', '2025-08-04 23:27:00', 2, 40000, 11);
INSERT INTO `hoa_don_phong` VALUES (8, '2025-08-12 13:32:00', '2025-08-12 15:32:00', 3, 222000, 12);
INSERT INTO `hoa_don_phong` VALUES (10, '2025-08-04 16:03:00', '2025-08-04 18:36:00', 3, 222000, 13);

-- ----------------------------
-- Table structure for hoa_don_tong
-- ----------------------------
DROP TABLE IF EXISTS `hoa_don_tong`;
CREATE TABLE `hoa_don_tong`  (
  `ma_hoa_don` int NOT NULL AUTO_INCREMENT,
  `ma_nhan_vien` int NULL DEFAULT NULL,
  `ma_khach_hang` int NULL DEFAULT NULL,
  `thoi_gian_dat` datetime NULL DEFAULT NULL,
  `trang_thai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tong_tien` float NULL DEFAULT 0,
  `ghi_chu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`ma_hoa_don`) USING BTREE,
  INDEX `fk_hoadon_nhanvien`(`ma_nhan_vien` ASC) USING BTREE,
  INDEX `fk_hoadon_khachhang`(`ma_khach_hang` ASC) USING BTREE,
  CONSTRAINT `FK_hoa_don_tai_khoan` FOREIGN KEY (`ma_nhan_vien`) REFERENCES `tai_khoan` (`ma_tai_khoan`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_hoa_don_tai_khoan_2` FOREIGN KEY (`ma_khach_hang`) REFERENCES `tai_khoan` (`ma_tai_khoan`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hoa_don_tong
-- ----------------------------
INSERT INTO `hoa_don_tong` VALUES (3, 2, 6, '2025-07-14 18:20:31', 'da_thanh_toan', 315000, 'Diu dat phong');
INSERT INTO `hoa_don_tong` VALUES (4, NULL, NULL, NULL, 'cho_xac_nhan', 0, '');
INSERT INTO `hoa_don_tong` VALUES (5, NULL, NULL, NULL, 'cho_xac_nhan', 0, '');
INSERT INTO `hoa_don_tong` VALUES (6, NULL, NULL, NULL, 'cho_xac_nhan', 0, '');
INSERT INTO `hoa_don_tong` VALUES (7, NULL, NULL, NULL, 'cho_xac_nhan', 118000, '');
INSERT INTO `hoa_don_tong` VALUES (8, 2, 6, '2025-07-18 00:57:14', 'da_huy', 177000, '');
INSERT INTO `hoa_don_tong` VALUES (9, 2, 7, '2025-07-19 20:19:01', 'da_tra_phong', 1416000, '');
INSERT INTO `hoa_don_tong` VALUES (10, 2, 7, '2025-07-19 20:29:15', 'da_tra_phong', 99000, '');
INSERT INTO `hoa_don_tong` VALUES (11, NULL, 2, '2025-07-19 23:26:11', 'da_huy', 40000, 'Hủy bởi khách hàng lúc: 19/07/2025 23:31:07');
INSERT INTO `hoa_don_tong` VALUES (12, 8, 6, '2025-07-20 13:44:01', 'da_thanh_toan', 928000, 'ok');
INSERT INTO `hoa_don_tong` VALUES (13, NULL, 2, '2025-07-20 16:04:05', 'cho_xac_nhan', 606100, '');

-- ----------------------------
-- Table structure for lien_he
-- ----------------------------
DROP TABLE IF EXISTS `lien_he`;
CREATE TABLE `lien_he`  (
  `ma_lien_he` int NOT NULL AUTO_INCREMENT,
  `ho_ten` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_dien_thoai` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `chu_de` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `noi_dung` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `trang_thai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'moi',
  `ngay_gui` datetime NULL DEFAULT CURRENT_TIMESTAMP,
  `ngay_phan_hoi` datetime NULL DEFAULT NULL,
  `noi_dung_phan_hoi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ma_nhan_vien_phan_hoi` int NULL DEFAULT NULL,
  PRIMARY KEY (`ma_lien_he`) USING BTREE,
  INDEX `fk_lien_he_nhan_vien`(`ma_nhan_vien_phan_hoi` ASC) USING BTREE,
  CONSTRAINT `fk_lien_he_nhan_vien` FOREIGN KEY (`ma_nhan_vien_phan_hoi`) REFERENCES `tai_khoan` (`ma_tai_khoan`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lien_he
-- ----------------------------
INSERT INTO `lien_he` VALUES (1, 'Nguyễn Văn An', 'an.nguyen@email.com', '0901234567', 'dich_vu', 'Chào anh/chị,\n\nTôi muốn hỏi về dịch vụ spa tại khách sạn. Khách sạn có những dịch vụ spa nào và giá cả như thế nào?\n\nCảm ơn!', 'moi', '2024-12-15 09:30:00', NULL, NULL, NULL);
INSERT INTO `lien_he` VALUES (2, 'Trần Thị Bình', 'binh.tran@email.com', '0912345678', 'dat_phong', 'Xin chào,\n\nTôi muốn đặt 2 phòng cho gia đình vào cuối tuần này (25-26/12). Khách sạn còn phòng loại VIP không ạ? Và có ưu đãi gì cho gia đình có trẻ em không?\n\nXin cảm ơn!', 'da_dong', '2024-12-14 14:20:00', '2025-07-16 08:45:36', '5', 2);
INSERT INTO `lien_he` VALUES (3, 'Lê Minh Cường', 'cuong.le@email.com', '0923456789', 'gop_y', 'Chào khách sạn,\n\nTôi vừa ở khách sạn tuần trước và rất hài lòng với dịch vụ. Tuy nhiên tôi có một vài góp ý:\n1. Âm thanh từ phòng bên cạnh hơi to\n2. Wifi hơi chậm vào buổi tối\n\nHi vọng khách sạn sẽ cải thiện. Cảm ơn!', 'da_dong', '2024-12-13 16:45:00', '2025-07-16 08:50:43', 'rewrwe', 2);
INSERT INTO `lien_he` VALUES (4, 'Phạm Thu Hà', 'ha.pham@email.com', '0934567890', 'khieu_nai', 'Xin chào,\n\nTôi muốn khiếu nại về việc đặt phòng. Tôi đã đặt phòng nhưng khi đến thì không có phòng trống. Đây là lần thứ 2 xảy ra tình trạng này. Mong khách sạn giải quyết và bồi thường.\n\nCảm ơn!', 'dang_xu_ly', '2024-12-15 11:15:00', NULL, NULL, NULL);
INSERT INTO `lien_he` VALUES (5, 'Hoàng Minh Tuấn', 'tuan.hoang@email.com', '0945678901', 'su_kien', 'Chào admin,\n\nCông ty chúng tôi dự định tổ chức tiệc cuối năm cho 50 người vào ngày 30/12. Khách sạn có không gian và dịch vụ tổ chức sự kiện không? Giá cả như thế nào?\n\nVui lòng báo giá chi tiết. Cảm ơn!', 'dang_xu_ly', '2024-12-14 20:30:00', NULL, NULL, NULL);
INSERT INTO `lien_he` VALUES (6, 'Võ Thị Mai', 'mai.vo@email.com', NULL, 'khac', 'Xin chào,\n\nTôi là nhà báo, muốn viết bài về khách sạn của các anh chị. Có thể sắp xếp một cuộc phỏng vấn với ban lãnh đạo không?\n\nCảm ơn và chờ phản hồi!', 'moi', '2024-12-15 08:00:00', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for loai_phong
-- ----------------------------
DROP TABLE IF EXISTS `loai_phong`;
CREATE TABLE `loai_phong`  (
  `ma_loai_phong` int NOT NULL AUTO_INCREMENT,
  `hinh_anh` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `mo_ta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `trang_thai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ma_loai_phong`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of loai_phong
-- ----------------------------
INSERT INTO `loai_phong` VALUES (1, '687538cd0f143_1752512717.jpeg', 'VIP', '', 'hoat_dong');
INSERT INTO `loai_phong` VALUES (2, '687538df370cd_1752512735.jpeg', 'Cao cấp', '', 'hoat_dong');
INSERT INTO `loai_phong` VALUES (3, '687538f8506bd_1752512760.jpeg', 'Phổ thông', '', 'hoat_dong');

-- ----------------------------
-- Table structure for phong
-- ----------------------------
DROP TABLE IF EXISTS `phong`;
CREATE TABLE `phong`  (
  `ma_phong` int NOT NULL AUTO_INCREMENT,
  `ten_phong` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `trang_thai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia` int NOT NULL,
  `ma_loai_phong` int NULL DEFAULT NULL,
  `anh_bia` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`ma_phong`) USING BTREE,
  INDEX `ma_loai_phong`(`ma_loai_phong` ASC) USING BTREE,
  CONSTRAINT `FK_phong_loai_phong` FOREIGN KEY (`ma_loai_phong`) REFERENCES `loai_phong` (`ma_loai_phong`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of phong
-- ----------------------------
INSERT INTO `phong` VALUES (1, 'Phòng A101', 'Phòng cao cấp view bãi biển cực đẹp, không khí mát mẻ êm dịu', 'Bảo trì', 59000, 2, '687bb22765bb6_1752936999.jpg');
INSERT INTO `phong` VALUES (2, 'Phòng 102', 'Mô tả phòng 102', 'Đang dọn dẹp', 40000, 3, '687bb2d60de16_1752937174.png');
INSERT INTO `phong` VALUES (3, 'Deluxe Room 1013', 'khong', 'Đang hoạt động', 222000, 3, '687c8554e7d72_1752991060.jpg');
INSERT INTO `phong` VALUES (4, 'Deluxe Room 10132', '', 'Ngừng hoạt động', 22000, 2, '687c86870b93f_1752991367.jpeg');

-- ----------------------------
-- Table structure for tai_khoan
-- ----------------------------
DROP TABLE IF EXISTS `tai_khoan`;
CREATE TABLE `tai_khoan`  (
  `ma_tai_khoan` int NOT NULL AUTO_INCREMENT,
  `ho_ten` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_cccd` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdt` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mat_khau` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phan_quyen` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `trang_thai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ngay_tao` datetime NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ma_tai_khoan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tai_khoan
-- ----------------------------
INSERT INTO `tai_khoan` VALUES (2, 'Lê Duyên', '122122122', '0987654321', 'ltduyenn@gmail.com', '$2y$12$euEkabvCkTBA6UHWXmRJ1urM33WsKrywXzcndyKHQjwaPM06UYqBG', 'Quản lý', NULL, NULL);
INSERT INTO `tai_khoan` VALUES (6, 'Cao Thị Dịu', '123123123', '0123123123', 'ctdiu@gmail.com', '$2y$12$6AAp4iW8v0IuA0zgFxG1e.YC2BdzOq1E0PWzmEa0WClIMH7fD3soG', 'Khách hàng', NULL, '2025-07-14 18:19:26');
INSERT INTO `tai_khoan` VALUES (7, 'Dịu', '01231230123', '0123123123', 'diu@gmail.com', '$2y$12$u4kG7jGVj7FeYZ3DsZ7DUuvBd1Ip0aP7iv3sLI.kZBpvieSXJ9t7.', 'Khách hàng', NULL, '2025-07-19 20:18:35');
INSERT INTO `tai_khoan` VALUES (8, 'Lễ Tân', '12312321321', '123123123', 'letan@gmail.com', '$2y$12$s2QpeU0T6d7qsK9K9LViheSV08rg7egkeEWR.YHqli4PhuQyjsYXm', 'Lễ tân', NULL, '2025-07-20 15:08:54');

-- ----------------------------
-- Table structure for tin_tuc
-- ----------------------------
DROP TABLE IF EXISTS `tin_tuc`;
CREATE TABLE `tin_tuc`  (
  `ma_tin_tuc` int NOT NULL AUTO_INCREMENT,
  `ma_tai_khoan` int NOT NULL,
  `noi_dung` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngay_dang` datetime NOT NULL,
  `trang_thai` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tieu_de` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anh_dai_dien` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `luot_xem` int NULL DEFAULT NULL,
  PRIMARY KEY (`ma_tin_tuc`) USING BTREE,
  INDEX `fk_tintuc_taikhoan`(`ma_tai_khoan` ASC) USING BTREE,
  CONSTRAINT `FK_tin_tuc_tai_khoan` FOREIGN KEY (`ma_tai_khoan`) REFERENCES `tai_khoan` (`ma_tai_khoan`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tin_tuc
-- ----------------------------
INSERT INTO `tin_tuc` VALUES (2, 2, 'Khám phá các điểm đến hàng đầu theo cách bạn thích ở Việt Nam', '2025-07-16 01:35:56', 'published', 'Điểm đến phổ biến với du khách từ Việt Nam', '687701fc42022_1752629756.jpg', 12);

SET FOREIGN_KEY_CHECKS = 1;
