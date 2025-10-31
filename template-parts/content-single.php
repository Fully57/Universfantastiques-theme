<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if (function_exists('astra_entry_before')) astra_entry_before(); ?>

	<header class="entry-header <?php echo esc_attr(function_exists('astra_entry_header_class') ? astra_entry_header_class() : ''); ?>">
		<?php if (function_exists('astra_entry_header_before')) astra_entry_header_before(); ?>
		<?php the_title('<h1 class="entry-title" itemprop="headline">', '</h1>'); ?>
		<?php if (function_exists('astra_entry_header_after')) astra_entry_header_after(); ?>
	</header>

	<?php if (function_exists('astra_entry_content_before')) astra_entry_content_before(); ?>

	<?php if (has_post_thumbnail()) : ?>
		<div class="acf-featured-image" style="margin: 2em 0; text-align:center;">
			<?php the_post_thumbnail('large', ['style' => 'border-radius: 10px; max-width:100%; height:auto;']); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content clear" itemprop="text">
		<?php
		$fields = ['auteur', 'editeur', 'date_parution', 'genres', 'pages', 'format', 'resume', 'avis', 'note', 'lien_amazon'];
		$has_acf = false;
		foreach ($fields as $f) {
			if (!empty(get_field($f))) { $has_acf = true; break; }
		}
		?>

		<?php if ($has_acf): ?>
			<div class="acf-book-details" style="background:#fff;padding:1.5em;border-radius:10px;margin-bottom:1.5em;box-shadow:0 5px 20px rgba(0,0,0,0.05);">
				<ul class="acf-meta-list" style="list-style:none;padding:0;margin:0;">
					<?php foreach ($fields as $field): 
						if ($field === 'resume' || $field === 'avis' || $field === 'note' || $field === 'lien_amazon') continue;
						$value = get_field($field);
						if ($value):
							if (is_array($value)) $value = implode(', ', $value);
							$label = ucfirst(str_replace('_', ' ', $field));
					?>
						<li style="margin-bottom:0.75em;">
							<strong><?= esc_html($label) ?> :</strong>
							<span><?= esc_html($value) ?></span>
						</li>
					<?php endif; endforeach; ?>
				</ul>

				<?php if ($note = get_field('note')): 
					$hearts = str_repeat('❤️', min(5, max(1, (int) $note)));
				?>
					<div style="margin-top:1em;">
						<strong>Note :</strong> <span style="font-size: 1.5em;"><?= $hearts ?></span>
					</div>
				<?php endif; ?>

				<?php if ($link = get_field('lien_amazon')): ?>
					<p style="margin-top:1.5em;"><a class="acf-amazon-link button" href="<?= esc_url($link); ?>" target="_blank">Acheter sur Amazon</a></p>
				<?php endif; ?>
			</div>

			<?php if ($resume = get_field('resume')) : ?>
				<div class="acf-resume" style="background:#f9f9f9;padding:1em 1.5em;margin-bottom:1.5em;border-left:4px solid #ccc;border-radius:8px;">
					<h2 style="margin-top:0;">Résumé éditeur</h2>
					<p><?= esc_html($resume); ?></p>
				</div>
			<?php endif; ?>

			<?php if ($avis = get_field('avis')) : ?>
				<div class="acf-avis" style="background:#f9f9f9;padding:1em 1.5em;border-left:4px solid #ccc;border-radius:8px;">
					<h2 style="margin-top:0;">Mon avis</h2>
					<p><?= esc_html($avis); ?></p>
				</div>
			<?php endif; ?>

		<?php else: ?>
			<?php the_content(); ?>
		<?php endif; ?>

		<?php
		wp_link_pages([
			'before' => '<div class="page-links">' . esc_html__('Pages:', 'astra'),
			'after'  => '</div>',
		]);
		?>
	</div>

	<?php if (function_exists('astra_entry_content_after')) astra_entry_content_after(); ?>

	<footer class="entry-footer <?php echo esc_attr(function_exists('astra_entry_footer_class') ? astra_entry_footer_class() : ''); ?>">
		<?php if (function_exists('astra_entry_footer_before')) astra_entry_footer_before(); ?>
		<?php if (function_exists('astra_entry_footer')) astra_entry_footer(); ?>
		<?php if (function_exists('astra_entry_footer_after')) astra_entry_footer_after(); ?>
	</footer>

	<?php if (function_exists('astra_entry_after')) astra_entry_after(); ?>

	<?php
	// ✅ Active les commentaires
	if (comments_open() || get_comments_number()) :
		comments_template();
	endif;
	?>

</article>