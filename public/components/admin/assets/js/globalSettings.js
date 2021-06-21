/**
 * Created by Outpost-PC2 on 2/22/2016.
 */
$(document).ready(function () {
    if (location.hash !== '') {
        $('.nav-tabs a[href="' + location.hash.replace('tab_','') + '"]').tab('show');
    } else {
        $('.nav-tabs a:first').tab('show');
    }

    $('.nav-tabs a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        window.location.hash = 'tab_'+  e.target.hash.substr(1) ;
        return false;
    });
});