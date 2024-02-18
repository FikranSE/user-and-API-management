<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<h4 class="fs-6 font-monospace">Admin Users</h4>
<table class="table">
  <thead>
    <tr>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">Created</th>
      <th scope="col">Action</th>
    </tr>
    </tr>
  </thead>
  <tbody>
    <?php $number = 1; ?>
    <?php foreach ($adminUsers as $adminUser) : ?>
    <tr>
      <td><?= $number++; ?></td>
      <td><?= $adminUser['username']; ?></td>
      <td><?= $adminUser['email']; ?></td>
      <td>
        <span class="badge rounded-pill text-bg-success my-auto">
          <?= $adminUser['role']; ?>
        </span>
      </td>
      <td><?= date('d F Y', strtotime($adminUser['created_at'])); ?></td>
      <td>
        <a class="btn btn-warning" href="<?= site_url('editUser/' . $adminUser['id']); ?>">
          <i class="bi bi-pencil-square"></i></a>
        <a class="btn btn-danger" href="<?= site_url('delete/' . $adminUser['id']); ?>"
          onclick="return confirm('Are you sure you want to delete this user?')"><i class="bi bi-trash3"></i></a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<h4 class="mt-5 fs-6 font-monospace">User Users</h4>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">Created</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $number = 1; ?>
    <?php foreach ($userUsers as $userUser) : ?>
    <tr>
      <td><?= $number++; ?></td>
      <td><?= $userUser['username']; ?></td>
      <td><?= $userUser['email']; ?></td>
      <td>
        <span class="badge rounded-pill text-bg-warning my-auto">
          <?= $userUser['role']; ?>
        </span>
      </td>
      <td><?= date('d F Y', strtotime($userUser['created_at'])); ?></td>
      <td>
        <a class="btn btn-warning" href="<?= site_url('admin/editUser/' . $userUser['id']); ?>">
          <i class="bi bi-pencil-square"></i></a>
        <a class="btn btn-danger" href="<?= site_url('admin/deleteMaster/' . $userUser['id']); ?>"
          onclick="return confirm('Are you sure you want to delete this user?')"><i class="bi bi-trash3"></i></a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>



<?= $this->endSection(); ?>