function autoPriceCalc() {
    var day_price;
    var work_day;
    var vat_percent;
    var tot_price;
    var vat_price;
    var calc_price;
    var unpaid_price;
    var deposit_price;
    var add_price;

    // 문자열에서 콤마(',') 제거 후 숫자 값으로 바꿔야 값이 잘리지 않음(ex 123,123 -> parsInt -> 123)
    day_price = $("#tbl-day_price").val();
    day_price = parseInt(day_price.replace(/[^0-9]/g, ""));
    // console.log(day_price);

    work_day = parseFloat($("#tbl-work_day").find('option:selected').val());
    // console.log("work_day : ", work_day);

    vat_percent = $("#tbl-vat_percent").val();
    // console.log("vat_percent : ", vat_percent);

    deposit_price = $('#tbl-deposit_price').val();
    deposit_price = parseInt(deposit_price.replace(/[^0-9]/g, ""));
    // console.log("deposit_price : ", deposit_price);

    add_price = $("#tbl-add_price").val();
    add_price = parseInt(add_price.replace(/[^0-9]/g, ""));
    // console.log("add_price : ", add_price);

    // console.log("day_price : ", day_price);
    // console.log('work_day : ', work_day);
    // console.log('vat_percent : ', vat_percent);

    tot_price = day_price * work_day;
    tot_price = Math.round(tot_price);
    // console.log("tot_price : ", tot_price);

    vat_price = percent(tot_price, vat_percent);
    vat_price = Math.round(vat_price);
    // console.log('vat_price : ', vat_price);

    calc_price = tot_price - vat_price;
    // console.log('calc_price : ', calc_price);

    unpaid_price = calc_price - deposit_price + add_price ;
    // console.log('unpaid_price : ', unpaid_price);

    $("#tbl-tot_price").html(numberWithCommas(tot_price) + '원');
    $("#tbl-calc_price").html(numberWithCommas(calc_price) + '원');
    $("#tbl-unpaid_price").html(numberWithCommas(unpaid_price) + '원');
    if(!vat_percent) {$('#tbl-vat_price').html('노무자를 먼저 선택해주세요');}
    else {$("#tbl-vat_price").html(numberWithCommas(vat_price) + '원');}
}


function comma(num){
    var len, point, str;

    num = parseInt(num);
    num = num + "";
    point = num.length % 3 ;
    len = num.length;

    str = num.substring(0, point);
    while (point < len) {
        if (str != "") str += ",";
        str += num.substring(point, point + 3);
        point += 3;
    }

    return str;

}