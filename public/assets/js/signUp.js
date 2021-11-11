$(document).ready(function(){

    $("#hember").click(function(e){

        $("#sidebar").slideToggle(500, function() {
            if ($(this).css('display') == 'none') {

                $(this).css('display', '');
            }
        });
    });

    function objectifyForm(formArray) {
        //serialize data function
        var returnArray = {};
        for (var i = 0; i < formArray.length; i++){
            returnArray[formArray[i]['name']] = formArray[i]['value'];
        }
        return returnArray;
    }

    $( "#signupForm" ).submit(function(e) {

        var str = $( "#signupForm" ).serializeArray();
        var newArray = objectifyForm(str);

        $.ajax({
            type:'POST',
            url:'ajax/ajaxController/ajax',
            data:
                {
                    formData: JSON.stringify(newArray),
                    ajaxCall: "createUser"
                },
            success: function( errorMsg )
            {
                var errorMsg = JSON.parse(errorMsg);

                if($('#errorNameText').length === 0)
                {
                    $("#errorName").append("<p id='errorNameText'></p>");
                    $("#errorNameText").append(errorMsg.errorName);
                }

                if($('#errorEmailText').length === 0)
                {
                    $("#errorEmail").append("<p id='errorEmailText'></p>");
                    $("#errorEmailText").append(errorMsg.errorEmail);
                }

                if($('#errorPasswordText').length === 0)
                {
                    $("#errorPassword").append("<p id='errorPasswordText'></p>");
                    $("#errorPasswordText").append(errorMsg.errorPassword);
                }

                if(errorMsg.status=="none")
                {
                    location.href = "accountController";
                }
            }
        })
    });


    $( "#loginForm" ).submit(function(e) {

        var str = $( "#loginForm" ).serializeArray();
        var newArray = objectifyForm(str);

        $.ajax({
            type:'POST',
            url:'ajax/ajaxController/ajax',
            data:
                {
                    formData: JSON.stringify(newArray),
                    ajaxCall: "loginUser"
                },
            success: function( errorMsg )
            {
                var errorMsg = JSON.parse(errorMsg);
                if($('#errorAuthenticationText').length === 0)
                {
                    $("#errorEmail").append("<p id='errorAuthentication'></p>");
                    $("#errorAuthenticationText").append(errorMsg);
                }
                if(errorMsg.status=="success")
                {
                    location.href = "https://localhost/dashboard/profile";
                }
            }
        })
    });
});



