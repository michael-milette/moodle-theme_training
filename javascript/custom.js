// When the user scrolls down 20px from the top of the document, show the button.
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("back-to-top").style.display = "inline-block";
    } else {
        document.getElementById("back-to-top").style.display = "none";
    }
}
