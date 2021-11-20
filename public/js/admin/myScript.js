//Javascript Admin
$(document).ready(function() {
    $('.nav-link.active .sub-menu').slideDown();
    // $("p").slideUp();

    $('#sidebar-menu .arrow').click(function() {
        $(this).parents('li').children('.sub-menu').slideToggle();
        $(this).toggleClass('fa-angle-right fa-angle-down');
    });

    $("input[name='checkall']").click(function() {
        var checked = $(this).is(':checked');
        $('.table-checkall tbody tr td input:checkbox').prop('checked', checked);
    });
});

$(document).ready(function() {
    $("div.alert").delay(3000).slideToggle("3000");
    $(".message").delay(3000).fadeToggle("3000");
});

function confirm_delete(message) {
    if (window.confirm(message)) {
        return true;
    }
    return false;
}

$(document).ready(function() {
    $("button#add-images").click(function() {
        $("#insert-images").append('<div class="form-group col-md-12"><input class="form-control" type="file" name="images_detail[]"></div>');
    });
});

$(document).ready(function() {
    $("img.product_img_detail").hover(function() {
        $("a#delete-img").show(".icon-del");
    });

    if ($(window).click(function() {
        $("a#delete-img").hide(".icon-del");
    }));
    
});

$(document).ready(function() {
    $("a#delete-img").on('click', function() {
        var url = "http://localhost/laravel_unimart/unimart/admin/product/delete_img/";
        var _token = $("form[name='formEditProduct']").find("input[name='_token']").val();
        var id_img = $(this).parent().find("img").attr("id"); //Tìm đến thẻ img và chọn đến id.
        // alert(id_img);
        var img_detail = $(this).parent().find("img").attr("id_img");
        // alert(img_detail);
        var img = $(this).parent().find("img").attr("src");
        // alert(img);
        $.ajax({
            method: "GET",
            url: url + img_detail,
            data: {"_token":_token, "img_detail":img_detail, "img": img},
            success: function(data) {
                // console.log(url);
                if (data == true) {
                    $("#" + id_img).text(data).remove();
                } else {
                    alert("Xóa hình ảnh không thành công!");
                }
            }
        });
    });
});   


//Ajax transaction
$(document).ready(function() {
    $("a.preview-transaction").click(function(e) {
        e.preventDefault();
        let url = $(this).data('url');
        $.ajax({
            url: url,
            success: function(response) {
                $("#modal-preview-transaction .info-order").html(response.info_order);
                $("#modal-preview-transaction .content-order").html(response.html);
                $("#modal-preview-transaction .modal-footer").html(response.total_money);
                $("#modal-preview-transaction .modal-footer-trash").html(response.total_money_trash);
                $("#modal-preview-transaction").modal() ;
            }
        });
        

    });

    //Delete OrderItem
    $("body").on("click", '.order-item-delete', function(e) {
        e.preventDefault();
        let url = $(this).data('url');
        let $this = $(this);

        $.ajax({
            url: url,
            success: function(response) {
                if (response.code === 200) {
                    $this.parents("tr").remove();
                    location.reload();
                }
            }
        });
    })
});

$(function() {
    $("#status-transaction").on('change', function() {
        $(".form-transaction").submit();
    })
});

//Read-more
$(".load-more").click(function() {

    $(".toggle-content").toggleClass('toggle-main');
    var replaceText = $(".toggle-content").hasClass('toggle-main') ? 'Thu Gọn Nội Dung' : 'Xem Thêm Nội Dung';

    //Check trạng thái khi click chuột
    if (replaceText == 'Thu Gọn Nội Dung') {
        $(".gradient").css('display', 'none');
    } else {
        $(".gradient").css('display', 'block');
    }

    // Truyền trạng thái lên server
    $(".load-more").html(replaceText);

  

});

//Select-Role
$(function() {
    $(".select-role").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    })
    $(".select-role").select2({
        placeholder: "Chọn quyền",
        allowClear: true    
    })
    
    
})

//Checked Role
$(function() {
    $(".checkbox_wrapper").on('click', function() {
        $(this).closest(".card").find(".checkbox_children").prop('checked', $(this).prop('checked'));
    });
    $(".check-all-wrapper").on('click', function() {
        $(this).parents().find(".checkbox_children").prop('checked', $(this).prop('checked'));
        $(this).parents().find(".checkbox_wrapper").prop('checked', $(this).prop('checked'));

    });
   
});
//Slug_convert
function ChangeToSlug()
{
    var slug;
 
    //Lấy text từ thẻ input title 
    slug = document.getElementById("slug").value;

    //Đổi chữ hoa thành chữ thường
    slug = slug.toLowerCase();

    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”
    // return slug;
    document.getElementById('convert_slug').value = slug;
    
}






