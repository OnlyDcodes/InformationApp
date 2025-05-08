<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Welcome, <?= $user->username ?>!</div>
                <div class="card-body">
                    <?php if (session('message')) : ?>
                        <div class="alert alert-success"><?= session('message') ?></div>
                    <?php endif ?>
                    
                    <p style="color: white !important;">You are logged in successfully.</p>
                    <p style="color: white !important;">Access your centralized knowledge repository. Add, edit, or browse through your information entries.</p>
                    
                    <div class="d-grid gap-2 mt-4">
                        <a href="<?= site_url('knowledge-base') ?>" class="btn btn-primary">Go to Knowledge Base</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>