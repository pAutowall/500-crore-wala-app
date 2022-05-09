$(".course-preview").click(function () {
    window.open(`https://maps.google.com/?q=${$(this).attr("data")}`, "_blank").focus();
});
