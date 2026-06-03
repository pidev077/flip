<?php
/**
 * Template for displaying single posts – Tamya Blog
 */
get_header();

while (have_posts()) : the_post();

$categories   = get_the_category();
$primary_cat  = !empty($categories) ? $categories[0] : null;
$word_count   = str_word_count(wp_strip_all_tags(get_the_content()));
$reading_time = max(1, ceil($word_count / 200));

$author_avatar = get_field('author_avatar');
$author_name   = get_field('author_name');
$author_bio    = get_field('author_bio');
$author_role   = get_field('author_role');

$tags = get_the_tags();

$blog_page  = get_option('page_for_posts');
$blog_label = $blog_page ? get_the_title($blog_page) : 'Blog';
$blog_url   = $blog_page ? get_permalink($blog_page) : home_url('/blog');

$excerpt = get_the_excerpt();

// Lấy URL từ ACF image field (hỗ trợ cả array lẫn URL string)
function sp_avatar_src($field) {
    if (!$field) return '';
    if (is_array($field)) return $field['url'] ?? '';
    if (is_numeric($field)) return wp_get_attachment_url($field) ?: '';
    return $field;
}

// Sidebar related posts
$sidebar_related = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => 4,
    'post__not_in'   => [get_the_ID()],
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

// Bottom related posts
$bottom_related = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post__not_in'   => [get_the_ID()],
    'orderby'        => 'date',
    'order'          => 'DESC',
]);
?>

