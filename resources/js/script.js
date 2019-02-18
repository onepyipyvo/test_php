$(document).on('click', '#close-preview', function(){
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
            $('.image-preview').popover('show');
        },
        function () {
            $('.image-preview').popover('hide');
        }
    );
});

$(function() {
    $('#addBook, #editBook').submit(function(event) {
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        handleForm($(this), formData);
    });

    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");

    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });

    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse");
    });

    $(".image-preview-input input:file").change(function (){
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }
        reader.readAsDataURL(file);
    });

    var i = $("#img_path").val();
    if(i) {
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            img.attr('src', i);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
    };


    $('.trash').click(function(event){
        event.preventDefault();
        $.getJSON( $(this).attr("href") )
            .done(function( json ) {
                showMessage('success', 'Deleted successfully');
            })
            .fail(function( jqxhr, textStatus, error ) {
                showMessage('danger', error);
            });
    })
});

function showMessage(type, message) {
    var text_class = 'alert-danger';
    if (type == 'success') {
        text_class = 'alert-success';
    }
    $('.container').append('<div class="alert '+text_class+'" role="alert">' +
        message +
        '</div>');
}

function handleForm(form, formData) {
    $.ajax({
        type: 'POST',
        contentType: false,
        processData: false,
        url: $(form).attr('action'),
        data: formData
    })
        .done(function(response) {
            var d = $.parseJSON(response);
            if(d.success) {
                showMessage('success', 'Done')
            } else {
                showMessage('danger', d.errors);
            }
        })
        .fail(function(data) {
            var d = $.parseJSON(response);
            if(d.success) {
                showMessage('success', 'Done')
            } else {
                showMessage('danger', d.errors);
            }
        });
}