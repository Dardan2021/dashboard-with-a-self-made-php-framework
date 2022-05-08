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

                var tableValues = JSON.parse(tableValue);
                var tableValue = tableValues.datas;
                console.log(tableValue);
                var imgSrc = tableValues.imgSrc;
                console.log(imgSrc);

                $(".number").remove();
                $(".results").append("<span class='number'>"+tableValue.length+"</span>");
                $(".fullName").remove();
                $("img .fullName").remove();
                $(".button").remove();
                let resultCount= tableValue.length/2
                let count = Math.ceil(resultCount)
                $("#count").val(count);

                for(let i=0;i<count;i++)
                {

                    $("#main").append("<button class='button button"+i+"'>"+i+"</button>");

                    let tmpCount = document.querySelector("#count").value
                    console.log("valueis"+tmpCount);

                    $('.button'+i).click(function (e) {
                        $('.fullName'+i).removeClass("none")
                        for(let k=0;k<i;k++)
                        {
                            $('.fullName' + k).addClass("none")
                        }
                        for(let z=i+1;z<count;z++)
                        {
                            $('.fullName' + z).addClass("none")
                        }
                    });

                    for(let j=0;j<2;j++)
                    {
                        if(tableValue[2*i+j].full_name !='undefined')
                        {
                            $("#email").append("<img src='https://localhost/integrateChat/public/uploadFile/"+imgSrc[2*i+j]+"' class='fullName"+i+" fullName profileSearchImage'>");
                            $("#email").append("<p class='fullName fullName"+i+"' ><a href='viewProfile?name="+tableValue[2*i+j].full_name+"&id="+tableValue[2*i+j].id+" '>"+tableValue[2*i+j].full_name+"</a></p>");
                            $("#email").append("<p class='fullName fullName"+i+"'>"+tableValue[2*i+j].email+"</p>");
                        }
                        else
                        {
                            console.log('none')
                        }

                        if(i>0)
                        {
                            $('.fullName'+i).addClass("none")
                        }
                    }

                }
            }
        })
    });

});



