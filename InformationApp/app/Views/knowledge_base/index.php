<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h1>Knowledge Base</h1>
    
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

    <div class="mb-3">
        <a href="<?= site_url('knowledge-base/new') ?>" class="btn btn-primary">Add New Entry</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Project Code</th>
                <th>Solution</th>
                <th>Status</th>
                <th>Rating</th>
                <th>Created</th>
                <th>Created By</th>
                <th>Modified</th>
                <th>Modified By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($knowledge_base as $entry): ?>
                <tr>
                    <td><?= esc($entry['title']) ?></td>
                    <td><?= esc($entry['project_code']) ?></td>
                    <td><?= esc(substr($entry['solution'], 0, 50)) ?>...</td>
                    <td><?= esc($entry['status']) ?></td>
                    <td>
                        <?php for($i = 0; $i < $entry['rating']; $i++): ?>
                            <i class="fas fa-star text-warning"></i>
                        <?php endfor; ?>
                        <?php for($i = $entry['rating']; $i < 5; $i++): ?>
                            <i class="far fa-star"></i>
                        <?php endfor; ?>
                    </td>
                    <td><?= $entry['created_at'] ?></td>
                    <td><?= esc($entry['created_by']) ?></td>
                    <td><?= $entry['modified_at'] ?></td>
                    <td><?= esc($entry['modified_by']) ?></td>
                    <td>
                        <a href="<?= site_url('knowledge-base/'.$entry['id']) ?>" class="btn btn-sm btn-info">View</a>
                        <a href="<?= site_url('knowledge-base/'.$entry['id'].'/edit') ?>" class="btn btn-sm btn-warning">Edit</a>
                        <form action="<?= site_url('knowledge-base/'.$entry['id']) ?>" method="post" class="d-inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this entry?')">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($knowledge_base)): ?>
                <tr>
                    <td colspan="10" class="text-center">No entries found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>