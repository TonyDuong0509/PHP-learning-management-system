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
            <li class="breadcrumb-item active" aria-current="page">All Permission</li>
          </ol>
        </nav>
      </div>
      <div class="ms-auto">
        <div class="btn-group">
          <a href="<?php echo $router->generate('add.permission'); ?>" class="btn btn-primary px-5">Add Permission </a>
        </div>
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
                <th>Permission Name </th>
                <th>Group Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($permissions)): ?>
                <?php foreach ($permissions as $key => $permission): ?>
                  <tr>
                    <td>
                      <?php echo $key++; ?>
                    </td>
                    <td>
                      <?php echo $permission->getName(); ?>
                    </td>
                    <td>
                      <?php echo $permission->getGuardName(); ?>
                    </td>
                    <td>
                      <a href="<?php echo $router->generate('edit.permission', ['id' => $permission->getId()]); ?>" class="btn btn-info px-5">Edit </a>
                      <a onclick="return confirmDelete()" href="<?php echo $router->generate('delete.permission', ['id' => $permission->getId()]); ?>" class="btn btn-danger px-5" id="delete">Delete </a>
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