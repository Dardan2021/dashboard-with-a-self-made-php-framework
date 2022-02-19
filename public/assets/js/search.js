$(document).ready(function(){


    function objectifyForm(formArray) {
        //serialize data function
        var returnArray = {};
        for (var i = 0; i < formArray.length; i++){
            returnArray[formArray[i]['name']] = formArray[i]['value'];
        }
        return returnArray;
    }

    $( "#searchForm" ).submit(function(e) {

        var str = $( "#searchForm" ).serializeArray();
        var newArray = objectifyForm(str);
        e.preventDefault();
        $.ajax({
            type:'POST',
            url:'ajax/ajaxController/ajax',
            data:
                {
                    formData: JSON.stringify(newArray),
                    ajaxCall: "searchUser"
                },
            success: function( tableValue )
            {

                var tableValue = JSON.parse(tableValue);
                $(".number").remove();
                $(".results").append("<span class='number'>"+tableValue.length+"</span>");

                for(var i=0;i<tableValue.length;i++)
                 {
                     $("#email").append("<p class='fullName'>"+tableValue[i].full_name+"</p>");
                 }
                let parent = document.getElementById('email');
                console.log(tableValue.length);
                if(parent.children.length != tableValue.length+1)
                {
                   $(".fullName").remove();
                   $(".number").remove();

                   $(".results").append("<span class='number'>"+tableValue.length+"</span>");
                   for(var i=0;i<tableValue.length;i++)
                   {
                       $("#email").append("<p class='fullName'>"+tableValue[i].full_name+"</p>");
                   }
                }
                if(tableValue.length==0)
                {
                    $(".number").remove();
                    $(".results").append("<span class='number'>"+tableValue.length+"</span>");
                }
            }
        })
    });
});
