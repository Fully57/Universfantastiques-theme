<?php
/**
 * Template personnalisé - Blog Layout 4 (critique de livres)
 *
 * @package Astra Child
 */

$note        = get_field('note');
$titre       = get_field('titre');
$auteur      = get_field('auteur');
$avis        = get_field('avis');
$note        = min(100, max(0, intval($note)));
$note10      = round($note / 10, 1);
$gradient_id = 'heartFill-' . get_the_ID();
$percent     = $note . '%';
?>

<!-- ✅ On utilise un <div> et non un <article> -->
<div class="book-card" id="post-<?php the_ID(); ?>">

  <!-- Image et badge -->
  <div class="cover-container">
    <?php if ( has_post_thumbnail() ) : ?>
      <?php the_post_thumbnail('medium_large', ['class' => 'cover']); ?>
    <?php endif; ?>

    <?php if ( $note ) : ?>
      <div class="note-badge">
        <svg viewBox="0 0 24 24" width="24" height="24">
          <defs>
            <linearGradient id="<?php echo esc_attr($gradient_id); ?>" x1="0" y1="1" x2="0" y2="0">
              <stop offset="<?php echo $percent; ?>" stop-color="#e74c3c"/>
              <stop offset="<?php echo $percent; ?>" stop-color="#fff"/>
            </linearGradient>
          </defs>
          <path fill="url(#<?php echo esc_attr($gradient_id); ?>)"
                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 
                   2 5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 
                   4.5 2.09C13.09 3.81 14.76 3 16.5 3 
                   19.58 3 22 5.42 22 8.5c0 3.78-3.4 
                   6.86-8.55 11.54L12 21.35z"/>
        </svg>
        <span class="note-label"><?php echo esc_html($note10); ?>/10</span>
      </div>
    <?php endif; ?>
  </div>

  <!-- Contenu -->
  <div class="content">
    <?php if ( $titre ) : ?>
      <h2 class="title"><?php echo esc_html($titre); ?></h2>
    <?php else : ?>
      <h2 class="title"><?php the_title(); ?></h2>
    <?php endif; ?>

    <?php if ( $auteur ) : ?>
      <p class="author">par <?php echo esc_html($auteur); ?></p>
    <?php endif; ?>

    <?php if ( $avis ) : ?>
      <p class="excerpt"><?php echo wp_trim_words($avis, 30, '...'); ?></p>
    <?php endif; ?>

    <a href="<?php the_permalink(get_the_ID()); ?>" class="read-more">Lire la suite →</a>
  </div>

</div>