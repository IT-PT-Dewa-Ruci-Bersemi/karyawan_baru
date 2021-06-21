/**
 * Created by JetBrains PhpStorm.
 * User: Hendry Steven
 * Date: 12/16/12
 * Time: 10:45 PM
 * To change this template use File | Settings | File Templates.
 */

var i_modal={
    confirmModalCallBack:false,
    confirmModal:function(param) {
        var temp='',
            title=typeof param.title=='undefined'?"Confirmation":param.title,
            buttonYes=typeof param.buttonYes=='undefined'?"Save changes":param.buttonYes,
            buttonNo=typeof param.buttonNo=='undefined'?"Cancel":param.buttonNo,
            text=typeof param.text=='undefined'?"Are you sure to perform this action?":param.text;

            i_modal.confirmModalCallBack=typeof param.action=='function'?param.action:false;
        temp='<div class="modal fade" id="i-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            temp+='<div class="modal-dialog"><div class="modal-content">';
                temp+='<div class="modal-header">';
                    temp+='<h4 class="modal-title" id="myModalLabel">'+title+' Form</h4>';
                    temp+='<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
                temp+='</div>';
                temp+='<div class="modal-body">'+text+'</div>';
                temp+='<div class="modal-footer">';
                    temp+='<button type="button" class="btn btn-default" data-dismiss="modal">'+buttonNo+'</button>';
                    temp+='<button type="button" id="i-confirm-btn-yes" class="btn btn-primary">'+buttonYes+'</button>';
                temp+='</div>';
            temp+='</div>';
        temp+='</div>';
        $(".modal-holder").append(temp);
        $("#i-modal").modal({
            backdrop: 'static',
            keyboard: false
        });
    }
}

$(function(){
    $(document).on("click","#i-confirm-btn-yes", function () {
        if(i_modal.confirmModalCallBack)i_modal.confirmModalCallBack();
        $("#i-modal").modal('hide');
    });
});