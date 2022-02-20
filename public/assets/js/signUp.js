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
                console.log(errorMsg.status);
                if($('#errorAuthenticationText').length === 0)
                {
                    $("#errorAuthentication").append("<p id='errorAuthenticationText'></p>");
                    $("#errorAuthenticationText").append(errorMsg);
                }
                else if(errorMsg.status=="success")
                {
                    location.href = "https://localhost/integrateChat/profile";
                }
            }
        })
    });
});



// $(document).ready(function(){
//
//     function objectifyForm(formArray) {
//         //serialize data function
//         var returnArray = {};
//         for (var i = 0; i < formArray.length; i++){
//             returnArray[formArray[i]['name']] = formArray[i]['value'];
//         }
//         return returnArray;
//     }
//
//     // $( "#searchForm" ).submit(function(e) {
//     //
//     //     var str = $( "#searchForm" ).serializeArray();
//     //     var newArray = objectifyForm(str);
//     //     e.preventDefault();
//     //     $.ajax({
//     //         type:'POST',
//     //         url:'ajax/ajaxController/ajax',
//     //         data:
//     //             {
//     //                 formData: JSON.stringify(newArray),
//     //                 ajaxCall: "searchUser"
//     //             },
//     //         success: function( tableValue )
//     //         {
//     //             var tableValue = JSON.parse(tableValue);
//     //
//     //             $(".number").remove();
//     //
//     //             $(".numberCount").remove();
//     //             $(".results").append("<span class='number'>"+tableValue.length+"</span>");
//     //             let resultCount= tableValue.length/2
//     //             let count = Math.ceil(resultCount)
//     //
//     //             for(let i=0;i<count;i++)
//     //             {
//     //                 $('.fullName'+i).remove();
//     //             }
//     //             for(let i=0;i<count;i++)
//     //             {
//     //                 $(".button"+i)
//     //                 if( $(".button"+i) != null)
//     //                 {
//     //                     $(".button"+i).remove();
//     //                 }
//     //
//     //                 $("#main").append("<button class='button"+i+"'>"+i+"</button>");
//     //
//     //                 for(let j=0;j<2;j++)
//     //                 {
//     //                     if(tableValue[2*i+j].full_name != undefined && tableValue[2*i+j].full_name != null)
//     //                     {
//     //                         $("#email").append("<p class='fullName"+i+"'>"+tableValue[2*i+j].full_name+"</p>");
//     //                     }
//     //                     // if(i>0)
//     //                     // {
//     //                     //     $('.fullName'+i).addClass("none")
//     //                     // }
//     //                 }
//     //             }
//     //             // $(".count").append("<span class='numberCount'>"+count+"</span>");
//     //             // $(".numberCount").addClass("none")
//     //         }
//     //     })
//     // });
//
//     // let tmpCount = document.getElementById("count")
//     // console.log(tmpCount.inne)
//     //
//     // $('.click-me').click(function (event) {
//     //
//     //     // Don't follow the link
//     //     event.preventDefault();
//     //
//     //     // Log the clicked element in the console
//     //     console.log(event.target);
//     //
//     // });
//
// });


