<div class="container mt-2">

    <h1>All Categories</h1>

    <button class="random-category btn btn-sm btn-dark mb-2">Random data</button>

    <div class="border p-3">

        <form id="addCategoryForm" class="row align-items-center">

            <div class="col-9">

                <input type="text" name="name" placeholder="Name" class="form-control">

            </div>

            <div class="col-3">

                <button type="submit"
                    class="btn btn-dark w-100 submit-category-btn"><?php e(SAVE_BTN) ?></button>

            </div>

            <div class="add-category-msg form-text mt-3" style="display:none;"></div>

        </form>
    </div>

    <div class="categories-listing row mt-2">

        <?php foreach($categories as $category):?>

        <div class="col-12">

            <div class="category border rounded p-3 mb-2 d-flex align-items-center">

                <div style="flex: 1 1 auto;">

                    <h4>
                        <?php  e($category["name"]);?>
                    </h4>

                </div>

                <div>
                    <a
                        href="/admin/products/index.php?category=<?php e($category["id"]) ?>">
                        <?php e($category["product_count"]);?>
                    </a>
                </div>
            </div>

        </div>

        <?php endforeach;?>

    </div>

</div>