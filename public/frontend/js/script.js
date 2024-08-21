function addToWishList(course_id) {
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "/add-to-wishlist/" + course_id,
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

function wishList() {
  $.ajax({
    type: "GET",
    url: "/get-wishlist-course",
    dataType: "json",
    success: function (response) {
      $("#wishQty").text(response.wishQty);

      var rows = "";
      $.each(response.wishlist, function (key, value) {
        console.log(value);
        rows += `
                        <div class="col-lg-4 responsive-column-half">
                        <div class="card card-item">
                            <div class="card-image">
                                <a href="/course-details/${value.course_id}/${
          value.slug
        }.html" class="d-block">
                                    <img style="width:100%; height: 250px; object-fit:cover;" class="card-img-top" src="${
                                      value.image
                                    }" alt="Card image cap">
                                </a>
                            </div>
                            <style>
                                h5 a {
                                    display: block;
                                    display: -webkit-box;
                                    max-width: 100%;
                                    height: 2.4em;
                                    margin: 0 auto;
                                    font-size: 16px;
                                    line-height: 1.2em;
                                    -webkit-line-clamp: 2;
                                    -webkit-box-orient: vertical;
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    word-wrap: break-word;
                                }
                            </style>
                            <div class="card-body">
                                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">${
                                  value.label
                                }</h6>
                                <h5 class="card-title"><a href="/course-details/${
                                  value.course_id
                                }/${value.slug}.html">${value.name}</a></h5>

                                <div class="d-flex justify-content-between align-items-center">
                            ${
                              value.discount_price == 0
                                ? `<p class="card-price text-black font-weight-bold">$${value.selling_price}</p>`
                                : `<p class="card-price text-black font-weight-bold">$${value.discount_price} <span class="before-price font-weight-medium">$${value.selling_price}</span></p>`
                            }
                                    <div class="icon-element icon-element-sm shadow-sm cursor-pointer" data-toggle="tooltip" data-placement="top" title="Remove from Wishlist" id="${
                                      value.wishlist_id
                                    }" onclick="removeWishList(this.id)"><i class="la la-heart"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
      });
      $("#wishlist").html(rows);
    },
  });
}
wishList();

function removeWishList(id) {
  $.ajax({
    type: "GET",
    url: "/remove-wishlist/" + id,
    dataType: "json",
    success: function (response) {
      wishList();

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
}

function addToCart(courseId, courseName, instructorId, slug) {
  $.ajax({
    type: "POST",
    url: "/cart/data/store/" + courseId,
    data: {
      name: courseName,
      slug: slug,
      instructorId: instructorId,
    },
    dataType: "json",
    success: function (response) {
      miniCart();
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
}

function miniCart() {
  $.ajax({
    type: "GET",
    url: "/course/mini/cart",
    dataType: "json",
    success: function (response) {
      $('span[id="cartSubTotal"]').text(response.cartTotal);
      $("#cartQty").text(response.cartQty);
      var miniCart = "";

      $.each(response.carts, function (key, value) {
        miniCart += `
                        <li class="media media-card">
                            <a href="shopping-cart.html" class="media-img">
                                <img src="/${value.options.image}" alt="Cart image">
                            </a>
                            <div class="media-body">
                                <h5><a href="/course-details/${value.course_id}/${value.options.slug}.html"> ${value.name}</a></h5>
                                 <span class="d-block fs-14">$${value.price}</span>
                                <a type="submit" id="${value.course_id}" style="color: red; font-size: 18px; font-weight: 500;" onclick="removeMiniCart(this.id)"><i class="la la-times"></i> </a>
                            </div>
                        </li>
                    `;
      });
      $("#miniCart").html(miniCart);
    },
  });
}

miniCart();

function removeMiniCart(id) {
  $.ajax({
    type: "GET",
    url: "/minicart/course/remove/" + id,
    dataType: "json",
    success: function (data) {
      miniCart();

      if (data.success) {
        showAlert("success", data.success);
      } else if (data.error) {
        showAlert("danger", data.error);
      }
    },
    error: function (error) {
      showAlert("danger", "An error occurred while processing your request.");
    },
  });
}

function myCart() {
  $.ajax({
    type: "GET",
    url: "/get-cart-course",
    dataType: "json",
    success: function (response) {
      $('span[id="cartSubTotal"]').text(response.cartTotal);

      var rows = "";
      $.each(response.carts, function (key, value) {
        rows += `
                    <tr>
                    <th scope="row">
                        <div class="media media-card">
                            <a href="course-details.html" class="media-img mr-0">
                                <img src="/${value.options.image}" alt="Cart image">
                            </a>
                        </div>
                    </th>
                    <td>
                        <a href="/course-details/${value.course_id}/${value.options.slug}.html" class="text-black font-weight-semi-bold">${value.name}</a>

                    </td>
                    <td>
                        <ul class="generic-list-item font-weight-semi-bold">
                            <li class="text-black lh-18">$${value.price}</li>

                        </ul>
                    </td>

                    <td>
                        <button type="button" class="icon-element icon-element-xs shadow-sm border-0" data-toggle="tooltip" data-placement="top" title="Remove" style="color: red;" id="${value.course_id}" onclick="cartRemove(this.id)">
                            <i class="la la-times"></i>
                        </button>
                    </td>
                </tr>
                `;
      });
      $("#cartPage").html(rows);
    },
  });
}
myCart();

function cartRemove(id) {
  $.ajax({
    type: "GET",
    url: "/cart-remove/" + id,
    dataType: "json",
    success: function (data) {
      miniCart();
      myCart();

      if (data.success) {
        showAlert("success", data.success);
      } else if (data.error) {
        showAlert("danger", data.error);
      }
    },
    error: function (error) {
      showAlert("danger", "An error occurred while processing your request.");
    },
  });
}
