<?php
/* ==========================================================================
   FOOTER.PHP
   Closes <main>, renders the footer + next-page link, loads script.js.
   Pages may set $nextPage = ['href.php', 'Label'] before including this.
   ========================================================================== */
$nextPage  = $nextPage  ?? null;
$YOUR_NAME = $YOUR_NAME ?? 'Me';
?>
</main><!-- /#content -->

<footer class="footer">
    <?php if ($nextPage): ?>
        <a class="footer__next reveal" href="<?php echo e($nextPage[0]); ?>">
            <span class="footer__next-label">Next</span>
            <span class="footer__next-title"><?php echo e($nextPage[1]); ?></span>
            <span class="footer__next-arrow" aria-hidden="true">→</span>
        </a>
    <?php endif; ?>

    <div class="footer__inner">
        <p class="footer__line">Built slowly, on purpose — <?php echo e($YOUR_NAME); ?>.</p>
        <p class="footer__hint">
            Psst. There are things hidden in here.
            <span class="footer__hint-soft">The moon knows one. So does the title. So does the word you already know.</span>
        </p>
    </div>
</footer>

</div><!-- /.page -->

<script src="script.js"></script>
</body>
</html>
