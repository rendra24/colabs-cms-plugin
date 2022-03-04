function toogleParent(value, idParent) {
    
    if(value == 1){
        $('#'+idParent).hide();
    }else{
        $('#'+idParent).show();
    }
    
}

$('#form-sort').submit(function(event) {
    event.preventDefault()
    $.ajax({
        type: "post",
        url: "<?= base_url('cms/menu/save_menu');?>",
        data: $(this).serialize(),
        success: function(data) {
            swal({
                title: "Simpan Berhasil",
                icon: "success",
                button: "Tutup",
                allowOutsideClick: false,
                allowEscapeKey: false,
            }).then(function() {
                location.reload();
            });
        },
        error: function() {

        },
    })
})

$('.form-serialize').submit(function(event) {
    event.preventDefault();
    var url = $(this).attr('data-url');
    $.ajax({
        type: "post",
        url: url,
        data: $(this).serialize(),
        success: function(data) {
            swal({
                title: "Simpan Berhasil",
                icon: "success",
                button: "Tutup",
                allowOutsideClick: false,
                allowEscapeKey: false,
            }).then(function() {
                location.reload();
            });
        },
        error: function() {
            swal({
                title: "Gagal Coba Lagi Nanti",
                icon: "error",
                button: "Tutup",
                allowOutsideClick: false,
                allowEscapeKey: false,
            }).then(function() {
                location.reload();
            });
        },
    })
});

$('.get-data').click(function(event) {
    event.preventDefault();
    var url = $(this).attr('data-url');
    var value = $(this).attr('key');

    $.ajax({
        type: "post",
        url: url,
        data: {value:value},
        dataType: "json",
        success: function(data) {
            
            $('input[name=nama_menu]').val(data.nama_menu);
            $('input[name=id]').val(data.id);
            $('select[name=content_type]').val(data.content_type).change();
            $('select[name=parent]').val(data.parent).change();
            $('input[name=link]').val(data.link);
            if(data.status == '1'){
                $('input[name=status]').attr('checked', true);
            }

            if(data.menu_id){
                $('select[name=id_menu]').val(data.menu_id).change();
            }
        },
        error: function() {
            swal({
                title: "Gagal Coba Lagi Nanti",
                icon: "error",
                button: "Tutup",
                allowOutsideClick: false,
                allowEscapeKey: false,
            }).then(function() {
                location.reload();
            });
        },
    })
});

function sucessCmsHandle(form, data, respond_type) {

    if (data.response == "validation_error") {
        form.find(":input").removeClass("is-invalid");
        $.each(data.validation.data, function (key, data) {
            form.find(":input[name=" + key + "]").addClass("is-invalid");
            form.find(":input[name=" + key + "]")
                .parent()
                .find(".invalid-feedback")
                .text(data);

            form.find("#place_" + key).prepend(
                '<div class="alert alert-danger clone-feedback">' +
                    data +
                    "</div>"
            );
        });
    } else {
        switch (respond_type) {
            case "reload":
                swal({
                    title: "Simpan Berhasil",
                    icon: "success",
                    button: "Tutup",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                }).then(function () {
                    location.reload();
                });
                break;
            default:
                $("#modalSide").modal("hide");
                loadDatatables(".tableAjax");
                swal({
                    title: "Simpan Berhasil",
                    icon: "success",
                    button: "Tutup",
                });
        }
    }
}
function errorCmsHandle(form) {
    loadingAjax(form, "hide");
    swal({
        title: "Simpan Gagal",
        text: "Periksa kembali koneksi anda !",
        icon: "error",
        button: "Tutup",
    });
}

$("body").on("submit", ".ajax-cms-multipart", function () {
    form = $(this);
    uri_redirect = $(this).data("redirect");
    respond = $(this).data("respond");
    $.ajax({
        type: "post",
        url: $(this).attr("action"),
        data: new FormData(this), //buat ngambil isi dari form
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        beforeSend: loadingAjax(form, "show"),
        success: function (data) {
            sucessCmsHandle(form, data, 'reload');
        },
        error: function () {
            errorCmsHandle(form);
        },
    });
    return false;
});
    


var nestedSortables = $(".nested-sortable");

// Loop through each nested sortable element
for (var i = 0; i < nestedSortables.length; i++) {
    new Sortable(nestedSortables[i], {
        group: 'nested',
        animation: 150,
        fallbackOnBody: true,
        swapThreshold: 0.65,
        onSort: function(e) {
            var items = e.to.children;
            var result = [];
            for (var i = 0; i < items.length; i++) {
                result.push($(items[i]).data('id'));
            }

            $('#standard_order').val(result);
        }
    });
}