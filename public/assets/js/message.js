$(document).ready(function() {
    var userid = $("#id").text();
    var useridsend = $("#idSend").text();
    $("#messageChat").keypress(function(e){
        function updateScroll(){
            var element = document.getElementById("chatContainer");
            element.scrollTop = element.scrollHeight;
        }
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
    $("#upload-files").change(function(){
        var file_name=$("#upload-files").val();
        if(file_name.length !=""){
            $.ajax({
                type: 'POST',
                url:'ajax/ajaxController/files',
                data: new FormData($("#messageChat")[0]),
                contentType: false,
                processData: false,
                success:function(feedback){
                    if(feedback == "success")
                    {
                        alert("u vendos");
                    }
                }
            })
        }
    })
    $("#upload-files").change(function(){
        var scrolled = false;

        if(!scrolled){
            console.log("haleluja")
            var elem = document.getElementById('chatContainer');
            elem.scrollTop =  300;
            console.log('scroll top',elem.scrollTop);
        }


        $("#chatContainer").on('scroll', function(){
            scrolled=true;
        });
        let file_name=$("#upload-files").val();
        let type = file_name.split('.').pop();
        var filename = $('#upload-files').val().replace(/C:\\fakepath\\/i, '')
        alert(filename);
        if(file_name.length !=""){
            $.ajax({
                dataType: 'JSON',
                type: 'POST',
                url:'ajax/ajaxController/ajax',
                data:
                    {
                        fileName:filename,
                        userid: userid,
                        useridsend:useridsend,
                        ajaxCall: "sendfile",
                        type: type
                    },

                success:function(feedback){
                    if(feedback.status=="success")
                    {
                        alert('u vendos');
                    }
                }
            })
        }
    })

});
window.addEventListener('load', (event) => {
    function updateScroll(){
        var element = document.getElementById("chatContainer");
        element.scrollTop = element.scrollHeight;
    }
    setTimeout(updateScroll, 100)
});
