/* 
 * Displays tooltips and notifications
 */

$(function () {
    $(document).ready(function () {
        var view_count = $.cookie('media_tip_count',Number);
        if(!view_count){
            $.cookie('media_tip_count','1');
            view_count = 1;
        }else{
            if(view_count<=3){
                view_count+=1;
                $.cookie('media_tip_count',view_count);
            }
        }
        
        if(view_count<=3){
            //$.jGrowl.defaults.closer = false;
            $.jGrowl.defaults.position = 'top-right';
            $.jGrowl.defaults.close = function(){
                $.cookie('media_tip_count',"5");
            };
            $.jGrowl("For Chat, Video and More, click 'Listen Live' ", {life: 10000});
        }
        
        
    });
    
});