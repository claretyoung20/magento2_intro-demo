function multiImageDisplay(element, optid) {

    jQuery('#displayImageCusOptn').html('');
    var list = [];
    jQuery('#select_' + optid+' option:selected').each(function () {
        list.push(jQuery(this).attr('data-src'));
    });

    list.forEach(function (element) {
        var data = element.split('||');
        if(data[0] == 'image'){
            var html = '<img src="'+data[1]+'" width="50px" height="50px" style="margin-right: 5px" />';
        }
        if(data[0] == 'color'){
            var html = '<span style="background: '+data[1]+'; width: 50px; height: 50px; display: inline-block; margin-right: 5px;"></span>';
        }
        jQuery('#displayImageCusOptn').append(html);
    });
    jQuery('#displayImageCusOptn').show();



}

function singleImageDisplay(element,optid) {
    jQuery('#displayImageCusOptn').html('');
    var src = jQuery('#select_' + optid+' option:selected').attr('data-src');
    var data = '';
    if(src != null){
        data = src.split('||');
    }
    if(data[0] == 'image'){
        var html = '<img src="'+data[1]+'" width="40px" height="40px"/>';
    }
    if(data[0] == 'color'){
        var html = '<span style="background: '+data[1]+'; width: 40px; height: 40px; display: inline-block;"></span>';
    }
    jQuery('#displayImageCusOptn').append(html);
    jQuery('#displayImageCusOptn').show();
}
