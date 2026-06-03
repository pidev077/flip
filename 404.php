<?php
/**
 * The template for displaying 404 pages (not found)
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 * @package flip
 */

get_header();

$link_contact = get_field('link_contact_hd', 'option');
?>
<main id="primary" class="site-main">
    <section class="page-404">

        <div class="page-404__decor page-404__decor--left" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 800" fill="none">
                <path d="M118 0 C113 100 106 220 114 340 C121 460 116 580 112 700 C110 760 112 780 114 800" stroke="#c8d3bf" stroke-width="1.5"/>
                <ellipse cx="68" cy="135" rx="52" ry="86" transform="rotate(-28 68 135)" fill="#ccd6c3" opacity="0.75"/>
                <ellipse cx="170" cy="248" rx="50" ry="82" transform="rotate(24 170 248)" fill="#ccd6c3" opacity="0.70"/>
                <ellipse cx="66" cy="375" rx="52" ry="84" transform="rotate(-22 66 375)" fill="#ccd6c3" opacity="0.75"/>
                <ellipse cx="172" cy="488" rx="48" ry="78" transform="rotate(20 172 488)" fill="#ccd6c3" opacity="0.70"/>
                <ellipse cx="68" cy="605" rx="48" ry="76" transform="rotate(-18 68 605)" fill="#ccd6c3" opacity="0.75"/>
            </svg>
        </div>

        <div class="page-404__decor page-404__decor--right" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 800" fill="none">
                <path d="M122 0 C127 100 134 220 126 340 C119 460 124 580 128 700 C130 760 128 780 126 800" stroke="#c8d3bf" stroke-width="1.5"/>
                <ellipse cx="172" cy="110" rx="50" ry="82" transform="rotate(22 172 110)" fill="#ccd6c3" opacity="0.70"/>
                <ellipse cx="68" cy="230" rx="52" ry="86" transform="rotate(-26 68 230)" fill="#ccd6c3" opacity="0.75"/>
                <ellipse cx="175" cy="350" rx="50" ry="80" transform="rotate(20 175 350)" fill="#ccd6c3" opacity="0.70"/>
                <ellipse cx="65" cy="462" rx="48" ry="78" transform="rotate(-22 65 462)" fill="#ccd6c3" opacity="0.75"/>
                <ellipse cx="174" cy="578" rx="48" ry="76" transform="rotate(18 174 578)" fill="#ccd6c3" opacity="0.70"/>
                <ellipse cx="68" cy="690" rx="45" ry="72" transform="rotate(-16 68 690)" fill="#ccd6c3" opacity="0.75"/>
            </svg>
        </div>

        <div class="container">
            <div class="page-404__inner">
                <div class="page-404__bg-text" aria-hidden="true">404</div>

                <div class="page-404__content">
                    <p class="page-404__label">TRANG KHÔNG TÌM THẤY</p>
                    <h1 class="page-404__title">Có vẻ bạn đã lạc<br>vào nơi không đúng.</h1>
                    <p class="page-404__desc">Trang bạn đang tìm kiếm không tồn tại<br class="d-none d-sm-block">hoặc đã được chuyển đến địa chỉ khác.</p>

                    <a class="page-404__btn" href="<?php echo esc_url(home_url('/')); ?>">
                        VỀ TRANG CHỦ →
                    </a>

                    <?php if (!empty($link_contact)): ?>
                        <a class="page-404__contact-link" href="<?php echo esc_url($link_contact['url']); ?>" target="<?php echo esc_attr($link_contact['target']); ?>">
                            Liên hệ với chúng tôi
                        </a>
                    <?php else: ?>
                        <a class="page-404__contact-link" href="<?php echo esc_url(home_url('/lien-he')); ?>">
                            Liên hệ với chúng tôi
                        </a>
                    <?php endif; ?>

                    <div class="page-404__nav">
                        <span class="page-404__nav-label">HOẶC XEM</span>
                        <div class="page-404__nav-links">
                            <a href="<?php echo esc_url(home_url('/lieu-trinh')); ?>">Liệu trình</a>
                            <a href="<?php echo esc_url(home_url('/san-pham')); ?>">Sản phẩm</a>
                            <a href="<?php echo esc_url(home_url('/tin-tuc')); ?>">Tin tức</a>
                            <a href="<?php echo esc_url(home_url('/dat-hen')); ?>">Đặt hẹn</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</main><!-- #main -->
<?php get_footer(); ?>
