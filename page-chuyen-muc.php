<?php

/**
 * Template Name: Chuyên Mục
 */

get_header();

$hero_title = get_field('hero_title') ?: 'Kiến thức & Cảm hứng';
$hero_desc  = get_field('hero_desc')  ?: 'Góc chia sẻ của Tamya về chăm sóc da, xu hướng làm đẹp và lối sống cân bằng — để hành trình chữa lành tiếp nối mỗi ngày.';

// Tab lọc = toàn bộ chuyên mục đang có bài viết, trừ "Uncategorized" mặc định
$all_cats = get_categories([
    'hide_empty' => true,
    'exclude'    => [get_option('default_category')],
]);

$cats      = ['' => 'Tất cả'];
$cat_slugs = [];
foreach ($all_cats as $term) {
    $cats[$term->slug] = $term->name;
    $cat_slugs[]       = $term->slug;
}

// Đọc nhiều — bài được gắn cờ nổi bật (custom field _flip_trending), tách riêng khỏi lưới chính
$trending_query = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => 2,
    'meta_key'       => '_flip_trending',
    'meta_value'     => 1,
]);
$trending_ids = wp_list_pluck($trending_query->posts, 'ID');

// Bài viết nổi bật — mỗi tab lọc có bài mới nhất riêng: Tất cả = mới nhất trong 3 chuyên mục,
// từng chuyên mục = bài mới nhất của riêng chuyên mục đó. Không tính các bài đã lên "Đọc nhiều".
$featured_ids_by_tab = [];
foreach ($cats as $slug => $label) {
    $fq = new WP_Query([
        'post_type'      => 'post',
        'posts_per_page' => 1,
        'post__not_in'   => $trending_ids,
        'tax_query'      => [[
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $slug === '' ? $cat_slugs : $slug,
        ]],
    ]);
    $featured_ids_by_tab[$slug] = $fq->have_posts() ? $fq->posts[0]->ID : 0;
}
$featured_id = $featured_ids_by_tab[''];

// Lưới bài viết chính — toàn bộ bài còn lại trong 3 chuyên mục
$grid_query = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => -1,
    'post__not_in'   => array_merge([$featured_id], $trending_ids),
    'tax_query'      => [[
        'taxonomy' => 'category',
        'field'    => 'slug',
        'terms'    => $cat_slugs,
    ]],
]);

$visible_count = 6; // Số thẻ hiển thị trước khi bấm "Xem thêm bài viết"

function pcm_reading_time($post_id)
{
    $word_count = str_word_count(wp_strip_all_tags(get_the_content(null, false, $post_id)));
    return max(1, ceil($word_count / 200));
}
?>

