<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Knowledge Base</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom CSS - Make sure this comes after Bootstrap to override -->
    <link href="<?= base_url('custom.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= site_url() ?>">Knowledge Base</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('/') ?>">Home</a>
                        </li>
                        <?php $authService = service('auth'); ?>
                        <?php if ($authService->loggedIn()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('knowledge-base') ?>">Knowledge Base</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                    <div class="d-flex align-items-center">
                        <?php if ($authService->loggedIn()): ?>
                            <span class="welcome-text">Welcome, <?= $authService->user()->username ?></span>
                            <form action="<?= site_url('logout') ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                            </form>
                        <?php else: ?>
                            <a href="<?= site_url('login') ?>" class="btn btn-outline-light btn-sm me-2">Login</a>
                            <a href="<?= site_url('register') ?>" class="btn btn-outline-light btn-sm">Register</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <?= $this->renderSection('content') ?>

    <footer class="container text-center py-3">
        <p>&copy; <?= date('Y') ?> Knowledge Base Application | Designed with <i class="fas fa-heart text-danger"></i></p>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>