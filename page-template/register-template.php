<?php
/**
 * Template name: Register Page
 * @author : Hy Hý
 */
if ( is_user_logged_in() ) {
	if ( isset( $_GET['redirect'] ) ) {
		wp_redirect( $_GET['redirect'] );
		exit;
	}
	wp_redirect( home_url() );
	exit;
}
get_header();
while ( have_posts() ) :
	the_post();
	?>
<script type= "text/javascript">
var country_arr = new Array("Tp. Hồ Chí Minh", "Huế");
var s_a = new Array();
s_a[0] = "";
s_a[1] = "Quận 1|Quận 2|Quận 3|Quận 4|Quận 5|Quận 6|Quận 7|Quận 8|Quận 9|Quận 10|Quận 11|Quận 12|Quận Bình Thạnh|Quận Gò Vấp|Quận Phú Nhuận|Quận Tân Bình|TP. Thủ Đức|Huyện Bình Chánh|Huyện Cần Giờ|Huyện Củ Chi|Huyện Hóc Môn|Huyện Nhà Bè|Quận Tân Phú|Quận Bình Tân";
s_a[2] = "Tp Huế|H.Phong Điền| H.Quảng Điền|Thị xã Hương Trà|H.Phú Vang| Thị xã Hương Thủy|H.Phú Lộc|H.Nam Đông|H.A Lưới";
var s_b = new Array();
s_b[1,1]	=	"THPT Bùi Thị Xuân|THPT Trưng Vương|THPT Ten Lơ Man|THPT Lương Thế Vinh|THPT Năng Khiếu TDTT|THPT Chuyên Trần Đại Nghĩa|Khác";
s_b[1,2]	=	"THPT Thủ Thiêm|THPT Giồng Ông Tố|Khác";
s_b[1,3]	=	"THPT Nguyễn Thị Minh Khai|THPT Lê Quý Đôn|THPT Marie Cuire|THPT Lê Thị Hồng Gấm|THPT Nguyễn Thị Diệu|Khác";
s_b[1,4]	=	"THPT Nguyễn Trãi|THPT Nguyễn Hữu Thọ|Khác";
s_b[1,5]	=	"Trung Học Thực Hành Sài Gòn|THPT Trần Hữu Trang|THPT Chuyên Lê Hồng Phong|THPT Hùng Vương|TH Thực Hành ĐHSP|PT Năng Khiếu Đại Học Quốc Gia|THPT Trần Khai Nguyên|Khác";
s_b[1,6]	=	"THPT Mạc Đĩnh Chi|THPT Bình Phú|THPT Nguyễn Tất Thành|THPT Phạm Phú Thứ|Khác";
s_b[1,7]	=	"THPT Nam Sài Gòn|THPT Ngô Quyền|THPT Tân Phong|THPT Lê Thánh Tôn|Khác";
s_b[1,8]	=	"THPT Nguyễn Văn Linh|THPT Lương Văn Can|THPT Ngô Gia Tự|THPT Tạ Quang Bửu|THPT Võ Văn Kiệt|THPT Năng Khiếu TDTT Nguyễn Thị Định|Khác";
s_b[1,9]	=	"THPT Phước Long|THPT Lonh Trường|THPT Nguyễn Huệ|THPT Nguyễn Văn Tăng|Khác";
s_b[1,10]	=	"THPT Nguyễn An Ninh|THPT Nguyễn Khuyến|THPT Nguyễn Du|THPT Sương Nguyệt Anh|THPT Diên Hồng|Khác";
s_b[1,11]	=	"THPT Nguyễn Hiền|THPT Nam Kỳ Khởi Nghĩa|THPT Trần Quang Khải|Khác";
s_b[1,12]	=	"THPT Thạnh Lộc|THPT Trường Chinh|THPT Võ Trường Toản|Khác";
s_b[1,13]	=	"THPT Trần Văn Giàu|THPT Hoàng Hoa Thám|THPT Thanh Đa|THPT Võ Thị Sáu|THPT Gia ĐỊnh|THPT Phan Đăng Lưu|Khác";
s_b[1,14]	=	"THPT Gò Vấp|THPT Nguyễn Công Trứ|THPT Nguyễn Trung Trực|THPT Trần Hưng Đạo|Khác";
s_b[1,15]	=	"THPT Phú Nhuận|THPT Quốc Tế Việt Úc|THPT Hàn Thuyên|Khác";
s_b[1,16]	=	"THPT Nguyễn Chí Thanh|THPT Nguyễn Thượng Hiền|THPT Nguyễn Thái Bình| THPT Lý Tự Trọng|Khác";
s_b[1,17]	=	"THPT Đào Sơn Tây|THPT Thủ Đức|THPT Nguyễn Hữu Huân| THPT Tam Phú|THPT Hiệp Bình|Phổ Thông Năng Khiếu Thể Thao Olympic|THPT Linh Trung|Khác";
s_b[1,18]	=	"THPT Năng Khiếu TDTT Huyện Bình Chánh|THPT Vĩnh Lộc B|THPT Bình Chánh| THPT Tân Túc|THPT Lê Minh Xuân|THPT Đa Phước|Khác";
s_b[1,19]	=	"THPT An Nghĩa|THPT Bình Khánh|THPT Cần Thạnh|THCS-THPT Thạnh An|Khác";
s_b[1,20]	=	"THPT Củ Chi|THPT Quang Trung|THPT An Nhơn Tây|THPT Trung Phú|THPT Trung Lập|THPT Phú Hòa|THPT Tân Thông Hội|Khác";
s_b[1,21]	=	"THPT Phạm Văn Sáng|THPT Bà Điểm|THPT Nguyễn Văn Cừ|THPT Nguyễn Hữu Tiến|THPT Nguyễn Hữu Cầu|THPT Lý Thường Kiệt|Khác";
s_b[1,22]	=	"THPT Long Thới|THPT Phước Kiển|THPT Dương Văn Dương|Khác";
s_b[1,23]	=	"THPT Lê Trọng Tấn|THPT Tây Thạnh|THPT Tân Bình|THPT Trần Phú|Khác";
s_b[1,24]	=	"THPT Vĩnh Lộc|THPT Bình Hưng Hòa|THPT Bình Tân|THPT An Lạc|THPT Nguyễn Hữu Cảnh|Khác";
s_b[2,1]	= 	"THPT Chuyên Quốc Học|THPT Hai Bà Trưng|THPT Nguyễn Huệ|THPT Gia Hội|THPT Bùi Thị Xuân|THPT Nguyễn Trường Tộ|THPT Dân tộc Nội trú Tỉnh|THPT Đặng Trần Côn|THPT Chi Lăng|THPT DL Trần Hưng Đạo|THPT Cao Thắng|Trung tâm GDTX TP Huế";
s_b[2,2]	= 	"THPT Phong Điền|THPT Tam Giang|THPT Nguyễn Đình Chiểu|THPT Trần Văn Kỷ|Trung tâm GDTX Phong Điền";
s_b[2,3]	= 	"THPT Hóa Châu|THPT Nguyễn Chí Thanh|THPT Tố Hữu|Trung tâm GDTX Quảng Điền";
s_b[2,4]	= 	"THPT Đặng Huy Trứ|THPT Hương Vinh|THPT Bình Điền|THPT Hương Trà|Trung tâm GDTX Hương Trà";
s_b[2,5]	= 	"THPT Phan Đăng Lưu|THPT Nguyễn Sinh Cung|THPT Vinh Xuân|THPT Thuận An|THPT Hà Trung|Trung tâm GDTX Phú Vang";
s_b[2,6]	= 	"THPT Hương Thủy|THPT Phú Bài|THPT Nguyễn Trãi|Trung tâm GDNN-GDTX Hương Thủy";
s_b[2,7]	= 	"THPT An Lương Đông|THPT Vinh Lộc|THPT Phú Lộc|THPT Thừa Lưu|THPT Tư Thục Thế Hệ Mới|Trung tâm GDTX Phú Lộc";
s_b[2,8]	= 	"THPT Nam Đông|THPT Hương Giang|Trung tâm GDTX Nam Đông";
s_b[2,9]	= 	"THPT A Lưới|THPT Hương Lâm|THPT Hồng Vân|Trung tâm GDNN-GDTX A Lưới";
function print_country(country_id){
	console.log('asf');
	var option_str = document.getElementById(country_id);
	option_str.length=0;
	option_str.options[0] = new Option('Chọn Khu vực','');
	option_str.selectedIndex = 0;
	for (var i=0; i<country_arr.length; i++) {
		option_str.options[option_str.length] = new Option(country_arr[i],country_arr[i]);
	}
}

