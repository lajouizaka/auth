<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Login</h3>
                    </div>

                    <div class="card-body">

                        <div class="mb-2">
                            <button class="btn btn-dark" id="rand">Random</button>
                        </div>

                        <form id="loginForm" action="/admin/login" method="POST">

                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" type="email" name="email"
                                    placeholder="name@example.com" />
                                <label for="inputEmail" class="text-muted">Email address</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputPassword" type="password" name="password"
                                    placeholder="Password" />
                                <label for="inputPassword" class="text-muted">Password</label>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <button type="submit" class="btn btn-primary w-100">
                                    Login
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>