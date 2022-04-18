<?php

/**
 * Template name: Giới thiệu Page
 * @author : Hy Hý
 */
get_header();
while (have_posts()) :
    the_post();
?>
	        <main class="main main-about">
                <section class="banner dm-banner aos-init aos-animate" data-aos="fade">
					<div class="banner-wrap">
						<div class="container">
							<div class="banner-content">
								<div class="banner-logo dm-banner-logo aos-init aos-animate" data-aos="zoom-in">
									<img src="<?php echo site_url('template') ?>/images/home-logo.png" alt="">
								</div>
								<div class="banner-img-list">
									<div class="banner-img dm-banner-img-left aos-init aos-animate" data-aos="zoom-out" data-aos-delay="150">
										<img src="<?php echo site_url('template') ?>/images/home-img-2.png" alt="">
									</div>
									<div class="banner-img dm-banner-img-right aos-init aos-animate" data-aos="zoom-out" data-aos-delay="200">
										<img src="<?php echo site_url('template') ?>/images/home-img-1.png" alt="">
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- <div class="banner-decor aos-init aos-animate" data-aos="zoom-in">
						<img src="<?php echo site_url('template') ?>/images/bg-home-2.png" alt="">
					</div> -->
				</section>
                <div class="about-sec sec-80 --pt-0 tt-18">
                    <div class="container">
                        <h2 class="main-title tt-40 --s-cl">Về cuộc thi</h2>
                        <div class="mona-content">
                            <div class="dm-grid-2 grid-gap-0-30">
                                <p>Cuộc thi ĐẦU BẾP TRẺ được tổ chức với mục tiêu tạo điều kiện cho các em học sinh tìm hiểu kiến thức về dinh dưỡng và trải nghiệm kỹ năng nấu ăn, thông qua sân chơi vui, bổ ích, thiết thực; đồng thời nâng cao nhận thức của học sinh về vai trò của việc đảm bảo dinh dưỡng trong những bữa ăn hằng ngày. Đây cũng là sân chơi giúp rèn luyện, nâng cao kỹ năng, tạo cơ hội để giáo viên và học sinh trao đổi kinh nghiệm cũng như thể hiện kỹ năng và năng khiếu về ẩm thực.</p>
                                <p><span class="dm-img"><img src="<?php echo site_url('template') ?>/images/home-img-3.png" alt=""></span></p>
                                <p>Năm 2014 đánh dấu lần đầu tiên cuộc thi được thực hiện tại TPHCM với hơn 100 đội thí sinh từ các khối lớp 10, 11,12 có năng khiếu, yêu thích bộ môn Nấu ăn ở các trường THPT, học viên các Trung tâm GDTX, Trung tâm GDNN-GDTX các quận, huyện. Wilmar CLV hân hạnh được đồng hành xuyên suốt cùng cuộc thi này dưới sự tài trợ chính bởi nhãn hàng Meizan.</p>
                                <p>Thông qua cuộc thi, chúng tôi mong muốn góp phần định hướng nghề nghiệp, giúp học sinh hiểu được nghề, biết tự đánh giá năng lực để lựa chọn cho mình một ngành nghề tương lai phù hợp với sở thích, năng lực bản thân, hoàn cảnh gia đình và nhu cầu thực tế của xã hội.</p>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="faqs-sec-wrap tt-18">
                    <section class="faqs-sec active">
                        <div class="faqs-sec-title">
                            <div class="container">
                                <h2 class="main-title tt-40">Thể lệ</h2>
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="faqs-sec-content">
                            <div class="container">
                                <div class="faqs-content-row">
                                    <h3 class="faqs-content-row-title main-title tt-30 f-oswald f-normal">01. Vòng Thi Trải Nghiệm Kiến Thức Dinh Dưỡng</h3>
                                    <div class="faqs-content-row-desc">
                                        <div class="dm-grid-2">
                                            <div class="active-content">
                                                <!-- <h4 class="active-content-title tt-24">PHẦN THI TRẮC NGHIỆM TRỰC TUYẾN<br><span class="--s-cl">(BẮT BUỘC)</span></h4> -->
                                                <div class="active-content-desc mona-content">
                                                    <p>Các thành viên trong đội truy cập trang web của hội thi và làm bài trắc nghiệm trực tiếp trên máy tính hoặc thiết bị di động có kết nối internet. Hằng tuần, mỗi thành viên trong đội có 01 lượt thi chính thức. Với mỗi lượt thi, thí sinh trả lời <strong class="--t-cl">30 câu hỏi trắc nghiệm trong thời gian 15 phút.</strong> Nội dung câu hỏi là những kiến thức về dinh dưỡng học đường, bộ môn nghề nấu ăn và các kỹ năng bếp.</p>
                                                    <p>Kết quả thi của đội được tính như sau:</p>
                                                    <p>+ <strong class="--t-cl"><i>Điểm tuần</i></strong><strong> = tổng điểm thi trong tuần của 3 thành viên;</strong></p>
                                                    <p>Trường hợp các đội có điểm thi bằng nhau, BTC sẽ xét đến tổng thời gian thi của đội trong tuần đó.  </p>
                                                    <!-- <p><a href="#" class="--s-cl f-bold">Đọc thêm</a></p> -->
                                                </div>
                                            </div>
                                          
                                        </div>
                                    </div>
                                </div>
                                <div class="faqs-content-row">
                                    <h3 class="faqs-content-row-title main-title tt-30 f-oswald f-normal">02. Vòng Chung Kết</h3>
                                    <div class="faqs-content-row-desc">
                                        <div class="dm-grid-2">
                                            <p><strong class="--t-cl"><i>Nội dung thi:</i></strong> các đội dự thi thực hiện một bữa ăn theo yêu cầu của Ban tổ chức theo quy định</p>
                                            <p>Trước vòng thi, các đội thi sẽ được tập huấn để có đầu đủ kiến thức và kỹ năng để tham dự vòng chung kết</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="faqs-sec">
                        <div class="faqs-sec-title">
                            <div class="container">
                                <h2 class="main-title tt-40">Đơn vị tổ chức và nhà tài trợ</h2>
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="faqs-sec-content">
                            <div class="container"> 
                                <div class="faqs-content-row">
                                    <h3 class="faqs-content-row-title main-title tt-30 f-oswald f-normal text-center">Đơn vị tổ chức</h3>
                                    <div class="faqs-content-row-desc">
                                        <div class="dm-grid-2">
                                            <div class="active-content">
                                                <h4 class="active-content-title tt-24 mo-wrap-image m-border-bottom"> 
                                                    <img src="<?php echo site_url() ?>/wp-content/uploads/2021/04/so-giao-duc-va-dao-tao.png" alt=""> 
                                                    Sở Giáo dục và Đào tạo TPHCM 
                                                </h4>  
                                            </div> 
                                        </div>
                                    </div>
                                </div> 
                                <div class="faqs-content-row">
                                    <h3 class="faqs-content-row-title main-title tt-30 f-oswald f-normal text-center">Nhà tài trợ độc quyền</h3>
                                    <div class="faqs-content-row-desc">
                                        <div class="dm-grid-2">
                                            <div class="active-content">
                                                <h4 class="active-content-title tt-24 mo-wrap-image"> 
                                                    <img src="<?php echo site_url() ?>/wp-content/uploads/2021/04/Logo-Wilmar-CLV-01.png" alt="">   
                                                    Tập đoàn Wilmar CLV
                                                </h4>  
                                                <div class="active-content-desc mona-content"> 
                                                    <p><b>Về Wilmar CLV</b></p>
                                                    <p>Được thành lập từ năm 1991, Wilmar International có trụ sở chính đặt tại Singapore, là tập đoàn hàng đầu châu Á về kinh doanh các sản phẩm nông nghiệp. Wilmar International được xếp trong danh sách những doanh nghiệp có vốn hóa thị trường lớn nhất tại Sở chứng khoán Singapore. Mục tiêu chính trong chiến lược phát triển của Wilmar International là hướng tới việc xây dựng và phát triển mô hình kinh doanh khép kín với đa dạng các mặt hàng nông nghiệp. Hiện nay, tập đoàn có hơn 500 nhà máy sản xuất cùng hệ thống phân phối rộng khắp tại Trung Quốc, Ấn Độ, In-đô-nê-xi-a và 50 quốc gia khác, với hơn 90.000 nhân viên trên toàn thế giới. </p>
                                                    <p>Có mặt lần đầu tiên tại Việt Nam từ năm 1998, Wilmar CLV (Campuchia – Lào – Việt Nam) tự hào là tập đoàn hàng đầu trong khu vực với 4 mảng kinh doanh chính: Thực phẩm, Nguyên liệu Thức ăn chăn nuôi, Sản phẩm hóa dầu và Hệ thống Phân phối chuyên nghiệp. Đến nay, Wilmar CLV đã thành công trong việc xây dựng nền móng vững chắc với sự hiện diện của 8 công ty, 4 văn phòng, 10 nhà máy và hơn 2.300 nhân viên. Hiện tại, 7 trên tổng số 10 cơ sở sản xuất ở Việt Nam, không chỉ cung cấp sản phẩm đến khách hàng công nghiệp, còn là nhà sản xuất các mặt hàng tiêu dùng như dầu ăn và chất béo, bột mì, gạo, các sản phẩm giá trị gia tăng từ ngũ cốc (bột trộn sẵn, mì trứng, nui) cũng như nước chấm và gia vị.</p>
                                                    <p>Sứ mệnh của Wilmar CLV là nâng cao sự hài lòng của khách hàng và người tiêu dùng thông qua việc cung cấp sản phẩm chất lượng đẳng cấp quốc tế với chi phí tối ưu.</p> 
                                                </div>
                                            </div>
                                            <!-- <div class="active-content">
                                              
                                            </div> -->
                                        </div>
                                    </div>
                                </div> 
                                <!-- <div class="faqs-content-row">
                                    <h3 class="faqs-content-row-title main-title tt-30 f-oswald f-normal">Sứ mệnh của Wilmar CLV</h3>
                                    <div class="faqs-content-row-desc">
                                        <div class="dm-grid-2">
                                           <p>Nâng cao sự hài lòng của khách hàng và người tiêu dùng thông qua việc cung cấp sản phẩm chất lượng đẳng cấp quốc tế với chi phí tối ưu.</p>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </section>
                    <section class="faqs-sec">
                        <div class="faqs-sec-title">
                            <div class="container">
                                <h2 class="main-title tt-40">Giải thưởng</h2>
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="faqs-sec-content">
                            <div class="container">
                                <div class="faqs-content-row">
                                    <h3 class="faqs-content-row-title main-title tt-30 f-oswald f-normal">Các phần của giải thưởng</h3>
                                    <div class="faqs-content-row-desc">
                                        <div class="dm-grid-2">
                                            <!--div class="active-content">
                                                <h4 class="active-content-title tt-24">01. Giải thưởng vòng loại<br>
                                                </h4>
                                                <div class="active-content-desc mona-content">
                                                    <ul>
                                                        <li>30 Giải tuần phần thi trực tuyến: Bộ quà tặng sản phẩm của đơn vị tài trợ</li>
                                                        <li>03 Giải Tài năng cho 03 phần thi tranh tài: Bộ quà tặng sản phẩm của đơn vị tài trợ</li>
                                                        <li>01 Giải Tập thể: giấy khen + tiền mặt + quà tặng của nhà tài trợ dành cho trường có số lượng đội thi trực tuyến nhiều nhất</li>
                                                    </ul>
                                                </div>
                                            </div-->
                                            <div class="active-content">
                                                <h4 class="active-content-title tt-24">Giải thưởng vòng chung kết
                                                    <!-- <br><span class="--s-cl">(BẮT BUỘC)</span> -->
                                                </h4>
                                                <div class="active-content-desc mona-content">
                                                    <ul>
                                                        <li>1 Giải Nhất bao gồm: hiện kim + giấy khen + bộ quà tặng sản phẩm của đơn vị tài trợ</li>
                                                        <li>3 Giải Nhì bao gồm: hiện kim + giấy khen + bộ quà tặng sản phẩm của đơn vị tài trợ</li>
                                                        <li> 6 Giải Ba bao gồm: hiện kim + giấy khen + bộ quà tặng sản phẩm của đơn vị tài trợ</li>
                                                        <li>40 Giải khuyến khích: hiện kim + giấy khen + bộ quà tặng sản phẩm của đơn vị tài trợ</li>
                                                        <li>Các đội vào vòng Chung kết sẽ được tặng bộ quà tặng sản phẩm của đơn vị tài trợ</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </section>
                    <section class="faqs-sec">
                        <div class="faqs-sec-title">
                            <div class="container">
                                <h2 class="main-title tt-40">Hướng dẫn thi</h2>
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="faqs-sec-content">
                            <div class="container">
                                <div class="faqs-content-row">
                                    <!-- <h3 class="faqs-content-row-title main-title tt-30 f-oswald f-normal">01. Đối với bài thi cá nhân</h3> -->
                                    <div class="faqs-content-row-desc">
                                        <div class="dm-grid-2">
                                            <div class="active-content">
                                                <h4 class="active-content-title tt-24">Đối với bài thi trắc nghiệm Online</h4>
                                                <div class="active-content-desc mona-content"> 
                                                    <p>
                                                        <strong class="--t-cl"><i>Bước 1:</i></strong>
                                                        <strong> Truy cập website hội thi và nhấn vào nút “Vào thi” để vào thi hoặc đăng ký tài khoản</strong>
                                                    </p>
                                                    <p><strong class="--t-cl"><i>Bước 2:</i></strong><strong> Nhập các thông tin theo yêu cầu và tạo tài khoản dự thi</strong></p>
                                                    <p><strong class="--t-cl"><i>Bước 3:</i></strong><strong> Đọc kỹ thể lệ Vòng thi trải nghiệm kiến thức dinh dưỡng. Thí sinh có thể lựa chọn “Thi Thử" để làm quen với đề và cách làm bài</strong></p>
                                                    <p><strong class="--t-cl"><i>Bước 4:</i></strong><strong> Lập nhóm đầy đủ 3 thành viên (Xem hướng dẫn Lập nhóm phía dưới)</strong></p>
                                                    <p><strong class="--t-cl"><i>Bước 5:</i></strong><strong> Nhấn vào "Trải nghiệm" để thực hiện bài thi trắc nghiệm</strong></p>
                                                    <p><strong class="--t-cl"><i>Bước 6:</i></strong><strong> Nhấn “Nộp bài” để nộp bài thi trắc nghiệm và xem kết quả thi trắc nghiệm.</strong></p>
                                                    
                                                </div>
                                            </div>
                                            <div class="active-content">
                                                <h4 class="active-content-title tt-24">Hướng dẫn lập nhóm</h4>
                                                <div class="active-content-desc mona-content">
                                                    <p><strong class="--t-cl"><i>* </i></strong><strong>Đại diện nhóm sẽ thực hiện việc lập nhóm theo các bước sau:</strong></p>
                                                    <p><strong class="--t-cl"><i>Bước 1:</i></strong><strong> Nhấn "Thêm đồng đội" để bắt đầu gộp nhóm</strong></p>
                                                    <p><strong class="--t-cl"><i>Bước 2:</i></strong><strong> Nhập ID hoặc email để tìm đồng đội trong nhóm</strong></p>
                                                    <p><strong class="--t-cl"><i>Bước 3:</i></strong><strong> Sau khi nhóm đã đủ thành viên (3 thành viên), nhấn "Hoàn tất"</strong></p> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
			</main>
<?php
endwhile;
get_footer(); ?>    