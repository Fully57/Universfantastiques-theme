<?php echo "<!-- FOOTER CHILD ACTIVÉ -->"; ?>

<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Ashe
 */
?>

</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
  <div class="footer-inner clear-fix">
    <?php if ( is_active_sidebar( 'footer-area' ) ) : ?>
      <div class="footer-widgets">
        <?php dynamic_sidebar( 'footer-area' ); ?>
      </div>
    <?php endif; ?>

    <div class="footer-copyright">
      <?php echo esc_html( get_theme_mod( 'footer_copyright', '© ' . date("Y") . ' ' . get_bloginfo( 'name' ) ) ); ?>
    </div>
  </div>
</footer><!-- #colophon -->

<div id="palette-switcher" style="text-align:center; margin:2em 0;">
  <button class="switch-theme" data-theme="sepia">🌾 Sépia</button>
  <button class="switch-theme" data-theme="bleu">🔷 Lavande</button>
  <button class="switch-theme" data-theme="the">🍵 Thé vert</button>
    <button class="switch-theme" data-theme="the">🍵HappyHues</button> 
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const links = {
      sepia: document.querySelector('link[href*="palette_sepia.css"]'),
      bleu: document.querySelector('link[href*="palette_bleu_lavande.css"]'),
      the: document.querySelector('link[href*="palette_the_vert.css"]'),
	  happyhues: document.querySelector('link[href*="happyhues.css"]')
    };

    function activate(key) {
      for (const [k, l] of Object.entries(links)) {
        if (l) l.disabled = (k !== key);
      }
      localStorage.setItem("themePalette", key);
    }

    const saved = localStorage.getItem("themePalette") || "sepia";
    activate(saved);

    document.querySelectorAll(".switch-theme").forEach(btn => {
      btn.addEventListener("click", () => activate(btn.dataset.theme));
    });
  });
</script>

<?php wp_footer(); ?>
</body>
</html>