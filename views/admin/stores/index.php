<div class="container mt-2">

    <h1>All Stores</h1>

    <button class="random-store btn btn-sm btn-dark mb-2">Random data</button>

    <div class="border p-3">

        <form id="storeForm" action="/admin/stores/post.php" method="POST" class="row align-items-center">

            <div class="col-9">

                <input type="text" name="name" placeholder="Name" class="form-control">

            </div>

            <div class="col-3">

                <button type="submit"
                    class="btn btn-dark w-100 submit-store-btn"><?php e(SAVE_BTN) ?></button>

            </div>

            <div class="add-store-msg form-text mt-3" style="display:none;"></div>

        </form>
    </div>

    <div class="stores-listing row mt-2">

        <?php foreach($stores as $store):?>

        <div class="col-12">

            <div class="category border rounded p-3 mb-2 d-flex align-items-center">

                <div style="flex: 1 1 auto;">

                    <h4>
                        <?php e($store["name"]);?>
                    </h4>

                </div>

                <div>
                    <a
                        href="/admin/products/index.php?store=<?php e($store["id"]) ?>">
                        <?php e($store["product_count"]);?>
                    </a>
                </div>
            </div>

        </div>

        <?php endforeach;?>

    </div>
</div>