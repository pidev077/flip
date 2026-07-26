<?php
/**
 * Template Name: Đào Tạo & Workshop
 */

get_header();

$zoom_img   = get_field('zoom_banner_image');
$zoom_title = get_field('zoom_title')        ?: 'Zoom Training Định Kỳ';
$zoom_desc  = get_field('zoom_description')  ?: 'Tham gia buổi đào tạo chuyên sâu cùng đội ngũ chuyên gia da liễu của Tamya. Cập nhật kiến thức mới nhất về công nghệ thẩm mỹ, kỹ thuật điều trị và chăm sóc da chuyên nghiệp.';
$zoom_sched = get_field('zoom_schedule')     ?: 'Thứ 5 hàng tuần';
$zoom_time  = get_field('zoom_time')         ?: '20:00 – 21:30 (GMT+7)';
$zoom_price = get_field('zoom_price')        ?: 'MIỄN PHÍ';
$zoom_link  = get_field('zoom_register_link');
$zoom_note  = get_field('zoom_note')         ?: 'Thông tin Zoom sẽ được gửi qua email sau khi đăng ký';

$zoom_room_link     = get_field('zoom_room_link');
$zoom_room_id       = get_field('zoom_room_id');
$zoom_room_password = get_field('zoom_room_password');
$zoom_datetime      = trim($zoom_sched . ($zoom_time ? ' · ' . $zoom_time : ''));

$gallery_items = get_field('gallery_items');

// ── Đăng ký đào tạo (form dùng chung Zoom + Sự kiện) ─────────
$reg_form_id = get_option('tamya_training_form_id');
$fb_link     = get_field('link_facebook', 'option') ?: '#';
$zalo_link   = get_field('link_zalo', 'option')     ?: '#';

$info_group    = get_field('info_group', 'option') ?: [];
$hotline_field = $info_group['phone_number'] ?? null;
$hotline_label = $hotline_field ? $hotline_field['title'] : '0964.202.040';

// Sự kiện đào tạo sắp diễn ra — sắp xếp theo ngày diễn ra gần nhất
$events_query = new WP_Query([
    'post_type'      => 'su-kien-dao-tao',
    'posts_per_page' => 3,
    'meta_key'       => 'event_date',
    'orderby'        => 'meta_value',
    'order'          => 'ASC',
]);
?>

