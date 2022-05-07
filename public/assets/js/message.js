$(document).ready(function() {
    function updateScroll(){
        var element = document.getElementById("chatContainer");
        element.scrollTop = element.scrollHeight;
    }
    var userid = $("#id").text();
    var useridsend = $("#idSend").text();
    $("#messageChat").keypress(function(e){

        setTimeout(updateScroll, 100)
        if(e.keyCode==13) {

            var send_message = $("#textMessage").val();
            var userid = $("#id").text();
            var useridsend = $("#idSend").text();

             if(send_message!="")
             {

                 $.ajax({
                     type :'POST',
                    url:'ajax/ajaxController/ajax',
                     data:
                         {
                             send_message: send_message,
                             userid: userid,
                             useridsend:useridsend,
                             ajaxCall: "sendMessage"
                         },
                     dataType: 'JSON',
                     success: function(feedback){
                         if(feedback.status=="success"){
                             $("#messageChat").trigger("reset");
                             show_message();

                         }
                     }
                 } )
             }
             else
             {

                 return false;
             }
        }
        else
        {
            myStop();
        }
    })

    function show_message(){
        var msg=true;
        var userid = $("#id").text();
        var useridsend = $("#idSend").text();
        $.ajax({
            type:'POST',
            url:'ajax/ajaxController/ajax',
            data:
                { userid: userid,
                    useridsend:useridsend,
                    send_message: msg,
                    ajaxCall: "showMessage"
                },
            success: function(feedback){
                $(".chatContainer").html(feedback);
            }
        })
    }
    show_message();
    // setInterval(function(){
    //     show_message();
    // },1000);

    $("#addFriend").click(function(){
        $.ajax({
            type:'POST',
            url:'ajax/ajaxController/ajax',
            data:
                {
                    userid: userid,
                    useridsend:useridsend,
                    ajaxCall: "addFriendship"
                },
            dataType: 'JSON',
            success: function(feedback){
                console.log(feedback.status);
                if(feedback.status=="success")
                {
                    location.reload(true);
                }
            }
        })
    });
    $("#removeFriend").click(function(){
        console.log("hello");
        $.ajax({
            type:'POST',
            url:'ajax/ajaxController/ajax',
            data:
                {
                    userid: userid,
                    useridsend:useridsend,
                    ajaxCall: "removeFriendship"
                },
            dataType: 'JSON',
            success: function(feedback){
                console.log(feedback)
                console.log(feedback.status);
                if(feedback.status=="success")
                {
                    location.reload(true);
                }
            }
        })
    });
});
window.addEventListener('load', (event) => {
    function updateScroll(){
        var element = document.getElementById("chatContainer");
        element.scrollTop = element.scrollHeight;
    }
    setTimeout(updateScroll, 100)
});
