var current = $("#current").text();

$(document).ready(() => {
    $("#"+current).attr("src", "images/"+ current +"-white.png");
    $("#"+current).closest("div").addClass("icon-active");
    
    // for mobile devices
    $("#"+current+"-mobile").attr("src", "images/"+ current +"-white.png");
    $("#"+current+"-mobile").closest("div").addClass("icon-active");
});

$(".icon-container").mouseenter((e) => {
    var icon = $(e.currentTarget).find("img").attr("id");
    icon = icon.split("-");
    if(icon[0] != current){
        $(e.currentTarget).css("background-color", "#0D4C92");
        $(e.currentTarget).find("img").attr("src", "images/"+icon[0]+"-white.png");
    }
});
$(".icon-container").mouseleave((e) => {
    var icon = $(e.currentTarget).find("img").attr("id");
    icon = icon.split("-");
    if(icon[0] != current){
        $(e.currentTarget).css("background-color", "white");
        $(e.currentTarget).find("img").attr("src", "images/"+icon[0]+"-blue.png");
    }
});