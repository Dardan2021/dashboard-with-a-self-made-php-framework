/*
$(document).ready(function() {
    $("#messageChat").keypress(function(e){
        if(e.keyCode==13){
            var send_message=$("#textMessage").val();

            if(send_message.length!=""){

                $.ajax({
                    type :'POST',
                    url:'ajax/ajaxController/ajax',
                    data:
                        {
                            send_message: send_message,
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
            else  {
                alert("su be");}
            }
    })
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
                $(".messages").html(feedback);
            }
        })
    }
});


*/