<main id="primary" class="site-main sp-single">

    <!-- ── Breadcrumb bar (above hero, light bg) ─────────────── -->
    <div class="sp-crumb-bar">
        <div class="container">
            <nav class="sp-breadcrumb" aria-label="Breadcrumb">
                <a href="<?= esc_url(home_url('/')) ?>">Trang chủ</a>
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <a href="<?= esc_url($blog_url) ?>"><?= esc_html($blog_label) ?></a>
                <?php if ($primary_cat) : ?>
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <a href="<?= esc_url(get_category_link($primary_cat->term_id)) ?>"><?= esc_html($primary_cat->name) ?></a>
                <?php endif; ?>
                <svg width="10" height="10" viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span><?= wp_trim_words(get_the_title(), 8, '...') ?></span>
            </nav>
        </div>
    </div>

    <!-- ── Hero (featured image + content at bottom) ─────────── -->
    <section class="sp-hero">
        <?php if (has_post_thumbnail()) : ?>
        <div class="sp-hero__bg"><?php the_post_thumbnail('full'); ?></div>
        <?php endif; ?>
        <div class="sp-hero__overlay"></div>

        <!-- Content sits at bottom of hero image -->
        <div class="sp-hero__inner">
            <div class="container">

                <!-- Category + Date only (reading time in sidebar) -->
                <div class="sp-hero__meta">
                    <?php if ($primary_cat) : ?>
                    <a href="<?= esc_url(get_category_link($primary_cat->term_id)) ?>" class="sp-badge"><?= esc_html($primary_cat->name) ?></a>
                    <?php endif; ?>
                    <span class="sp-hero__date"><?= get_the_date('d.m.Y') ?></span>
                </div>

                <!-- Title -->
                <h1 class="sp-hero__title"><?php the_title(); ?></h1>

                <!-- Excerpt -->
                <?php if ($excerpt) : ?>
                <p class="sp-hero__excerpt"><?= esc_html($excerpt) ?></p>
                <?php endif; ?>

                <!-- Author + Share -->
                <div class="sp-hero__foot">
                    <div class="sp-hero__author">
                        <div class="sp-hero__author-avatar">
                            <?php $av_src = sp_avatar_src($author_avatar);
                            if ($av_src) : ?>
                            <img src="<?= esc_url($av_src) ?>" alt="<?= esc_attr($author_name ?: get_the_author()) ?>">
                            <?php else :
                                echo get_avatar(get_the_author_meta('ID'), 44);
                            endif; ?>
                        </div>
                        <div class="sp-hero__author-info">
                            <div class="sp-hero__author-name"><?= esc_html($author_name ?: get_the_author()) ?></div>
                            <?php if ($author_role) : ?>
                            <div class="sp-hero__author-role"><?= esc_html($author_role) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="sp-share">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(get_permalink()) ?>" target="_blank" rel="noopener" aria-label="Facebook" class="sp-share__btn">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M6.9 16.125H9.9V10.118H12.6l.3-2.985H9.9V5.625c0-.597.473-1.5 1.5-1.5H12.9V1.125H10.65A3.75 3.75 0 006.9 4.875v1.258H5.1l-.3 2.985H6.9v6.007Z" fill="currentColor"/></svg>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?= urlencode(get_permalink()) ?>&text=<?= urlencode(get_the_title()) ?>" target="_blank" rel="noopener" aria-label="X" class="sp-share__btn">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M10.456 7.794L16.152 1.125h-1.35L9.858 6.916 5.907 1.125H1.35l5.974 8.757L1.35 16.875h1.35l5.223-6.119 4.172 6.119h4.556L10.456 7.794Z" fill="currentColor"/></svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- /Hero -->

    <!-- ── Body: Content + Sidebar ───────────────────────────── -->
    <div class="sp-body">
        <div class="container sp-body__container">

            <!-- Main Content -->
            <article class="sp-body__main">

                <!-- Inline author strip (below hero) -->
                <div class="sp-inline-author">
                    <div class="sp-inline-author__info">
                        <div class="sp-inline-author__avatar">
                            <?php $av_src = sp_avatar_src($author_avatar);
                            if ($av_src) : ?>
                            <img src="<?= esc_url($av_src) ?>" alt="<?= esc_attr($author_name ?: get_the_author()) ?>">
                            <?php else :
                                echo get_avatar(get_the_author_meta('ID'), 40);
                            endif; ?>
                        </div>
                        <div>
                            <div class="sp-inline-author__name"><?= esc_html($author_name ?: get_the_author()) ?></div>
                            <?php if ($author_role) : ?>
                            <div class="sp-inline-author__role"><?= esc_html($author_role) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="sp-inline-author__share">
                        <!-- Facebook share -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(get_permalink()) ?>" target="_blank" rel="noopener" class="sp-inline-author__share-btn" aria-label="Chia sẻ Facebook">
                            <svg width="16" height="16" viewBox="0 0 18 18" fill="none"><path d="M6.9 16.125H9.9V10.118H12.6l.3-2.985H9.9V5.625c0-.597.473-1.5 1.5-1.5H12.9V1.125H10.65A3.75 3.75 0 006.9 4.875v1.258H5.1l-.3 2.985H6.9v6.007Z" fill="currentColor"/></svg>
                        </a>
                        <!-- Copy link -->
                        <button class="sp-inline-author__share-btn" id="sp-copy-link" data-url="<?= esc_url(get_permalink()) ?>" aria-label="Sao chép liên kết">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </button>
                        <!-- Bookmark -->
                        <button class="sp-inline-author__share-btn" id="sp-bookmark" aria-label="Lưu bài viết">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"><path d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2v16z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </button>
                    </div>
                </div>

                <!-- Gutenberg blocks content -->
                <div class="sp-content entry-content">
                    <?php the_content(); ?>
                </div>

                <!-- Tags -->
                <?php if ($tags) : ?>
                <div class="sp-tags">
                    <?php foreach ($tags as $tag) : ?>
                    <a href="<?= esc_url(get_tag_link($tag->term_id)) ?>" class="sp-tag"><?= esc_html($tag->name) ?></a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

            </article>
            <!-- /Main Content -->

            <!-- Sidebar -->
            <aside class="sp-sidebar">

                <!-- Meta: reading time + date -->
                <div class="sp-sidebar-meta">
                    <div class="sp-sidebar-meta__item">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 6v6l4 2M22 12a10 10 0 11-20 0 10 10 0 0120 0z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <div>
                            <div class="sp-sidebar-meta__label">Thời gian đọc</div>
                            <div class="sp-sidebar-meta__val"><?= $reading_time ?> phút</div>
                        </div>
                    </div>
                    <div class="sp-sidebar-meta__item">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M19.5 3H16.5V1.5H15V3H9V1.5H7.5V3H4.5C3.675 3 3 3.675 3 4.5V19.5C3 20.325 3.675 21 4.5 21H19.5C20.325 21 21 20.325 21 19.5V4.5C21 3.675 20.325 3 19.5 3ZM19.5 19.5H4.5V9H19.5V19.5ZM19.5 7.5H4.5V4.5H7.5V6H9V4.5H15V6H16.5V4.5H19.5V7.5Z" fill="currentColor"/></svg>
                        <div>
                            <div class="sp-sidebar-meta__label">Ngày đăng</div>
                            <div class="sp-sidebar-meta__val"><?= get_the_date('d/m/Y') ?></div>
                        </div>
                    </div>
                </div>

                <!-- TOC (JS generated) -->
                <nav class="sp-toc" id="sp-toc" style="display:none">
                    <div class="sp-toc__title">Nội dung bài viết</div>
                    <ul class="sp-toc__list" id="sp-toc-list"></ul>
                </nav>

                <!-- Bài viết liên quan -->
                <?php if ($sidebar_related->have_posts()) : ?>
                <div class="sp-sidebar-related">
                    <div class="sp-sidebar-related__title">Bài viết liên quan</div>
                    <?php while ($sidebar_related->have_posts()) : $sidebar_related->the_post(); ?>
                    <a href="<?= esc_url(get_permalink()) ?>" class="sp-ritem">
                        <?php if (has_post_thumbnail()) : ?>
                        <div class="sp-ritem__img"><?php the_post_thumbnail('thumbnail'); ?></div>
                        <?php endif; ?>
                        <div class="sp-ritem__body">
                            <div class="sp-ritem__date"><?= get_the_date('d.m.Y') ?></div>
                            <div class="sp-ritem__title"><?php the_title(); ?></div>
                        </div>
                    </a>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
                <?php endif; ?>

            </aside>
            <!-- /Sidebar -->

        </div>
    </div>
    <!-- /Body -->

    <!-- ── Author Box ────────────────────────────────────────── -->
    <?php
    $av_src = sp_avatar_src($author_avatar);
    $bio    = $author_bio ?: get_the_author_meta('description');
    if ($author_name || $bio) : ?>
    <div class="sp-author-box">
        <div class="container">
            <div class="sp-author-box__inner">
                <div class="sp-author-box__flex">
                    <div class="sp-author-box__avatar">
                        <?php if ($av_src) : ?>
                        <img src="<?= esc_url($av_src) ?>" alt="<?= esc_attr($author_name ?: get_the_author()) ?>">
                        <?php else :
                            echo get_avatar(get_the_author_meta('ID'), 100);
                        endif; ?>
                    </div>
                    <div class="sp-author-box__info">
                        <?php if ($author_role) : ?>
                        <div class="sp-author-box__prefix"><?= esc_html($author_role) ?></div>
                        <?php endif; ?>
                        <div class="sp-author-box__name"><?= esc_html($author_name ?: get_the_author()) ?></div>
                        <?php if ($bio) : ?>
                        <p class="sp-author-box__bio"><?= wp_kses_post($bio) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- ── CTA ───────────────────────────────────────────────── -->
    <?php
    $cta_text = get_field('post_cta_text', 'option');
    $cta_link = get_field('post_cta_link', 'option');
    $cta_btn  = get_field('post_cta_btn',  'option');
    if (!$cta_text) {
        $cta_text = 'Da bạn đang cần được phục hồi<br>đúng cách sau laser?';
        $cta_btn  = 'Tư vấn ngay';
    }
    ?>
    <div class="sp-cta">
        <div class="container sp-cta__inner">
            <p class="sp-cta__text"><?= wp_kses_post($cta_text) ?></p>
            <a href="<?= esc_url($cta_link ?: '#lien-he') ?>" class="sp-cta__btn">
                <?= esc_html($cta_btn ?: 'Tư vấn ngay') ?>
            </a>
        </div>
    </div>

    <!-- ── Có thể bạn quan tâm ───────────────────────────────── -->
    <?php if ($bottom_related->have_posts()) : ?>
    <section class="sp-bottom-related">
        <div class="container">
            <div class="sp-bottom-related__head">
                <h2 class="sp-bottom-related__title">Có thể bạn quan tâm</h2>
                <div class="sp-bottom-related__nav">
                    <button class="sp-nav-btn" id="sp-rel-prev" aria-label="Trước">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                    <button class="sp-nav-btn" id="sp-rel-next" aria-label="Sau">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                </div>
            </div>
            <div class="sp-bottom-related__grid">
                <?php while ($bottom_related->have_posts()) : $bottom_related->the_post();
                    $r_cats = get_the_category();
                    $r_cat  = $r_cats[0] ?? null;
                    $r_bg   = $r_cat ? (get_term_meta($r_cat->term_id, 'bg_category', true) ?: '#799852') : '#799852';
                ?>
                <a href="<?= esc_url(get_permalink()) ?>" class="sp-bcard">
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="sp-bcard__img"><?php the_post_thumbnail('medium_large'); ?></div>
                    <?php endif; ?>
                    <div class="sp-bcard__body">
                        <div class="sp-bcard__meta">
                            <?php if ($r_cat) : ?>
                            <span class="sp-badge" style="background:<?= esc_attr($r_bg) ?>"><?= esc_html($r_cat->name) ?></span>
                            <?php endif; ?>
                            <span class="sp-bcard__date"><?= get_the_date('d.m.Y') ?></span>
                        </div>
                        <h3 class="sp-bcard__title"><?php the_title(); ?></h3>
                        <p class="sp-bcard__excerpt"><?= wp_trim_words(get_the_excerpt(), 18, '...') ?></p>
                    </div>
                </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

