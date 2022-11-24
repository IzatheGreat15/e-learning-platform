var current = $("#current").text();

$(document).ready(() => {
    $("#"+current).attr("src", "images/"+ current +"-white.png");
    $("#"+current).closest("div").addClass("icon-active");
    
    // for mobile devices
    $("#"+current+"-mobile").attr("src", "images/"+ current +"-white.png");
    $("#"+current+"-mobile").closest("div").addClass("icon-active");
});

$(".icon-container").mouseenter((e) => {
    var icon = $(e.currentTarget).find("img").attr("alt");

    if(icon != current){
        $(e.currentTarget).css("background-color", "#0D4C92");
        $(e.currentTarget).find("img").attr("src", "images/"+icon+"-white.png");
    }
});
$(".icon-container").mouseleave((e) => {
    var icon = $(e.currentTarget).find("img").attr("alt");
  
    if(icon != current){
        $(e.currentTarget).css("background-color", "white");
        $(e.currentTarget).find("img").attr("src", "images/"+icon+"-blue.png");
    }
});

// menu buttons
$(".more").click(() => {
    $(".course-navbar").slideToggle();
    $(".course-navbar").addClass("blue");
    $(".course-navbar .link").css("color", "white");
});