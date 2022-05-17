$(".course-preview,#locationButton").on("click", function() {
    window.open(`https://maps.google.com/?q=${$(this).attr("data")}`, "_blank").focus();

});
// $(".fra").on("click", function() {
//     console.log("Hi");
//     $("#frame").toggle();

// });


$("#load").click(function() {
    var new_url = $("#url").val();
    $("#main_frame").attr("src", new_url);
});
// $(".btn#locationButton").on("click", function() {

//     window.open(`https://maps.google.com/?q=${$(this).attr("data")}`, "_blank").focus();
// });
$(document).ready(async function() {
    $("#expiry").datetimepicker();
});
$("#applyModal").on("show.bs.modal", function(event) {
    var button = $(event.relatedTarget);
    var ajaxData = button.data("ajax-data");
    var modal = $(this);

    modal.find(".modal-title").text("Apply for donation");
    modal.find(".modal-body input").val(ajaxData.foodDisplayId);

    modal.find("#applyModalSubmit").data(ajaxData);
});

$("#editModal").on("show.bs.modal", function(event) {
    var button = $(event.relatedTarget);
    var ajaxData = button.data("ajax-data");
    var modal = $(this);

    modal.find("#requestType").val(ajaxData.requestType);
    modal.find("#location").val(ajaxData.location);
    modal.find("#expiry").val(ajaxData.expirry);
    modal.find("#foodDescription").val(ajaxData.foodDetails.replace("<br>", /\n/g));

    modal.find("#editModalSubmit").data(ajaxData);
});

// $("#editModal").on("shown.bs.modal", function (event) {
//     $("#expiry").datetimepicker();
//     $(".daterangepicker").css("z-index", "1600");
// });
// $("#editModal").on("hidden.bs.modal", function (event) {
//     $("#expiry").datetimepicker("destroy");
// });

$("#applyModal #applyModalSubmit").click(function() {
    var modal = $("#applyModal");

    let foodId = $(this).data().foodId;
    let message = modal.find("textarea").val().replace(/\n/g, "<br>");

    $.post("api.php", { foodId: foodId, message: message, actionType: "apply" }, function(result) {
        console.log(result);
    });
});

$("#editModal #editModalSubmit").click(function() {
    var modal = $("#editModal");
    let foodId = $(this).data().foodId;
    // let message = modal.val().replace(/\n/g, "<br>");

    var requestType = modal.find("#requestType").val();
    var location = modal.find("#location").val();
    var expirry = modal.find("#expiry").val();
    var foodDetails = modal.find("#foodDescription").val().replace(/\n/g, "<br>");

    var postData = {
        foodId,
        expirry,
        location,
        foodDetails,
        actionType: "edit",
    };

    $.post("api.php", postData, function(result) {
        console.log(result);
    });
});