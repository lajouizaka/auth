<?php

/**
 *  @author Zakriae Lajoui
 *  @package ecommerce management
 */

defined('ABSPATH') || exit; ?>

<footer>
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
</footer>

<script src="<?php e(JS) ?>bootstrap.bundle.min.js"></script>
<script
    src="<?php e(JS) ?>app.js?v=<?php e(rand(1, 1000)) ?>">
</script>

</body>

</html>