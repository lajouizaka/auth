<?php

/**
 *  @author Zakriae Lajoui
 *  @package ecommerce management
 */

defined('ABSPATH') || exit; ?>

<!-- <footer>
    <div class="container">

        <div class="lang-bottom ms-auto d-none">
            <form class="my-2" style="width: 70px;" action="/" method="get">
                <select class="form-select" name="language" onchange="document.forms[0].submit()">
                    <?php foreach (["en", "fr"] as $lang) : ?>
<option value="<?php e($lang) ?>" <?php e($selected_language === $lang ? "selected" : "") ?>>
    <?php e($lang) ?>
</option>
<?php endforeach ?>
</select>
</form>
</div>

</div>
</footer> -->
<footer class="py-4 bg-light mt-auto position-fixed w-100" style="bottom: 0px; left: 0px">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website 2022</div>
            <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>

<script src="<?php e(JS) ?>bootstrap.bundle.min.js"></script>
<script
    src="<?php e(JS) ?>auth.js?v=<?php e(rand(1, 1000)) ?>">
</script>
</body>

</html>