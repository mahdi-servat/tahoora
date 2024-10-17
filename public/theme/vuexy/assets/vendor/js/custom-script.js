(function(window, undefined) {
    'use strict';
    if ( $.isFunction($.fn.DataTable) ) {
        $('.table-list-data').DataTable({
            dom: 'Bfrtip',
            "ordering": true,
            "order": [],
            "aaSorting": [],
            buttons: [
                // 'copy', 'csv', 'excel', 'pdf', 'print'
                // {extend: 'excel', className: 'btn btn-primary waves-effect waves-light'}
            ],
            "bPaginate": true,
            bFilter: true,
            bInfo: false,
            "language": {
                "sProcessing": "درحال پردازش...",
                "sLengthMenu": "نمایش محتویات _MENU_",
                "sZeroRecords": "موردی یافت نشد",
                "sInfo": "نمایش _START_ تا _END_ از مجموع _TOTAL_ مورد",
                "sInfoEmpty": "تهی",
                "sInfoFiltered": "(فیلتر شده از مجموع _MAX_ مورد)",
                "sInfoPostFix": "",
                "sSearch": "جستجو:",
                "search": "جستجو:",
                "previous": "قبلی",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "ابتدا",
                    "sPrevious": "قبلی",
                    "sNext": "بعدی",
                    "sLast": "انتها"
                },
                "paginate": {
                    "first": "ابتدا",
                    "previous": "قبلی",
                    "next": "بعدی",
                    "last": "انتها"
                }
            }
        });
        $('div.dataTables_filter input').removeClass("form-control-sm");
        $('.dataTables_paginate > .pagination').addClass("justify-content-center");
    }
    $(document).ready(function (){
        $('.date-time-picker').persianDatepicker({
            initialValue: false,
            calendar:{
                persian:{
                    locale:'fa'
                }
            },
            persianDigit:false,
            format: 'YYYY/MM/DD HH:m',
            timePicker: {
                enabled: true,
                meridiem: {
                    enabled: true
                },
                second: {
                    enabled: false,
                },
                minute: {
                    enabled: true,
                    step: true,
                }
            }        ,
            onSelect:function (e){
                toEn()
            },
            onSet:function (e){
                toEn()
            },
            onHide:function (e){
                toEn()
            }
        });
        $('.date-picker').persianDatepicker({
            initialValue: false,
            calendar:{
                persian:{
                    locale:'fa'
                }
            },
            persianDigit:false,
            format: 'YYYY/MM/DD',
            timePicker: {
                enabled: false,
            }        ,
            onSelect:function (e){
                toEn()
            },
            onSet:function (e){
                toEn()
            },
            onHide:function (e){
                toEn()
            }
        });
        $('.time-picker').persianDatepicker({
            initialValue: false,
            onlyTimePicker: true,
            calendar:{
                persian:{
                    locale:'en'
                }
            },
            format: 'HH:m',
            timePicker: {
                enabled: true,
                meridiem: {
                    enabled: true
                },
                second: {
                    enabled: false,
                },
                persianDigit:false
                // minute: {
                //   enabled: true,
                //   step: true,
                // }
                ,
                onSelect:function (e){
                    toEn()
                },
                onSet:function (e){
                    toEn()
                },
                onHide:function (e){
                    toEn()
                }
            }
        });
        setTimeout(()=>{
            toEn()
        },500)
    })
    /*
    NOTE:
    ------
    PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
    WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */

})(window);
function toEn(){
    $('.date-time-picker').each(function (){
        $(this).val(convertNumber($(this).val()))
    })
    $('.time-picker').each(function (){
        $(this).val(convertNumber($(this).val()))
    })
    $('.date-picker').each(function (){
        $(this).val(convertNumber($(this).val()))
    })
}
function request(sorceUrl, preload, formData, method, dataType, callback) {
    if (!dataType) {
        dataType = 'json';
    }
    preLoad(preload);
    var data = new FormData();
    if (formData.length > 0) {
        if ($('#image') != undefined && $('#image') != null && $('#image').length > 0) {
            $.each($('#image')[0].files, function (i, file) {
                data.append("image", file);
                $("#image-error").text('');
            });
        }
        // if ($('#file') != undefined && $('#file') != null && $('#file').length > 0) {
        //   $.each($('#file')[0].files, function (i, file) {
        //     data.append("file", file);
        //     $("#file-error").text('');
        //   });
        // }
        $.each($("input[type=file]"), function (i, obj) {
            $.each(obj.files, function (j, file) {
                data.append('attachment_file[' + j + ']', file);
            })
        });
        for (j = 0; j < formData.length; j++) {
            data.append(formData[j].name, formData[j].value);
        }
    }
    $.ajax(
        {
            method: method,
            type: method,
            dataType: dataType,
            url: sorceUrl,
            data: data,
            contentType: false,
            processData: false,
            crossDomain: true,
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            },
            mimeType: "multipart/form-data",
            success: function (data) {
                if (callback != null && callback !== undefined) {
                    callback(data, formData);
                }
                // message('عملیات با موفقیت انجام شد.', 'success');
                preLoad(0);
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(xhr);
                if (xhr.responseJSON.errors !== undefined) {
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        message(value[0], 'error', null, 5000);
                    });
                } else if (xhr.responseJSON.message !== undefined) {
                    message(xhr.responseJSON.message, 'error');
                } else {
                    message('عملیات ناموفق بود،ورودی های خود را بررسی کرده و سپس دوباره تلاش کنید.', 'error');
                }
                preLoad(0);
            }
        });
    // } else {
    //   message('لطفا فرم را با دفت تکمیل نمائید.', 'error');
    // }
}
function preLoad(flag) {

}
function message(message, type, id, time) {
    time = time != null && time != '' ? time : 10000;
    var element_txt;
    var heading = '';
    var icon = '';
    var loaderBg = '';
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": time,
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    if (type == 'error') {
        element_txt = 'alert_danger';
        heading = 'خطا';
        icon = 'error';
        loaderBg = '';
        toastr.error(message);
    } else if (type == 'success') {
        element_txt = 'alert_success';
        heading = 'پیام';
        icon = 'success';
        toastr.success(message);
    } else if (type == 'info') {
        element_txt = 'alert_info';
        heading = 'پیام';
        icon = 'info';
        toastr.info(message);
    } else if (type == 'warning') {
        element_txt = 'alert_warning';
        heading = 'هشدار';
        icon = 'warning';
        toastr.warning(message);
    }
    if (id != null && id != '' && document.getElementById(id) != null && typeof(document.getElementById(id)) != undefined) {
        document.getElementById(id).focus();
    }
}


