$(document).ready(function() {

    $("#messagecommentBox").keypress(function(e){
        console.log("hello world")
        var userid = $("#id").text();
        var useridsend = $("#idSend").text();

        if(e.keyCode==13) {

            var comment = $("#commentBox").val();
            var userid = $("#id").text();
            var useridsend = $("#idSend").text();
            console.log(comment)
            console.log(userid)
            console.log(useridsend)
            if(comment!="")
            {
                $.ajax({
                    type :'POST',
                    url:'ajax/ajaxController/ajax',
                    data:
                        {
                            comment: comment,
                            userid: userid,
                            useridsend:useridsend,
                            ajaxCall: "sendCommentStatus"
                        },
                    dataType: 'JSON',
                    success: function(feedback){
                        if(feedback.status=="success")
                        {
                            $("#messagecommentBox").trigger("reset");
                            showComment()
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

    function showComment()
    {
        var msg=true;
        var userid = $("#id").text();
        var useridsend = $("#idSend").text();
        var element1 = document.getElementById("chatContainer");
        var element1Height = element1.scrollHeight;
        $.ajax({
            type:'POST',
            url:'ajax/ajaxController/ajax',
            data:
                {
                    userid: userid,
                    useridsend:useridsend,
                    send_message: msg,
                    ajaxCall: "showCommentStatus"
                },
            success: function(feedback) {
                $("#commentStatusContainer").html(feedback);
            }
        })
    }
    showComment();
})