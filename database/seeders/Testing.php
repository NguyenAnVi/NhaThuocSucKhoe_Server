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

        DB::table('shipping')->insert([
            [
                'name' => 'Giao hàng nhanh',
                'code' => 'GHN',
                'min_weight' => '0',
                'max_weight' => '20000',
                'fee' => '56'
            ],
            [
                'name' => 'Giao hàng tiết kiệm',
                'code' => 'GHTK',
                'min_weight' => '0',
                'max_weight' => '50000',
                'fee' => '60'
            ],
        ]);

        DB::unprepared(
            "INSERT INTO nhathuocsuckhoe.categories
                (id,name,parent_id,detail,imageurl,status)
            VALUES
                ('1', 'Dược phẩm', '0', '<div class=\"ProductTab_content__aTUkM\"><p><strong>Thành phần</strong><br>Hoạt chất: Acenocoumarol 1,00mg<br>Tá dược vừa đủ 1 viên nén: Lactose; Hypromellose; Tinh bột ngô; Colloidal silicon dioxid; Magnesi stearat; Talc.</p><p></p><p><strong>Chỉ định</strong> (Thuốc dùng cho bệnh gì?)<br>Điều trị và ngăn ngừa bệnh nghẽn mạch.</p><p></p><p><strong>Chống chỉ định </strong>(Khi nào không nên dùng thuốc này?)<br>- Quá mẫn cảm với acenocoumarol, các dẫn xuất của coumarin hay thành phần có trong thuốc.<br>- Phụ nữ mang thai.<br>- Người già yếu, nghiện rượu, bị rối loạn thần kinh hoặc người không có sự giám sát.<br>- Tất cả các điều kiện về nguy cơ xuất huyết quá mức có thể có lợi ích về lâm sàng như: tạng xuất huyết và/hoặc loạn thể tạng xuất huyết.<br>- Ngay trước hoặc sau phẫu thuật trên hệ thần kinh trung ương hoặc mắt và phẫu thuật chấn thương liên quan đến sự phơi bày quá mức của các mô.<br>- Loét tiêu hóa hoặc xuất huyết bộ máy dạ dày - ruột, bộ máy niệu - sinh dục hoặc hệ hô hấp.<br>- Xuất huyết mạch máu não.<br>- Viêm màng ngoài tim cấp; chảy dịch thể màng ngoài tim.<br>- Viêm nhiễm màng trong tim.<br>- Tăng huyết áp nặng.<br>- Suy gan nặng hoặc suy thận nặng và các trường hợp hoạt động phân hủy fibrin tăng theo các hoạt động của phổi, tiền liệt tuyến hoặc tử cung.</p><p></p><p><strong>Liều dùng </strong><br><u><em>Dân số chung mục tiêu:</em></u><br>- Sự nhạy cảm với các chất kháng đông máu biến đổi từ bệnh nhân này sang bệnh nhân khác và cũng có thể thay đổi bất thường trong quá trình điều trị. Vì thế, cần thực hiện kiểm tra thường xuyên thời gian prothrombin (PT)/ tỉ lệ bình thường của quốc tế (INR) và theo đó điều chỉnh liều cho bệnh nhân. Nếu không thể thực hiện được, không dùng acenocoumarol.<br>- Acenocoumarol phải được dùng đường uống với liều đơn.<br><u><em>Liều ban đầu:</em></u><br>- Liều của acenocoumarol phải được cá nhân hóa. Nếu giá trị PT/INR nằm trong khoảng bình thường trước khi bắt đầu điều trị, thời biểu liều sau được khuyến cáo:<br>- Liều ban đầu có ích nằm trong khoảng 2mg/ngày đến 4mg/ngày, không dùng liều ban đầu cao hơn. Việc điều trị cũng có thể bắt đầu với chế độ liều ban đầu cao hơn, thường 6mg vào ngày đầu tiên và sang ngày thứ hai là 4mg.<br>- Nếu thời gian thromboplastin lúc đầu là bình thường, việc điều trị phải được xây dựng với sự thận trọng.<br>- Các bệnh nhân cao tuổi (&gt;65 tuổi), các bệnh nhân bị bệnh gan hoặc suy tim nặng có sung huyết gan hoặc các bệnh nhân bị suy dinh dưỡng có thể yêu cầu liều thấp hơn trong quá trình điều trị ban đầu và duy trì.<br>- Đo thời gian thromboplastin phải được thực hiện hàng ngày ở bệnh viện bắt đầu từ liều thứ hai hoặc thứ ba cho đến khi tình trạng đông máu được ổn định trong khoảng mục tiêu. Khoảng thời gian giữa các lần kiểm tra có thể được mở rộng ra trễ hơn, tùy thuộc vào sự ổn định của kết quả. Mẩu máu để thực hiện các kiểm tra ở phòng thí nghiệm phải luôn luôn được thực hiện cùng thời gian trong ngày.<br><u><em>Điều trị duy trì và các kiểm tra đông máu</em></u><br>- Liều duy trì của acenocoumarol thay đổi từ bệnh nhân này sang bệnh nhân khác và phải được kiểm tra riêng biệt trên cơ sở giá trị PT/INR. PT/INR phải được đánh giá ở khoảng thời gian đều đặn như ít nhất một lần một tháng.<br>- Liều duy trì nhìn chung nằm trong khoảng 1 đến 8mg hàng ngày tùy thuộc vào bệnh nhân riêng biệt, các bệnh khác trong cơ thể, chỉ định lâm sàng và tăng cường mong muốn kháng đông máu.<br>- Tùy thuộc vào chỉ định lâm sàng, tăng cường tối ưu kháng đông máu hoặc khoảng điều trị được nhắm tới nhìn chung nằm giữa các giá trị INR 2.0 và 3.5. Giá trị INR cao hơn tới 4.5 có thể được yêu cầu các trường hợp riêng.<br><u><em>INR được khuyến cáo cho điều trị kháng đông máu dùng đường uống</em></u></p><p>Chỉ định</p><p>INR được khuyến cáo</p><p>Phòng và điều trị nghẽn tĩnh mạch ( bao gồm tắc mạch phổi)</p><p>2.0 - 3.0</p><p>Rối loạn nhịp nhĩ</p><p>2.0 - 3.0</p><p>Sau nhồi máu cơ tim (có nguy cơ tăng biến chứng nghẽn mạch)</p><p>2.0 - 3.0</p><p>Các van tim sinh học giả</p><p>2.0 - 3.0</p><p>Dự phòng ở các bệnh nhân có hội chứng kháng phospholipid</p><p>2.0 - 3.0</p><p>Các bệnh nhân có hội chứng kháng phospholipid bị nghẽn tĩnh mạch<strong> đang điều trị bằng thuốc kháng vitamin K</strong></p><p>2.0 - 3.5</p><p>Các giá trị cơ học của tim</p><p>2.0 - 3.5</p><p>PT, chỉ sự giảm của Vitamin K lệ thuộc các yếu tố đông máu VII, X và II, tùy thuộc vào đáp ứng của thromboplastin được sử dụng để kiểm tra PT. Sự đáp ứng của thromboplastin của từng cá thể so với các chuẩn đối chiếu quốc tế của tổ chức y tế thế giới được phản ánh bởi chỉ số nhạy cảm quốc tế (ISI).<br>“Tỉ lệ bình thường quốc tế” (INR) được đưa ra với mục đích chuẩn hóa PT. INR là tỉ lệ của PT huyết tương được kháng đông máu của bệnh nhân đối với PT huyết tương bình thường dùng cùng thromboplastin trong cùng hệ thống kiểm tra đạt tới năng lực của giá trị được định nghĩa bởi chỉ số nhạy cảm quốc tế.<br><u><em>Việc điều trị không tiếp tục</em></u><br>Nhìn chung, sau khi ngưng acenocoumarol, thường không có nguy hiểm về tăng đông máu phản ứng và vì vậy không cần thiết đưa ra liều dùng được giảm từ từ. Tuy nhiên, trong các trường hợp rất hiếm, ở một số bệnh nhân có nguy cơ cao (ví dụ: sau nhồi máu cơ tim), việc ngưng thuốc phải từ từ.<br><u><em>Quên liều</em></u><br>- Tác dụng kháng đông máu của acenocoumarol kéo dài hơn 24 giờ. Nếu bệnh nhân quên dùng liều đã được kê đơn tại thời biểu đã định, liều phải được dùng càng sớm càng tốt trong cùng ngày. Bệnh nhân không nên dùng liều đã quên bằng dùng gấp đôi liều hàng ngày để bù cho các liều bị quên, nhưng phải tham khảo trở lại bác sĩ điều trị.<br><u><em>Sự chuyển đổi từ điều trị bằng heparin</em></u><br>- Trong các trạng thái lâm sàng yêu cầu kháng đông máu nhanh, điều trị ban đầu bằng heparin được thích hơn vì tác dụng kháng đông máu của acenocoumarol chậm. Việc chuyển đổi sang acenocoumarol có thể bắt đầu đồng thời với điều trị bằng heparin hoặc có thể chậm lại tùy thuộc vào trạng thái lâm sàng. Để đảm bảo kháng đông máu tiếp diễn, khuyến cáo nên tiếp tục kê đơn điều trị bằng heparin đủ liều trong ít nhất 4 ngày sau khi bắt đầu điều trị bằng acenocoumarol và tiếp tục điều trị bằng heparin đến khi INR nằm trong khoảng mục tiêu ít nhất hai ngày liên tục.<br>Trong giai đoạn chuyển đổi, giám sát chặt tác dụng kháng đông máu là cần thiết.<br><u><em>Điều trị trong nha khoa và phẫu thuật</em></u><br>Các bệnh nhân dùng acenocoumarol, người trải qua quá trình phẫu thuật hoặc xâm lấn yêu cầu thăm dò chặt chẽ tình trạng đông máu của họ. Ở các điều kiện xác định, như khi vị trí phẫu thuật bị giới hạn và có thể tiếp cận được cho phép sử dụng hiệu quả các quy trình tại chỗ cho việc cầm máu, các quá trình nha khoa và phẫu thuật rất nhỏ có thể được thực hiện trong quá trình kháng đông máu được tiếp diễn, không có nguy cơ xuất huyết quá mức. Quyết định ngưng acenocoumạrol, thậm chí trong một thời gian ngắn, phải cẩn thận xem xét các nguy cơ và các lợi ích riêng lẻ. Việc dựa vào kiểu bắc cầu điều trị kháng đông máu, như dùng heparin phải dựa trên đánh giá cẩn thận các nguy cơ tắc mạch và chảy máu.<br><u><em>Dân số đặc biệt</em></u><br><em><strong>Suy thận</strong></em><br>Acenocoumarol không được khuyên dùng cho bệnh nhân suy thận nặng do tăng nguy cơ xuất huyết. Phải thận trong ở các bệnh nhân suy thận nhẹ và vừa.<br><em><strong>Suy gan</strong></em><br>Acenocoumarol không được khuyên dùng cho bệnh nhân suy gan nặng do tăng nguy cơ xuất huyết. Phải thận trọng ở các bệnh nhân suy gan nhẹ và vừa.<br><u><em>Dân số trẻ em</em></u><br>- Kinh nghiệm về thuốc kháng đông máu dùng đường uống bao gồm acenocoumarol ở trẻ em còn hạn chế. Thận trọng và giám sát thường xuyên hơn thời gian prothrombin và INR được khuyến cáo.<br>- Người cao tuổi: liều thấp hơn được khuyến cáo, liều của người lớn có thể đủ cho các bệnh nhân lớn tuổi. Thận trọng và giám sát thường xuyên hơn thời gian prothrombin và INR được khuyến cáo.<br><u><em>Cách dùng</em></u><br>Liều hàng ngày phải luôn luôn được dùng vào cùng một thời điểm trong ngày. Viên thuốc phải được nuốt nguyên với nước.</p><p></p><p><strong>Tác dụng phụ</strong><br>- Các biểu hiện chảy máu là biến chứng hay gặp nhất, có thể xảy ra trên khắp cơ thể: Hệ thần kinh trung ương, các chi, các phủ tạng, trong ổ bụng, trong nhãn cầu,...<br>- Đôi khi xảy ra tiêu chảy (có thể kèm theo phân nhiễm mỡ), đau khớp riêng lẻ.<br>- Hiếm khi xảy ra: Rụng tóc; hoại tử da khu trú, có thể do di truyền thiếu protein C hay đồng yếu tố là protein S; mẫn da dị ứng.<br>- Rất hiếm thấy bị viêm mạch máu, tổn thương gan.<br>- Xuất huyết trong các cơ quan nội tạng khác nhau do liều lượng thuốc sử dụng, độ tuổi của bệnh nhân và bản chất của các bệnh tiềm ẩn (nhưng không phải trong thời gian điều trị). Các vị trí xuất huyết có thể thấy ở: dạ dày, ruột, não, đường niệu sinh dục, tử cung, gan, túi mật và mắt. Nếu xuất huyết xảy ra ở một bệnh nhân với một thời gian thromboplastin trong phạm vi điều trị, chẩn đoán tình trạng của bệnh nhân phải được xác định rõ để có biện pháp điều trị thích hợp.<br>- Đôi khi xuất hiện các triệu chứng liên quan đến coumarin và dẫn chất của nó như: rối loạn dạ dày-ruột (mất cảm giác ngon miệng, buồn nôn, nôn), dị ứng (nổi mề day và phát ban, viêm da và sốt), rụng tóc, xuất huyết hoại tử da (do thiếu hụt protein C và protein S bẩm sinh), viêm mạch và tổn thương gan.<br><u><em>Hiếm gặp các tình trạng sau:</em></u><br>- Phản ứng dị ứng (ví dụ: mề đay, phát ban).<br>- Viêm mạch.<br>- Rối loạn tiêu hóa, mất cảm giác ngon miệng, buồn nôn, ói mửa.<br>- Xuất hiện chứng rụng tóc.<br><u><em>Rất hiếm:</em></u> Xuất huyết hoại tử da (thường kết hợp với thiếu hụt protein C bẩm sinh hoặc protein đồng yếu tố của nó S). Thông báo cho bác sỹ những tác dụng không mong muốn gặp phải khi sử dụng thuốc.</p><p></p><p><strong>Thận trọng</strong> (Những lưu ý khi dùng thuốc)<br><u><em>Suy gan</em></u><br>Phải thận trọng ở các bệnh nhân suy gan nhẹ và vừa vì sự tổng hợp các yếu tố đông máu có thể bị suy giảm hoặc có thể có hoạt động bất thường của tiểu cầu.<br><u><em>Suy thận</em></u><br>Do khả năng tích lũy các chất chuyển hóa khi bị suy giảm chức năng thận, phải thận trọng ở các bệnh nhân suy thận nhẹ và vừa.<br><u><em>Suy tim</em></u><br>Trong suy tim nặng, thời biểu về liều vô cùng thận trọng phải được thực hiện, vì sung huyết có thể giảm hoạt tính của gamma-carboxyl hóa của các yếu tố đông máu. Tuy nhiên, với sự phục hồi của sung huyết gan, cần thiết có thể tăng liều.<br><u><em>Huyết học</em></u><br>Phải thận trọng với các bệnh nhân đã biết hoặc nghi ngờ (như: chảy máu bất thường sau bị thương) thiếu hụt protein C hoặc protein S<br><u><em>Dân số đặc biệt</em></u><br>Ở các bệnh nhân trẻ em và lớn tuổi (&gt;65 tuổi), thận trọng và giám sát thường xuyên hơn thời gian prothrombin và INR được khuyến cáo.<br><u><em>Các thể khác</em></u><br>- Giám sát y tế nghiêm ngặt phải được thực hiện trong các trường hợp bệnh hoặc điều kiện có thể giảm liên kết protein của acenocoumarol (như: cường giáp, u, bệnh thận, viêm và nhiễm trùng).<br>- Các rối loạn ảnh hưỏng đến sự hấp thu của dạ dày-ruột có thể thay đổi tác dụng kháng đông máu của acenocoumarol.<br>- Trong quá trình điều trị bằng các thuốc kháng đông máu, tiêm trong cơ có thể gây bướu máu và phải được tránh. Tiêm dưới da và tiêm tĩnh mạch có thể thực hiện mà không gây biến chứng này.<br>- Chăm sóc thật kỹ phải được thực hiện là cần thiết để rút ngắn PT/INR (thời gian thromboplastin) cho quá trình chẩn đoán hoặc điều trị (như: chụp X quang, chọc dò tủy sống, phẫu thuật rất nhỏ, nhổ răng ...).<br>- Các bệnh nhân có vấn đề di truyền hiếm về dung nạp galactose, sự thiếu Lapp lactase hoặc kém hấp thu glucose-galactose không được dùng thuốc này.<br><u><em>Thai kỳ</em></u><br>- Thời kỳ mang thai<br>Đã có thống kê khoảng 4% dị dạng thai nhi khi người mẹ dùng thuốc này trong quý đầu thai kỳ. Vào các quý sau, vẫn thấy có nguy cơ (cả sảy thai). Vì vậy chỉ dùng thuốc khi không thể cho heparin.<br>- Thời kỳ cho con bú<br>Tránh cho con bú. Nếu phải cho bú thì nên bù vitamin K cho đứa trẻ. <br><em>Không dùng thuốc cho phụ nữ có thai và nuôi con bú, vì thuốc đi qua nhau thai và sữa mẹ.</em></p><p></p><p><strong>Tương tác thuốc</strong><em> (Những lưu ý khi dùng chung thuốc với thực phẩm hoặc thuốc khác)</em><br>Rất nhiều thuốc có thể tương tác với thuốc kháng vitamin K nên cần theo dõi người bệnh 3-4 ngày sau khi thêm hay bớt thuốc phối hợp.<br><em><u>Chống chỉ định phối hợp</u></em><br>- Aspirin (nhất là với liều cao trên 3 g/ngày) làm tăng tác dụng chống đông máu và nguy cơ chảy máu do ức chế kết tập tiểu cầu và chuyển dịch thuốc uống chống đông máu ra khỏi liên kết với protein huyết tương.<br>- Miconazol: Xuất huyết bất ngờ có thể nặng do tăng dạng tự do trong máu và ức chế chuyển hóa của thuốc kháng vitamin K.<br>- Phenylbutazon làm tăng tác dụng chống đông máu kết hợp với kích ứng niêm mạc đường tiêu hóa.<br>- Thuốc chống viêm không steroid nhóm pyrazol: tăng nguy cơ chảy máu do ức chế tiểu cầu và kích ứng niêm mạc đường tiêu hóa.<br><em><u>Không nên phối hợp:</u></em><br>- Aspirin với liều dưới 3 g/ngày.<br>- Các thuốc chống viêm không steroid, kể cả loại ức chế chọn lọc COX-2.<br>- Cloramphenicol: Tăng tác dụng của thuốc uống chống đông máu do làm giảm chuyển hóa thuốc này tại gan. Nếu không thể tránh phối hợp thì phải kiểm tra INR thường xuyên hơn, hiệu chỉnh liều trong và sau 8 ngày ngừng cloramphenicol.<br>- Diflunisal: Tăng tác dụng của thuốc uống chống đông máu do cạnh tranh liên kết với protein huyết tương.<br>- Nên dùng thuốc giảm đau khác, thí dụ Paracetamol.<br><em><u>Thận trọng khi phối hợp:</u></em><br>Allopurinol, aminoglutethimid, amiodaron, androgen, thuốc chống trầm cảm cường serotonin, benzbromaron, bosentan, carbamazepin, cephalosporin, cimetidin (trên 800 mg/ngày), cisaprid, cholestyramin, corticoid (trừ hydrocortison dùng điều trị thay thế trong bệnh Addison), cyclin, thuốc gây độc tế bào, fibrat, các azol trị nấm, fluoroquinolon, các loại heparin, nội tiết tố tuyến giáp, thuốc gây cảm ứng enzym, các statin, macrolid (trừ spiramycin), neviparin, efavirenz, nhóm imidazol, orlistat, pentoxifylin, phenytoin, propafenon, ritonavir, lopinavir, một số sulfamid (sulfamethoxazol, sulfafurazol, sulfamethizol), sucralfat, thuốc trị ung thư (tamoxifen, raloxifen), tibolon, vitamin E trên 500 mg/ngày, rượu, thuốc chống lập kết tiểu cầu, thuốc tiêu huyết khối,... cũng làm thay đổi tác dụng chống đông máu.<br><em>Các thuốc làm tăng tác dụng chống đông máu của acenocoumarol:</em><br>- Allopurinol; Anabolic steroids; Androgen.<br>- Thuốc chống loạn nhịp tim (như amiodarone, quinidine).<br>- Thuốc kháng sinh, kháng sinh phổ rộng (như amoxicillin, coamoxiclav) macrolid (như erythromycin, clarithromycin).<br>- Cephalosporin thế hệ thứ hai và thứ ba.<br>- Metronidazole; Quinolone (như ciprofloxacin, norfloxacin, ofloxacin); Tetracyclines; Neomycin; Chloramphenicol; Fibrates (như acid clofibric).<br>- Các dẫn xuất của fibrates hoặc có cấu trúc tương tự (như gemfibrozil, fenofibrate);<br>- Disulfiram; Etacrynic acid; Glucagon; Thuốc kháng H2 (nhưcimetidine).<br>- Các dẫn xuất của imidazole (econazole, fluconazole, ketoconazole, miconazole).<br>- Paracetamol; Sulfonamides (bao gổm cả co-trimoxazole); Antidiabetic (glibenclamide).<br>- Kích thích tố tuyến giáp (dextrothyroxine).<br>- Sulfinpyrazone; Sulphonylureas (tolbutamide và chlopropamide).<br>- Statin (atorvastatin, fluvastatin, simvastatin).<br>- Các chất ức chế sự tái hấp thu serotonin chọn lọc (fluoxetine, paroxetine); Tamoxifen; 5-fluorouracil; Tramadol.<br>- Corticosteroid (methylprednisolone, prednisone).<br>- Các chất ức chế của CYP2C9, thuốc cầm máu bao gồm heparin; chất ức chế tiểu cầu (clopidogrel, dipyridamole), acid salicylic và các dẫn xuất như acetylsalicylic axit, para-aminosalicylic acid; diflunisal, phenylbutazone và các dẫn xuất pyrazolone (sulfinpyrazone); chất chống viêm không steroid (NSAIDs) bao gồm thuốc ức chế COX-2 (celecoxib) và methylprednisolone. Chúng có thể làm tăng nguy cơ xuất huyết. Trong trường hợp việc sử dụng đồng thời là không thể tránh khỏi thì việc xét nghiệm đông máu nên được thực hiện thường xuyên.<br><em>Các thuốc làm giảm tác dụng chống đông máu của thuốc acenocoumarol</em><br>- Aminoglutethimide.<br>- Các loại thuốc chống ung thư (azathioprine, 6-mercaptopurine), Barbiturates (Phenobarbital); Carbamazepine; Colestyramine; Griseofulvin; Thuốc tránh thai; Rifampicin.<br>- Các thuốc lợi tiểu; các tác nhân gây cảm ứng: CYP2C19, CYP2C9 hoặc CYP3A4.<br>- Ngoài ra. thuốc ức chế protease (indinavir, nelfinavir, ritonavir, saquinavir) cũng có ảnh hưởng đến tác dụng chống đông máu của thuốc và chưa có báo cáo nào về việc tăng hay giảm hoạt động chống đông máu của thuốc.<br>- Nồng độ hydantoin trong huyết thanh có thể tăng khi điều trị đồng thời với những dẫn xuất của hydantoin (như phenytoin).<br>- Acenocoumarol có thể làm tăng tác dụng hạ đường huyết khi sử dụng những dẫn xuất của sulphonylurea (như glibenclamide, glimepiride).<br>- Bệnh nhân bị rối loạn chức năng gan khi điều trị với Acenocoumarol nên hạn chế uống rượu.<br>- Khi điều trị với Acenocoumarol, bệnh nhân nên tránh uống nước ép của quả quất. Tăng cường giám sát và theo dõi INR đối với bệnh nhân thường xuyên sử dụng nước ép quất.<br>- Không được phối hợp với aspirin liều cao, thuốc chống viêm không steroid nhân pyrazol, miconazol dùng đường toàn thân, âm đạo; phenylbutazol, cloramphenicol, diflunisal.</p><p></p><p><strong>Bảo quản</strong>: Nơi khô ráo, tránh ánh sáng, nhiệt độ không quá 30°C</p><p></p><p><strong>Đóng gói:</strong> Hộp 3 vỉ x 10 viên nén</p><p></p><p><strong>Thương hiệu:</strong> SPM</p><p></p><p><strong>Nơi sản xuất</strong>: Lô 51, Đường số 2, KCN Tân Tạo, P.Tân Tạo A, Q.Bình Tân, TpHCM, Việt Nam</p><p></p><p><em>Mọi thông tin trên đây chỉ mang tính chất tham khảo. Việc sử dụng thuốc phải tuân theo hướng dẫn của bác sĩ, dược sĩ.</em><br><em>Vui lòng đọc kĩ thông tin chi tiết ở tờ rơi bên trong hộp sản phẩm.</em></p><p> </p><p> </p><p> </p></div>', 'https://data-service.pharmacity.io/pmc-upload-media/production/pmc-ecm-core/category-icons/D%C6%B0%E1%BB%A3c_ph%E1%BA%A9m.jpg', '1'),
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
