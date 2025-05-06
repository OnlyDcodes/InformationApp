<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 style="color: white !important; margin-bottom: 0;">Knowledge Base Entries</h4>
                    <a href="<?= site_url('knowledge-base/new') ?>" class="btn btn-sm btn-light">
                        <i class="fas fa-plus"></i> Add New Entry
                    </a>
                </div>
                <div class="card-body">
                    <?php if(session()->getFlashdata('message')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('message') ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (empty($knowledge_base)): ?>
                        <div class="text-center py-5">
                            <p style="color: white !important;">No entries found. Click the button above to add your first entry.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover" style="color: white !important;">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Project Code</th>
                                        <th>Status</th>
                                        <th>Rating</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($knowledge_base as $entry): ?>
                                        <tr>
                                            <td><?= esc($entry['title']) ?></td>
                                            <td><?= esc($entry['project_code']) ?></td>
                                            <td>
                                                <?php if($entry['status'] == 'Active'): ?>
                                                    <span class="badge bg-success">Active</span>
                                                <?php elseif($entry['status'] == 'Pending'): ?>
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary"><?= esc($entry['status']) ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php for($i = 0; $i < $entry['rating']; $i++): ?>
                                                    <i class="fas fa-star text-warning"></i>
                                                <?php endfor; ?>
                                                <?php for($i = $entry['rating']; $i < 5; $i++): ?>
                                                    <i class="far fa-star" style="color: #6c757d;"></i>
                                                <?php endfor; ?>
                                            </td>
                                            <td class="text-end">
                                                <a href="<?= site_url('knowledge-base/'.$entry['id']) ?>" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="<?= site_url('knowledge-base/'.$entry['id'].'/edit') ?>" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="<?= site_url('knowledge-base/'.$entry['id']) ?>" method="post" class="d-inline">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this entry?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="text-center mt-3">
                <a href="<?= site_url('/') ?>" class="btn btn-outline-light">
                    <i class="fas fa-home"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>