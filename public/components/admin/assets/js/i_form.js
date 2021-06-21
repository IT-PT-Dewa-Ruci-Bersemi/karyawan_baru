/**
 * Created by JetBrains PhpStorm.
 * User: Hendry Steven
 * Date: 12/16/12
 * Time: 10:45 PM
 * To change this template use File | Settings | File Templates.
 */

$.ajaxSetup({
    beforeSend: function( xhr ) {
        xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))
    }
});

$.extend({
    postdata:function(url,formdata){
      data = $.ajax({
              url: url,
              type: "POST",
              data: formdata
          });
          return data;
    },getdata:function(url){
      data = $.ajax({
              url: url,
              type: "GET"
          });
          return data;
    }
});

var i_form={
    _raw_data:[],
    _raw_container:null,
    _raw_id:[],
    _raw_header:[],
    _button:[],
    _set_raw_data:function(data,container,header) {
        this._raw_data=data;
        this._raw_container=container;
        this._raw_header=header;
        temp=[];
        $.each(data,function(index,value) {
            temp.push(parseInt(value.id));
        });
        this._raw_id=temp;
    },
    initButton:function(title,index,id) {
        var temp='',
            fields=this._button[index],
            token=$('meta[name="csrf-token"]').attr('content'),
            id=id!=null?parseInt(id):false;
        var _timepicker=false,_datepicker=false,_file=false,_toggle=false,_ckeditorType=1,
            _ckeditor=false,_ckeditorFlag=1,_fileFlag= 1,autofocus=false,firstfocus=false;
        if(this._button==false)return false;
        if(id!==false)id=this._raw_id.indexOf(id);
        temp='<div class="modal fade" id="modal-'+index+'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
        temp+='<div class="modal-dialog modal-lg"><div class="modal-content">';
        temp+='<div class="modal-header">';
        temp+='<h4 class="modal-title" id="myModalLabel">'+title+' Form</h4><button type="button" class="close" data-dismiss="modal">&times;</button></div>';
        temp+='<div class="modal-body">';
        if(fields!=null){
            temp+='<form role="form" action="?act='+index+'" method="POST" enctype="multipart/form-data">';
            temp+='<input type="hidden" name="_token" value="'+token+'" />';
            if(id!==false)temp+='<input type="hidden" name="id" value="'+ i_form._raw_data[id]["id"] +'" />';
            $.each(fields,function(el,val){
                if(autofocus==false&&firstfocus==false&&val.type!='hidden')autofocus=true;
                if(val.type=='hidden'){
                    if(typeof val.source=='undefined')
                        temp+='<input type="hidden" name="'+val.name+'" value="'+val.value+'" />';
                    else
                        temp+='<input type="hidden" name="'+val.name+'" value="'+i_form._raw_data[id][val.source]+'" />';
                    return true;
                }else if(val.type=='panel'){
                    temp+='<div id="'+val.id+'" style="display:none;">';
                    $.each(val.field,function(e,v){
                        if(v.type=='timepicker'){_timepicker = true;}
                        else if(v.type=='datepicker'){_datepicker=true;}
                        else if(v.type=='editor'){
                            _ckeditorType=(typeof v.admin!='undefined')?(v.admin?0:1):1;
                            temp+=i_form.generateButton(autofocus,v,id,_ckeditorFlag);
                            _ckeditor=true;_ckeditorFlag++;return;
                        }
                        else if(v.type=='file'){
                            temp+=i_form.generateButton(autofocus,v,id,_fileFlag);
                            _file=true;_fileFlag++;return;
                        }
                        temp+=i_form.generateButton(autofocus,v,id);
                    });
                    temp+='</div>';
                }else{
                    if(val.type=='timepicker'){_timepicker=true;}
                    else if(val.type=='datepicker'){_datepicker=true;}
                    else if(val.type=='editor'){
                        _ckeditorType=(typeof val.admin!='undefined')?(val.admin?0:1):1;
                        temp+=i_form.generateButton(autofocus,val,id,_ckeditorFlag);
                        _ckeditor=true;_ckeditorFlag++;return;
                    }
                    else if(val.type=='file'){
                        temp+=i_form.generateButton(autofocus,val,id,_fileFlag);
                        _file=true;_fileFlag++;return;
                    }
                    temp+=i_form.generateButton(autofocus,val,id);
                }
                if(autofocus==true){autofocus=false;firstfocus=true;}
            });
            temp+='<div class="modal-footer">';
            temp+='<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
            temp+='<button type="submit" class="btn btn-primary">Save changes</button>';
            temp+='</div>';
            if(_file)temp+='<input type="hidden" name="_total_files" value="'+(_fileFlag-1)+'" />';
            temp+='</form>';
        }
        temp+='</div></div></div>';
        temp+="<script type='text/javascript'>";
        temp+="$(function(){";
        if(_timepicker) temp+='$(".timepicker").timepicker({showInputs:false,showMeridian:false});';
        if(_datepicker) temp+='$(".datepicker").datepicker({format:"yyyy-mm-dd",todayHighlight:true});';
        if(_ckeditor) {
            for(var i=1;i<=_ckeditorFlag-1;i++) {
                temp+="CKEDITOR.replace('editor"+i+"', {filebrowserBrowseUrl: '"+__base_path+"/filemanager/dialog.php?type=2&admin="+_ckeditorType+"&akey=1nt1&editor=ckeditor&fldr=', filebrowserUploadUrl: '"+__base_path+"/filemanager/dialog.php?type=2&admin="+_ckeditorType+"&akey=1nt1&editor=ckeditor&fldr=', filebrowserImageBrowseUrl: '"+__base_path+"/filemanager/dialog.php?type=2&admin="+_ckeditorType+"&akey=1nt1&editor=ckeditor&fldr='});";
            }
            temp+="$.fn.modal.Constructor.prototype.enforceFocus = function () {modal_this = this;$(document).on('focusin.modal', function (e) {if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length&&!$(e.target.parentNode).hasClass('cke_dialog_ui_input_select') && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {modal_this.$element.focus()}})};";
        }
        if(_file) {
            for(var i=1;i<=_fileFlag-1;i++) {
                temp+='$("#file-input-'+i+'").change(function(){';
                temp+='if(this.files && this.files[0]){var reader = new FileReader();reader.onload = function (e) {$("#file-preview-'+i+'").attr("src", e.target.result);};reader.readAsDataURL(this.files[0]);}';
                temp+='});';
            }
        }
        temp+="});"
        temp+='</script>';
        return temp;
    },
    generateButton:function(autofocus,val,id,counter){
        var temp='',
            placeholder=typeof val.placeholder!='undefined'?val.placeholder:'',
            required=typeof val.required!='undefined'?val.required:false,
            required=required!=false?"required":"",
            preffix=typeof val.preffix!='undefined'?val.preffix:false,
            suffix=typeof val.suffix!='undefined'?val.suffix:false,
            defValue=id!==false?i_form._raw_data[id][val.name]?i_form._raw_data[id][val.name]:'':'',
            properties=typeof val.properties!='undefined'?val.properties:false,
            preffix_addon=typeof val.preffix_addon!='undefined'?val.preffix_addon:false,
            suffix_addon=typeof val.suffix_addon!='undefined'?val.suffix_addon:false,
            comboSelected='',toggle='',script='',tempAttribute='';
        defValue=defValue===false?typeof val.value!='undefined'?val.value:'':defValue;
        if(properties!==false){
            $.each(properties,function(key,value){
                tempAttribute+=' '+key+'="'+value+'"';
            });
        }
        if(autofocus)tempAttribute+= ' autofocus ';
        temp+='<div class="form-group">';
        temp+='<label for="_form_input_'+val.name+'">'+val.label+'</label>';
        if(preffix!==false)temp+='<div class="_preffix_notes">'+preffix+'</div>';
        if(val.type=='text'){
            if(preffix_addon)temp+='<div class="input-group"><div class="input-group-prepend"><span class="input-group-text">'+preffix_addon+'</span></div>';
            else if(suffix_addon)temp+='<div class="input-group">';
            temp+='<input type="text" class="form-control" name="'+val.name+'" id="_form_input_'+val.name+'" value="'+defValue+'" placeholder="'+placeholder+'" '+tempAttribute+' '+required+' />';
            if(val.permalink==true){temp+='<input type="hidden" name="_permalink" value="'+val.name+'" />'}
            if(preffix_addon)temp+='</div>';
            else if(suffix_addon)temp+='<div class="input-group-append"><span class="input-group-text">'+suffix_addon+'</span></div></div>';
        }else if(val.type=='number'||val.type=='email'){
            if(preffix_addon)temp+='<div class="input-group"><div class="input-group-prepend"><span class="input-group-text">'+preffix_addon+'</span></div>';
            else if(suffix_addon)temp+='<div class="input-group">';
            temp+='<input type="'+val.type+'" class="form-control" name="'+val.name+'" id="_form_input_'+val.name+'" value="'+defValue+'" placeholder="'+placeholder+'" '+tempAttribute+' '+required+' />';
            if(preffix_addon)temp+='</div>';
            else if(suffix_addon)temp+='<div class="input-group-append"><span class="input-group-text">'+suffix_addon+'</span></div></div>';
        }else if(val.type=='textarea'){
            temp+='<textarea name="'+val.name+'" class="form-control" '+required+' placeholder="'+placeholder+'">'+defValue+'</textarea>';
        }else if(val.type=='timepicker'){
            temp+='<div class="bootstrap-timepicker"><div class="input-group">';
            temp+='<input type="text" name="'+val.name+'" id="_form_input_'+val.name+'" value="'+defValue+'" placeholder="'+placeholder+'" '+tempAttribute+' '+required+' class="form-control timepicker" />';
            temp+='<div class="input-group-append"><span class="input-group-text"><i class="far fa-clock"></i></span></div></div></div>';
        }else if(val.type=='datepicker'){
            temp+='<div class="input-group">';
            temp+='<div class="input-group-prepend"><span class="input-group-text"><i class="far fa-calendar-alt"></i></span></div>';
            temp+='<input type="text" name="'+val.name+'" id="_form_input_'+val.name+'" value="'+defValue+'" placeholder="'+placeholder+'" '+tempAttribute+' '+required+' class="form-control datepicker" />';
            temp+='</div>';
        }else if(val.type=='editor'){
            temp+='<textarea name="'+val.name+'" '+tempAttribute+' '+required+' id="editor'+counter+'">'+defValue+'</textarea>';
        }else if(val.type=='file'){
            if(defValue!=''){defValue=__base_path+'/'+val.path+'/'+defValue;}
            else{defValue=__base_path+'/components/images/none.png';}
            temp+='<input type="file" id="file-input-'+counter+'" '+tempAttribute+' '+required+' name="_file-'+counter+'" />';
            temp+='<input type="hidden" name="_file_path-'+counter+'" value="'+val.path+'" />';
            temp+='<input type="hidden" name="_file_name-'+counter+'" value="'+val.name+'" />';
            temp+='<input type="hidden" name="_file_ext-'+counter+'" value="'+val.ext+'" />';
            temp+='<img id="file-preview-'+counter+'" class="file-input-preview" src="'+defValue+'" alt="'+val.name+'" />';
        }else if(val.type=='select'){
            temp+='<select '+required+' '+tempAttribute+' name="'+val.name+'" id="_form_input_'+val.name+'" class="form-control">';
            temp+='<option value="">Please Choose '+val.label+'</option>';
            $.each(val.data,function(index,value) {
                if(value["value"]==defValue)comboSelected='selected';
                else comboSelected='';
                temp+='<option value="'+value["value"]+'" '+comboSelected+'>'+value["display"]+'</option>';
            });
            temp+='</select>'
        }else if(val.type=='radio'){
            temp+='<div>';
            $.each(val.option,function(index,value){
                toggle=typeof value.toggle!=="undefined"?value.toggle:false;
                if(value.value==defValue)comboSelected='checked="checked"';
                else comboSelected='';
                temp+='<label class="radio-inline"><input type="radio" name="'+val.name+'" data-toggle="'+toggle+'" value="'+value.value+'" '+comboSelected+' '+required+' />'+value.display+'</label>';
                if(toggle){
                    script+='$(document).on("click", "input:radio[name='+val.name+']", function() {';
                        script+='$("#'+value.toggle+'").hide();';
                        script+='if($(this).data("toggle")=="'+value.toggle+'")$("#'+value.toggle+'").show();';
                    script+='});';
                }
            });
            if(val.toggle==true){
                script+='$("input:radio[name='+val.name+']:checked").trigger("click");';
                script='<script type="text/javascript">$(document).ready(function(){'+script+'});</script>';
            }
            temp+=script;
            temp+='</div>';
        }
        if(suffix!==false)temp+='<div class="_suffix_notes small">'+suffix+'</div>';
        temp+='</div>';
        return temp;
    },
    initGrid:function(param,container){
        var data=param.data,
            header=param.header,
            number=typeof param.number!=='undefined'?param.number:false,
            pagination=typeof param.pagination!=='undefined'?param.pagination.length==0?true:param.pagination:false,
            filter=typeof param.filter!=='undefined'?param.filter:false,sort=param.sort,
            records=pagination!=false?data.data:data,
            menu_action=param.menu_action;
        var _timepicker=false,_datepicker=false;
        this._button=typeof param.button!='undefined'?param.button:false;
        this._set_raw_data(records,container,header);
        var temp="",a,b,c,i,val,_start_number=0;
            temp+='<div class="card card-primary"><div class="card-body"><div class="table-responsive">';
            if(filter!==false)temp+='<form class="form-filter"><input type="hidden" name="_filter" value="'+Math.floor((Math.random() * 100) + 1)+'" />';
            temp+='<table class="table table-striped table-iform">';
            temp+='<thead><tr">';
            if(number)temp+='<th style="width:1%"></th>';
            for(a=0;a<header.length;a++){
                var bool_sort=typeof header[a].sort!='undefined'?header[a].sort:false;
                var sort_method='asc';
                var sort_class='fa-sort';
                if(__sort==header[a].data) {
                    sort_method=__sort_method=='asc'?'desc':'asc';
                    sort_class+='-'+(__sort_method=='asc'?'down':'up');
                }
                temp+='<th class="col pt-3 pb-2" style="text-align:'+header[a].align+';width:'+(header[a].width*10)+'%">';
                if(bool_sort) temp+='<a href="?sort='+header[a].data+'&method='+sort_method+'">';
                temp+=header[a].head;
                if(bool_sort) temp+=' <i class="fas '+sort_class+'"></i></a>';
                if(filter!==false){
                    var old_value='';
                    for(i=0;i<filter.length;i++){
                        if(filter[i].data==header[a].data){
                            old_value=typeof __filter[header[a].data]!=='undefined'?__filter[header[a].data].value:'';
                            if(filter[i].type=='text'){temp+='<div><input class="form-control filter-input" type="text" name="qt_'+filter[i].data+'" value="'+old_value+'" /></div>';}
                            else if(filter[i].type=='datepicker'){
                                temp+='<div><input class="form-control filter-input datepicker" type="text" name="qt_'+filter[i].data+'" value="'+old_value+'" /></div>';
                                _datepicker=true;
                            }else if(filter[i].type=='select'){
                                temp+='<div>';
                                temp+='<select class="form-control filter-input" name="qs_'+filter[i].data+'">';
                                var selected=false;
                                if(old_value=='')temp+='<option val="" selected></option>';
                                for(c=0;c<filter[i].options.length;c++){
                                    if(old_value!='')selected=filter[i].options[c].value==old_value?'selected':'';
                                    temp+='<option value="'+filter[i].options[c].value+'" '+selected+'>'+filter[i].options[c].display+'</option>';
                                }
                                temp+='</select>';
                                temp+='</div>';
                            }
                            break;
                        }
                    }
                }
                temp+='</th>';
            }
            if(menu_action.length || filter!==false) {
                if(filter!==false) {
                    temp+='<th class="filter-menu-holder" style="vertical-align: bottom;">';
                    temp+='<a class="filter-menu filter-search"><i class="fa fa-search"></i></a>';
                    temp+='<button type="submit" style="display:none;"></button>';
                    temp+='<a href="'+__current_page+'" class="filter-menu filter-refresh"><i class="fal fa-sync"></i></a>';
                    temp+='</th>';
                } else temp+='<th></th>';
            }
            temp+='</tr></thead><tbody>';
            if(number)_start_number=data.from;
            for(a=0;a<records.length;a++,_start_number++){
                temp+='<tr data-id="'+records[a].id+'" '+(!sort?'':'class="row-orderable"')+'>';
                if(number)temp+='<td class="">'+_start_number+'</td>';
                for(b=0;b<header.length;b++){
                    val='-';
                    if(header[b].type=='custom') {
                        val=header[b].render(records[a], records[a][header[b].data]);
                    }else if(header[b].type=='check'){
                        var temporary,fast_edit,
                            icon=typeof header[b].icon!='undefined'?header[b].icon:false,
                            colorClass=typeof header[b].colorClass!='undefined'?header[b].colorClass:false,
                            render=typeof header[b].render!='undefined'?header[b].render:false;
                        if(records[a][header[b].data]==1){fast_edit=0;}else{fast_edit=1;}
                        if(render==false){
                            if(records[a][header[b].data]==1){temporary='<i class="fa '+(icon==false?'fa-check':icon[1])+' '+(colorClass==false?'text-success':colorClass[1])+'"></i>';fast_edit=0;}
                            else{temporary='<i class="fa '+(icon==false?'fa-times':icon[0])+' '+(colorClass==false?'text-danger':colorClass[0])+'"></i>';fast_edit=1;}
                        }else{
                            if(records[a][header[b].data]==1){temporary=render[1];}
                            else{temporary=render[0];}
                        }
                        val='<a class="btn-fast-ajax" href="#" data-field="'+header[b].data+'" data-id="'+records[a]['id']+'" data-value="'+fast_edit+'">'+temporary+'</a>';
                    }else if(header[b].type=='relation') {
                        if(records[a][header[b].data]) val=records[a][header[b].belongsTo[0]][header[b].belongsTo[1]];
                    }else {val=records[a][header[b].data];}
                    temp+='<td align="'+header[b].align+'" '+(typeof header[b].class!='undefined'?('class="'+header[b].class+'"'):false)+'>'+val+'</td>';
                }
                if(menu_action.length || filter!==false){
                    temp+='<td>';
                    for(c=0;c<menu_action.length;c++){
                        if(menu_action[c]=='edit') {
                            temp+='<a class="far fa-pencil row-menu menu-default" title="Edit" data-target="#modal-edit" href="#'+records[a]["id"]+'"></a>';
                        }else if(menu_action[c]=='delete'){
                            temp+='<a class="far fa-trash row-menu btn-delete" title="Delete" data-id="'+records[a]["id"]+'"></a>';
                        }
                    }
                    temp+='</td>';
                }
                temp+='</tr>';
            }
            temp+='</tbody></table>';
            if(filter!==false)temp+='</form>';
            temp+='</div></div></div>';
        if(pagination!=false&pagination!=true)temp+=pagination;
        temp+="<script type='text/javascript'>";
        temp+="$(function(){";
        if(_timepicker) temp+='$(".timepicker").timepicker({showInputs:false,showMeridian:false});';
        if(_datepicker) temp+='$(".datepicker").datepicker({format:"yyyy-mm-dd",todayHighlight:true});';
        if(sort) temp+='$("#'+container.attr('id')+' tbody").sortable();'
        temp+="});"
        temp+='</script>';
        container.html(temp);
    }
}
$(function () {
    $(document).on('click','.btn-fast-ajax',function () {
        var selector=$(this),
            token=$('meta[name="csrf-token"]').attr('content'),
            data={_token:token,act:'fast_edit',data:{field:selector.data('field'),id:selector.data('id'),value:selector.data('value')}},
            headerResult=getObjects(i_form._raw_header, 'data', selector.data('field'));

        $.ajax({type:'post',url:window.location.href,data:data,success:function(response){
            var next=parseInt(response.current)==1?0:1;
            if(headerResult.length){
                if(response.status){
                    var renderable=typeof headerResult.render!='undefined'?headerResult.render:false;
                    if(renderable!=false){selector.html(headerResult[0].render[response.current]);}
                    else{selector.html('<i class="fa '+(next==1?'fa-times text-danger':'fa-check text-success')+'"></i>');}
                    selector.data('value', next);
                }
                else{bootbox.alert(response.message);}
            }
            return true;
        }});
        return false;
    });

    $(document).on('click','.menu-default',function () {
        var selector=$(this),
            target=selector.attr('data-target').split('-')[1],
            id=null,
            title=selector.attr('title');
        if(target=='edit')id=selector.attr('href').split('#')[1];
        $(".modal").remove();
        var temp=i_form.initButton(title,target,id);
        if(temp==false)return false;
        $(".main-content").append(temp);
        $("#modal-"+target).modal({
            backdrop:'static',
            keyboard: false
        });
        return false;
    });

    $(document).on('click', '.menu-order', function () {
        var data=i_form._raw_container.find('tbody').sortable("toArray",{attribute:'data-id'});
        i_modal.confirmModal({
            title:'Order Index',
            buttonYes: 'Save',
            text:'Are you sure to save this order arrange?<br /><small>*In order to re-arrange the index, just drag the grid wherever you like</small>',
            action:function(value){
                var token=$('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type:'POST',
                    url:window.location.href,
                    data:{_token:token,act:'order',data:data},
                    success:function(respond) {
                        window.location = '';
                    }
                });
            }
        });
        return false;
    });

    $(document).on('click', '.filter-search', function () {
        $(".form-filter").submit();
    });

    $(document).on('click', '.btn-delete', function () {
        var id=$(this).attr('data-id');
        var token=$('meta[name="csrf-token"]').attr('content');
        i_modal.confirmModal({
            title:'Delete',
            buttonYes:'Delete',
            action:function(value){
                $('<form method="post"><input type="hidden" name="_token" value="'+token+'" /><input type="hidden" name="act" value="delete" /><input type="hidden" name="id" value="'+id+'" /></form>').appendTo('body').submit();
            }
        });
        return false;
    });

    $(document).on('shown.bs.modal', function (e) {
        $('[autofocus]', e.target).focus();
    });
});