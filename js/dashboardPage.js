$(".course-preview").click(function () {
    window.open(`https://maps.google.com/?q=${$(this).attr("data")}`, "_blank").focus();
});

$("#applyModal").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var ajaxData = button.data("ajax-data"); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);
    modal.find(".modal-title").text("Apply for donation");
    modal.find(".modal-body input").val(ajaxData.foodDisplayId);
    modal.find("#applyModalSubmit").data(ajaxData);
});
$("#applyModal #applyModalSubmit").click(function () {
    let foodId = $(this).data().foodId;
    let message = $("textarea").val().replace(/\n/g, "<br>");
    console.log(foodId, message);
    $.post("applypage.php", { foodId: foodId, message: message }, function (result) {
        console.log(result);
    });
});
