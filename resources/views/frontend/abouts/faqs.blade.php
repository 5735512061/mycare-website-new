@extends("/frontend/layouts/template/template-bg")

@section("content")

@include("/frontend/layouts/header/about/header-faqs")

<section id="service">
    <div class="container">
        <div class="row" style="margin-top:-90px !important;">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading4">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    MY CARE คืออะไร ?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
                            <div class="panel-body">
                                <p></p>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> บริการหลังการขายจากศูนย์บริการยางรถยนต์เอกการยาง ที่มอบสิทธิพิเศษให้กับคุณลูกค้า นอกเหนือจากการให้บริการเรื่องยาง แต่เป็นการดูแลคุณ ไม่ว่าจะเรื่องอาหาร ที่พัก และไลฟ์สไตล์ต่างๆของคุณ เปรียบเสมือน “เพื่อนแท้ดูแลกัน”
                                    คุณลูกค้าจะได้รับสิทธิพิเศษต่างๆ จากร้านค้าพันธมิตรในเครือของ MY CARE ที่ทางเอกการยาง มอบให้เป็นบริการหลังการขายแก่คุณลูกค้า</span><br><br>
                            </div>
                        </div>
                    </div><br>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading1">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                    ร้านค้าพันธมิตรที่เข้าร่วมกับทางบัตร MY CARE มีอะไรบ้าง ?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
                            <div class="panel-body">
                                <p></p>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> ศูนย์บริการยางรถยนต์เอกการยาง ทั้ง 6 สาขา ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> ร้านผัดไทยประตูหมี รับส่วนลดอาหารและเครื่องดื่ม มูลค่า 50 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> ร้านก๋วยเตี๋ยวเรือสี่พระยา รับส่วนลดอาหารและเครื่องดื่ม มูลค่า 50 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> URBIE รับส่วนลดอาหารและเครื่องดื่ม มูลค่า 50 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> บางเจี้ยม ติ่มซำ รับส่วนลดอาหารและเครื่องดื่ม มูลค่า 50 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> ร้านอาหารเลมอนกราส รับส่วนลดอาหารและเครื่องดื่ม 10% และรับส่วนลดเพิ่ม 100 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> ANNYTIME รับส่วนลดเบเกอรี่และเครื่องดื่ม มูลค่า 50 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> KOPI de phuket รับส่วนลดอาหารและเครื่องดื่ม 10% และรับส่วนลดเพิ่ม 100 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> O-OH Cafe รับส่วนลดอาหารและเครื่องดื่ม 15% และรับส่วนลดเพิ่ม 100 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> เคลียร์85ชาบู รับส่วนลดบุฟเฟ่ 100 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> PiKGo รับส่วนลดเบเกอรี่และเครื่องดื่ม มูลค่า 50 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> Sweet Old Cafe' รับส่วนลดเครื่องดื่ม มูลค่า 50 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> Mellow Yellow รับส่วนลดเครื่องดื่ม มูลค่า 50 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> ปิ้งกะเนย รับส่วนลดบุฟเฟ่ 100 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> ชุนซูชิ รับส่วนลดอาหารและเครื่องดื่ม 10% และรับส่วนลดเพิ่ม 100 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> โปรคลีน ล้างรถ พร้อมดูดฝุ่นภายใน มูลค่า 200.- ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> KINN Shabu รับส่วนลดบุฟเฟ่ 100 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> KUMA SUSHI รับส่วนลดบุฟเฟ่ 100 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> Bake The Story รับส่วนลดเบเกอรี่และเครื่องดื่ม มูลค่า 50 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> Pim's BISTRO&BAKERY รับส่วนลดเบเกอรี่และเครื่องดื่ม มูลค่า 50 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> The Fire Bear รับส่วนลดเครื่องดื่ม มูลค่า 50 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> Isara Cafe' รับส่วนลดเครื่องดื่ม มูลค่า 50 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> ข้าวกับหนม รับส่วนลดอาหารและเครื่องดื่ม มูลค่า 50 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> View Cafe' รับส่วนลดอาหารและเครื่องดื่ม 15% และรับส่วนลดเพิ่ม 100 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> Rabbit Hole&Cafe' รับส่วนลดอาหารและเครื่องดื่ม มูลค่า 50 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> Chino@cafe' รับส่วนลดอาหารและเครื่องดื่ม มูลค่า 50 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> Mellow Yellow Pool Cafe' รับส่วนลดเครื่องดื่ม มูลค่า 50 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> Shabu De Bear รับส่วนลดบุฟเฟ่ 100 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> Good Morning รับส่วนลดเบเกอรี่และเครื่องดื่ม มูลค่า 50 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> Good Cafe' Phuket รับส่วนลดเบเกอรี่และเครื่องดื่ม มูลค่า 50 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> Aura Mediplex รับสิทธิ์ซื้อแพ็กเกจ 1 แถม 1 ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> Veloche รับส่วนลด 2,000 บาท สำหรับห้องแฟมิลี่สูท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br>
                                {{-- <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> Hom mes รับส่วนลดเบเกอรี่และเครื่องดื่ม มูลค่า 50 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br> --}}
                                {{-- <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> Ras Saa Daa รับส่วนลดเบเกอรี่และเครื่องดื่ม มูลค่า 50 บาท ตั้งแต่วันนี้-31 ธ.ค. 63</span><br> --}}
                                <span class="tab-number">** บริษัทฯ ขอสงวนสิทธิ์ในการเปลี่ยนแปลงหรือยกเลิกร้านค้าพันธมิตร โดยไม่ต้องแจ้งให้ทราบล่วงหน้า</span><br><br>
                            </div>
                        </div>
                    </div><br>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading5">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    MY CARE สมัครยังไง - มีค่าใช้จ่ายไหม ?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading5">
                            <div class="panel-body">
                                <p></p>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> เพียงคุณลูกค้าเข้าใช้บริการที่ศูนย์บริการยางรถยนต์เอกการยาง ได้ทุกสาขา และเปิดบิลสินค้าโดยไม่มีขั้นต่ำ</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> รับสิทธิ์แลกซื้อบัตรสมาชิก MY CARE ในราคา 200.-</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> บัตรสมาชิกมีอายุ 1 ปี นับจากวันที่สมัครสมาชิก บัตรสมาชิกจะต่ออายุอัตโนมัติเพียงเข้าใช้บริการศูนย์บริการยางรถยนต์เอกการยาง</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> สแกน QR Code เพื่อต่ออายุบัตรสมาชิก นับจากวันที่สแกน QR Code ครั้งล่าสุด บัตรสมาชิกจะมีอายุ 1 ปี</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> กรณีบัตรสมาชิกหมดอายุ ลูกค้าสามารถต่ออายุบัตรได้โดยการเปิดบิลสินค้าที่ศูนย์บริการยางรถยนต์เอกการยาง</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> กรณีสมัครสมาชิกใหม่ ทางบริษัทฯ จะจัดส่งบัตรสมาชิกถึงท่าน ภายใน 7 วันทำการ</span><br><br>
                            </div>
                        </div>
                    </div><br>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading2">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    ในกรณีบัตรสมาชิกสูญหาย หรือชำรุด ต้องทำอย่างไร ?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
                            <div class="panel-body">
                                <p>ในกรณีบัตรสมาชิกสูญหาย</p>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> กรุณาแจ้ง 082-628-2244 เพื่อทำการอายัติบัตร</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> ในกรณีที่ต้องการสมัครบัตรสมาชิกใหม่ จะมีค่าธรรมเนียมในการสมัครบัตรใหม่ 500.-</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> บริษัทฯ ขอสงวนสิทธิ์ในการเปลี่ยนแปลงเงื่อนไขในการออกบัตรสมาชิกใหม่ โดยไม่ต้องแจ้งให้ทราบล่วงหน้า</span><br>
                                <p>ในกรณีบัตรสมาชิกชำรุด</p>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> สมาชิกต้องนำบัตรเก่ามาเปลี่ยนบัตรใหม่โดยไม่มีค่าใช้จ่าย (หมายเลขสมาชิก 16 หลักจาง หลุด ลอกจากตัวบัตร)</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> ทางทีมงานจะออกบัตรใบใหม่ พร้อมโอนคะแนนสะสมไปยังบัตรใหม่</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> บริษัทฯ ขอสงวนสิทธิ์ในการเปลี่ยนแปลงเงื่อนไขในการออกบัตรสมาชิกใหม่ โดยไม่ต้องแจ้งให้ทราบล่วงหน้า</span><br><br>
                            </div>
                        </div>
                    </div><br>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading3">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    บัตรมีวันหมดอายุหรือไม่ ?
                                </a>
                            </h4>
                        </div>
                        <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
                            <div class="panel-body">
                                <p></p>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> บัตรสมาชิกมีอายุ 1 ปี นับจากวันที่สมัครสมาชิก บัตรสมาชิกจะต่ออายุอัตโนมัติเพียงเข้าใช้บริการ และสแกน QR Code เพื่อต่ออายุ</span><br>
                                <span class="tab-number"><i class="fa fa-caret-right" style="color:#d4d3d3; font-size:30px;"></i><i class="fa fa-caret-left" style="color:#0038ff;"></i> กรณีบัตรสมาชิกหมดอายุ ลูกค้าสามารถต่ออายุบัตรได้โดยการเปิดบิลสินค้าที่ศูนย์บริการเอกการยาง และแจ้งพนักงานเพื่อต่ออายุ</span><br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</section><br><br>

@endsection