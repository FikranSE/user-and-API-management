<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>title</title>
</head>
<link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <div id="body-pd">
    <header class="header" id="header">
      <div class="header_toggle">
        <i class="bi bi-list" id="header-toggle"></i>
      </div>
      <div class="d-flex align-items-center gap-2">
        <?php if (session()->get('role') === 'admin') : ?>
        <span class="fw-medium">admin</span>
        <?php else : ?>
        <span class="fw-medium">user</span>
        <?php endif; ?>
        <div class="header_img">
          <img src="https://i.imgur.com/hczKIze.jpg" alt="">
        </div>
      </div>

    </header>
    <div class="l-navbar" id="nav-bar">
      <nav class="nav">
        <div>
          <a href="<?= site_url('/'); ?>" class="nav_logo">
            <i class="bi bi-stack"></i>
            <span class="nav_logo-name">userAPI</span>
          </a>
          <div class="nav_list">
            <a href="<?= site_url('/'); ?>"
              class="nav_link <?= (current_url(true)->getSegment(1) == '') ? 'active' : ''; ?>">
              <i class="bi bi-person-fill"></i>
              <span class="nav_name">Users</span>
            </a>
            <?php if (session()->get('role') === 'admin') : ?>
            <a href="<?= site_url('admin/master'); ?>"
              class="nav_link <?= (current_url(true)->getSegment(1) == 'master') ? 'active' : ''; ?>">
              <i class="bi bi-person-badge-fill"></i>
              <span class="nav_name">Master</span>
            </a>
            <?php endif; ?>
            <a href="#" class="nav_link <?= (current_url(true)->getSegment(1) == 'bookmark') ? 'active' : ''; ?>">
              <i class="bi bi-bookmark"></i>
              <span class="nav_name">Bookmark</span>
            </a>
            <a href="#" class="nav_link <?= (current_url(true)->getSegment(1) == 'files') ? 'active' : ''; ?>">
              <i class="bi bi-files"></i>
              <span class="nav_name">Files</span>
            </a>
          </div>
        </div>
        <a href="<?= site_url('auth/logout'); ?>" class="nav_link">
          <i class="bi bi-box-arrow-right"></i>
          <span class="nav_name">SignOut</span>
        </a>
      </nav>

    </div>
    <!--Container Main start-->
    <div class="height-100 container">
      <?= $this->renderSection('content'); ?>
    </div>
    <!--Container Main end-->
  </div>
</body>
<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<!-- end -->
<script>
document.addEventListener("DOMContentLoaded", function(event) {

  const showNavbar = (toggleId, navId, bodyId, headerId) => {
    const toggle = document.getElementById(toggleId),
      nav = document.getElementById(navId),
      bodypd = document.getElementById(bodyId),
      headerpd = document.getElementById(headerId)

    if (toggle && nav && bodypd && headerpd) {
      toggle.addEventListener('click', () => {
        nav.classList.toggle('show')
        toggle.classList.toggle('bx-x')
        bodypd.classList.toggle('body-pd')
        headerpd.classList.toggle('body-pd')
      })
    }
  }

  showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

  /*===== LINK ACTIVE =====*/
  const linkColor = document.querySelectorAll('.nav_link')

  function colorLink(event) {

    if (linkColor) {
      linkColor.forEach(l => l.classList.remove('active'));
      this.classList.add('active');
    }
  }
  linkColor.forEach(l => l.addEventListener('click', colorLink))
});
</script>

</html>