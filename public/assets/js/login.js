$(document).ready(function(){
    $("#hember").click(function(e){
        e.preventDefault();
        $("#sidebar").slideToggle(500, function() {
            if ($(this).css('display') == 'none') {

                $(this).css('display', '');
            }
        });
    });
});

let image = document.getElementById("myImage");
let label = document.getElementById("imageLabel");

image.addEventListener("change", function(){
    let imageName = image.value;
    let onlyName = imageName.split("\\");
    label.innerText = onlyName[2];
})