<main id="primary" class="site-main page-daotao">

    <!-- ── Zoom Training Định Kỳ ───────────────────────────── -->
    <section class="pdt-zoom">
        <div class="container pdt-zoom__inner">

            <div class="pdt-zoom__img-wrap">
                <?php if (!empty($zoom_img)) : ?>
                    <img src="<?= esc_url($zoom_img['url']) ?>"
                         alt="<?= esc_attr($zoom_img['alt'] ?: $zoom_title) ?>">
                <?php endif; ?>
            </div>

            <div class="pdt-zoom__body">
                <p class="pdt-eyebrow"><span class="pdt-dot"></span>Trực Tuyến</p>

                <h1 class="pdt-zoom__title"><?= esc_html($zoom_title) ?></h1>
                <p class="pdt-zoom__desc"><?= wp_kses_post($zoom_desc) ?></p>

                <div class="pdt-schedule">
                    <p class="pdt-schedule__label">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="1.8"/>
                            <path d="M16 2v4M8 2v4M3 10h18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                        Lịch Cố Định
                    </p>
                    <p class="pdt-schedule__day"><?= esc_html($zoom_sched) ?></p>
                    <p class="pdt-schedule__time"><?= esc_html($zoom_time) ?></p>
                </div>

                <div class="pdt-zoom__actions">
                    <span class="pdt-tag-free"><?= esc_html($zoom_price) ?></span>
                    <?php if ($zoom_link && !empty($zoom_link['url'])) : ?>
                    <a class="pdt-btn-cta"
                       href="<?= esc_url($zoom_link['url']) ?>"
                       <?= $zoom_link['target'] ? 'target="' . esc_attr($zoom_link['target']) . '"' : '' ?>>
                        <?= esc_html($zoom_link['title'] ?: 'Đăng Ký Ngay') ?>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </a>
                    <?php else : ?>
                    <button type="button" class="pdt-btn-cta"
                        data-open-register="1"
                        data-register-flow="zoom"
                        data-register-title="<?= esc_attr($zoom_title) ?>"
                        data-register-time="<?= esc_attr($zoom_datetime) ?>"
                        data-register-cost="<?= esc_attr($zoom_price) ?>">
                        Đăng Ký Ngay
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </button>
                    <?php endif; ?>
                </div>

                <p class="pdt-zoom__note"><?= esc_html($zoom_note) ?></p>
            </div>

        </div>
    </section>

    <!-- ── Sự kiện đào tạo (Custom Post Type: su-kien-dao-tao) ─ -->
    <section class="pdt-events">
        <div class="container">

            <div class="pdt-workshop__head">
                <p class="pdt-eyebrow pdt-eyebrow--center">Lịch Đào Tạo</p>
                <h2 class="pdt-workshop__title">Sự kiện đào tạo nổi bật sắp diễn ra</h2>
                <p class="pdt-workshop__desc">Các lớp đào tạo chuyên sâu cùng chuyên gia trong và ngoài nước — cập nhật công nghệ, kỹ thuật và tư duy chữa lành làn da.</p>
            </div>

            <?php if ($events_query->have_posts()) : ?>
            <div class="pdt-events__grid">
                <?php while ($events_query->have_posts()) : $events_query->the_post();
                    $ev_terms   = get_the_terms(get_the_ID(), 'loai-su-kien');
                    $ev_badge   = ($ev_terms && !is_wp_error($ev_terms)) ? $ev_terms[0]->name : '';
                    $ev_date    = get_field('event_date');
                    $ev_time    = get_field('event_time');
                    $ev_price   = get_field('price_type') ?: 'co_phi';
                    $ev_price_label = $ev_price === 'mien_phi' ? 'Miễn phí' : 'Có phí';

                    $ev_expert_name = get_field('expert_name');
                    $ev_expert_role = get_field('expert_role');
                    $ev_format      = get_field('format');
                    $ev_duration    = get_field('duration');
                    $ev_cost_label  = get_field('cost_label') ?: $ev_price_label;
                    $ev_benefits    = get_field('benefits');
                    $ev_register    = get_field('register_link');
                    $ev_note        = get_field('register_note') ?: 'Sau khi đăng ký, chuyên viên Tamya sẽ liên hệ xác nhận suất tham gia và gửi link phòng học qua email.';
                    $ev_image       = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : '';
                ?>
                <article class="pdt-event-card"
                    tabindex="0"
                    data-dt-popup
                    data-badge="<?= esc_attr($ev_badge) ?>"
                    data-image="<?= esc_attr($ev_image) ?>"
                    data-title="<?= esc_attr(get_the_title()) ?>"
                    data-date="<?= esc_attr($ev_date) ?>"
                    data-time="<?= esc_attr($ev_time) ?>"
                    data-format="<?= esc_attr($ev_format) ?>"
                    data-duration="<?= esc_attr($ev_duration) ?>"
                    data-expert-name="<?= esc_attr($ev_expert_name) ?>"
                    data-expert-role="<?= esc_attr($ev_expert_role) ?>"
                    data-benefits="<?= esc_attr($ev_benefits) ?>"
                    data-cost-label="<?= esc_attr($ev_cost_label) ?>"
                    data-register-url="<?= esc_attr($ev_register ? $ev_register['url'] : '') ?>"
                    data-register-label="<?= esc_attr($ev_register && $ev_register['title'] ? $ev_register['title'] : 'Đăng ký tham gia') ?>"
                    data-note="<?= esc_attr($ev_note) ?>"
                >
                    <div class="pdt-event-card__img">
                        <?php if (has_post_thumbnail()) the_post_thumbnail('medium_large'); ?>
                        <?php if ($ev_badge) : ?><span class="pdt-badge"><?= esc_html($ev_badge) ?></span><?php endif; ?>
                    </div>
                    <div class="pdt-event-card__body">
                        <?php if ($ev_date || $ev_time) : ?>
                        <p class="pdt-event-card__meta"><span class="meta-space"></span>
                            <?= esc_html($ev_date) ?><?= $ev_time ? ' · ' . esc_html($ev_time) : '' ?>
                        </p>
                        <?php endif; ?>
                        <h3 class="pdt-event-card__title"><?php the_title(); ?></h3>
                        <p class="pdt-event-card__desc"><?= wp_trim_words(get_the_excerpt(), 20, '...') ?></p>
                        <div class="pdt-event-card__foot">
                            <span class="pdt-event-card__price pdt-event-card__price--<?= esc_attr($ev_price) ?>"><?= esc_html($ev_price_label) ?></span>
                            <span class="pdt-event-card__btn">Xem chi tiết</span>
                        </div>
                    </div>
                </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- ── Hình ảnh đào tạo (bento gallery) ─────────────────── -->
    <section class="pdt-gallery">
        <div class="container">

            <div class="pdt-workshop__head">
                <p class="pdt-eyebrow pdt-eyebrow--center">Hình Ảnh Đào Tạo</p>
                <h2 class="pdt-workshop__title">Khoảnh khắc đào tạo nổi bật</h2>
                <p class="pdt-workshop__desc">Liên tục đào tạo và cải tiến là giá trị cốt lõi của Tamya.</p>
            </div>

            <?php if (!empty($gallery_items)) : ?>
            <div class="pdt-bento">
                <?php foreach ($gallery_items as $item) :
                    $img     = $item['image']   ?? null;
                    $caption = $item['caption'] ?? '';
                    $link    = $item['link']    ?? '';
                    $tag     = $link ? 'a' : 'div';
                ?>
                <<?= $tag ?> <?= $link ? 'href="' . esc_url($link) . '"' : '' ?> class="pdt-bento__item">
                    <?php if ($img) : ?>
                        <img src="<?= esc_url($img['url']) ?>" alt="<?= esc_attr($img['alt'] ?: $caption) ?>">
                    <?php endif; ?>
                    <?php if ($caption) : ?>
                    <span class="pdt-bento__caption"><?= esc_html($caption) ?></span>
                    <?php endif; ?>
                </<?= $tag ?>>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- ── Popup chi tiết sự kiện đào tạo ────────────────────── -->
    <div class="training-popup" data-dt-popup-root>
        <div class="training-popup__overlay" data-dt-popup-close></div>
        <div class="training-popup__panel" data-lenis-prevent>
            <div class="training-popup__media">
                <img data-dt-popup-image alt="">
                <span class="training-popup__badge" data-dt-popup-badge hidden></span>
                <button type="button" class="training-popup__close" data-dt-popup-close aria-label="Đóng">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
            </div>

            <div class="training-popup__body">
                <p class="training-popup__eyebrow">Khóa đào tạo</p>
                <h2 class="training-popup__title" data-dt-popup-title></h2>

                <div class="training-popup__expert" data-dt-popup-expert-wrap hidden>
                    <span class="training-popup__avatar" data-dt-popup-avatar></span>
                    <div>
                        <p class="training-popup__expert-name" data-dt-popup-expert-name></p>
                        <p class="training-popup__expert-role" data-dt-popup-expert-role></p>
                    </div>
                </div>

                <div class="training-popup__info" data-dt-popup-info-wrap hidden>
                    <div>
                        <p class="training-popup__info-label">Thời gian</p>
                        <p class="training-popup__info-value" data-dt-popup-datetime></p>
                    </div>
                    <div>
                        <p class="training-popup__info-label">Hình thức</p>
                        <p class="training-popup__info-value" data-dt-popup-format></p>
                    </div>
                    <div>
                        <p class="training-popup__info-label">Thời lượng</p>
                        <p class="training-popup__info-value" data-dt-popup-duration></p>
                    </div>
                </div>

                <div class="training-popup__section" data-dt-popup-benefits-wrap hidden>
                    <p class="training-popup__section-title">Lợi ích khi tham gia</p>
                    <div class="training-popup__section-content" data-dt-popup-benefits></div>
                </div>

                <div class="training-popup__foot">
                    <div class="training-popup__cost" data-dt-popup-cost-wrap hidden>
                        <p class="training-popup__info-label">Chi phí</p>
                        <p class="training-popup__cost-value" data-dt-popup-cost></p>
                    </div>
                    <a href="#" class="training-popup__cta" data-dt-popup-cta>
                        <span data-dt-popup-cta-label>Đăng ký tham gia</span>
                    </a>
                </div>
                <p class="training-popup__note" data-dt-popup-note></p>
            </div>
        </div>
    </div>

    <!-- ── Popup đăng ký (dùng chung Zoom Training + Sự kiện) ── -->
    <div class="training-register-popup" data-reg-popup-root data-form-id="<?= (int) $reg_form_id ?>">
        <div class="training-register-popup__overlay" data-reg-popup-close></div>
        <div class="training-register-popup__panel" data-lenis-prevent>
            <button type="button" class="training-popup__close" data-reg-popup-close aria-label="Đóng">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            </button>
            <div class="training-register-popup__body">
                <p class="training-popup__eyebrow" data-reg-popup-eyebrow>Đăng ký tham gia</p>
                <h2 class="training-popup__title" data-reg-popup-title></h2>
                <p class="training-register-popup__meta" data-reg-popup-meta></p>

                <?php if ($reg_form_id) : ?>
                    <div class="training-register-popup__form">
                        <?= do_shortcode('[contact-form-7 id="' . intval($reg_form_id) . '" title="Tamya – Đăng Ký Đào Tạo"]') ?>
                    </div>
                <?php else : ?>
                    <p class="training-register-popup__fallback">Form đang khởi tạo. Vui lòng tải lại trang sau vài giây.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- ── Popup thành công: Zoom Training Định Kỳ (tự động, miễn phí) ── -->
    <div class="training-success-popup" data-zoom-success-root>
        <div class="training-success-popup__overlay" data-zoom-success-close></div>
        <div class="training-success-popup__panel" data-lenis-prevent>
            <button type="button" class="training-popup__close" data-zoom-success-close aria-label="Đóng">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            </button>

            <span class="training-success-popup__icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 13l4 4L19 7" stroke="#fff" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
            <h2 class="training-success-popup__title">Đăng ký thành công!</h2>
            <p class="training-success-popup__desc">Thông tin phòng học Zoom đã sẵn sàng cho bạn.</p>

            <div class="training-success-popup__info">
                <div><span>Chủ đề</span><strong><?= esc_html($zoom_title) ?></strong></div>
                <div><span>Thời gian</span><strong><?= esc_html($zoom_datetime) ?></strong></div>
                <?php if ($zoom_room_link && !empty($zoom_room_link['url'])) : ?>
                <div><span>Đường dẫn</span><strong><a href="<?= esc_url($zoom_room_link['url']) ?>" target="_blank" rel="noopener"><?= esc_html(preg_replace('#^https?://#', '', $zoom_room_link['url'])) ?></a></strong></div>
                <?php endif; ?>
                <?php if ($zoom_room_id) : ?>
                <div><span>Mã phòng</span><strong><?= esc_html($zoom_room_id) ?></strong></div>
                <?php endif; ?>
                <?php if ($zoom_room_password) : ?>
                <div><span>Mật khẩu</span><strong><?= esc_html($zoom_room_password) ?></strong></div>
                <?php endif; ?>
            </div>

            <p class="training-success-popup__note">Thông tin trên cũng đã được gửi tới email bạn dùng khi đăng ký.</p>

            <div class="training-success-popup__actions">
                <?php if ($zoom_room_link && !empty($zoom_room_link['url'])) : ?>
                <a href="<?= esc_url($zoom_room_link['url']) ?>" target="_blank" rel="noopener" class="training-success-popup__btn training-success-popup__btn--solid">Vào phòng học</a>
                <?php endif; ?>
                <button type="button" class="training-success-popup__btn training-success-popup__btn--outline" data-zoom-success-close>Đóng</button>
            </div>
        </div>
    </div>

    <!-- ── Popup thành công: Sự kiện đào tạo (chờ xác nhận thanh toán) ── -->
    <div class="training-success-popup" data-event-success-root>
        <div class="training-success-popup__overlay" data-event-success-close></div>
        <div class="training-success-popup__panel" data-lenis-prevent>
            <button type="button" class="training-popup__close" data-event-success-close aria-label="Đóng">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            </button>

            <span class="training-success-popup__icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 13l4 4L19 7" stroke="#fff" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
            <h2 class="training-success-popup__title">Đã ghi nhận đăng ký</h2>
            <p class="training-success-popup__desc">Cảm ơn bạn đã quan tâm. Chuyên viên Tamya sẽ liên hệ để xác nhận suất tham gia. Vì liên quan đến thanh toán, vui lòng nhắn tin qua Zalo hoặc Facebook để được hướng dẫn nhanh nhất.</p>

            <div class="training-success-popup__info">
                <div><span>Khóa đào tạo</span><strong data-event-success-title></strong></div>
                <div><span>Thời gian</span><strong data-event-success-time></strong></div>
                <div><span>Chi phí</span><strong data-event-success-cost></strong></div>
            </div>

            <p class="training-success-popup__note">Mọi thắc mắc vui lòng liên hệ hotline <?= esc_html($hotline_label) ?>.</p>

            <div class="training-success-popup__actions">
                <a href="<?= esc_url($zalo_link) ?>" target="_blank" rel="noopener" class="training-success-popup__btn training-success-popup__btn--solid">Nhắn Zalo</a>
                <a href="<?= esc_url($fb_link) ?>" target="_blank" rel="noopener" class="training-success-popup__btn training-success-popup__btn--outline">Facebook</a>
            </div>
        </div>
    </div>

