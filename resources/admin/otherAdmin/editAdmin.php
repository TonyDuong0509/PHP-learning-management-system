<?php require ABSPATH . 'resources/admin/layout/sidebar.php'; ?>

<?php require ABSPATH . 'resources/admin/layout/header.php'; ?>

<div class="page-wrapper">
  <div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit Admin</li>
          </ol>
        </nav>
      </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
      <div class="card-body p-4">
        <h5 class="mb-4">Edit Admin</h5>
        <form action="<?php echo $router->generate('update.admin'); ?>" method="POST" class="row g-3" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $admin->getId(); ?>">
          <div class="form-group col-md-6">
            <label for="input1" class="form-label">Admin User Name</label>
            <input type="text" name="username" class="form-control" id="input1" value="<?php echo $admin->getUsername(); ?>">
          </div>

          <div class="form-group col-md-6">
            <label for="input1" class="form-label">Admin Name</label>
            <input type="text" name="name" class="form-control" id="input1" value="<?php echo $admin->getName(); ?>">
          </div>

          <div class="form-group col-md-6">
            <label for="input1" class="form-label">Admin Email</label>
            <input type="email" name="email" class="form-control" disabled id="input1" value="<?php echo $admin->getEmail(); ?>">
          </div>

          <div class="form-group col-md-6">
            <label for="input1" class="form-label"> Role Name</label>
            <select name="role" class="form-select mb-3" aria-label="Default select example">
              <option selected="" disabled>Open this select menu</option>
              <?php if (!empty($roles)): ?>
                <?php foreach ($roles as $role): ?>
                  <option <?php echo ($role->getId() == (int) $admin->getRole()) ? 'selected' : ''; ?> value="<?php echo $role->getId(); ?>"><?php echo $role->getName(); ?></option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>

          <div class="col-md-12">
            <div class="d-md-flex d-grid align-items-center gap-3">
              <button type="submit" class="btn btn-primary px-4">Save Changes</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="overlay toggle-icon"></div>
<a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
<?php require ABSPATH . 'resources/admin/layout/footer.php'; ?>
</div>

<?php require ABSPATH . 'resources/admin/layout/footerScript.php'; ?>

<script src="public/js/app.js"></script>

</body>

</html>