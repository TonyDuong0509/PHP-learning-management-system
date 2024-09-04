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
            <li class="breadcrumb-item active" aria-current="page">All Roles in Permission</li>
          </ol>
        </nav>
      </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>Id</th>
                <th>Roles Name </th>
                <th>Permission </th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($roles)): ?>
                <?php foreach ($roles as $key => $role): ?>
                  <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $role->getName(); ?></td>
                    <td>
                      <?php if (!empty($role->getPermissions())): ?>
                        <?php foreach ($role->getPermissions() as $permission): ?>
                          <span class="badge bg-danger"><?php echo $permission['name']; ?></span>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </td>
                    <td>
                      <a href="<?php echo $router->generate('admin.edit.roles', ['id' => $role->getId()]); ?>" class="btn btn-info px-5">Add & Edit</a>
                      <a onclick="return confirmDelete()" href="<?php echo $router->generate('admin.roles.delete', ['id' => $role->getId()]); ?>" class="btn btn-danger px-5" id="delete">Delete</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
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

</body>

</html>