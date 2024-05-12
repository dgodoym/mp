<!-- Footer -->
<footer class="footer dark-mode bg-dark pt-5 pb-4 pb-lg-5">
    <div class="container pt-lg-4">
        <p class="nav d-block fs-xs text-center text-md-start pb-2 pb-lg-0 mb-0">
            <span class="text-light opacity-50">&copy; Todos los Derechos Reservados. Creado por </span>
            <a class="nav-link d-inline-block p-0" href="https://irtvhn.info/" target="_blank" rel="noopener">iRaffle TV</a>
        </p>
    </div>
</footer>


<!-- Back to top button -->
<a href="#top" class="btn-scroll-top" data-scroll>
    <span class="btn-scroll-top-tooltip text-muted fs-sm me-2">Subir</span>
    <i class="btn-scroll-top-icon bx bx-chevron-up"></i>
</a>


<!-- Vendor Scripts -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
<script src="assets/vendor/@lottiefiles/lottie-player/dist/lottie-player.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/console-ban/console-ban.min.js"></script>
<script src="assets/vendor/toastify/toastify.min.js"></script>

<!-- Main Theme Script -->
<script src="assets/js/theme.min.js"></script>

<!-- Filtro de tarjetas -->
<?php if (isset($_GET['p']) && $_GET['p'] == "iptv") {
    // No mostramos
} else {
?>
<script src="assets/js/filter.js"></script>
<?php } ?>
</body>

</html>