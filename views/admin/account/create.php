<main>

    <div class="container">

        <form id="addUserForm" action="/admin/account" method="POST">

            <div class="row justify-content-center">

                <div class="col-md-5">

                    <div class="card rounded-lg mt-5">

                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Sign Up</h3>
                        </div>

                        <div class="card-body">
                            <div class="mb-2">
                                <button class="btn btn-dark" id="rand">Random</button>
                            </div>



                            <div class="form-floating mb-3">
                                <input class="form-control" type="email" name="email" placeholder="name@example.com" />
                                <label for="inputEmail" class="text-muted">Email address</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control" type="password" name="password" placeholder="Password" />
                                <label for="inputPassword" class="text-muted">Password</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control" type="password" name="c_password" placeholder="Password" />
                                <label for="inputPassword" class="text-muted">Password</label>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <button type="submit" class="btn btn-primary w-100">
                                    Add User
                                </button>
                            </div>



                        </div>

                    </div>
                </div>

                <div class="col-md-5">

                    <div class="card rounded-lg mt-5">

                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Permissions</h3>
                        </div>

                        <div class="card-body">

                            <?php foreach($permissions as $permission):?>

                            <div>

                                <input class="form-checkbox" type="checkbox" name="permissions[]"
                                    value="<?php e($permission["id"])?>">&nbsp;
                                <?php e(text($permission["name"]))?>

                            </div>

                            <?php endforeach?>

                        </div>

                    </div>
                </div>

            </div>

        </form>

    </div>

</main>