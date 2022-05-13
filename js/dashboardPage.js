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

$("#editModal").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var ajaxData = button.data("ajax-data"); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);
    modal.find("#requestType").val(ajaxData.requestType);
    modal.find("#location").val(ajaxData.location);
    modal.find("#expiry").val(ajaxData.expiry);
    modal.find("#foodDescription").val(ajaxData.foodDetails.replace("<br>", /\n/g));
});

$("#applyModal #applyModalSubmit").click(function () {
    var modal = $("#applyModal");

    let foodId = $(this).data().foodId;
    let message = modal.find("textarea").val().replace(/\n/g, "<br>");

    $.post("api.php", { foodId: foodId, message: message, actionType: "applypage" }, function (result) {
        console.log(result);
    });
});

$("#editModal #editModalSubmit").click(function () {
    var modal = $("#editModal");
    let foodId = $(this).data().foodId;
    // let message = modal.val().replace(/\n/g, "<br>");

    var requestType = modal.find("#requestType").val();
    var location = modal.find("#location").val();
    var expiry = modal.find("#expiry").val();
    var foodDetails = modal.find("#foodDescription").val().replace(/\n/g, "<br>");

    $.post("api.php", { foodId: foodId, message: message, actionType: "editModal" }, function (result) {
        console.log(result);
    });
});
