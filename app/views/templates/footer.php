<footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <h4 class="fw-bold mb-0 text-danger">Kuliner<span class="text-white">Ku</span></h4>
                    <p class="text-muted small">Solusi perut lapar dengan rasa bintang lima.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0 text-muted small">&copy; <?= date('Y'); ?> All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Memberikan efek shadow saat kartu menu di-hover
            $('.card').hover(
                function() { $(this).addClass('shadow').css('cursor', 'pointer'); },
                function() { $(this).removeClass('shadow'); }
            );
        });
    </script>

</body>
</html>