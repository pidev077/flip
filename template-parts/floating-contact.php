<?php
/**
 * Floating contact buttons (fixed, right side)
 */

$fc_enable  = get_field('floating_contact_enable', 'option');
$fc_buttons = get_field('floating_contact_buttons', 'option');

if (!$fc_enable || !$fc_buttons) {
	return;
}
?>
<div class="floating-contact">
	<?php foreach ($fc_buttons as $btn) :
		$type  = $btn['type'] ?: 'phone';
		$bg    = $btn['bg_color'];
		$label = $btn['label'];
		$url   = '';
		$target = '';

		if ($type === 'phone') {
			$phone = $btn['phone'];
			if (!$phone) continue;
			$url   = 'tel:' . preg_replace('/[^0-9+]/', '', $phone);
			$label = $label ?: $phone;
		} else {
			$link = $btn['link'];
			if (empty($link['url'])) continue;
			$url    = $link['url'];
			$label  = $label ?: $link['title'];
			$target = ' target="_blank" rel="noopener"';
		}
	?>
	<a class="floating-contact__item floating-contact__item--<?= esc_attr($type); ?>" href="<?= esc_url($url); ?>"<?= $target; ?><?php if ($bg) : ?> style="background-color: <?= esc_attr($bg); ?>;"<?php endif; ?><?php if ($label) : ?> title="<?= esc_attr($label); ?>" aria-label="<?= esc_attr($label); ?>"<?php endif; ?>>
		<?php if ($type === 'zalo') : ?>
			<span class="floating-contact__text">Zalo</span>
		<?php elseif ($type === 'custom') : ?>
			<?php if (!empty($btn['icon'])) : ?>
				<img src="<?= esc_url($btn['icon']); ?>" alt="<?= esc_attr($label); ?>">
			<?php else : ?>
				<span class="floating-contact__text"><?= esc_html(mb_substr($label ?: '?', 0, 1)); ?></span>
			<?php endif; ?>
		<?php else : ?>
			<?= flip_svg_icon($type); ?>
		<?php endif; ?>
	</a>
	<?php endforeach; ?>
</div>
