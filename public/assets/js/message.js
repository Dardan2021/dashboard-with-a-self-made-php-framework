function updateScroll(){
    var element = document.getElementById("chatContainer");
    if(element != null)
    {
        element.scrollTop = element.scrollHeight;
    }
}
$(document).ready(function() {

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
                         if(feedback.status=="success")
                         {
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

        }
    })

    function show_message(){
        var msg=true;
        var userid = $("#id").text();
        var useridsend = $("#idSend").text();
        var element1 = document.getElementById("chatContainer");
        if(element1 != null)
        {
            var element1Height = element1.scrollHeight;
        }
        $.ajax({
            type:'POST',
            url:'ajax/ajaxController/ajax',
            data:
                { userid: userid,
                    useridsend:useridsend,
                    send_message: msg,
                    ajaxCall: "showMessage"
                },
            success: function(feedback) {
                $(".chatContainer").html(feedback);
                var element2 = document.getElementById("chatContainer");
                if(element2 != null)
                {
                    var element2Height = element2.scrollHeight;
                    if (element1Height != element2Height)
                    {
                        setTimeout(updateScroll, 100)
                    }
                }

            }
        })
    }
    show_message();
     setInterval(function(){
         show_message();
     },100);

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

    $("#showChat").click(function(){
        console.log("hellos");
        const Chat = document.querySelector('.chatContent');
        const showChat = document.querySelector('.showChat');
        const hideChat = document.querySelector('.removeChat');

        Chat.style.display = 'inline';
        showChat.style.display = 'none';
        hideChat.style.display = 'inline';
    });
    $("#removeChat").click(function(){
        console.log("hellos");
        const Chat = document.querySelector('.chatContent');
        const hideChat = document.querySelector('.removeChat');
        const showChat = document.querySelector('.showChat');

        Chat.style.display = 'none';
        hideChat.style.display = 'none';
        showChat.style.display = 'inline';
    });
});
window.addEventListener('load', (event) => {
    setTimeout(updateScroll, 100)
});
