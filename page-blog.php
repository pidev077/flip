<?php
/**
 * Template Name: Blog – Góc nhìn Tamya
 */

get_header();

$categories = [
    ['slug' => 'xu-huong-tham-my',     'label' => 'Xu hướng thẩm mỹ',       'tt_id' => 56],
    ['slug' => 'cham-soc-da-chuyen-sau','label' => 'Chăm sóc da chuyên sâu', 'tt_id' => 57],
    ['slug' => 'hoat-dong-cong-dong',   'label' => 'Hoạt động cộng đồng',    'tt_id' => 58],
    ['slug' => 'su-kien-tamya',         'label' => 'Sự kiện Tamya',           'tt_id' => 59],
];

// anchor => label (empty anchor = scroll to top / featured)
$filter_links = [
    '#featured'              => 'Tất cả',
    '#xu-huong-tham-my'      => 'Xu hướng thẩm mỹ',
    '#cham-soc-da-chuyen-sau'=> 'Chăm sóc da chuyên sâu',
    '#hoat-dong-cong-dong'   => 'Hoạt động cộng đồng',
    '#su-kien-tamya'         => 'Sự kiện Tamya',
];

// Featured post: most recent from "noi-bat"
$featured_query = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => 1,
    'tax_query'      => [[
        'taxonomy' => 'category',
        'field'    => 'slug',
        'terms'    => 'noi-bat',
    ]],
]);
?>

<main id="primary" class="site-main page-blog-tamya">

    <!-- ── Hero ──────────────────────────────────────────── -->
    <section class="pbt-hero container">
        <div class="pbt-hero__left">
            <span class="pbt-hero__eyebrow">Tin tức &amp; Sự kiện</span>
            <h1 class="pbt-hero__title">Góc nhìn<br><em>Tamya</em></h1>
        </div>
        <div class="pbt-hero__right">
            <p class="pbt-hero__desc">Cập nhật xu hướng thẩm mỹ, kiến thức chăm sóc da chuyên sâu và những câu chuyện đến từ Tamya Clinic.</p>
        </div>
    </section>

    <!-- ── Filter tabs (anchor scroll) ─────────────────────── -->
    <nav class="pbt-filters container">
        <?php foreach ($filter_links as $anchor => $label) : ?>
        <a class="pbt-filter-btn" href="<?= esc_attr($anchor) ?>">
            <?= esc_html($label) ?>
        </a>
        <?php endforeach; ?>
    </nav>

    <!-- ── Featured post ─────────────────────────────────── -->
    <?php if ($featured_query->have_posts()) : $featured_query->the_post(); ?>
    <section id="featured" class="pbt-featured container">
        <a href="<?= esc_url(get_permalink()) ?>" class="pbt-featured__card">
            <?php if (has_post_thumbnail()) : ?>
            <div class="pbt-featured__img">
                <?php the_post_thumbnail('large'); ?>
                <div class="pbt-featured__overlay"></div>
            </div>
            <?php endif; ?>
            <div class="pbt-featured__body">
                <div class="pbt-featured__cats">
                    <span class="pbt-badge pbt-badge--white">Nổi bật</span>
                    <?php foreach ((get_the_tags() ?: []) as $tag) : ?>
                    <span class="pbt-badge pbt-badge--white"><?= esc_html($tag->name) ?></span>
                    <?php endforeach; ?>
                    <span class="pbt-featured__date"><?= get_the_date('d.m.Y') ?></span>
                </div>
                <h2 class="pbt-featured__title"><?php the_title(); ?></h2>
                <p class="pbt-featured__excerpt"><?= wp_trim_words(get_the_excerpt(), 25, '...') ?></p>
                <span class="pbt-featured__cta">Đọc bài viết <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            </div>
        </a>
    </section>
    <?php wp_reset_postdata(); endif; ?>

    <!-- ── Category sections ─────────────────────────────── -->
    <?php foreach ($categories as $cat) :
        $is_horizontal = in_array($cat['slug'], ['hoat-dong-cong-dong', 'su-kien-tamya']);
        $posts_query = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => $is_horizontal ? 3 : 3,
            'tax_query'      => [[
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $cat['slug'],
            ]],
        ]);
        if (!$posts_query->have_posts()) continue;
        $cat_obj  = get_category_by_slug($cat['slug']);
        $cat_link = $cat_obj ? get_category_link($cat_obj->term_id) : '#';
    ?>
    <section id="<?= esc_attr($cat['slug']) ?>" class="pbt-section container">
        <div class="pbt-section__head">
            <h2 class="pbt-section__title"><?= esc_html($cat['label']) ?></h2>
            <a href="<?= esc_url($cat_link) ?>" class="pbt-section__more">
                Xem tất cả
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        </div>

        <?php if ($is_horizontal) : ?>
        <div class="pbt-list">
            <?php while ($posts_query->have_posts()) : $posts_query->the_post();
                $tags = get_the_tags();
                $t    = $tags ? $tags[0] : null;
                $bg   = $t ? get_term_meta($t->term_id, 'bg_tag', true) : '#799852';
                $bg   = $bg ?: '#799852';
            ?>
            <a href="<?= esc_url(get_permalink()) ?>" class="pbt-hcard">
                <div class="pbt-hcard__img">
                    <?php if (has_post_thumbnail()) the_post_thumbnail('medium'); ?>
                </div>
                <div class="pbt-hcard__body">
                    <div class="pbt-hcard__meta">
                        <span class="pbt-badge" style="background:<?= esc_attr($bg) ?>"><?= $t ? esc_html($t->name) : esc_html($cat['label']) ?></span>
                        <span class="pbt-hcard__date"><?= get_the_date('d.m.Y') ?></span>
                    </div>
                    <h3 class="pbt-hcard__title"><?php the_title(); ?></h3>
                    <p class="pbt-hcard__excerpt"><?= wp_trim_words(get_the_excerpt(), 20, '...') ?></p>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <?php else : ?>
        <div class="pbt-grid">
            <?php while ($posts_query->have_posts()) : $posts_query->the_post();
                $tags = get_the_tags();
                $t    = $tags ? $tags[0] : null;
                $bg   = $t ? get_term_meta($t->term_id, 'bg_tag', true) : '#799852';
                $bg   = $bg ?: '#799852';
            ?>
            <a href="<?= esc_url(get_permalink()) ?>" class="pbt-card">
                <div class="pbt-card__img">
                    <?php if (has_post_thumbnail()) the_post_thumbnail('medium_large'); ?>
                </div>
                <div class="pbt-card__body">
                    <div class="pbt-card__meta">
                        <span class="pbt-badge" style="background:<?= esc_attr($bg) ?>"><?= $t ? esc_html($t->name) : esc_html($cat['label']) ?></span>
                        <span class="pbt-card__date"><?= get_the_date('d.m.Y') ?></span>
                    </div>
                    <h3 class="pbt-card__title"><?php the_title(); ?></h3>
                    <p class="pbt-card__excerpt"><?= wp_trim_words(get_the_excerpt(), 18, '...') ?></p>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php endif; ?>
    </section>
    <?php endforeach; ?>