</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var popupRoot = document.querySelector('[data-dt-popup-root]');
    if (!popupRoot) return;

    var imageEl      = popupRoot.querySelector('[data-dt-popup-image]');
    var badgeEl      = popupRoot.querySelector('[data-dt-popup-badge]');
    var titleEl      = popupRoot.querySelector('[data-dt-popup-title]');
    var expertWrap   = popupRoot.querySelector('[data-dt-popup-expert-wrap]');
    var avatarEl     = popupRoot.querySelector('[data-dt-popup-avatar]');
    var expertNameEl = popupRoot.querySelector('[data-dt-popup-expert-name]');
    var expertRoleEl = popupRoot.querySelector('[data-dt-popup-expert-role]');
    var infoWrap      = popupRoot.querySelector('[data-dt-popup-info-wrap]');
    var datetimeEl    = popupRoot.querySelector('[data-dt-popup-datetime]');
    var formatEl      = popupRoot.querySelector('[data-dt-popup-format]');
    var durationEl    = popupRoot.querySelector('[data-dt-popup-duration]');
    var benefitsWrap = popupRoot.querySelector('[data-dt-popup-benefits-wrap]');
    var benefitsEl   = popupRoot.querySelector('[data-dt-popup-benefits]');
    var costWrap  = popupRoot.querySelector('[data-dt-popup-cost-wrap]');
    var costEl    = popupRoot.querySelector('[data-dt-popup-cost]');
    var ctaEl      = popupRoot.querySelector('[data-dt-popup-cta]');
    var ctaLabelEl = popupRoot.querySelector('[data-dt-popup-cta-label]');
    var noteEl   = popupRoot.querySelector('[data-dt-popup-note]');

    function openPopup(card) {
        var image = card.getAttribute('data-image') || '';
        imageEl.src = image;
        imageEl.alt = card.getAttribute('data-title') || '';

        var badge = card.getAttribute('data-badge') || '';
        badgeEl.textContent = badge;
        badgeEl.hidden = !badge;

        titleEl.textContent = card.getAttribute('data-title') || '';

        var expertName = card.getAttribute('data-expert-name') || '';
        var expertRole = card.getAttribute('data-expert-role') || '';
        expertWrap.hidden = !expertName;
        avatarEl.textContent = expertName ? expertName.trim().charAt(0).toUpperCase() : '';
        expertNameEl.textContent = expertName ? 'Chuyên gia ' + expertName : '';
        expertRoleEl.textContent = expertRole;

        var date = card.getAttribute('data-date') || '';
        var time = card.getAttribute('data-time') || '';
        var format = card.getAttribute('data-format') || '';
        var duration = card.getAttribute('data-duration') || '';
        infoWrap.hidden = !(date || time || format || duration);
        datetimeEl.textContent = [date, time].filter(Boolean).join(' · ') || '—';
        formatEl.textContent = format || '—';
        durationEl.textContent = duration || '—';

        var benefits = card.getAttribute('data-benefits') || '';
        benefitsWrap.hidden = !benefits;
        benefitsEl.innerHTML = benefits;

        var cost = card.getAttribute('data-cost-label') || '';
        costWrap.hidden = !cost;
        costEl.textContent = cost;

        var registerUrl = card.getAttribute('data-register-url');
        ctaLabelEl.textContent = card.getAttribute('data-register-label') || 'Đăng ký tham gia';

        if (registerUrl) {
            // Link đăng ký ngoài do biên tập viên chỉ định — giữ hành vi liên kết thường.
            ctaEl.setAttribute('href', registerUrl);
            ctaEl.setAttribute('target', '_blank');
            ctaEl.setAttribute('rel', 'noopener');
            ctaEl.removeAttribute('data-open-register');
        } else {
            // Mặc định: mở form đăng ký nội bộ ngay trong popup.
            ctaEl.setAttribute('href', '#');
            ctaEl.removeAttribute('target');
            ctaEl.removeAttribute('rel');
            ctaEl.setAttribute('data-open-register', '1');
            ctaEl.setAttribute('data-register-flow', 'event');
            ctaEl.setAttribute('data-register-title', card.getAttribute('data-title') || '');
            ctaEl.setAttribute('data-register-time', [card.getAttribute('data-date'), card.getAttribute('data-time')].filter(Boolean).join(' · '));
            ctaEl.setAttribute('data-register-cost', card.getAttribute('data-cost-label') || '');
        }

        noteEl.textContent = card.getAttribute('data-note') || '';

        popupRoot.classList.add('is-active');
        document.body.classList.add('dt-popup-open');
        if (window.lenis) window.lenis.stop();
    }

    function closePopup() {
        popupRoot.classList.remove('is-active');
        document.body.classList.remove('dt-popup-open');
        if (window.lenis) window.lenis.start();
    }

    document.querySelectorAll('[data-dt-popup]').forEach(function (card) {
        card.addEventListener('click', function () { openPopup(card); });
        card.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openPopup(card); }
        });
    });

    popupRoot.querySelectorAll('[data-dt-popup-close]').forEach(function (el) {
        el.addEventListener('click', closePopup);
    });

    /* ── Popup đăng ký (dùng chung Zoom Training + Sự kiện) ─── */
    var regRoot   = document.querySelector('[data-reg-popup-root]');
    var regFormId = regRoot ? parseInt(regRoot.getAttribute('data-form-id'), 10) : 0;
    var regEyebrowEl = regRoot ? regRoot.querySelector('[data-reg-popup-eyebrow]') : null;
    var regTitleEl   = regRoot ? regRoot.querySelector('[data-reg-popup-title]') : null;
    var regMetaEl    = regRoot ? regRoot.querySelector('[data-reg-popup-meta]') : null;

    var zoomSuccessRoot  = document.querySelector('[data-zoom-success-root]');
    var eventSuccessRoot = document.querySelector('[data-event-success-root]');

    var currentRegister = { flow: 'event', title: '', time: '', cost: '' };

    function setRegHiddenField(name, value) {
        if (!regRoot) return;
        var el = regRoot.querySelector('input[name="' + name + '"]');
        if (el) el.value = value;
    }

    function openRegisterPopup(opts) {
        if (!regRoot) return;
        currentRegister = opts;

        if (regEyebrowEl) regEyebrowEl.textContent = opts.flow === 'zoom' ? 'Đăng ký Zoom Training' : 'Đăng ký tham gia';
        if (regTitleEl) regTitleEl.textContent = opts.title || '';
        if (regMetaEl) regMetaEl.textContent = [opts.time, opts.cost].filter(Boolean).join(' · ');

        setRegHiddenField('loai-dang-ky', opts.title || '');
        setRegHiddenField('thoi-gian', opts.time || '');
        setRegHiddenField('chi-phi', opts.cost || '');
        setRegHiddenField('loai-flow', opts.flow || 'event');

        regRoot.classList.add('is-active');
        document.body.classList.add('dt-popup-open');
        if (window.lenis) window.lenis.stop();
    }

    function closeRegisterPopup() {
        if (!regRoot) return;
        regRoot.classList.remove('is-active');
        document.body.classList.remove('dt-popup-open');
        if (window.lenis) window.lenis.start();
    }

    function openSuccessPopup(root) {
        if (!root) return;
        root.classList.add('is-active');
        document.body.classList.add('dt-popup-open');
        if (window.lenis) window.lenis.stop();
    }

    function closeSuccessPopup(root) {
        if (!root) return;
        root.classList.remove('is-active');
        document.body.classList.remove('dt-popup-open');
        if (window.lenis) window.lenis.start();
    }

    // Mọi nút/thẻ có [data-open-register="1"] đều mở popup đăng ký
    // (nút "Đăng Ký Ngay" của Zoom Training, và CTA trong popup sự kiện).
    document.addEventListener('click', function (e) {
        var trigger = e.target.closest('[data-open-register="1"]');
        if (!trigger) return;
        e.preventDefault();

        var isEventFlow = trigger === ctaEl;
        openRegisterPopup({
            flow:  trigger.getAttribute('data-register-flow') || 'event',
            title: trigger.getAttribute('data-register-title') || '',
            time:  trigger.getAttribute('data-register-time') || '',
            cost:  trigger.getAttribute('data-register-cost') || '',
        });

        if (isEventFlow) closePopup(); // đóng popup chi tiết sự kiện phía sau
    });

    if (regRoot) {
        regRoot.querySelectorAll('[data-reg-popup-close]').forEach(function (el) {
            el.addEventListener('click', closeRegisterPopup);
        });
    }

    [zoomSuccessRoot, eventSuccessRoot].forEach(function (root) {
        if (!root) return;
        root.querySelectorAll('[data-zoom-success-close], [data-event-success-close]').forEach(function (el) {
            el.addEventListener('click', function () { closeSuccessPopup(root); });
        });
    });

    document.addEventListener('wpcf7mailsent', function (event) {
        if (regFormId && event.detail && event.detail.contactFormId && event.detail.contactFormId !== regFormId) return;

        closeRegisterPopup();

        if (currentRegister.flow === 'zoom') {
            openSuccessPopup(zoomSuccessRoot);
        } else {
            if (eventSuccessRoot) {
                var titleEl2 = eventSuccessRoot.querySelector('[data-event-success-title]');
                var timeEl2  = eventSuccessRoot.querySelector('[data-event-success-time]');
                var costEl2  = eventSuccessRoot.querySelector('[data-event-success-cost]');
                if (titleEl2) titleEl2.textContent = currentRegister.title || '—';
                if (timeEl2) timeEl2.textContent = currentRegister.time || '—';
                if (costEl2) costEl2.textContent = currentRegister.cost || '—';
            }
            openSuccessPopup(eventSuccessRoot);
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Escape') return;
        closePopup();
        closeRegisterPopup();
        closeSuccessPopup(zoomSuccessRoot);
        closeSuccessPopup(eventSuccessRoot);
    });
});
</script>

<?php get_footer(); ?>
