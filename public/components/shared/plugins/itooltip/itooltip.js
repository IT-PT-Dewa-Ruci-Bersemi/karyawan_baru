/**
 * Created by kim on 21/02/2017.
 */
/*!
 * tooltip.js v1
 * - require bootstrap..
 * - require jquery..
 * - complement of clipboard.js
 *
 */
var i_tooltip={
    init:function(selector, trigger, placement){
        trigger=typeof trigger!='undefined'?trigger:'click';
        placement=typeof placement!='undefined'?placement:'bottom';

        $(selector).tooltip({
            trigger: trigger,
            placement: placement
        });

        $(selector).bind('mouseleave', function () {
            $(selector).tooltip('hide');
        });
    },
    setTooltip:function(btn, message) {
        $(btn).attr('data-original-title', message).tooltip('show');
    }
};
