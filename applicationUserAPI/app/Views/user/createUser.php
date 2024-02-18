<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<form class="form" action="<?= site_url('store'); ?>" method="post">
  <p class="form-title">Create User</p>

  <div class="row mb-3">
    <div class="col-6 input-container">
      <input placeholder="Enter username" type="text" name="username" class="form-control">
      <?php if (isset($validation) && $validation->getError('username')) : ?>
      <div class="invalid-feedback">
        <?= $validation->getError('username'); ?>
      </div>
      <?php endif; ?>
    </div>
    <div class="col-6 input-container">
      <input placeholder="Enter password" type="password" name="password" class="form-control">
      <?php if (isset($validation) && $validation->getError('password')) : ?>
      <div class="invalid-feedback">
        <?= $validation->getError('password'); ?>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="input-container mb-3">
    <input placeholder="Enter email" type="email" name="email" class="form-control">
    <?php if (isset($validation) && $validation->getError('email')) : ?>
    <div class="invalid-feedback">
      <?= $validation->getError('email'); ?>
    </div>
    <?php endif; ?>
  </div>

  <div class="input-container mb-3">
    <select name="role" class="form-select">
      <option value="" disabled selected>Select a role</option>
      <option value="user">User</option>
      <option value="admin">Admin</option>
    </select>
    <?php if (isset($validation) && $validation->getError('role')) : ?>
    <div class="invalid-feedback">
      <?= $validation->getError('role'); ?>
    </div>
    <?php endif; ?>
  </div>

  <div class="w-25 d-flex align-items-center gap-1 mt-2">
    <button class="submit btn btn-primary" type="submit">
      Create
    </button>
    <a class="submit btn btn-danger" href="<?= site_url('/'); ?>">Cancel</a>
  </div>
</form>
<?= $this->endSection(); ?>