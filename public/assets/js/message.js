

$(document).ready(function() {

    $("#messageChat").keypress(function(e){
        if(e.keyCode==13) {

            var send_message = $("#textMessage").val();
            var userid = $("#id").text();
            var useridsend = $("#idSend").text();
            var scrolled = false;

            if(!scrolled){
                var elem = document.getElementById('chatContainer');
                elem.scrollTop =  elem.scrollHeight - elem.clientHeight;
                console.log(elem.scrollTop);
            }


            $("#chatContainer").on('scroll', function(){
                scrolled=true;
            });
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
    })
    setInterval(function(){
        show_message();
        },3000);


    function show_message(){
        var msg=true;
        $.ajax({
            type:'POST',
            url:'ajax/ajaxController/ajax',
            data:
                {
                    send_message: msg,
                    ajaxCall: "showMessage"
                },
            success: function(feedback){
                $(".chatContainer").html(feedback);
            }
        })
    }
    show_message();
});


window.addEventListener('mouseover', respondHover);
function respondHover()
{

    var scrolled = false;

    if(!scrolled){
        var elem = document.getElementById('chatContainer');
        elem.scrollTop =  elem.scrollHeight - elem.clientHeight;
        console.log(elem.scrollTop);
    }


    $("#chatContainer").on('scroll', function(){
        scrolled=true;
    });
}
function RespondClick()
{
    window.removeEventListener("mouseover", respondHover);
}
RespondClick() ;
