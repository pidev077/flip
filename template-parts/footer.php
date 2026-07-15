<?php
/**
 * Footer template
 */


// ===== INTRO & SOCIAL =====
$logo_footer       = get_field('logo_footer', 'option');
$background_image  = get_field('background_image', 'option');
$footer_tagline    = get_field('footer_tagline', 'option');
$social_heading    = get_field('social_heading', 'option');
$social_links      = get_field('social_links', 'option');


// ===== CONTACT =====
$contact_heading = get_field('contact_heading', 'option');
$hotline_label   = get_field('hotline_label', 'option');
$phone           = get_field('phone_number', 'option');
$email           = get_field('email', 'option');
$hours_label     = get_field('hours_label', 'option');
$hours_value     = get_field('hours_value', 'option');


// ===== EXPLORE =====
$explore_heading = get_field('explore_heading', 'option');


// ===== BRANCHES =====
$branch_groups = get_field('branch_groups', 'option');


// ===== BOTTOM =====
$copyright_text = get_field('copyright_text', 'option');
$bottom_links   = get_field('bottom_links', 'option');
?>


<footer id="footer" class="footer">
   <div class="footer-main" <?php if ($background_image) : ?>style="background-image: url('<?= esc_url($background_image); ?>');" <?php endif; ?>>
      <div class="container">
         <div class="footer-columns">

            <div class="footer-col footer-col--intro">
               <?php if ($logo_footer) : ?>
               <img class="footer-logo" src="<?= esc_url($logo_footer); ?>" alt="<?= esc_attr(get_bloginfo('name')); ?>">
               <?php endif; ?>

               <?php if ($footer_tagline) : ?>
               <p class="footer-tagline"><?= esc_html($footer_tagline); ?></p>
               <?php endif; ?>

               <?php if ($social_heading || $social_links) : ?>
               <div class="footer-social">
                  <?php if ($social_heading) : ?>
                  <h4 class="footer-col__heading"><?= esc_html($social_heading); ?></h4>
                  <?php endif; ?>

                  <?php if ($social_links) : ?>
                  <div class="social-links">
                     <?php foreach ($social_links as $social) :
                           $platform = $social['platform'] ?: 'facebook';
                           $label    = $social['label'] ?: ucfirst($platform);
                           $url      = $social['url'];
                           $icon     = $social['icon'];
                           if (!$url) continue;
                        ?>
                     <a class="social-link social-link--<?= esc_attr($platform); ?>" href="<?= esc_url($url); ?>" target="_blank" rel="noopener">
                        <span class="social-link__icon">
                           <?php if ($icon) : ?>
                           <img src="<?= esc_url($icon); ?>" alt="<?= esc_attr($label); ?>">
                           <?php else : ?>
                           <?= flip_svg_icon($platform); ?>
                           <?php endif; ?>
                        </span>
                        <span class="social-link__label"><?= esc_html($label); ?></span>
                     </a>
                     <?php endforeach; ?>
                  </div>
                  <?php endif; ?>
               </div>
               <?php endif; ?>
            </div>


            <div class="footer-col footer-col--contact">
               <?php if ($contact_heading) : ?>
               <h4 class="footer-col__heading"><?= esc_html($contact_heading); ?></h4>
               <?php endif; ?>

               <?php if ($hotline_label || $phone) : ?>
               <div class="footer-field">
                  <?php if ($hotline_label) : ?>
                  <p class="footer-field__label"><?= esc_html($hotline_label); ?></p>
                  <?php endif; ?>
                  <?php if ($phone && $phone['url']) :
                        $phone_target = $phone['target'] ? ' target="_blank" rel="noopener"' : '';
                     ?>
                  <a class="footer-field__value footer-field__value--accent" href="<?= esc_url($phone['url']); ?>"<?= $phone_target; ?>><?= esc_html($phone['title']); ?></a>
                  <?php endif; ?>
               </div>
               <?php endif; ?>

               <?php if ($email) : ?>
               <div class="footer-field">
                  <p class="footer-field__label">Email</p>
                  <a class="footer-field__value" href="mailto:<?= esc_attr($email); ?>"><?= esc_html($email); ?></a>
               </div>
               <?php endif; ?>

               <?php if ($hours_label || $hours_value) : ?>
               <div class="footer-field">
                  <?php if ($hours_label) : ?>
                  <p class="footer-field__label"><?= esc_html($hours_label); ?></p>
                  <?php endif; ?>
                  <?php if ($hours_value) : ?>
                  <p class="footer-field__value"><?= esc_html($hours_value); ?></p>
                  <?php endif; ?>
               </div>
               <?php endif; ?>
            </div>


            <?php if ($explore_heading || has_nav_menu('footer-menu')) : ?>
            <div class="footer-col footer-col--explore">
               <?php if ($explore_heading) : ?>
               <h4 class="footer-col__heading"><?= esc_html($explore_heading); ?></h4>
               <?php endif; ?>

               <?php
                     if (has_nav_menu('footer-menu')) {
                         wp_nav_menu([
                             'theme_location' => 'footer-menu',
                             'menu_class'     => 'footer-explore-menu list-unstyled p-0 m-0',
                             'container'      => false,
                         ]);
                     }
                     ?>
            </div>
            <?php endif; ?>


            <?php if ($branch_groups) : ?>
            <?php foreach ($branch_groups as $branch_group) :
                     $region_title = $branch_group['region_title'];
                     $locations    = $branch_group['locations'];
                     if (!$region_title && !$locations) continue;
                  ?>
            <div class="footer-col footer-col--branch">
               <?php if ($region_title) : ?>
               <h4 class="footer-col__heading"><?= esc_html($region_title); ?></h4>
               <?php endif; ?>

               <?php if ($locations) : ?>
               <?php foreach ($locations as $location) :
                        $name         = $location['name'];
                        $address      = $location['address'];
                        $hotline_label_branch = $location['hotline_label'];
                        $hotline      = $location['hotline'];
                     ?>
               <div class="footer-branch">
                  <?php if ($name) : ?>
                  <p class="footer-branch__name"><?= esc_html($name); ?></p>
                  <?php endif; ?>
                  <?php if ($address) : ?>
                  <p class="footer-branch__address"><?= nl2br(esc_html($address)); ?></p>
                  <?php endif; ?>
                  <?php if ($hotline && $hotline['url']) :
                           $hotline_target = $hotline['target'] ? ' target="_blank" rel="noopener"' : '';
                        ?>
                  <?php if ($hotline_label_branch) : ?>
                  <p class="footer-field__label"><?= esc_html($hotline_label_branch); ?></p>
                  <?php endif; ?>
                  <a class="footer-branch__hotline" href="<?= esc_url($hotline['url']); ?>"<?= $hotline_target; ?>><?= esc_html($hotline['title']); ?></a>
                  <?php endif; ?>
               </div>
               <?php endforeach; ?>
               <?php endif; ?>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>

         </div>
      </div>
   </div>


   <div class="footer-bottom">
      <div class="container">
         <div class="footer-bottom__inner">
            <?php if ($copyright_text) : ?>
            <p class="footer-copyright"><?= esc_html($copyright_text); ?></p>
            <?php endif; ?>

            <?php if ($bottom_links) : ?>
            <ul class="footer-bottom-links list-unstyled p-0 m-0">
               <?php foreach ($bottom_links as $link) :
                        if (!$link['url']) continue;
                     ?>
               <li><a href="<?= esc_url($link['url']); ?>"><?= esc_html($link['label']); ?></a></li>
               <?php endforeach; ?>
            </ul>
            <?php endif; ?>
         </div>
      </div>
   </div>
</footer>
