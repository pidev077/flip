<?php
/**
 * Template Name: Chính Sách Bảo Mật
 */

get_header();

$info    = get_field('info_group', 'option') ?: [];
$phone   = $info['phone_number'] ?? null;
$hotline = $phone ? esc_html($phone['title']) : '0964.202.040';
?>

<main id="primary" class="site-main page-privacy">

    <!-- ── Hero ──────────────────────────────────────────────── -->
    <section class="pp-hero">
        <div class="container pp-hero__inner">
            <span class="pp-hero__eyebrow">KHÁC VỀ</span>
            <h1 class="pp-hero__title">Chính sách<br>bảo mật thông tin.</h1>
            <p class="pp-hero__meta">Tạo vào: 01.01.2025 &nbsp;&nbsp;·&nbsp;&nbsp; Phiên bản 1.1</p>
        </div>
    </section>

    <!-- ── Body: TOC + Content ───────────────────────────────── -->
    <section class="pp-body">
        <div class="container pp-body__wrap">

            <!-- Table of Contents -->
            <aside class="pp-toc">
                <p class="pp-toc__label">MỤC LỤC</p>
                <ol class="pp-toc__list">
                    <li><a href="#pp-s1">Giới thiệu &amp; Phạm vi áp dụng</a></li>
                    <li><a href="#pp-s2">Thông tin chúng tôi thu thập</a></li>
                    <li><a href="#pp-s3">Mục đích sử dụng thông tin</a></li>
                    <li><a href="#pp-s4">Bảo mật và lưu trữ dữ liệu</a></li>
                    <li><a href="#pp-s5">Chia sẻ thông tin với bên thứ ba</a></li>
                    <li><a href="#pp-s6">Quyền của bạn</a></li>
                    <li><a href="#pp-s7">Cookie và công nghệ theo dõi</a></li>
                    <li><a href="#pp-s8">Liên hệ &amp; Khiếu nại</a></li>
                </ol>
            </aside>

            <!-- Content -->
            <div class="pp-content">

                <!-- 01 -->
                <article class="pp-section" id="pp-s1">
                    <div class="pp-section__head">
                        <span class="pp-section__num">01</span>
                        <h2 class="pp-section__title">Giới thiệu &amp; Phạm vi áp dụng</h2>
                    </div>
                    <div class="pp-section__body">
                        <p>Tamya Clinic ("Tamya", "chúng tôi") cam kết bảo vệ quyền riêng tư và quyền thông tin cá nhân của khách hàng. Chính sách này mô tả cách chúng tôi thu thập, sử dụng, lưu trữ và bảo vệ dữ liệu cá nhân của bạn khi sử dụng website, dịch vụ hoặc liên hệ với Tamya.</p>
                        <p>Chính sách này áp dụng cho tất cả khách hàng, người dùng website, người đặt hẹn trực tuyến và bất kỳ ai tương tác với Tamya thông qua các kênh trực tuyến hoặc trực tiếp tại cơ sở.</p>
                        <div class="pp-note">
                            Bằng việc sử dụng dịch vụ của Tamya hoặc cung cấp thông tin cho chúng tôi, bạn đồng ý với các điều khoản được nêu trong chính sách này.
                        </div>
                    </div>
                </article>

                <!-- 02 -->
                <article class="pp-section" id="pp-s2">
                    <div class="pp-section__head">
                        <span class="pp-section__num">02</span>
                        <h2 class="pp-section__title">Thông tin chúng tôi thu thập</h2>
                    </div>
                    <div class="pp-section__body">
                        <p>Tamya chỉ thu thập những thông tin cần thiết để cung cấp dịch vụ tốt nhất cho bạn.</p>
                        <p><strong>Thông tin bạn chủ động cung cấp:</strong></p>
                        <ul>
                            <li>Họ tên, số điện thoại để đặt hẹn hoặc điền vào biểu mẫu liên hệ</li>
                            <li>Tình trạng da, lịch sử điều trị và các vấn đề sức khỏe liên quan trong quá trình tư vấn</li>
                            <li>Lịch sử sử dụng dịch vụ và các phản hồi bạn chia sẻ với chúng tôi</li>
                            <li>Phản hồi, đánh giá và ý kiến bạn gửi cho chúng tôi</li>
                        </ul>
                        <p><strong>Thông tin thu thập tự động khi bạn sử dụng website:</strong></p>
                        <ul>
                            <li>Địa chỉ IP, loại trình duyệt và thiết bị bạn truy cập</li>
                            <li>Trang bạn xem, thời gian truy cập (thông qua cookie phân tích)</li>
                            <li>Nguồn truy cập (từ công cụ tìm kiếm, mạng xã hội hay liên kết khác)</li>
                        </ul>
                    </div>
                </article>

                <!-- 03 -->
                <article class="pp-section" id="pp-s3">
                    <div class="pp-section__head">
                        <span class="pp-section__num">03</span>
                        <h2 class="pp-section__title">Mục đích sử dụng thông tin</h2>
                    </div>
                    <div class="pp-section__body">
                        <p>Thông tin của bạn được sử dụng cho các mục đích sau:</p>
                        <ul>
                            <li>Xác nhận lịch hẹn và liên lạc về dịch vụ bạn đã đăng ký</li>
                            <li>Tư vấn và thiết kế phác đồ điều trị phù hợp với tình trạng da cụ thể của bạn</li>
                            <li>Theo dõi tiến trình điều trị và nhắc nhở về thời điểm cần tái khám</li>
                            <li>Gửi thông tin về chương trình, liệu trình mới hợp pháp theo nhu cầu của bạn</li>
                            <li>Cải thiện chất lượng dịch vụ và trải nghiệm khách hàng</li>
                            <li>Tuân thủ các nghĩa vụ pháp lý theo các quy định pháp luật Việt Nam</li>
                        </ul>
                        <div class="pp-note">
                            Tamya <strong>không</strong> sử dụng thông tin của bạn cho mục đích quảng cáo của bên thứ ba hay bán/trao đổi dữ liệu khách hàng dưới bất kỳ hình thức nào.
                        </div>
                    </div>
                </article>

                <!-- 04 -->
                <article class="pp-section" id="pp-s4">
                    <div class="pp-section__head">
                        <span class="pp-section__num">04</span>
                        <h2 class="pp-section__title">Bảo mật và lưu trữ dữ liệu</h2>
                    </div>
                    <div class="pp-section__body">
                        <p>Tamya áp dụng các biện pháp kỹ thuật và tổ chức phù hợp để đảm bảo bảo mật thông tin cá nhân theo quy định pháp luật:</p>
                        <ul>
                            <li>Dữ liệu khách hàng được lưu trên hệ thống bảo mật, chỉ nhân viên được ủy quyền mới được truy cập</li>
                            <li>Mọi thông tin được truy cập qua website được mã hóa thông qua giao thức bảo mật SSL/TLS</li>
                            <li>Mật khẩu và thông tin nhạy cảm được mã hóa bằng thuật toán và không được lưu dưới dạng văn bản thuần</li>
                            <li>Thông tin chỉ được lưu trữ trong thời gian cần thiết hoặc theo yêu cầu pháp luật</li>
                        </ul>
                        <p>Mặc dù chúng tôi áp dụng mọi biện pháp bảo vệ hợp lý, không có phương thức truyền dữ liệu qua internet nào là an toàn tuyệt đối. Nếu có bất kỳ sự cố bảo mật nào, Tamya sẽ thông báo cho bạn theo quy định pháp luật hiện hành.</p>
                    </div>
                </article>

                <!-- 05 -->
                <article class="pp-section" id="pp-s5">
                    <div class="pp-section__head">
                        <span class="pp-section__num">05</span>
                        <h2 class="pp-section__title">Chia sẻ thông tin với bên thứ ba</h2>
                    </div>
                    <div class="pp-section__body">
                        <p>Tamya <strong>không</strong> bán, cho thuê hoặc trao đổi thông tin cá nhân của bạn cho bên thứ ba vì mục đích thương mại. Thông tin của bạn chỉ có thể được chia sẻ trong các trường hợp sau:</p>
                        <ul class="pp-list--table">
                            <li>
                                <strong>Đối tác cung cấp dịch vụ</strong>
                                <span>— các nhà cung cấp công nghệ, thanh toán hoặc dịch vụ hỗ trợ vận hành của Tamya, có nghĩa vụ bảo mật nghiêm ngặt</span>
                            </li>
                            <li>
                                <strong>Yêu cầu pháp lý</strong>
                                <span>— khi nhận yêu cầu chính thức của cơ quan nhà nước có thẩm quyền theo quy định pháp lý Việt Nam</span>
                            </li>
                            <li>
                                <strong>Với sự đồng ý của bạn</strong>
                                <span>— trong các trường hợp cụ thể khác, chúng tôi sẽ xin phép bạn trước khi chia sẻ</span>
                            </li>
                        </ul>
                    </div>
                </article>

                <!-- 06 -->
                <article class="pp-section" id="pp-s6">
                    <div class="pp-section__head">
                        <span class="pp-section__num">06</span>
                        <h2 class="pp-section__title">Quyền của bạn</h2>
                    </div>
                    <div class="pp-section__body">
                        <p>Theo quy định Luật An toàn thông tin mạng và các văn bản pháp luật liên quan, bạn có các quyền sau đối với dữ liệu cá nhân của mình:</p>
                        <ul>
                            <li><strong>Quyền truy cập</strong> — yêu cầu thông tin về dữ liệu cá nhân chúng tôi đang lưu giữ về bạn</li>
                            <li><strong>Quyền chỉnh sửa</strong> — yêu cầu cập nhật dữ liệu nếu thông tin không chính xác</li>
                            <li><strong>Quyền xóa</strong> — yêu cầu xóa dữ liệu cá nhân trong trường hợp hợp lệ theo quy định pháp luật</li>
                            <li><strong>Quyền rút đồng ý</strong> — từ chối nhận thông tin tiếp thị hoặc từ bỏ các quyền đã đồng ý</li>
                        </ul>
                        <p>Để thực hiện các quyền trên, vui lòng liên hệ trực tiếp với Tamya qua hotline hoặc email được cung cấp ở mục 08. Tất cả yêu cầu sẽ được phản hồi trong vòng <strong>7 ngày làm việc</strong>.</p>
                    </div>
                </article>

                <!-- 07 -->
                <article class="pp-section" id="pp-s7">
                    <div class="pp-section__head">
                        <span class="pp-section__num">07</span>
                        <h2 class="pp-section__title">Cookie và công nghệ theo dõi</h2>
                    </div>
                    <div class="pp-section__body">
                        <p>Website của Tamya sử dụng cookie và các công nghệ tương tự để cải thiện trải nghiệm người dùng và phân tích lượng truy cập. Các loại cookie chúng tôi sử dụng:</p>
                        <ul>
                            <li><strong>Cookie cần thiết</strong> — đảm bảo website hoạt động đúng chức năng, không thể tắt</li>
                            <li><strong>Cookie phân tích</strong> — đo lường lưu lượng và hành vi người dùng thông qua Google Analytics (ẩn danh hoàn toàn)</li>
                            <li><strong>Cookie marketing</strong> — theo dõi hiệu quả quảng cáo của chúng tôi trên Facebook, Google (có thể tắt thông qua cài đặt trình duyệt)</li>
                        </ul>
                        <p>Bạn có thể kiểm soát cookie thông qua cài đặt trình duyệt. Tuy nhiên, tắt một số cookie có thể ảnh hưởng đến trải nghiệm khi sử dụng website.</p>
                    </div>
                </article>

                <!-- 08 -->
                <article class="pp-section" id="pp-s8">
                    <div class="pp-section__head">
                        <span class="pp-section__num">08</span>
                        <h2 class="pp-section__title">Liên hệ &amp; Khiếu nại</h2>
                    </div>
                    <div class="pp-section__body">
                        <p>Nếu có bất kỳ câu hỏi, yêu cầu hoặc khiếu nại nào liên quan đến chính sách bảo mật, vui lòng liên hệ với chúng tôi:</p>
                        <ul>
                            <li><strong>Hotline:</strong> <?php echo $hotline; ?> (T2–T7, 08:00–19:00)</li>
                            <li><strong>Địa chỉ HCM:</strong> Aqua 4, Vinhomes Ba Son, Quận 1, TP. HCM</li>
                            <li><strong>Địa chỉ HN:</strong> 456 Kim Ngưu, Phường Vĩnh Tuy, Quận Hai Bà Trưng, Hà Nội</li>
                        </ul>
                        <p>Chính sách này được cập nhật định kỳ để phản ánh hoạt động của Tamya hoặc theo các quy định pháp luật mới. Các thay đổi sẽ được đăng tải trên website và có hiệu lực ngay sau ngày cập nhật trên trang.</p>
                    </div>
                </article>

            </div><!-- .pp-content -->
        </div><!-- .pp-body__wrap -->
    </section>

    <!-- ── CTA Bar ────────────────────────────────────────────── -->
    <section class="pp-cta">
        <div class="container pp-cta__inner">
            <p class="pp-cta__text">Chúng tôi luôn sẵn sàng giải đáp.</p>
            <a href="<?php echo esc_url(home_url('/lien-he')); ?>" class="pp-cta__btn">LIÊN HỆ TAMYA</a>
        </div>
    </section>

</main>

<script>
(function () {
    var tocLinks = document.querySelectorAll('.pp-toc__list a');
    var sections = document.querySelectorAll('.pp-section');

    function onScroll() {
        var scrollY = window.scrollY + 120;
        var current = '';
        sections.forEach(function (sec) {
            if (sec.offsetTop <= scrollY) current = sec.id;
        });
        tocLinks.forEach(function (link) {
            link.classList.toggle('is-active', link.getAttribute('href') === '#' + current);
        });
    }

    tocLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            var target = document.querySelector(link.getAttribute('href'));
            if (target) window.scrollTo({ top: target.offsetTop - 80, behavior: 'smooth' });
        });
    });

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
})();
</script>

<?php get_footer(); ?>