</main>


<script>
(function () {
    var headerEl = document.getElementById('header');
    var root     = document.documentElement;

    function getHeaderH() {
        return headerEl ? headerEl.getBoundingClientRect().height : 0;
    }

    function syncHeaderH() {
        root.style.setProperty('--header-h', getHeaderH() + 'px');
    }
    syncHeaderH();
    window.addEventListener('scroll', syncHeaderH, { passive: true });
    window.addEventListener('resize', syncHeaderH, { passive: true });

    // RAF-based smooth scroll — không bị ảnh hưởng bởi CSS scroll-behavior: auto
    function smoothScrollTo(targetY, duration) {
        var startY    = window.pageYOffset;
        var distance  = targetY - startY;
        var startTime = null;

        function step(now) {
            if (!startTime) startTime = now;
            var elapsed  = now - startTime;
            var progress = Math.min(elapsed / duration, 1);
            // ease-in-out cubic
            var ease = progress < 0.5
                ? 4 * progress * progress * progress
                : 1 - Math.pow(-2 * progress + 2, 3) / 2;
            window.scrollTo(0, startY + distance * ease);
            if (progress < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    }

    var filterBtns = Array.from(document.querySelectorAll('a.pbt-filter-btn'));

    function setActive(btn) {
        filterBtns.forEach(function (b) { b.classList.remove('is-active'); });
        if (btn) btn.classList.add('is-active');
    }

    // Set first button active on load
    setActive(filterBtns[0]);

    // Click: scroll + activate
    filterBtns.forEach(function (link) {
        link.addEventListener('click', function (e) {
            var href = link.getAttribute('href') || '';
            if (href.charAt(0) !== '#') return;
            e.preventDefault();
            setActive(link);

            var target = document.getElementById(href.slice(1));
            var top    = target
                ? Math.max(0, target.getBoundingClientRect().top + window.pageYOffset - getHeaderH() - 124)
                : 0;

            smoothScrollTo(top, 700);
        });
    });

    // Scroll spy: activate button matching the section closest to top
    var sections = filterBtns.map(function (btn) {
        var href = btn.getAttribute('href') || '';
        return { btn: btn, el: document.getElementById(href.slice(1)) };
    }).filter(function (item) { return item.el; });

    window.addEventListener('scroll', function () {
        var scrollY  = window.pageYOffset;
        var offset   = getHeaderH() + 140;
        var current  = null;

        sections.forEach(function (item) {
            if (item.el.getBoundingClientRect().top + window.pageYOffset - offset <= scrollY) {
                current = item.btn;
            }
        });

        setActive(current || filterBtns[0]);
    }, { passive: true });
})();
</script>

<?php get_footer(); ?>
