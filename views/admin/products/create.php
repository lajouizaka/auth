<div class="container">


    <form id="addProductForm" class='mx-auto my-3 form' enctype="multipart/form-data">

        <div class="mb-1 row">
            <div class="mb-2">
                <button type="button" class="btn btn-sm btn-dark random" data-id="1">Product 1</button>
                <button type="button" class="btn btn-sm btn-dark random" data-id="2">Product 2</button>
                <button type="button" class="btn btn-sm btn-dark random" data-id="3">Product 3</button>
                <button type="button" class="btn btn-sm btn-dark random" data-id="4">Product 4</button>
            </div>

            <div class="col-md-8 mt-2">
                <div class="row ps-1">

                    <div class='form-group mb-2 col-sm-6 pe-sm-1'>
                        <input type='text' name='title' placeholder='Title' class='form-control' />
                    </div>
                    <div class='form-group mb-2 col-sm-6 ps-sm-1'>
                        <input type='text' name='description' placeholder='Description' class='form-control' />
                    </div>
                    <div class='form-group mb-2 col-sm-6 pe-sm-1'>
                        <input type='text' name='price' placeholder='Price' class='form-control' />
                    </div>
                    <div class='form-group mb-2 col-sm-6 ps-sm-1'>
                        <input type='text' name='cost' placeholder='Cost' class='form-control' />
                    </div>
                    <div class='form-group mb-2 col-sm-6 pe-sm-1'>
                        <input type='text' name='stock' placeholder='Stock' class='form-control' />
                    </div>
                    <div class='form-group mb-2'>
                        <select name='store' class='form-select' id='store'>
                            <?php foreach ($stores as $store) : ?>
                            <option
                                value='<?php e($store["id"]) ?>'>
                                <?php e($store["name"]) ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class='form-group mb-2'>
                        <select name='category' class='form-select' id='category'>
                            <?php foreach ($categories as $category) : ?>
                            <option
                                value='<?php e($category["id"]) ?>'>
                                <?php e($category["name"]) ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <div class="error-box alert alert-danger" style="display: none;">

        </div>
        <div class="success-box alert alert-success" style="display: none;">

        </div>

        <!-- <a href="" download="">Download</a> -->
        <div class='form-group my-3 ms-1'>
            <input type='checkbox' name='ready_to_sell' />
            &nbsp;<?php e(READY_TO_SELL) ?>
        </div>
        <button class='btn btn-dark w-100 mt-1' type='submit'>
            <?php e(ADD_BTN) ?>
        </button>
    </form>
</div>