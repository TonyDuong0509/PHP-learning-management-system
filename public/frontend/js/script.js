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
      console.error(error);
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
                                <a type="submit" id="${value.course_id}" style="color: red; font-size: 18px; font-weight: 500;" onclick="cartRemove(this.id)"><i class="la la-times"></i> </a>
                            </div>
                        </li>
                    `;
      });
      $("#miniCart").html(miniCart);
    },
  });
}

miniCart();

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
      couponCalculation();

      if (data.success) {
        showAlert("success", data.success);
      } else if (data.error) {
        showAlert("danger", data.error);
      }
    },
    error: function (error) {
      showAlert("danger", "An error occurred while processing your request.");
      console.error(error);
    },
  });
}

function applyCoupon() {
  var coupon_name = $("#coupon_name").val();

  $.ajax({
    type: "POST",
    url: "/coupon-apply",
    data: JSON.stringify({
      coupon_name: coupon_name,
    }),
    contentType: "application/json",
    dataType: "json",
    success: function (response) {
      couponCalculation();
      if (response.validity == true) {
        $("#couponField").hide();
      }
      if (response.success) {
        showAlert("success", response.success);
      } else if (response.error) {
        showAlert("danger", response.error);
      }
    },
    error: function (error) {
      showAlert("danger", "An error occurred while processing your request.");
      console.error(error);
    },
  });
}

function couponCalculation() {
  $.ajax({
    type: "GET",
    url: "/coupon-calculation",
    dataType: "json",
    success: function (data) {
      if (data.total) {
        $("#couponCalField").html(
          `
             <h3 class="fs-18 font-weight-bold pb-3">Cart Totals</h3>
                <div class="divider"><span></span></div>
                <ul class="generic-list-item pb-4">
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Subtotal: $</span>
                        <span>$${data.total}</span>
                    </li>
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Total: $</span>
                        <span>$${data.total}</span>
                    </li>
                </ul>
          `
        );
      } else {
        $("#couponCalField").html(
          `
            <h3 class="fs-18 font-weight-bold pb-3">Cart Totals</h3>
                <div class="divider"><span></span></div>
                <ul class="generic-list-item pb-4">
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Subtotal: </span>
                        <span>$${data.subtotal} </span>
                    </li>
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Coupon Name : </span>
                        <span>${data.coupon_name} 
                          <button type="button" class="icon-element icon-element-xs shadow-sm border-0" data-toggle="tooltip" data-placement="top" onclick="couponRemove()">
                             <i class="la la-times" style="color: red;"></i>
                          </button>
                        </span>
                    </li>
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Coupon Discount:</span>
                        <span> $${data.discount_amount}</span>
                    </li>
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Grand Total:</span>
                        <span> $${data.total_amount}</span>
                    </li> 
                </ul>
          `
        );
      }
    },
  });
}

couponCalculation();

function couponRemove() {
  $.ajax({
    type: "GET",
    url: "/coupon-remove",
    dataType: "json",
    success: function (data) {
      couponCalculation();
      $("#couponField").show();

      if (data.success) {
        showAlert("success", data.success);
      } else if (data.error) {
        showAlert("danger", data.error);
      }
    },
    error: function (error) {
      showAlert("danger", "An error occurred while processing your request.");
      console.error(error);
    },
  });
}

// Function to open the first lecture when page loads
function openFirstPage() {
  const firstLecture = document.querySelector(".lecture-title");
  if (firstLecture) {
    firstLecture.click();
  }
}

// Function to open the first lecture when the page loads
function openFirstLecture() {
  const firstLecture = document.querySelector(".lecture-title"); // Get the first lecture element
  if (firstLecture) {
    firstLecture.click(); // Trigger the click event on the first lecture
  }
}
// Function to handle lecture clicks and load content
function viewLesson(videoUrl, vimeoUrl, textContent) {
  const video = document.getElementById("videoContainer");
  const text = document.getElementById("textLesson");
  const textContainer = document.createElement("div");
  if (videoUrl && videoUrl.trim() !== "") {
    video.classList.remove("d-none");
    text.classList.add("d-none");
    text.innerHTML = "";
    video.setAttribute("src", videoUrl);
  } else if (vimeoUrl && vimeoUrl.trim() !== "") {
    video.classList.remove("d-none");
    text.classList.add("d-none");
    text.innerHTML = "";
    video.setAttribute("src", vimeoUrl);
  } else if (textContent && textContent.trim() !== "") {
    video.classList.add("d-none");
    text.classList.remove("d-none");
    text.innerHTML = "";
    textContainer.innerText = textContent;
    textContainer.style.fontSize = "14px";
    textContainer.style.textAlign = "left";
    textContainer.style.paddingLeft = "40px";
    textContainer.style.paddingRight = "40px";
    text.appendChild(textContainer);
  }
}
// Add a click event listener to all lecture elements
document.querySelectorAll(".lecture-title").forEach((lectureTitle) => {
  lectureTitle.addEventListener("click", () => {
    const videoUrl = lectureTitle.getAttribute("data-video-url");
    const vimeoUrl = lectureTitle.getAttribute("data-vimeo-url");
    const textContent = lectureTitle.getAttribute("data-content");
    viewLesson(videoUrl, vimeoUrl, textContent);
  });
});
// Open the first lecture when the page loads
window.addEventListener("load", () => {
  openFirstLecture();
});
