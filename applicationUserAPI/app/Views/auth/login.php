<!-- login.php -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<body>

  <div class="container d-flex align-items-center justify-content-center">
    <form class="form w-25" action="<?= base_url('auth/loginProses'); ?>" method="post">
      <p class="form-title">Sign in to your account</p>

      <?php if (isset($validation) && $validation->getErrors()): ?>
      <div class="alert alert-danger" role="alert">
        <?= $validation->listErrors(); ?>
      </div>
      <?php endif; ?>

      <div class="input-container">
        <input placeholder="Enter username" type="text" name="username"
          class="form-control <?= isset($validation) && $validation->hasError('username') ? 'is-invalid' : ''; ?>">
        <?php if (isset($validation) && $validation->hasError('username')): ?>
        <div class="invalid-feedback">
          <?= $validation->getError('username'); ?>
        </div>
        <?php endif; ?>
      </div>
      <div class="input-container">
        <input placeholder="Enter password" type="password" name="password"
          class="form-control <?= isset($validation) && $validation->hasError('password') ? 'is-invalid' : ''; ?>">
        <?php if (isset($validation) && $validation->hasError('password')): ?>
        <div class="invalid-feedback">
          <?= $validation->getError('password'); ?>
        </div>
        <?php endif; ?>
      </div>
      <button class="submit" type="submit">
        Sign in
      </button>
    </form>

  </div>

</body>

</html>