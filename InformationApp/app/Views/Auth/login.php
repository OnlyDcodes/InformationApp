<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <?php if (session('error')) : ?>
                        <div class="alert alert-danger"><?= session('error') ?></div>
                    <?php endif ?>
                    
                    <?php if (session('message')) : ?>
                        <div class="alert alert-success"><?= session('message') ?></div>
                    <?php endif ?>
                    
                    <form action="<?= url_to('login') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label" style="color: white !important;">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
                            <?php if (session('errors.email')) : ?>
                                <div class="text-danger"><?= session('errors.email') ?></div>
                            <?php endif ?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label" style="color: white !important;">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <?php if (session('errors.password')) : ?>
                                <div class="text-danger"><?= session('errors.password') ?></div>
                            <?php endif ?>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                    
                    <div class="mt-3">
                        <p style="color: white !important;">Don't have an account? <a href="<?= url_to('register') ?>" style="color: #0dcaf0 !important;">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
