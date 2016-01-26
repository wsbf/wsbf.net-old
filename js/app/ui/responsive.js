$(function() {
    var resizeTimer;
    //from StackOverflow answer http://stackoverflow.com/questions/1038727/how-to-get-browser-width-using-javascript-code
    function getBrowserWidth(){
        var x = 0;
        if (self.innerHeight){
            x = self.innerWidth;
        }
        else if (document.documentElement && document.documentElement.clientHeight){
            x = document.documentElement.clientWidth;
        }
        else if (document.body){
            x = document.body.clientWidth;
        }
        return x;
    }
    
    $(window).resize(function() {
        if(resizeTimer){
            clearTimeout(resizeTimer);
        }
        resizeTimer = setTimeout(function(){
            //console.log("jQuery: " + $(this).width());
            //console.log("Javascript: " + getWidth());
            var w = getBrowserWidth(); //returns browsers current width
            if(w >=768 && w <=991){
                
            }
        }, 100);
    });
    
});