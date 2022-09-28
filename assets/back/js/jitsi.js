
$('form').submit(function (e) {
    $('#install_progress').show();
    $('#modal_1').show();
    $('.btn').val('saving, please wait...');
    $('form').submit();
    e.preventDefault();
});

function get_class_sections(class_id) {

    $.ajax({
        url: '<?php echo base_url(); ?>admin/get_class_section/' + class_id,
        success: function (response) {
            jQuery('#section_selector_holder').html(response);
        }
    });

}


$('#check').click(function () {

    if ($('#check').is(':checked') == true) {
        $("#send_sms").show(500);
        $("#initial").hide(500);
    } else {

        $("#send_sms").hide(500);
        $("#initial").show(500);
    }

});

$("#send_sms").hide();
