<?php

/**
 * Template Name: Sản Phẩm
 */

get_header();

$hero_title = 'Trọn chu trình dưỡng da';
$hero_desc  = 'Từ làm sạch đến chống nắng — chọn theo bước trong quy trình, đầy đủ trong một khung nhìn.';

$steps = [
    'lam-sach'   => ['num' => '01', 'label' => 'Làm sạch'],
    'can-bang'   => ['num' => '02', 'label' => 'Cân bằng'],
    'tinh-chat'  => ['num' => '03', 'label' => 'Tinh chất'],
    'dac-tri'    => ['num' => '04', 'label' => 'Đặc trị'],
    'sua-duong'  => ['num' => '05', 'label' => 'Sữa dưỡng'],
    'kem-duong'  => ['num' => '06', 'label' => 'Kem dưỡng'],
    'chong-nang' => ['num' => '07', 'label' => 'Chống nắng'],
];

$products_query = new WP_Query([
    'post_type'      => 'sanpham',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);
?>

<main id="primary" class="site-main page-san-pham">

    <!-- ── Hero ─────────────────────────────────────────────── -->
    <section class="sp-hero">
        <div class="container container--1400">
            <p class="sp-eyebrow">Sản Phẩm</p>
            <h1 class="sp-hero__title"><?= esc_html($hero_title) ?></h1>
            <p class="sp-hero__desc"><?= esc_html($hero_desc) ?></p>
            <button type="button" class="sp-tab sp-tab--all is-active" data-filter="">Tất cả sản phẩm</button>
        </div>
    </section>

    <!-- ── Thanh bước quy trình ─────────────────────────────── -->
    <section class="sp-steps">
        <div class="container container--1400">
            <ul class="sp-steps__list" data-sp-tabs>
                <?php $i = 0; foreach ($steps as $slug => $step) : $i++; ?>
                <?php if ($i > 1) : ?><li class="sp-steps__line" aria-hidden="true"></li><?php endif; ?>
                <li class="sp-steps__item">
                    <button type="button" class="sp-step" data-filter="<?= esc_attr($slug) ?>">
                        <span class="sp-step__num"><?= esc_html($step['num']) ?></span>
                        <span class="sp-step__label"><?= esc_html($step['label']) ?></span>
                    </button>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <!-- ── Lưới sản phẩm ─────────────────────────────────────── -->
    <section class="sp-grid-section">
        <div class="container container--1400">
            <div class="block-products-list__grid" style="--product-cols:4;" data-sp-grid>

                <?php if ($products_query->have_posts()) : while ($products_query->have_posts()) : $products_query->the_post();
                    $pid        = get_the_ID();
                    $brand      = get_field('product_brand', $pid);
                    $subtitle   = get_field('product_subtitle', $pid);
                    $terms      = get_the_terms($pid, 'buoc-cham-soc');
                    $step_slugs = ($terms && !is_wp_error($terms)) ? wp_list_pluck($terms, 'slug') : [];
                    $gallery    = get_field('product_gallery', $pid);
                    $hover_video = get_field('product_hover_video', $pid);
                    $type_tag   = get_field('product_type_tag', $pid);
                    $skin_type  = get_field('product_skin_type', $pid);
                    $texture    = get_field('product_texture', $pid);
                    $volume     = get_field('product_volume', $pid);
                    $ingredient_rows = get_field('product_ingredients', $pid);
                    $ingredient_rows = is_array($ingredient_rows) ? $ingredient_rows : [];
                    $benefits    = get_field('product_benefits', $pid);
                    $usage       = get_field('product_usage', $pid);
                    $cta_url     = get_field('product_cta_url', $pid);
                    $cta_label   = get_field('product_cta_label', $pid) ?: 'Tư vấn sản phẩm này';

                    $step_num = '';
                    foreach ($step_slugs as $ss) {
                        if (isset($steps[$ss])) { $step_num = $steps[$ss]['num']; break; }
                    }
                    $badge_parts = array_filter([$step_num ? "Bước {$step_num}" : '', $type_tag]);
                    $badge_text  = implode(' · ', $badge_parts);

                    $ingredients_json = wp_json_encode(array_map(function ($row) {
                        return [
                            'name'  => $row['ingredient_name'] ?? '',
                            'badge' => $row['ingredient_badge'] ?? '',
                            'desc'  => $row['ingredient_desc'] ?? '',
                        ];
                    }, $ingredient_rows));
                ?>
                <article class="product-card<?= $hover_video ? ' product-card--has-video' : '' ?>"
                    tabindex="0"
                    data-cats="<?= esc_attr(implode(' ', $step_slugs)) ?>"
                    data-sp-popup
                    data-badge="<?= esc_attr($badge_text) ?>"
                    data-brand="<?= esc_attr($brand) ?>"
                    data-title="<?= esc_attr(get_the_title()) ?>"
                    data-subtitle="<?= esc_attr($subtitle) ?>"
                    data-skin-type="<?= esc_attr($skin_type) ?>"
                    data-texture="<?= esc_attr($texture) ?>"
                    data-volume="<?= esc_attr($volume) ?>"
                    data-ingredients='<?= esc_attr($ingredients_json) ?>'
                    data-benefits="<?= esc_attr($benefits) ?>"
                    data-usage="<?= esc_attr($usage) ?>"
                    data-cta-url="<?= esc_attr($cta_url ?: '') ?>"
                    data-cta-label="<?= esc_attr($cta_label) ?>"
                    data-gallery='<?= esc_attr(wp_json_encode($gallery ? wp_list_pluck($gallery, 'url') : [get_the_post_thumbnail_url($pid, 'large')])) ?>'
                >
                    <div class="product-card__image-wrap">
                        <?php if (has_post_thumbnail()) : ?>
                            <?= get_the_post_thumbnail($pid, 'medium', ['class' => 'product-card__image']) ?>
                        <?php endif; ?>
                        <?php if ($hover_video) : ?>
                            <video class="product-card__video" src="<?= esc_url($hover_video) ?>" muted loop playsinline preload="none" data-sp-hover-video></video>
                        <?php endif; ?>
                    </div>
                    <div class="product-card__info">
                        <?php if ($brand) : ?><p class="product-card__brand"><?= esc_html($brand) ?></p><?php endif; ?>
                        <h3 class="product-card__title"><?php the_title(); ?></h3>
                        <?php if ($subtitle) : ?><p class="product-card__subtitle"><?= esc_html($subtitle) ?></p><?php endif; ?>
                    </div>
                </article>
                <?php endwhile; wp_reset_postdata(); endif; ?>

                <!-- ── Thẻ "sắp ra mắt" cho bước chưa có sản phẩm ── -->
                <article class="product-card product-card--soon" data-cats="lam-sach chong-nang">
                    <div class="product-card__image-wrap product-card__image-wrap--soon">
                        <span class="sp-soon-icon">+</span>
                        <span class="sp-soon-text">Sắp ra mắt</span>
                    </div>
                    <div class="product-card__info">
                        <p class="product-card__brand">Sữa rửa mặt</p>
                        <p class="product-card__subtitle">Đang cập nhật</p>
                    </div>
                </article>

            </div>
        </div>
    </section>

    <!-- ── Popup chi tiết sản phẩm ───────────────────────────── -->
    <div class="product-popup" data-sp-popup-root>
        <div class="product-popup__overlay" data-sp-popup-close></div>
        <div class="product-popup__panel" data-lenis-prevent>
            <button type="button" class="product-popup__close" data-sp-popup-close aria-label="Đóng">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            </button>

            <div class="product-popup__gallery" data-sp-popup-gallery>
                <span class="product-popup__badge" data-sp-popup-badge hidden></span>
                <!-- slides injected by JS -->
            </div>

            <div class="product-popup__body">
                <p class="product-popup__brand" data-sp-popup-brand></p>
                <h2 class="product-popup__title" data-sp-popup-title></h2>
                <p class="product-popup__subtitle" data-sp-popup-subtitle></p>

                <div class="product-popup__specs" data-sp-popup-specs-wrap hidden>
                    <div>
                        <p class="product-popup__spec-label">Loại da</p>
                        <p class="product-popup__spec-value" data-sp-popup-skin-type></p>
                    </div>
                    <div>
                        <p class="product-popup__spec-label">Kết cấu</p>
                        <p class="product-popup__spec-value" data-sp-popup-texture></p>
                    </div>
                    <div>
                        <p class="product-popup__spec-label">Dung tích</p>
                        <p class="product-popup__spec-value" data-sp-popup-volume></p>
                    </div>
                </div>

                <div class="product-popup__section" data-sp-popup-ingredients-wrap hidden>
                    <p class="product-popup__section-title">Thành phần chính</p>
                    <div data-sp-popup-ingredients></div>
                </div>

                <div class="product-popup__section" data-sp-popup-benefits-wrap hidden>
                    <p class="product-popup__section-title">Công dụng</p>
                    <div class="product-popup__section-content" data-sp-popup-benefits></div>
                </div>

                <div class="product-popup__section" data-sp-popup-usage-wrap hidden>
                    <p class="product-popup__section-title">Cách dùng</p>
                    <div class="product-popup__section-content" data-sp-popup-usage></div>
                </div>

                <a href="#" class="product-popup__cta" data-sp-popup-cta>
                    <span data-sp-popup-cta-label>Tư vấn sản phẩm này</span>
                    <span aria-hidden="true">&#8594;</span>
                </a>
                <p class="product-popup__cta-caption">Tư vấn miễn phí qua Messenger · phản hồi trong 2 giờ</p>
            </div>
        </div>
    </div>

</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var grid     = document.querySelector('[data-sp-grid]');
    var tabsBar  = document.querySelector('[data-sp-tabs]');
    var allBtn   = document.querySelector('.sp-tab--all');
    if (!grid) return;

    var cards = Array.prototype.slice.call(grid.querySelectorAll('.product-card'));

    function setActive(filter, activeBtn) {
        document.querySelectorAll('.sp-step, .sp-tab--all').forEach(function (b) { b.classList.remove('is-active'); });
        if (activeBtn) activeBtn.classList.add('is-active');

        cards.forEach(function (card) {
            var cats = (card.getAttribute('data-cats') || '').split(' ');
            var match = !filter || cats.indexOf(filter) !== -1;
            card.classList.toggle('is-filtered-out', !match);
        });
    }

    if (tabsBar) {
        tabsBar.addEventListener('click', function (e) {
            var btn = e.target.closest('.sp-step');
            if (!btn) return;
            setActive(btn.getAttribute('data-filter'), btn);
        });
    }

    if (allBtn) {
        allBtn.addEventListener('click', function () { setActive('', allBtn); });
    }

    /* ── Popup ─────────────────────────────────────────────── */
    var popupRoot = document.querySelector('[data-sp-popup-root]');
    if (!popupRoot) return;

    var galleryEl      = popupRoot.querySelector('[data-sp-popup-gallery]');
    var badgeEl        = popupRoot.querySelector('[data-sp-popup-badge]');
    var brandEl        = popupRoot.querySelector('[data-sp-popup-brand]');
    var titleEl        = popupRoot.querySelector('[data-sp-popup-title]');
    var subtitleEl     = popupRoot.querySelector('[data-sp-popup-subtitle]');
    var specsWrap       = popupRoot.querySelector('[data-sp-popup-specs-wrap]');
    var skinTypeEl      = popupRoot.querySelector('[data-sp-popup-skin-type]');
    var textureEl       = popupRoot.querySelector('[data-sp-popup-texture]');
    var volumeEl        = popupRoot.querySelector('[data-sp-popup-volume]');
    var ingredientsWrap = popupRoot.querySelector('[data-sp-popup-ingredients-wrap]');
    var ingredientsEl   = popupRoot.querySelector('[data-sp-popup-ingredients]');
    var benefitsWrap    = popupRoot.querySelector('[data-sp-popup-benefits-wrap]');
    var benefitsEl      = popupRoot.querySelector('[data-sp-popup-benefits]');
    var usageWrap       = popupRoot.querySelector('[data-sp-popup-usage-wrap]');
    var usageEl         = popupRoot.querySelector('[data-sp-popup-usage]');
    var ctaEl           = popupRoot.querySelector('[data-sp-popup-cta]');
    var ctaLabelEl      = popupRoot.querySelector('[data-sp-popup-cta-label]');

    function openPopup(card) {
        var badge = card.getAttribute('data-badge') || '';
        badgeEl.textContent = badge;
        badgeEl.hidden = !badge;

        brandEl.textContent    = card.getAttribute('data-brand') || '';
        titleEl.textContent    = card.getAttribute('data-title') || '';
        subtitleEl.textContent = card.getAttribute('data-subtitle') || '';

        var skinType = card.getAttribute('data-skin-type') || '';
        var texture  = card.getAttribute('data-texture') || '';
        var volume   = card.getAttribute('data-volume') || '';
        specsWrap.hidden = !(skinType || texture || volume);
        skinTypeEl.textContent = skinType || '—';
        textureEl.textContent  = texture || '—';
        volumeEl.textContent   = volume || '—';

        var ingredients = [];
        try { ingredients = JSON.parse(card.getAttribute('data-ingredients') || '[]'); } catch (e) {}
        ingredients = ingredients.filter(function (row) { return row && (row.name || row.desc); });
        ingredientsWrap.hidden = !ingredients.length;
        ingredientsEl.innerHTML = '';
        ingredients.forEach(function (row) {
            var cardEl = document.createElement('div');
            cardEl.className = 'product-popup__ingredient-card';

            var head = document.createElement('div');
            head.className = 'product-popup__ingredient-head';

            var name = document.createElement('span');
            name.className = 'product-popup__ingredient-name';
            name.textContent = row.name || '';
            head.appendChild(name);

            if (row.badge) {
                var badgeSpan = document.createElement('span');
                badgeSpan.className = 'product-popup__ingredient-badge';
                badgeSpan.textContent = row.badge;
                head.appendChild(badgeSpan);
            }

            cardEl.appendChild(head);

            if (row.desc) {
                var desc = document.createElement('p');
                desc.className = 'product-popup__ingredient-desc';
                desc.textContent = row.desc;
                cardEl.appendChild(desc);
            }

            ingredientsEl.appendChild(cardEl);
        });

        var benefits = card.getAttribute('data-benefits') || '';
        benefitsWrap.hidden = !benefits;
        benefitsEl.innerHTML = benefits;

        var usage = card.getAttribute('data-usage') || '';
        usageWrap.hidden = !usage;
        usageEl.innerHTML = usage;

        var ctaUrl = card.getAttribute('data-cta-url');
        ctaLabelEl.textContent = card.getAttribute('data-cta-label') || 'Tư vấn sản phẩm này';
        ctaEl.setAttribute('href', ctaUrl || '#lien-he');

        var images = [];
        try { images = JSON.parse(card.getAttribute('data-gallery') || '[]').filter(Boolean); } catch (e) {}
        galleryEl.innerHTML = '';
        images.forEach(function (src, i) {
            var slide = document.createElement('div');
            slide.className = 'product-popup__gallery-slide' + (i === 0 ? ' is-active' : '');
            var img = document.createElement('img');
            img.className = 'product-popup__gallery-img';
            img.src = src;
            img.alt = card.getAttribute('data-title') || '';
            slide.appendChild(img);
            galleryEl.appendChild(slide);
        });

        if (images.length > 1) {
            var dots = document.createElement('div');
            dots.className = 'product-popup__gallery-dots';
            images.forEach(function (_, i) {
                var dot = document.createElement('button');
                dot.type = 'button';
                dot.className = 'product-popup__gallery-dot' + (i === 0 ? ' is-active' : '');
                dot.addEventListener('click', function () { showSlide(i); });
                dots.appendChild(dot);
            });
            galleryEl.appendChild(dots);

            var prev = document.createElement('button');
            prev.type = 'button';
            prev.className = 'product-popup__gallery-nav product-popup__gallery-nav--prev';
            prev.innerHTML = '&#8249;';
            prev.addEventListener('click', function () { showSlide(currentSlide - 1); });

            var next = document.createElement('button');
            next.type = 'button';
            next.className = 'product-popup__gallery-nav product-popup__gallery-nav--next';
            next.innerHTML = '&#8250;';
            next.addEventListener('click', function () { showSlide(currentSlide + 1); });

            galleryEl.appendChild(prev);
            galleryEl.appendChild(next);
        }

        var currentSlide = 0;
        function showSlide(i) {
            var slides = galleryEl.querySelectorAll('.product-popup__gallery-slide');
            var dotEls = galleryEl.querySelectorAll('.product-popup__gallery-dot');
            currentSlide = (i + slides.length) % slides.length;
            slides.forEach(function (s, idx) { s.classList.toggle('is-active', idx === currentSlide); });
            dotEls.forEach(function (d, idx) { d.classList.toggle('is-active', idx === currentSlide); });
        }

        popupRoot.classList.add('is-active');
        document.body.classList.add('sp-popup-open');
        if (window.lenis) window.lenis.stop();
    }

    function closePopup() {
        popupRoot.classList.remove('is-active');
        document.body.classList.remove('sp-popup-open');
        if (window.lenis) window.lenis.start();
    }

    cards.forEach(function (card) {
        if (!card.hasAttribute('data-sp-popup')) return;
        card.addEventListener('click', function () { openPopup(card); });
        card.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openPopup(card); }
        });
    });

    /* ── Video hover ───────────────────────────────────────── */
    cards.forEach(function (card) {
        var video = card.querySelector('[data-sp-hover-video]');
        if (!video) return;

        card.addEventListener('mouseenter', function () {
            video.currentTime = 0;
            video.play().catch(function () {});
        });
        card.addEventListener('mouseleave', function () {
            video.pause();
        });
        card.addEventListener('focus', function () {
            video.currentTime = 0;
            video.play().catch(function () {});
        });
        card.addEventListener('blur', function () {
            video.pause();
        });
    });

    popupRoot.querySelectorAll('[data-sp-popup-close]').forEach(function (el) {
        el.addEventListener('click', closePopup);
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closePopup();
    });
});
</script>

<?php get_footer(); ?>
