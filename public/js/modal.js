function extendModalOpen(obj) {
    // console.log(222);
    var code = $(obj).attr('data-id');
    // console.log($(obj).attr('data-id'));
    // console.log(code);
    $(".period_id").val(code);

    $('#extend-modal').css('display', 'block');
}

function extendModalClose() {
    $('#extend-modal').css('display', 'none');
}