<main id="primary" class="site-main page-chuyen-muc">

    <!-- ── Hero ─────────────────────────────────────────────── -->
    <section class="pcm-hero container">
        <p class="pcm-eyebrow">Chuyên mục</p>
        <h1 class="pcm-hero__title"><?= esc_html($hero_title) ?></h1>
        <p class="pcm-hero__desc"><?= esc_html($hero_desc) ?></p>
    </section>

    <!-- ── Tabs lọc ─────────────────────────────────────────── -->
    <section class="pcm-tabs container">
        <ul class="pcm-tabs__list" data-pcm-tabs>
            <?php foreach ($cats as $slug => $label) : ?>
            <li>
                <button type="button" class="pcm-tab cc <?= $slug === '' ? 'is-active' : '' ?>" data-filter="<?= esc_attr($slug) ?>" data-featured-id="<?= esc_attr($featured_ids_by_tab[$slug]) ?>">
                    <?= esc_html($label) ?>
                </button>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <!-- ── Bài viết nổi bật (mỗi tab có 1 bản, JS chuyển đổi khi lọc) ── -->
    <?php foreach ($cats as $slug => $label) :
        $fid = $featured_ids_by_tab[$slug];
        if (!$fid) continue;
        $f_terms  = get_the_terms($fid, 'category');
        $f_badge  = ($f_terms && !is_wp_error($f_terms)) ? $f_terms[0]->name : '';
        $f_author = get_field('author_name', $fid) ?: 'Chuyên gia Tamya';
    ?>
    <section class="pcm-featured container<?= $slug === '' ? ' is-active' : '' ?>" data-pcm-featured="<?= esc_attr($slug) ?>">
        <a href="<?= esc_url(get_permalink($fid)) ?>" class="pcm-featured__card">
            <div class="pcm-featured__img">
                <?php if (has_post_thumbnail($fid)) echo get_the_post_thumbnail($fid, 'large'); ?>
            </div>
            <div class="pcm-featured__body">
                <?php if ($f_badge) : ?><span class="pcm-badge"><?= esc_html($f_badge) ?></span><?php endif; ?>
                <h2 class="pcm-featured__title"><?= esc_html(get_the_title($fid)) ?></h2>
                <p class="pcm-featured__excerpt"><?= wp_trim_words(get_the_excerpt($fid), 25, '...') ?></p>
                <p class="pcm-featured__meta">
                    <?= esc_html($f_author) ?>
                    <span class="pcm-meta__sep">·</span>
                    <?= esc_html(get_the_date('d.m.Y', $fid)) ?>
                    <span class="pcm-meta__sep">·</span>
                    <?= pcm_reading_time($fid) ?> phút đọc
                </p>
                <span class="pcm-cta">
                    Đọc tiếp
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
            </div>
        </a>
    </section>
    <?php endforeach; ?>

    <!-- ── Lưới bài viết ──────────────────────────────────────── -->
    <?php if ($grid_query->have_posts()) : ?>
    <section class="pcm-grid-section container">
        <div class="pcm-grid" data-pcm-grid>
            <?php
            $i = 0;
            while ($grid_query->have_posts()) : $grid_query->the_post();
                $i++;
                $terms = get_the_terms(get_the_ID(), 'category');
                $badge = ($terms && !is_wp_error($terms)) ? $terms[0]->name : '';
                $cat_slugs_post = $terms ? wp_list_pluck($terms, 'slug') : [];
                $author = get_field('author_name') ?: 'Chuyên gia Tamya';
            ?>
            <article class="pcm-card<?= $i > $visible_count ? ' is-hidden' : '' ?>" data-pcm-card data-post-id="<?= esc_attr(get_the_ID()) ?>" data-cats="<?= esc_attr(implode(' ', $cat_slugs_post)) ?>">
                <a href="<?= esc_url(get_permalink()) ?>" class="pcm-card__link">
                    <div class="pcm-card__img">
                        <?php if (has_post_thumbnail()) the_post_thumbnail('medium_large'); ?>
                    </div>
                    <div class="pcm-card__body">
                        <?php if ($badge) : ?><span class="pcm-badge"><?= esc_html($badge) ?></span><?php endif; ?>
                        <h3 class="pcm-card__title"><?php the_title(); ?></h3>
                        <p class="pcm-card__excerpt"><?= wp_trim_words(get_the_excerpt(), 18, '...') ?></p>
                        <p class="pcm-card__meta"><?= esc_html($author) ?> <span class="pcm-meta__sep">·</span> <?= get_the_date('d.m.Y') ?></p>
                    </div>
                </a>
            </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- ── Đọc nhiều ────────────────────────────────────────── -->
    <?php if (!empty($trending_ids)) : ?>
    <section class="pcm-highlight container">
        <p class="pcm-eyebrow pcm-eyebrow--sm">Đọc nhiều</p>
        <h2 class="pcm-highlight__title">Bài viết nổi bật</h2>

        <div class="pcm-highlight__list">
            <?php foreach ($trending_ids as $tid) :
                $t_terms  = get_the_terms($tid, 'category');
                $t_badge  = ($t_terms && !is_wp_error($t_terms)) ? $t_terms[0]->name : '';
                $t_author = get_field('author_name', $tid) ?: 'Chuyên gia Tamya';
            ?>
            <article class="pcm-hcard" data-pcm-card data-cats="<?= esc_attr($t_terms ? implode(' ', wp_list_pluck($t_terms, 'slug')) : '') ?>">
                <a href="<?= esc_url(get_permalink($tid)) ?>" class="pcm-hcard__link">
                    <div class="pcm-hcard__img">
                        <?php if (has_post_thumbnail($tid)) echo get_the_post_thumbnail($tid, 'medium_large'); ?>
                    </div>
                    <div class="pcm-hcard__body">
                        <?php if ($t_badge) : ?><span class="pcm-badge"><?= esc_html($t_badge) ?></span><?php endif; ?>
                        <h3 class="pcm-hcard__title"><?= esc_html(get_the_title($tid)) ?></h3>
                        <p class="pcm-hcard__excerpt"><?= wp_trim_words(get_the_excerpt($tid), 26, '...') ?></p>
                        <p class="pcm-hcard__meta"><?= pcm_reading_time($tid) ?> phút đọc <span class="pcm-meta__sep">·</span> <?= esc_html(get_the_date('d.m.Y', $tid)) ?></p>
                        <span class="pcm-cta">
                            Đọc tiếp
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                    </div>
                </a>
            </article>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- ── Xem thêm ─────────────────────────────────────────── -->
    <?php if ($i > 0) : ?>
    <div class="pcm-loadmore">
        <button type="button" class="pcm-btn-outline" data-pcm-loadmore>Xem thêm bài viết</button>
    </div>
    <?php endif; ?>