function print_state(state_id, state_index){
	var option_str = document.getElementById(state_id);
	option_str.length=0;
	option_str.options[0] = new Option('Chọn Quận','');
	option_str.selectedIndex = 0;
	var state_arr = s_a[state_index].split("|");
	for (var i=0; i<state_arr.length; i++) {
		option_str.options[option_str.length] = new Option(state_arr[i],state_arr[i]);
	}
}

function print_district(district_id, district_index){
	var option_str = document.getElementById(district_id);
	option_str.length=0;
	option_str.options[0] = new Option('Chọn Trường','');
	option_str.selectedIndex = 0;
	var district_arr = s_b[district_index].split("|");
	for (var i=0; i<district_arr.length; i++) {
		option_str.options[option_str.length] = new Option(district_arr[i],district_arr[i]);
	}
}

</script>
	<main class="main main-auth main-auth-register">
		<section class="auth sec-60" data-aos="fade">
			<div class="container">
				<div class="auth-nav --mb-50">
					<?php echo get_template_part( 'patch/auth', 'nav' ) ?>
				</div>
				<div class="auth-title --mb-50">
					<h2 class="main-title tt-40 --s-cl" data-aos="fade-up">
						<?php the_title() ?>
					</h2>
					<div class="desc mona-content" data-aos="fade-up" data-aos-delay="100">
						<?php the_content() ?>
					</div>
				</div>
				<div class="auth-form">
					<form id="mona-register-form">
						<div class="auth-form-grid --mb-30">
							<div class="f-group" data-aos="fade-up" data-aos-delay="150">
								<label for="#">
									Họ và tên <span class="--s-cl">*</span>
								</label>
								<input required type="text" class="f-control" name="full-name"/>
							</div>
							<div class="f-group" data-aos="fade-up" data-aos-delay="150">
								<label for="#">
									Ngày tháng năm sinh <span class="--s-cl">*</span>
								</label>
								<input required type="date" id="birthday" class="f-control flatpickr-input" name="birthday" />
							</div>
							<div class="f-group" data-aos="fade-up" data-aos-delay="150">
								<label for="#"> Lớp <span class="--s-cl">*</span> </label>
								<input required type="text" class="f-control" name="class"/>
							</div>
							<div class="f-group" data-aos="fade-up" data-aos-delay="200">
								<label for="#"> Khu vực <span class="--s-cl">*</span> </label>
								<select  required name="block" id="country" class="f-control" onchange="print_state('state',this.selectedIndex);">
								</select>
							</div>
							<div class="f-group" data-aos="fade-up" data-aos-delay="200">
								<label for="#"> Quận <span class="--s-cl">*</span> </label>
								<select  required name="block" id="state" class="f-control" onchange="print_district('district',this.selectedIndex);">
								</select>
							</div>
							<div class="f-group" data-aos="fade-up" data-aos-delay="200">
								<label for="#">
									Trường <span class="--s-cl">*</span>
								</label>
								<select class="f-control" name ="school" id ="district"></select>
								<div id="myschool"  style="display:none"><input class="f-control" name ="school" id ="school"></div>
							</div>
							<div class="f-group" data-aos="fade-up" data-aos-delay="200">
								<label for="#">
									Số điện thoại<span class="--s-cl">*</span>
								</label>
								<input required type="tel" class="f-control" name="number-phone" />
							</div>
							<div class="f-group" data-aos="fade-up" data-aos-delay="300">
								<label for="#">
									Email <span class="--s-cl">*</span>
								</label>
								<input required type="text" class="f-control" name="user-name"/>
							</div>
							<div class="f-group" data-aos="fade-up" data-aos-delay="300">
								<label for="#">
									Password <span class="--s-cl">*</span>
								</label>
								<input required type="password" class="f-control" name="password" />
							</div>

							<div class="f-group" data-aos="fade-up" data-aos-delay="300">
								<label for="#">
									Nhập lại password <span class="--s-cl">*</span>
								</label>
								<input required type="password" class="f-control" name="password-confirm" />
							</div>
						</div>
						<div class="f-submit" data-aos="fade-up" data-aos-delay="300">
							<button type="submit" class="main-btn main-btn-ajax">Đăng ký</button>
						</div>
						<div id="response-messenger">
							<ul>

							</ul>
						</div>
					</form>
					<script language="javascript">
						print_country("country");
						jQuery('#state').on('change',function(){
							console.log('1');
							if( $(this).val()==="Khác"){
								console.log('2');
								jQuery("#myschool").show();
								jQuery("#state").hide();
							}
							else{
								jQuery("#myschool").hide();
							}
						});
					</script>
				</div>
			</div>
			<div class="auth-bg">
				<img src="<?php echo site_url( 'template' ) ?>/images/bg-register.png" alt="" />
			</div>
		</section>
	</main>
	<?php
endwhile;
get_footer();
?>
