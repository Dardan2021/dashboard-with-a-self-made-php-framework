if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
$(document).ready(function() {
    function updateScroll(){
        var element = document.getElementById("chatContainer");
        element.scrollTop = element.scrollHeight;
    }
    var userid = $("#id").text();
    var useridsend = $("#idSend").text();

    $("#upload-files").change(function(){
        var file_name=$("#upload-files").val();
        if(file_name.length !=""){
            $.ajax({
                type: 'POST',
                url:'ajax/fileAjaxController/files',
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
                    setTimeout(updateScroll, 1000)
                }
            })
        }
    })
    $("#formChangePhoto").submit(function(e){
        var file_name=$("#myImage").val();
        var filename = file_name.replace(/C:\\fakepath\\/i, '')
        console.log(file_name)
        if(file_name.length !=""){
            $.ajax({
                type: 'POST',
                url:'ajax/fileAjaxController/filesProfile',
                data: new FormData($("#formChangePhoto")[0]),
                contentType: false,
                processData: false,
                success:function(feedback){

                    if(feedback == "success")
                    {
                        alert("u vendos");
                    }
                }
            })
            $.ajax({
                type: 'POST',
                url:'ajax/ajaxController/ajax',
                data:
                    {
                        userid: userid,
                        ajaxCall: "sendPicture",
                        fileName:filename,
                    },
                success:function(feedback){

                    if(feedback == "success")
                    {
                        location.reload(true);
                    }
                }
            })
        }
    })
    $("#changePassword").submit(function(e){

        var current_password=$("#currentPassword").val();
        var new_password=$("#newPassword").val();

        $.ajax({
            type: 'POST',
            url:'ajax/ajaxController/ajax',
            data:
                {
                    currentPassword: current_password,
                    newPassword: new_password,
                    ajaxCall: "changePassword",
                    userid :userid,
                },
            success:function(feedback){

                if(feedback == "success")
                {
                    alert("well done")
                }
                else if(feedback == "error")
                {
                    alert("not done")
                }
            }
        })
    })
    $("#changeNameForm").submit(function(e){
        e.preventDefault()
        var newName=$("#newName").val();

        $.ajax({
            type: 'POST',
            url:'ajax/ajaxController/ajax',
            data:
                {
                    newName: newName,
                    ajaxCall: "changeName",
                    userid :userid,
                },
            dataType: 'JSON',
            success:function(feedback){

                if(feedback.status=="success")
                {
                    document.getElementById("profileName").innerHTML = feedback.name;
                }
            }
        })
    })
});
