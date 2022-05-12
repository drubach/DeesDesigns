function footerPosition() {
    var windowHeight = $(window).height();
    var documentHeight = $(document).height();
    console.log(windowHeight);
    console.log(documentHeight);
        
    if (documentHeight == windowHeight) {
        $("#footer").css({'position': 'fixed', 'bottom': '0px', 'width': '100%'});
    } else {
        $("#footer").css({'position': '', 'bottom': '', 'width': ''});
    }
}

$(document).ready(function() {
    footerPosition();
})

$(window).resize(function() {
    footerPosition();
})