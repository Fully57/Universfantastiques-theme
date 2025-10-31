<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if (function_exists('astra_entry_before')) astra_entry_before(); ?>

    <header class="entry-header <?php echo esc_attr(function_exists('astra_entry_header_class') ? astra_entry_header_class() : ''); ?>">
        <?php if (function_exists('astra_entry_header_before')) astra_entry_header_before(); ?>
        <?php the_title('<h1 class="entry-title" itemprop="headline">', '</h1>'); ?>
        <?php if (function_exists('astra_entry_header_after')) astra_entry_header_after(); ?>
    </header>

    <?php if (function_exists('astra_entry_content_before')) astra_entry_content_before(); ?>

    <div class="entry-content clear" itemprop="text">

        <?php if (has_post_thumbnail()) : ?>
            <div class="acf-thumbnail">
                <?php the_post_thumbnail('large'); ?>
            </div>
        <?php endif; ?>

        <div class="acf-book-details">
            <ul class="acf-meta-list">
                <?php
                $fields = [
                    'auteur'        => 'Auteur',
                    'editeur'       => 'Éditeur',
                    'date_parution' => 'Date de parution',
                    'genres'        => 'Genres',
                    'pages'         => 'Nombre de pages',
                    'format'        => 'Format',
                ];

                foreach ($fields as $key => $label) {
                    $value = get_field($key);
                    echo '<li><strong>' . esc_html($label) . ' :</strong> <span>';
                    if (empty($value)) {
                        echo 'Non renseigné';
                    } elseif (is_array($value)) {
                        echo esc_html(implode(', ', $value));
                    } else {
                        echo esc_html($value);
                    }
                    echo '</span></li>';
                }
                ?>
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