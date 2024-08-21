function confirmDelete() {
  return confirm("Are you sure ? Click OK to delete.");
}

function showAlert(type, message) {
  var alertHtml = `
    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
`;
  $("#alert-container").html(alertHtml);

  setTimeout(function () {
    $(".alert").alert("close");
  }, 3000);
}

$(document).ready(function () {
  $(".status-toggle").on("change", function () {
    var courseId = $(this).data("course-id");
    var isChecked = $(this).is(":checked");

    $.ajax({
      type: "POST",
      url: "/admin/update/course-status",
      data: JSON.stringify({
        course_id: courseId,
        is_checked: isChecked ? 1 : 0,
      }),
      contentType: "application/json",
      dataType: "json",
      success: function (response) {
        if (response.success) {
          showAlert("success", response.success);
        } else if (response.error) {
          showAlert("danger", response.error);
        }
      },
      error: function (error) {
        showAlert("danger", "An error occurred while processing your request.");
      },
    });
  });
});
