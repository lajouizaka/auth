<?php
// global $user;
// global $productsObj ;
// global $request ;
?>

<div class="container mt-3">


    <?php if($user->can_insert_products()):?>

    <a class="btn btn-md btn-dark" href="/admin/products/create">
        <?php e(ADD_PRODUCT) ?>
    </a>

    <?php endif?>

    <?php if ($productsObj->pagination) : ?>

    <div class="pagination d-flex align-items-center justify-content-center mt-3">

        <!-- Link to Previous -->
        <div class="me-3">
            <?php if ($productsObj->pagination->previous) : ?>

            <a href="/admin/products?page=<?php e($productsObj->pagination->previous) ?>"
                class="btn btn-sm btn-dark">
                <?php e(PREV_BTN) ?>
            </a>

            <?php else : ?>

            <a class="btn btn-sm btn-dark disabled" disabled>
                <?php e(PREV_BTN) ?>
            </a>

            <?php endif ?>
        </div>

        <!-- Pages -->
        <?php if ($productsObj->pagination) : ?>

        <div class="links">
            <?php foreach ($productsObj->pagination->links as $link) : ?>

            <a href="/admin/products?page=<?php e($link) ?>"
                class="mx-1 <?php e($link === (int) $page ? "link-primary" : "link-secondary") ?>">
                <?php e($link) ?>
            </a>

            <?php endforeach; ?>

            <!-- TODO: Refactoring -->
            <?php if (!in_array($productsObj->pagination->last, $productsObj->pagination->links) or (array_pop($productsObj->pagination->links) - 1 === $productsObj->pagination->last)) : ?>
            &nbsp;...&nbsp;

            <a href="<?php e($productsObj->pagination->last) ?>"
                class="mx-1 link-secondary">
                <?php e($productsObj->pagination->last) ?>
            </a>

            <?php endif ?>

        </div>

        <?php endif ?>

        <!-- Link to Next -->
        <div class="ms-3">
            <?php if ($productsObj->pagination->next) : ?>

            <a href="/admin/products?page=<?php e($productsObj->pagination->next) ?>"
                class="btn btn-sm btn-dark">
                <?php e(NEXT_BTN) ?>
            </a>

            <?php else : ?>

            <a class="btn btn-sm btn-dark disabled" disabled>
                <?php e(NEXT_BTN) ?>
            </a>

            <?php endif ?>
        </div>

    </div>

    <?php endif ?>

    <div class="row mt-3">

        <?php foreach ($productsObj->data as $product) : ?>

        <div class="col-12 col-md-6">
            <div class="card mb-3">
                <div class="card-body">

                    <h4 class="card-title text-dark">
                        <?php e($product["title"]) ?>
                    </h4>
                    <span><b><?php e(COST) ?></b>:
                        <?php e($product["cost"]) ?>
                        &
                        <b><?php e(PRICE) ?></b>:
                        <?php e($product["price"]) ?></span>
                    <br />
                    <span><?php e(READY_TO_SELL) ?>:
                        <?php e($product["ready_to_sell"] ? "yes" : "no") ?></span>
                    <br />
                    <span><?php e(ADDED_IN) ?>:
                        <?php echo($product["created_at"]) ?></span>
                    <div class="div mt-2">
                        <a href="/products/single.php?id=<?php e($product["id"]) ?>"
                            class="btn btn-sm btn-dark">
                            <?php e(DETAILS_BTN) ?>
                        </a>
                        &nbsp;

                        <?php if($user->can_delete_products()):?>

                        <form class="delete-product-form d-inline-block" action="/admin/products" method="post">

                            <input type="hidden" name="method" value="DELETE">

                            <input type="hidden" name="id"
                                value="<?php e($product["id"]) ?>">

                            <input type="submit"
                                value="<?php e(DELETE_BTN)  ?>"
                                class="btn btn-sm text-danger">
                        </form>

                        <?php endif;?>

                        &nbsp;
                    </div>
                </div>
            </div>
        </div>

        <?php endforeach ?>

    </div>
</div>