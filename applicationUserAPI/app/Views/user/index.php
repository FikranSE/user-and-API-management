<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<table class="table">
  <?php if (session()->get('role') === 'admin') : ?>
  <a class="btn btn-primary mb-3" href="<?= site_url('admin/createUser'); ?>">Add User</a>
  <?php endif; ?>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">Created</th>
      <?php if (session()->get('role') === 'admin') : ?>
      <th scope="col">Action</th>
      <?php endif; ?>
    </tr>
  </thead>
  <tbody>
    <?php $number = 1; ?>
    <?php foreach ($users as $user) : ?>
    <tr>
      <td><?= $number++; ?></td>
      <td><?= $user['username']; ?></td>
      <td><?= $user['email']; ?></td>
      <td>
        <span
          class="badge rounded-pill my-auto <?= ($user['role'] === 'admin') ? 'text-bg-success' : 'text-bg-warning'; ?>">
          <?= $user['role']; ?>
        </span>

      </td>
      <td><?= date('d F Y', strtotime($user['created_at'])); ?></td>
      <?php if (session()->get('role') === 'admin') : ?>
      <td>
        <a class="btn btn-warning" href="<?= site_url('admin/editUser/' . $user['id']); ?>">
          <i class="bi bi-pencil-square"></i></a>
        <a class="btn btn-danger" href="<?= site_url('admin/delete/' . $user['id']); ?>"
          onclick="return confirm('Are you sure you want to delete this user?')"><i class="bi bi-trash3"></i></a>
      </td>
      <?php endif; ?>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?= $this->endSection(); ?>