function message2(message, type, id, time, title = "", position = "top") {
    time = time != null && time != '' ? time : 10000;
    toastr.options = {
        maxOpened: 1,
        autoDismiss: true,
        closeButton: 1,
        debug: 0,
        newestOnTop: 0,
        progressBar: 1,
        positionClass: 'toast-' + position + '-center',
        preventDuplicates: 0,
        onclick: null,
        rtl: 'rtl'
    };
    //Add fix for multiple toast open while changing the position
    //    toastr.options.hideDuration = 0;
    //   toastr.clear();
    toastr.options.showDuration = 1;
    toastr.options.hideDuration = 0;
    toastr.options.timeOut = time;
    toastr.options.extendedTimeOut = 0;
    toastr.options.showEasing = "swing";
    toastr.options.hideEasing = "linear";
    toastr.options.showMethod = "fadeIn";
    toastr.options.hideMethod = "fadeOut";
    toastr.options.tapToDismiss = false;
    var $toast = toastr[type](message, title);
}
function deleteR(url, msg) {
    if (window.confirm(msg)) {
        window.location.href = url;
    }
}

function search(e, url, param, value) {
    e.preventDefault();
    window.location.href = '/' + url + '?search=' + param + ':' + value+'&title='+value;
    return false;
}
function searchWithDate(e, url, param, value , start , end , status = null) {
    e.preventDefault();
    if (status === ''){
        status = null ;
    }
    if(status !== null){
        window.location.href = '/' + url + '?start=' + start + '&end=' + end + '&status=' + status;
    }
    else if (value === ''){
        window.location.href = '/' + url + '?start=' + start + '&end=' + end;
    }
    else {
        window.location.href = '/' + url + '?search=' + param + ':' + value+'&title='+value + '&param='+param + '&start=' + start + '&end=' + end;
    }
    return false;
}
function searchCustom(e, url, param1, value1 , param2, value2 , start , end ) {
    e.preventDefault();
    window.location.href = '/' + url + '?search=' + param1 + ':' + value1+';' + param2 +':'+value2 + '&start=' + start + '&end=' + end + '&searchJoin=and' ;

    return false;
}
function searchInTwo(e, url, param1, value1 ,param2,value2) {
    e.preventDefault();
    window.location.href = '/' + url + '?search=' + param1 + ':' + value1+'&' + param2 +'='+value2 + '&title=' +value1 ;
    return false;
}
function search2(e, url,params, value) {
    e.preventDefault();
    var s='';
    for (var i in params) {
        if(s!=''){
            s+=';'+params[i]+':'+value
        }else {
            s=params[i]+':'+value
        }
    }
    window.location.href = '/' + url + '?search=' +s+'&title='+value;
    return false;
}
function search3(e, url,params, value,search,search2) {
    e.preventDefault();
    var s='';
    if (search===undefined || search==null){
        search='';
    }
    if (value!=''){
        for (var i in params) {
            if(s!=''){
                s+=';'+params[i]+':'+value
            }else {
                s=params[i]+':'+value
            }
        }
    }
    if (s!='' && search!=''){
        s=s+';'+search;
    }else if(search!=''){
        s=search;
    }
    if (search2!==undefined && search2!=''){
        window.location.href = '/' + url + '?search=' +s+'&'+search2+'&title='+value+'&searchJoin=and';
    }else{
        window.location.href = '/' + url + '?search=' +s+'&title='+value+'&searchJoin=and';
    }
    return false;
}


