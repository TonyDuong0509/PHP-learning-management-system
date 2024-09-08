<?php require ABSPATH . 'resources/admin/layout/sidebar.php'; ?>

<?php require ABSPATH . 'resources/admin/layout/header.php'; ?>

<style>
  .form-check-label {
    text-transform: capitalize;
  }
</style>

<div class="page-wrapper">
  <div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Add Role In Permission</li>
          </ol>
        </nav>
      </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
      <div class="card-body p-4">
        <form action="<?php echo $router->generate('role.permission.store'); ?>" method="POST" class="row g-3" enctype="multipart/form-data">
          <div class="form-group col-md-6">
            <label for="input1" class="form-label"> Roles Name</label>
            <select name="role_id" class="form-select mb-3" aria-label="Default select example">
              <option selected="" disabled>Open Roles</option>
              <?php if (!empty($roles)): ?>
                <?php foreach ($roles as $role): ?>
                  <option value="<?php echo $role->getId(); ?>"><?php echo $role->getName(); ?></option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckMain">
            <label class="form-check-label" for="flexCheckMain">Permission All </label>
          </div>
          <hr>
          <?php if (!empty($permissions_groups)): ?>
            <?php foreach ($permissions_groups as $group): ?>
              <div class="row">
                <div class="col-3">
                  <div class="form-check">
                    <label class="form-check-label" for="flexCheckDefault<?php echo htmlspecialchars($group['guard_name'], ENT_QUOTES, 'UTF-8'); ?>">
                      <?php echo htmlspecialchars($group['guard_name'], ENT_QUOTES, 'UTF-8'); ?>
                    </label>
                  </div>
                </div>
                <div class="col-9">
                  <?php if (!empty($permissions_groups_byName[$group['guard_name']])): ?>
                    <?php foreach ($permissions_groups_byName[$group['guard_name']] as $permission): ?>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="permission[]" value="<?php echo $permission->getId(); ?>" id="checkDefault<?php echo $permission->getId(); ?>">
                        <label class="form-check-label" for="checkDefault<?php echo $permission->getId(); ?>">
                          <?php echo htmlspecialchars($permission->getName(), ENT_QUOTES, 'UTF-8'); ?>
                        </label>
                      </div>
                    <?php endforeach; ?>
                  <?php endif; ?>
                  <br><br>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
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

<script>
  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>
<script>
  $(document).ready(function() {
    var table = $('#example2').DataTable({
      lengthChange: false,
      buttons: ['copy', 'excel', 'pdf', 'print']
    });

    table.buttons().container()
      .appendTo('#example2_wrapper .col-md-6:eq(0)');
  });
</script>
<script src="public/js/app.js"></script>

<script>
  $('#flexCheckMain').click(function() {
    if ($(this).is(':checked')) {
      $('input[type=checkbox]').prop('checked', true);
    } else {
      $('input[type=checkbox]').prop('checked', false);
    }
  });
</script>

</body>

</html>