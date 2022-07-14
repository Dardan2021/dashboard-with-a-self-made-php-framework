$(document).ready(function() {

    $("#messagecommentBox").keypress(function(e){
        console.log("hello world")
        var userid = $("#id").text();
        var useridsend = $("#idSend").text();

        if(e.keyCode==13) {

            var comment = $("#commentBox").val();
            var userid = $("#id").text();
            var useridsend = $("#idSend").text();

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
                            showCommentStatus();
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

    function showCommentStatus()
    {
        var msg=true;
        var userid = $("#id").text();
        var useridsend = $("#idSend").text();
        var element1 = document.getElementById("chatContainer");

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

    showCommentStatus();
    let commentDisplayId;

    function showComment(commentDisplayId)
    {
        var userid = $("#id").text();
        var useridsend = $("#idSend").text();
        var commentDisplayId2 = commentDisplayId.substring(14);
        $.ajax({
            type:'POST',
            url:'ajax/ajaxController/ajax',
            data:
                {
                    userid: userid,
                    useridsend:useridsend,
                    ajaxCall: "showComment",
                    commentDisplayId:commentDisplayId2
                },
            success: function(feedback) {
                $("#"+commentDisplayId).html(feedback);
            }
        })
    }

    function showComment2()
    {
        var inputs = document.getElementsByTagName("div");
        for (var i = 0; i < inputs.length; i++)
        {
            if(inputs[i].id.includes("sectionComment"))
            {
                showComment(inputs[i].id);
            }
        }
    }
    function keypress()
    {
        var inputs = document.getElementsByTagName("div");
        for (var i = 0; i < inputs.length; i++)
        {
            if(inputs[i].id.includes("sectionForm"))
            {
                showComment(inputs[i].id);
            }
        }
    }
    let formId;

    const onKey = (event) => {
        let textId = event.target.id;
        let result = textId.includes("sectionText");

        var commentId = textId.substring(11)
        var fullCommentID = "sectionComment"+commentId;
        var formSection = "sectionForm"+commentId;
        console.log('comment id is',fullCommentID);

        if(result)
        {
            console.log("hello world")
            if(event.keyCode==13)
            {
                var comment = $("#"+event.target.id).val();
                var userid = $("#id").text();
                var useridsend = $("#idSend").text();

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
                                commentId:commentId,
                                ajaxCall: "sendComment"
                            },
                        dataType: 'JSON',
                        success: function(feedback){
                            if(feedback.status=="success")
                            {
                                showComment(fullCommentID);
                                $("#"+formSection).trigger("reset");
                            }
                        }
                    } )
                }
                else
                {
                    return false;
                }
            }
        }
    }

    window.addEventListener('keypress', onKey);

    window.addEventListener('load', (event) => {
        setTimeout(showComment2, 100)
        setInterval(function(){
            showComment2();
        },1000);
    })

    window.addEventListener('keypress', (event) => {
        setTimeout(showComment2, 100)
        setInterval(function(){
            showComment2();
        },1000);
    });
})

