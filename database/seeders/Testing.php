<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Testing extends Seeder
{
    public function run()
    {
        DB::table('banners')->insert([
            [
                'name' => 'Siêu deal vui khỏe - Dành cho sản phẩm Chăm sóc cá nhân',
                'imageurl' => 'https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/collection-images/top1_981_x_486-05.jpg',
                'link' => 'https://go-vietnam.vn/tin-tuc/cham-soc-ca-nhan-nha-cua-sale-30-kem-qua-tang-hap-dan-1495.html',
                'status' => 'ACTIVE',
            ],
            [
                'name' => 'KM khi mua Solga',
                'imageurl' => 'https://www.solgar.com/wp-content/uploads/2022/03/innovation13@2x.jpg',
                'link' => 'https://www.solgar.com/',
                'status' => 'INACTIVE',
                
            ],
        ]);

        DB::unprepared(
            "INSERT INTO nhathuocsuckhoe.categories
                (id,name,parent_id,detail,imageurl,status)
            VALUES
                ('1', 'Dược phẩm', '0', '', 'https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/category-icons/D%C6%B0%E1%BB%A3c_ph%E1%BA%A9m.jpg', '1'),
                ('2', 'Chăm sóc sức khỏe', '0', '', 'https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/category-icons/P22053_1_l.jpg', '1'),
                ('3', 'Chăm sóc cá nhân', '0', '', 'https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/category-icons/Ch%C4%83m_s%C3%B3c_c%C3%A1_nh%C3%A2n.jpg', '1'),
                ('4', 'Sản phẩm tiện lợi', '0', '', 'https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/category-icons/photo_2023-02-10_11-57-08.jpg', '1'),
                ('5', 'Thực phẩm chức năng', '0', '', 'https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/category-icons/Th%E1%BB%B1c_ph%E1%BA%A9m_ch%E1%BB%A9c_n%C4%83ng.jpg', '1'),
                ('6', 'Mẹ và Bé', '0', '', 'https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/category-icons/M%E1%BA%B9_v%C3%A0_b%C3%A9.jpg', '1'),
                ('7', 'Chăm sóc sắc đẹp', '0', '', 'https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/category-icons/Ch%C4%83m_s%C3%B3c_s%E1%BA%AFc_%C4%91%E1%BA%B9p.jpg', '1'),
                ('8', 'Thiết bị y tế', '0', '', 'https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/category-icons/Thi%E1%BA%BFt_b%E1%BB%8B_y_t%E1%BA%BF.jpg', '1'),
                ('9', 'Khuyến Mãi HOT💥', '0', '', 'http://127.0.0.1:8000/storage/category/duocpham.webp', '1'),
                ('10', 'Thuốc không kê đơn', '1', '', 'http://127.0.0.1:8000/storage/category/duocpham.webp', '1'),
                ('11', 'Thuốc kê đơn', '1', '', 'http://127.0.0.1:8000/storage/category/duocpham.webp', '1'),
                ('12', 'Thực phẩm dinh dưỡng', '2', '', 'http://127.0.0.1:8000/storage/category/duocpham.webp', '1'),
                ('13', 'Dụng cụ sơ cứu', '2', '', 'http://127.0.0.1:8000/storage/category/duocpham.webp', '1'),
                ('14', 'Kế hoạch gia đình', '2', '', 'http://127.0.0.1:8000/storage/category/duocpham.webp', '1'),
                ('15', 'Chăm sóc mắt/tai/mũi', '2', '', 'http://127.0.0.1:8000/storage/category/duocpham.webp', '1'),
                ('16', 'Chăm sóc chân', '2', '', '', '1'),
                ('17', 'Khẩu trang y tế', '2', '', '', '1'),
                ('18', 'Chống muỗi', '2', '', '', '1'),
                ('19', 'Dầu tràm, dầu massage', '2', '', '', '1'),
                ('20', 'Sản phẩm phòng tắm', '3', '', '', '1'),
                ('21', 'Sản phẩm khử mùi', '3', '', '', '1'),
                ('22', 'Chăm sóc tóc', '3', '', '', '1'),
                ('23', 'Vệ sinh phụ nữ', '3', '', '', '1'),
                ('24', 'Chăm sóc nam giới', '3', '', '', '1'),
                ('25', 'Chăm sóc răng miệng', '3', '', '', '1'),
                ('26', 'Chăm sóc cơ thể', '3', '', '', '1'),
                ('27', 'Hàng tổng hợp', '4', '', '', '1'),
                ('28', 'Hàng bách hóa', '4', '', '', '1'),
                ('29', 'Nhóm dạ dày', '5', '', '', '1'),
                ('30', 'Nhóm tim mạch', '5', '', '', '1'),
                ('31', 'Nhóm đường huyết', '5', '', '', '1'),
                ('32', 'Nhóm hô hấp', '5', '', '', '1'),
                ('33', 'Nhóm thần kinh', '5', '', '', '1'),
                ('34', 'Nhóm xương khớp', '5', '', '', '1'),
                ('35', 'Giảm cân', '5', '', '', '1'),
                ('36', 'Chăm sóc sắc đẹp', '5', '', '', '1'),
                ('37', 'Chăm sóc sức khỏe nam và nữ', '5', '', '', '1'),
                ('38', 'Nhóm Mắt/Tai/Mũi', '5', '', '', '1'),
                ('39', 'Vitamin tổng hợp và khoáng chất', '5', '', '', '1'),
                ('40', 'Chăm sóc tóc', '5', '', '', '1'),
                ('41', 'Nhóm dành cho Gan', '5', '', '', '1'),
                ('42', 'Nhóm khác', '5', '', '', '1'),
                ('43', 'Chăm sóc em bé', '6', '', '', '1'),
                ('44', 'Dành cho trẻ em', '5', '', '', '1'),
                ('45', 'Sản phẩm dành cho mẹ', '5', '', '', '1'),
                ('46', 'Dành cho phụ nữ mang thai', '5', '', '', '1'),
                ('47', 'Chăm sóc mặt', '7', '', '', '1'),
                ('48', 'Sản phẩm chống nắng', '7', '', '', '1'),
                ('49', 'Dụng cụ làm đẹp', '7', '', '', '1'),
                ('50', 'Dược - Mỹ phẩm', '7', '', '', '1'),
                ('51', 'Nhiệt kế', '8', '', '', '0'),
                ('52', 'Máy đo huyết áp', '8', '', '', '1'),
                ('53', 'Máy đo đường huyết', '8', '', '', '1'),
                ('54', 'Máy xông khí dung', '8', '', '', '1'),
                ('55', 'TestKit', '8', '', '', '1'),
                ('56', 'Khác', '8', '', '', '1');

            INSERT INTO nhathuocsuckhoe.products
                ( name , detail , classified , price , images , weight , saleoff_price , category_id, stock , sold, status)
            VALUES
                ('Băng cá nhân che phủ vết thương Urgo Optiskin 10cm x 7cm (3 miếng)', '<p><strong>Th&agrave;nh phần</strong><br>Bao gồm một lớp mỏng polyurethane phủ keo acrylic c&oacute; t&iacute;nh dung nạp qua da cao v&agrave; lớp gạc thấm h&uacute;t kh&ocirc;ng dệt c&oacute; khả năng thấm h&uacute;t cao, được bao phủ bởi một lớp vảo vệ polyethylene kh&ocirc;ng d&iacute;nh. Chất keo được bảo vệ bởi hai c&aacute;nh c&oacute; r&atilde;nh v&agrave; băng được bao bởi một lớp film trong suốt gi&uacute;p băng vết thương dễ d&agrave;ng hơn. Băng được khử tr&ugrave;ng bằng ethylene oxide.</p><p><strong>Ưu điểm</strong><br>Optiskin l&agrave; loại băng gạc b&aacute;m d&iacute;nh v&ocirc; tr&ugrave;ng c&oacute; t&iacute;nh b&aacute;n thấm.<br>- Kh&aacute;ng khuẩn v&agrave; ngăn ngừa nhiễm tr&ugrave;ng từ b&ecirc;n ngo&agrave;i.<br>- B&aacute;n thấm, cho kh&iacute; v&agrave; hơi nước đi qua, do đ&oacute; ngăn ngừa nguy cơ hăm da v&agrave; cho ph&eacute;p lưu băng d&agrave;i ng&agrave;y.<br>- Kh&ocirc;ng thấm nước gi&uacute;p bệnh nh&acirc;n c&oacute; thể tắm rửa, vệ sinh.<br>- Mềm mại, co gi&atilde;n c&oacute; thể băng bất cứ chỗ n&agrave;o tr&ecirc;n c&oacute; thể m&agrave; vẫn cử động b&igrave;nh thường.<br>- Trong suốt, gi&uacute;p dễ d&agrave;ng theo d&otilde;i mức độ thấm h&uacute;t của băng.<br>- Băng ph&ugrave; hợp với cả da nhạy cảm.</p><p><strong>C&ocirc;ng dụng</strong><br>Optiskin l&agrave; băng gạc sử dụng để bao phủ l&ecirc;n tất cả c&aacute;c vết thương ngo&agrave;i da (vết kh&acirc;u, vết trầy xước), hoặc c&aacute;c loại dụng cụ (que d&ograve;, ống dẫn...). Do Optiskin cho ph&eacute;p bệnh nh&acirc;n c&oacute; thể tắm rửa, vệ sinh n&ecirc;n băng đặc biệt ph&ugrave; hợp cho c&aacute;c liệu ph&aacute;p tắm ng&acirc;m hay n&oacute;i chung nhanh ch&oacute;ng bắt đầu lại c&aacute;c hoạt động sau phẫu thuật.</p><p><strong>Hướng dẫn sử dụng</strong><br>1. Chuẩn bị da: Cạo l&ocirc;ng nếu cẩn thiết đảm bảo băng d&iacute;nh chắc hơn. Cầm m&agrave;u vết thương. S&aacute;t tr&ugrave;ng to&agrave;n bộ v&ugrave;ng vết thương hoặc v&ugrave;ng d&aacute;n băng. Lau da thật kh&ocirc;.<br>2. D&aacute;n băng: Lấy băng optiskin ra khỏi bao giấy. Giữ hai c&aacute;nh giấy bảo vệ bằng ng&oacute;n c&aacute;i v&agrave; ng&oacute;n trỏ, hướng mặt keo v&agrave; &aacute;p gạc xuống vết thương. &Aacute;p mặt keo xuống rồi k&eacute;o hai c&aacute;nh giấy ra hai ph&iacute;a. Ấn nhẹ l&ecirc;n băng để &aacute;p keo cho d&iacute;nh. Lấy bỏ hai c&aacute;nh trong suốt ở ph&iacute;a ngo&agrave;i băng, bắt đầu từ khe giữa. Vuốt nhẹ từ giữa băng ra ngo&agrave;i để d&iacute;nh chắc hơn nữa.<br>3. Bỏ băng: Gỡ một m&eacute;p băng rồi nhẹ nh&agrave;ng k&eacute;o thẳng ra ngo&agrave;i để l&agrave;m căng v&agrave; tr&oacute;c keo trong l&uacute;c tay kia giữ cạnh băng b&ecirc;n kia để tạo đối lực. Gỡ như vậy bệnh nh&acirc;n sẽ kh&ocirc;ng đau v&agrave; da &iacute;t bị k&iacute;ch th&iacute;ch d&ugrave; phải thay băng nhiều lần.</p><p><em>Lưu &yacute;:</em><br>- C&oacute; thể lưu băng đến 7 ng&agrave;y.<br>- Trước khi sử dụng, kiểm tra t&igrave;nh trạng nguy&ecirc;n vẹn của bao b&igrave; băng để đảm bảo băng v&ocirc; tr&ugrave;ng.<br>- Tr&aacute;nh k&eacute;o căng khi d&aacute;n băng.<br>- Kh&ocirc;ng sử dụng băng cho c&aacute;c vết thương hoặc c&aacute;c vết thương bị nhiễm tr&ugrave;ng, đang ra m&aacute;u hoặc tiết dịch nhiều.<br>- Theo d&otilde;i thường xuy&ecirc;n vết thương v&agrave; v&ugrave;ng da xung quanh để ph&aacute;t hiện ngay c&aacute;c dấu hiệu nhiễm tr&ugrave;ng như: đau, đỏ, ph&ugrave; nề, c&oacute; m&ugrave;i h&ocirc;i hoặc mưng mủ bất thường.<br>- Kh&ocirc;ng d&ugrave;ng Optiskin để bao l&ecirc;n c&aacute;c ống th&ocirc;ng tĩnh mạch trung t&acirc;m. Sử dụng một lần, kh&ocirc;ng tiệt tr&ugrave;ng để sử dụng lại.</p><p><strong>Đ&oacute;ng g&oacute;i:</strong> Hộp 3 miếng, k&iacute;ch thước 10 cm x 7 cm</p><p><strong>Xuất xứ thương hiệu:</strong> Th&aacute;i Lan</p><p><strong>Sản xuất tại:</strong> Th&aacute;i Lan<br>&emsp;</p>', false , '50000', '[\"https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/products/P01018_1_l.webp\",\"https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/products/P01018_1_l.webp\"]', 1 , '3000' ,'1', 50, 12 , 'INACTIVE'),
                ('Băng cá nhân cho phụ nữ Urgo Women (Gói 10 miếng)', '<p><strong>Th&agrave;nh phần:&nbsp;</strong>Nền Polyethylene Film, keo Acrylic, m&agrave;ng Polyethylene.</p><p><br></p><p><strong>C&ocirc;ng dụng:&nbsp;</strong>Gi&uacute;p bảo vệ viết thương nhỏ, vết cắt, vết kim đ&acirc;m, vết trầy xước kh&ocirc;ng l&agrave;m trẻ đau.</p><p><br></p><p><strong>C&aacute;ch sử dụng:&nbsp;</strong>D&ugrave;ng tr&ecirc;n da l&agrave;nh, sạch v&agrave; kh&ocirc;, h&ocirc;ng k&eacute;o căng băng hoặc da. D&ugrave;ng ng&oacute;n tay vướt nhẹ miếng băng.</p><p><br></p><p><strong>Bảo quản:&nbsp;</strong>Nơi kh&ocirc; r&aacute;o tho&aacute;ng m&aacute;t, tr&aacute;nh &aacute;nh nắng v&agrave; nhiệt độ cao.</p><p><br></p><p><strong>Quy c&aacute;ch đ&oacute;ng g&oacute;i:&nbsp;</strong>G&oacute;i 10 miếng&nbsp;</p><p><br></p><p><strong>Xuất xứ thương hiệu:</strong> Ph&aacute;p</p><p><br></p><p><strong>Sản xuất tại:</strong> Th&aacute;i Lan</p><p><br></p><p><em>*Pharmacity cam kết chỉ b&aacute;n sản phẩm c&ograve;n d&agrave;i hạn sử dụng</em></p>', false , '13000', '[\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/2\\/1Bng-c-nhn-cho-ph-n-Urgo-Women-Gi-10-ming-1665077571.webp\"]', 2 , 0 ,'2', 13 , 20 , 'ACTIVE'),
                ('Băng cá nhân vải độ dính cao Urgo Durable (102 miếng/hộp)', '<p>Băng c&aacute; nh&acirc;n độ d&iacute;nh cao Urgo Durable được l&agrave;m từ chất liệu vải co gi&atilde;n tốt, gạc mềm phủ lưới Polyethylene kh&ocirc;ng g&acirc;y d&iacute;nh hoặc đau khi gỡ băng, gi&uacute;p bảo vệ ho&agrave;n hảo c&aacute;c vết thương nhỏ, vết trầy xước, r&aacute;ch da. C&aacute;c miếng băng được đựng trong bao ri&ecirc;ng, đảm bảo vệ sinh v&agrave; dễ d&agrave;ng bảo quản.&nbsp;</p><p><strong>Th&agrave;nh phần:&nbsp;</strong><br>Polyethylene</p><p><strong>C&ocirc;ng dụng:</strong><br>Gi&uacute;p bảo vệ c&aacute;c vết thương nhỏ, vết trầy xước, r&aacute;ch da.</p><p><strong>C&aacute;ch sử dụng:</strong><br>Vệ sinh, s&aacute;t khuẩn, rửa sạch v&agrave; lau kh&ocirc; nhẹ nh&agrave;ng vết thương v&agrave; khu vực xung quanh vết thương. D&aacute;n băng c&aacute; nh&acirc;n, vuốt nhẹ miếng băng. Thay băng &iacute;t nhất 2 lần mỗi ng&agrave;y.</p><p><strong>Bảo quản:</strong>&nbsp;<br>Nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh tiếp x&uacute;c trực tiếp với &aacute;nh nắng mặt trời.</p><p><strong>Quy c&aacute;ch đ&oacute;ng g&oacute;i:</strong> Hộp 102 miếng</p><p><strong>Xuất xứ thương hi&ecirc;u:</strong> Ph&aacute;p</p><p><strong>Sản xuất tại:</strong> Th&aacute;i Lan</p><p><em>*Pharmacity cam kết chỉ b&aacute;n sản phẩm c&ograve;n d&agrave;i hạn sử dụng.</em></p>', false, '68000', '', 1 , 0, '2', 13, 96, 'ACTIVE'),
                ('Băng cá nhân vải độ dính cao Urgo Durable (102 miếng/hộp)', '<p>Băng c&aacute; nh&acirc;n độ d&iacute;nh cao Urgo Durable được l&agrave;m từ chất liệu vải co gi&atilde;n tốt, gạc mềm phủ lưới Polyethylene kh&ocirc;ng g&acirc;y d&iacute;nh hoặc đau khi gỡ băng, gi&uacute;p bảo vệ ho&agrave;n hảo c&aacute;c vết thương nhỏ, vết trầy xước, r&aacute;ch da. C&aacute;c miếng băng được đựng trong bao ri&ecirc;ng, đảm bảo vệ sinh v&agrave; dễ d&agrave;ng bảo quản.&nbsp;</p><p><strong>Th&agrave;nh phần:&nbsp;</strong><br>Polyethylene</p><p><strong>C&ocirc;ng dụng:</strong><br>Gi&uacute;p bảo vệ c&aacute;c vết thương nhỏ, vết trầy xước, r&aacute;ch da.</p><p><strong>C&aacute;ch sử dụng:</strong><br>Vệ sinh, s&aacute;t khuẩn, rửa sạch v&agrave; lau kh&ocirc; nhẹ nh&agrave;ng vết thương v&agrave; khu vực xung quanh vết thương. D&aacute;n băng c&aacute; nh&acirc;n, vuốt nhẹ miếng băng. Thay băng &iacute;t nhất 2 lần mỗi ng&agrave;y.</p><p><strong>Bảo quản:</strong>&nbsp;<br>Nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh tiếp x&uacute;c trực tiếp với &aacute;nh nắng mặt trời.</p><p><strong>Quy c&aacute;ch đ&oacute;ng g&oacute;i:</strong> Hộp 102 miếng</p><p><strong>Xuất xứ thương hi&ecirc;u:</strong> Ph&aacute;p</p><p><strong>Sản xuất tại:</strong> Th&aacute;i Lan</p><p><em>*Pharmacity cam kết chỉ b&aacute;n sản phẩm c&ograve;n d&agrave;i hạn sử dụng.</em></p>', false, '68000', '', 1 , 0, '2', 13, 82, 'ACTIVE'),
                ('Bàn chải đánh răng Colgate Cushion Clean (Vỉ 2 cái)', '<p style=\"text-align: justify;\"><strong>Ưu điểm</strong><br>L&ocirc;ng b&agrave;n chải d&agrave;y hơn đến 7 lần<br>Đầu b&agrave;n chải mỏng chỉ 3,5mm dễ d&agrave;ng chải sạch s&acirc;u b&ecirc;n trong<br>Nhẹ nh&agrave;ng chải sạch răng v&agrave; m&aacute;t-xa nướu</p><p style=\"text-align: justify;\"><strong>Th&agrave;nh phần</strong><br>PBT, TPE</p><p style=\"text-align: justify;\"><strong>Th&ocirc;ng số kĩ thuật</strong><br>Lực k&eacute;o cước &gt;= 1,8kg</p><p style=\"text-align: justify;\"><strong>Hướng dẫn sử dụng</strong><br>N&ecirc;n thay b&agrave;n chải &iacute;t nhất 3 th&aacute;ng một lần hoặc khi l&ocirc;ng b&agrave;n chải m&ograve;n v&agrave; tưa.</p><p style=\"text-align: justify;\"><strong>Đ&oacute;ng g&oacute;i:</strong> Vỉ 2 b&agrave;n chải</p><p style=\"text-align: justify;\"><strong>Xuất xứ thương hiệu:</strong> H&agrave; Lan</p><p style=\"text-align: justify;\"><strong>Sản xuất tại:</strong> Trung Quốc</p>', false, '85000','[\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/5\\/1Bn-chi-nh-rng-Colgate-Cushion-Clean-V-2-ci-1665077777.webp\",\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/5\\/2Bn-chi-nh-rng-Colgate-Cushion-Clean-V-2-ci-1665077777.webp\"]', 2, 4000,  '2', 28, 23 , 'ACTIVE');
        ");

        copyr(storage_path('app/public/backup/products'), storage_path('app/public/products'));
        // DB::table('admins')->insert([
        //     [
        //         'name' => 'Admin01',
        //         'phone' => '0111111111',
        //         'password' => bcrypt('123456'),
        //     ],
        //     [
        //         'name' => 'Admin02',
        //         'phone' => '0222222222',
        //         'password' => bcrypt('123456'),

        //     ],
        //     [
        //         'name' => 'Admin03',
        //         'phone' => '0333333333',
        //         'password' => bcrypt('123456'),

        //     ],
        // ]);

        // DB::table('users')->insert([
        //     [
        //         'name' => 'User01',
        //         'phone' => '0111111111',
        //         'password' => bcrypt('123456'),
        //         'point' => 0,
        //     ],
        //     [
        //         'name' => 'User02',
        //         'phone' => '0222222222',
        //         'password' => bcrypt('123456'),
        //         'point' => 0,
        //     ],
        //     [
        //         'name' => 'User03',
        //         'phone' => '0333333333',
        //         'password' => bcrypt('123456'),
        //         'point' => 0,
        //     ],
        //     [
        //         'name' => 'User04',
        //         'phone' => '0444444444',
        //         'password' => bcrypt('123456'),
        //         'point' => 0,
        //     ],
        //     [
        //         'name' => 'User05',
        //         'phone' => '0555555555',
        //         'password' => bcrypt('123456'),
        //         'point' => 0,
        //     ],
        //     [
        //         'name' => 'User06',
        //         'phone' => '0666666666',
        //         'password' => bcrypt('123456'),
        //         'point' => 0,
        //     ],
        //     [
        //         'name' => 'User07',
        //         'phone' => '0777777777',
        //         'password' => bcrypt('123456'),
        //         'point' => 0,
        //     ],
        //     [
        //         'name' => 'User08',
        //         'phone' => '0888888888',
        //         'password' => bcrypt('123456'),
        //         'point' => 0,
        //     ],
        //     [
        //         'name' => 'User09',
        //         'phone' => '0999999999',
        //         'password' => bcrypt('123456'),
        //         'point' => 0,
        //     ],
        //     [
        //         'name' => 'User10',
        //         'phone' => '0101010101',
        //         'password' => bcrypt('123456'),
        //         'point' => 0,
        //     ],
        //     [
        //         'name' => 'User11',
        //         'phone' => '1111111111',
        //         'password' => bcrypt('123456'),
        //         'point' => 0,
        //     ],
        //     [
        //         'name' => 'User12',
        //         'phone' => '1212121212',
        //         'password' => bcrypt('123456'),
        //         'point' => 0,
        //     ],
        // ]);

        

        // DB::table('shipping')->insert([
        //     [
        //         'name' => 'Giao hàng tiết kiệm',
        //         'min_weight' => 100,
        //         'max_weight' => 50000,
        //         'fee' => 1600,
        //     ],
        //     [
        //         'name' => 'Giao hàng tiết kiệm',
        //         'min_weight' => 100,
        //         'max_weight' => 50000,
        //         'fee' => 1600,
        //     ],
            
        // ]);

        // copyr(storage_path('app/public/backup/saleoff'), storage_path('app/public/saleoff'));


    }
}
