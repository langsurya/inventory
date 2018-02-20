function ajaxWilayah(id, targetDiv, selected){
    var url = (typeof(selected) !== 'undefined') ? '&selected='+selected : '';
    $.ajax({
        type : "GET",
        url : "/ajax/get-wilayah?id="+id+url,
        success:function(data){
            $("#"+targetDiv).html(data);
        }
    });
}

function startTimer(duration, display) {
    if(display !== null){
        var timer = duration, minutes, seconds;
        var end =setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = seconds;

            if (--timer < 0) {
                clearInterval(end);
            }
        }, 1000);
    }
}



function ambilData(targetDiv, url){
    $.ajax({
        type : "POST",
        url  : url,
        success:function(data){
            $("#"+targetDiv).html(data);
        },
        beforeSend: function() {
            $("#"+targetDiv).html('<center><img src="/images/loading.gif" style="width: 50px;"></center>');
        },
    });
}