</main>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── TOC ────────────────────────────────────────────────────
    var content = document.querySelector('.sp-content');
    var tocEl   = document.getElementById('sp-toc');
    var tocList = document.getElementById('sp-toc-list');

    if (content && tocEl && tocList) {
        // Tìm tất cả h2, h3 trong content (bao gồm cả wp-block-heading)
        var headings = Array.from(content.querySelectorAll('h2, h3, h4'));

        if (headings.length >= 1) {
            tocEl.style.display = 'block';

            headings.forEach(function (h, i) {
                var id = 'sp-h-' + i;
                h.id = id;

                var li = document.createElement('li');
                if (h.tagName === 'H4') {
                    li.className = 'sp-toc__item sp-toc__item--sub';
                } else if (h.tagName === 'H3') {
                    li.className = 'sp-toc__item sp-toc__item--sub';
                } else {
                    li.className = 'sp-toc__item';
                }

                var a = document.createElement('a');
                a.href = '#' + id;
                a.textContent = h.textContent.trim();

                a.addEventListener('click', function (e) {
                    e.preventDefault();
                    var headerH = (document.getElementById('header') || {}).offsetHeight || 80;
                    var crumbH  = (document.querySelector('.sp-crumb-bar') || {}).offsetHeight || 0;
                    var top = h.getBoundingClientRect().top + window.pageYOffset - headerH - crumbH - 16;
                    window.scrollTo({ top: top, behavior: 'smooth' });
                });

                li.appendChild(a);
                tocList.appendChild(li);
            });

            // Scroll spy — đánh dấu link đang active
            var onScroll = function () {
                var scrollY = window.pageYOffset;
                var headerH = (document.getElementById('header') || {}).offsetHeight || 80;
                var current = null;

                headings.forEach(function (h) {
                    if (h.getBoundingClientRect().top + window.pageYOffset - headerH - 40 <= scrollY) {
                        current = h.id;
                    }
                });

                tocList.querySelectorAll('a').forEach(function (a) {
                    a.classList.toggle('is-active', a.getAttribute('href') === '#' + current);
                });
            };

            window.addEventListener('scroll', onScroll, { passive: true });
            onScroll(); // chạy ngay để set active khi load
        }
    }

    // ── Copy link ──────────────────────────────────────────────
    var copyBtn = document.getElementById('sp-copy-link');
    if (copyBtn) {
        copyBtn.addEventListener('click', function () {
            var url = copyBtn.getAttribute('data-url') || window.location.href;
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(url).then(function () {
                    copyBtn.classList.add('is-copied');
                    setTimeout(function () { copyBtn.classList.remove('is-copied'); }, 2000);
                });
            } else {
                // Fallback cho HTTP
                var ta = document.createElement('textarea');
                ta.value = url;
                ta.style.position = 'fixed';
                ta.style.opacity = '0';
                document.body.appendChild(ta);
                ta.select();
                document.execCommand('copy');
                document.body.removeChild(ta);
                copyBtn.classList.add('is-copied');
                setTimeout(function () { copyBtn.classList.remove('is-copied'); }, 2000);
            }
        });
    }

    // ── Bookmark (localStorage toggle) ─────────────────────────
    var bookmarkBtn = document.getElementById('sp-bookmark');
    if (bookmarkBtn) {
        var bKey = 'sp_bookmarks';
        var bUrl = window.location.href;
        var bList = JSON.parse(localStorage.getItem(bKey) || '[]');
        if (bList.indexOf(bUrl) !== -1) bookmarkBtn.classList.add('is-copied');

        bookmarkBtn.addEventListener('click', function () {
            var list = JSON.parse(localStorage.getItem(bKey) || '[]');
            var idx  = list.indexOf(bUrl);
            if (idx === -1) {
                list.push(bUrl);
                bookmarkBtn.classList.add('is-copied');
            } else {
                list.splice(idx, 1);
                bookmarkBtn.classList.remove('is-copied');
            }
            localStorage.setItem(bKey, JSON.stringify(list));
        });
    }

});
</script>

<?php endwhile; ?>
<?php get_footer(); ?>
