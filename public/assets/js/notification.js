$(document).ready(function()
{
    var userid = $("#id").text();
    var lastid = $("#remainingComment").text();
    function showNotification()
    {
        $.ajax({
            type:'POST',
            url:'ajax/ajaxController/ajax',
            data:
                {
                    lastid: lastid,
                    userid: userid,
                    ajaxCall: "countNotifications"
                },

            success: function(feedback) {
                try {
                    var f = JSON.parse(feedback);
                    console.log(f.lastid);
                    $("#notification").html(f.number);
                } catch (err) {
                    // 👇️ This runs
                    console.log('Error: ', err.message);
                }

            }
        })
    }

    showNotification();

    $("#notification").click(function(){

        $.ajax({
            type:'POST',
            url:'ajax/ajaxController/ajax',
            data:
                {
                    userid: userid,
                    lastid:lastid,
                    ajaxCall: "addLastNumber"
                },

            success: function(feedback){
                var f = JSON.parse(feedback)
                $("#notification").html(f.number);
                $("#remainingComment").html(f.lastid);
            }
        })
    });

});



