<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php astra_entry_before(); ?>

	<header class="entry-header <?php astra_entry_header_class(); ?>">
		<?php astra_entry_header_before(); ?>
		<?php the_title('<h1 class="entry-title" itemprop="headline">', '</h1>'); ?>
		<?php astra_entry_header_after(); ?>
	</header>

	<?php astra_entry_content_before(); ?>

	<div class="entry-content clear" itemprop="text">

		<?php
		// Vérifie si au moins un champ ACF est rempli
		$acf_fields_present = false;
		$fields = ['titre', 'tome', 'auteur', 'editeur', 'date_parution', 'genres', 'pages', 'format', 'resume', 'avis', 'note', 'lien_amazon'];
		foreach ($fields as $field) {
			if (!empty(get_field($field))) {
				$acf_fields_present = true;
				break;
			}
		}
		?>

		<?php if ($acf_fields_present): ?>

			<div class="acf-book-details">
				<ul class="acf-meta-list">
					<?php if ($auteur = get_field('auteur')) : ?>
						<li><strong>Auteur :</strong> <span><?= esc_html($auteur); ?></span></li>
					<?php endif; ?>
					<?php if ($editeur = get_field('editeur')) : ?>
						<li><strong>Éditeur :</strong> <span><?= esc_html($editeur); ?></span></li>
					<?php endif; ?>
					<?php if ($date = get_field('date_parution')) : ?>
						<li><strong>Date de parution :</strong> <span><?= esc_html($date); ?></span></li>
					<?php endif; ?>
					<?php if ($genres = get_field('genres')) : ?>
						<li><strong>Genres :</strong> <span><?= esc_html(implode(', ', $genres)); ?></span></li>
					<?php endif; ?>
					<?php if ($pages = get_field('pages')) : ?>
						<li><strong>Nombre de pages :</strong> <span><?= esc_html($pages); ?></span></li>
					<?php endif; ?>
					<?php if ($format = get_field('format')) : ?>
						<li><strong>Format :</strong> <span><?= esc_html($format); ?></span></li>
					<?php endif; ?>
				</ul>
			</div>

			<?php if ($resume = get_field('resume')) : ?>
				<div class="acf-resume">
					<h2>Résumé éditeur</h2>
					<p><?= esc_html($resume); ?></p>
				</div>
			<?php endif; ?>

			<?php if ($avis = get_field('avis')) : ?>
				<div class="acf-avis">
					<h2>Mon avis</h2>
					<p><?= esc_html($avis); ?></p>
				</div>
			<?php endif; ?>

			<?php if ($note = get_field('note')) : ?>
				<p><strong>Note :</strong> <?= esc_html($note); ?> / 5</p>
			<?php endif; ?>

			<?php if ($amazon = get_field('lien_amazon')) : ?>
				<p><a class="acf-amazon-link button" href="<?= esc_url($amazon); ?>" target="_blank">Acheter sur Amazon</a></p>
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

	<?php astra_entry_content_after(); ?>

	<footer class="entry-footer <?php astra_entry_footer_class(); ?>">
		<?php astra_entry_footer_before(); ?>
		<?php astra_entry_footer(); ?>
		<?php astra_entry_footer_after(); ?>
	</footer>

	<?php astra_entry_after(); ?>

</article>