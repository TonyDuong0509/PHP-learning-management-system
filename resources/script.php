<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (isset($_SESSION['notification'])): ?>
            var type = "<?php echo $_SESSION['notification']['alert-type']; ?>";
            var message = "<?php echo $_SESSION['notification']['message']; ?>";
            switch (type) {
                case 'info':
                    toastr.info(message);
                    break;
                case 'success':
                    toastr.success(message);
                    break;
                case 'warning':
                    toastr.warning(message);
                    break;
                case 'error':
                    toastr.error(message);
                    break;
            }
            <?php unset($_SESSION['notification']);
            ?>
        <?php endif; ?>
    });
</script>