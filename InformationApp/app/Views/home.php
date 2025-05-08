<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-4">
                <h1 style="color: white !important; font-weight: 600;">Welcome, <?= $user->username ?>!</h1>
                <p style="color: #adb5bd !important;">Your personal knowledge management system</p>
            </div>
            
            <?php if (session('message')) : ?>
                <div class="alert alert-success"><?= session('message') ?></div>
            <?php endif ?>
            
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center">
                    <i class="fas fa-database me-2"></i>
                    <h4 class="m-0">Knowledge Base</h4>
                </div>
                <div class="card-body">
                    <p style="color: white !important;">Access your centralized knowledge repository. Add, edit, or browse through your information entries.</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <div class="d-grid">
                                <a href="<?= site_url('knowledge-base') ?>" class="btn btn-primary">
                                    <i class="fas fa-list me-2"></i> View All Entries
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-grid">
                                <a href="<?= site_url('knowledge-base?open_modal=1') ?>" class="btn btn-success">
                                    <i class="fas fa-plus-circle me-2"></i> Add New Entry
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <i class="fas fa-user-circle me-2"></i>
                    <h4 class="m-0">Account Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <p class="p-2 bg-dark rounded" style="color: white !important;"><?= $user->username ?></p>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <p class="p-2 bg-dark rounded" style="color: white !important;"><?= $user->email ?? $user->getEmailIdentity()->secret ?? 'Not available' ?></p>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <form action="<?= site_url('logout') ?>" method="post" class="w-100">
                                <?= csrf_field() ?>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <p style="color: #adb5bd !important; font-size: 0.9rem;">Last login: <?= date('Y-m-d H:i:s') ?></p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>