</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var grid             = document.querySelector('[data-pcm-grid]');
    var tabsList         = document.querySelector('[data-pcm-tabs]');
    var loadMoreBtn      = document.querySelector('[data-pcm-loadmore]');
    var allCards         = Array.prototype.slice.call(document.querySelectorAll('[data-pcm-card]'));
    var featuredSections = Array.prototype.slice.call(document.querySelectorAll('[data-pcm-featured]'));
    if (!tabsList) return;

    var gridCards = grid ? Array.prototype.slice.call(grid.querySelectorAll('.pcm-card')) : [];

    tabsList.addEventListener('click', function (e) {
        var btn = e.target.closest('.pcm-tab');
        if (!btn) return;

        tabsList.querySelectorAll('.pcm-tab').forEach(function (t) { t.classList.remove('is-active'); });
        btn.classList.add('is-active');

        var filter     = btn.getAttribute('data-filter');
        var featuredId = btn.getAttribute('data-featured-id');

        // Chuyển sang bản bài viết nổi bật tương ứng với chuyên mục đang chọn
        featuredSections.forEach(function (sec) {
            sec.classList.toggle('is-active', sec.getAttribute('data-pcm-featured') === filter);
        });

        allCards.forEach(function (card) {
            var cats  = (card.getAttribute('data-cats') || '').split(' ');
            var match = !filter || cats.indexOf(filter) !== -1;
            card.classList.toggle('is-filtered-out', !match);
        });

        // Ẩn trong lưới bài đang được hiển thị trùng ở khối nổi bật
        gridCards.forEach(function (card) {
            var isDup = !!featuredId && card.getAttribute('data-post-id') === featuredId;
            card.classList.toggle('is-featured-dup', isDup);
        });

        if (filter) {
            gridCards.forEach(function (card) { card.classList.remove('is-hidden'); });
            if (loadMoreBtn) loadMoreBtn.style.display = 'none';
        } else if (loadMoreBtn) {
            loadMoreBtn.style.display = '';
        }
    });

    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function () {
            gridCards.forEach(function (card) { card.classList.remove('is-hidden'); });
            loadMoreBtn.style.display = 'none';
        });
    }
});
</script>

<?php get_footer(); ?>