// $('.time').clockTimePicker();

function searchWhitParam(e, url, params, value, value2 = [], limit,custom='',order='',sort='desc',append='') {
    e.preventDefault();
    var s = '';
    var s2 = '';
    var urll = '';
    limit = limit !== undefined && limit != '' && limit != null ? limit : 50;
    sort = sort !== undefined && sort != '' && sort != null ? sort : 'desc';
    if (value2!='' && typeof value2=="string")
        value2=value2.split(',')
    if (value.trim() != '') {
        var tt=value.trim();
        if (value.trim()=='تائید نشده'){
            value='0';
        }else if (value.trim()=='تائید شده'){
            value='1';
        }
        if (value2 === undefined || value2 == '' || value2.length == 0 || value2[0] == 0) {
            // for (var i in params) {
            //   if (params[i] != 'd_vch_digitalprice') {
            //     if (s != '') {
            //       s += ';' + params[i] + ':' + value;
            //     } else {
            //       s = params[i] + ':' + value;
            //     }
            //     s2 += '&' + params[i] + '=' + value;
            //   }
            // }
            if (s != '') {
                s += ';' + params[0] + ':' + value;
            } else {
                s = params[0] + ':' + value;
            }
            s2 += '&' + params[0] + '=' + value;
        } else {
            for (var i in value2) {
                if (s != '') {
                    s += ';' + value2[i] + ':' + value;
                } else {
                    s = value2[i] + ':' + value;
                }
                s2 += '&' + value2[i] + '=' + value;
            }
        }
        if (custom!==undefined && custom!=''){
            s+=';'+custom;
        }
        s2 += '&title=' + tt;
        urll = '/' + url + '?search=' + s + s2 + '&limit=' + limit;
    } else if(custom!==undefined && custom!='') {
        urll = '/' + url + '?search=' + custom  + '&limit=' + limit;
    } else {
        urll = '/' + url + '?limit=' + limit;
    }
    if (urll!=''){
        if (order!=''){
            urll+='&orderBy='+order+'&sortedBy='+sort;
        }
        window.location.href = urll+append;
    }
    return false;
}
$(document).ready(function () {
    $('.select2').select2();

})
var convertNumber= function (str)
{
    var
        persianNumbers = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g],
        arabicNumbers  = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g];
    if(typeof str === 'string')
    {
        for(var i=0; i<10; i++)
        {
            str = str.replace(persianNumbers[i], i).replace(arabicNumbers[i], i);
        }
    }
    return str;
};
function searchObject2(e, url, arrayRepository , arrayParam) {
    e.preventDefault();
    let finalUrl = '/' + url + '?search=' ;
    let url2 = '/' + url + '?search=' ;
    arrayRepository.forEach(function(item){
        if(item.value !== '' && item.value !== undefined && item.value !== null){
            finalUrl = finalUrl + item.param + ':' + item.value + ';'
        }
    })
    console.log(finalUrl)
    if (finalUrl === url2){
        // finalUrl =
    }else {
        finalUrl = finalUrl.slice(0, -1);
        finalUrl = finalUrl + '&searchJoin=and';
    }

    arrayParam.forEach(function(item){
        if(item.value !== '' && item.value !== undefined && item.value !== null){
            finalUrl = finalUrl + '&' + item.param + '=' + item.value
        }
    })
    window.location.href = finalUrl
    return false;
}
