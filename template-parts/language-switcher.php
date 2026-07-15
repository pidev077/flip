<?php
/**
 * Language switcher
 * Only renders once WPML is active (icl_get_languages available with 2+ languages).
 * Nothing is shown before that, so no placeholder/fallback UI to maintain.
 */

$languages = function_exists('icl_get_languages') ? icl_get_languages('skip_missing=0') : [];

if (empty($languages)) {
    return;
}
?>

<div class="header__lang lang-switcher">
    <?php foreach ($languages as $lang): ?>
        <a href="<?= esc_url($lang['url']) ?>" class="lang-switcher__item<?= $lang['active'] ? ' is-active' : '' ?>" title="<?= esc_attr($lang['native_name']) ?>">
            <?php if ($lang['active'] && !empty($lang['country_flag_url'])): ?>
                <img class="lang-switcher__flag" src="<?= esc_url($lang['country_flag_url']) ?>" alt="<?= esc_attr($lang['language_code']) ?>">
            <?php endif; ?>
            <span class="lang-switcher__code"><?= esc_html(strtoupper($lang['language_code'])) ?></span>
        </a>
    <?php endforeach; ?>
</div>
