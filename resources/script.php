<script type="text/javascript">
    function addToWishList(course_id) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/add-to-wishlist/" + course_id,
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.success);
                } else if (response.error) {
                    showAlert('danger', response.error);
                }
            },
            error: function(error) {
                showAlert('danger', 'An error occurred while processing your request.');
            }
        });
    }

    function showAlert(type, message) {
        var alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
        $('#alert-container').html(alertHtml);

        setTimeout(function() {
            $('.alert').alert('close');
        }, 3000);
    }

    function wishList() {
        $.ajax({
            type: "GET",
            url: "/get-wishlist-course",
            dataType: "json",
            success: function(response) {

                $('#wishQty').text(response.wishQty);

                var rows = "";
                $.each(response.wishlist, function(key, value) {
                    console.log(value);
                    rows += `
                        <div class="col-lg-4 responsive-column-half">
                        <div class="card card-item">
                            <div class="card-image">
                                <a href="/course-details/${value.id}/${value.slug}.html" class="d-block">
                                    <img style="width:100%; height: 250px; object-fit:cover;" class="card-img-top" src="${value.image}" alt="Card image cap">
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
                                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">${value.label}</h6>
                                <h5 class="card-title"><a href="/course-details/${value.id}/${value.slug}.html">${value.name}</a></h5>

                                <div class="d-flex justify-content-between align-items-center">
                            ${value.discount_price == 0 
                                    ? `<p class="card-price text-black font-weight-bold">$${value.selling_price}</p>`
                                    : `<p class="card-price text-black font-weight-bold">$${value.discount_price} <span class="before-price font-weight-medium">$${value.selling_price}</span></p>`
                                    }
                                    <div class="icon-element icon-element-sm shadow-sm cursor-pointer" data-toggle="tooltip" data-placement="top" title="Remove from Wishlist" id="${value.wishlist_id}" onclick="removeWishList(this.id)"><i class="la la-heart"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                });
                $('#wishlist').html(rows);
            }
        });
    }

    wishList();

    function removeWishList(id) {
        $.ajax({
            type: "GET",
            url: "/remove-wishlist/" + id,
            dataType: "json",
            success: function(response) {
                wishList();

                if (response.success) {
                    showAlert('success', response.success);
                } else if (response.error) {
                    showAlert('danger', response.error);
                }
            },
            error: function(error) {
                showAlert('danger', 'An error occurred while processing your request.');
            }
        });
    }
</script>