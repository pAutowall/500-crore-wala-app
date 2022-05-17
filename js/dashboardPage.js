$(".course-preview,#locationButton").on("click", function () {
    window.open(`https://maps.google.com/?q=${$(this).attr("data")}`, "_blank").focus();
});
// $(".fra").on("click", function() {
//     console.log("Hi");
//     $("#frame").toggle();

// });

$("#load").click(function () {
    var new_url = $("#url").val();
    $("#main_frame").attr("src", new_url);
});
// $(".btn#locationButton").on("click", function() {

//     window.open(`https://maps.google.com/?q=${$(this).attr("data")}`, "_blank").focus();
// });
$(document).ready(async function () {
    $("#expiry").datetimepicker();
});
$("#applyModal").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var ajaxData = button.data("ajax-data");
    var modal = $(this);

    modal.find(".modal-title").text("Apply for donation");
    modal.find(".modal-body input").val(ajaxData.foodDisplayId);

    modal.find("#applyModalSubmit").data(ajaxData);
});

$("#editModal").on("show.bs.modal", function (event) {
    var button = $(event.relatedTarget);
    var ajaxData = button.data("ajax-data");
    var modal = $(this);

    modal.find("#requestType").val(ajaxData.requestType);
    modal.find("#location").val(ajaxData.location);
    modal.find("#expiry").val(ajaxData.expiry);
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

$("#applyModal #applyModalSubmit").click(function () {
    var modal = $("#applyModal");
    var self = $(this);

    var foodId = $(this).data().foodId;
    var message = modal.find("textarea").val().replace(/\n/g, "<br>");

    $.post("api.php", { foodId: foodId, message: message, actionType: "apply" }, function (result) {
        console.log(result);
        self.parent().find(".divClose").click();
        $.toast("success", JSON.parse(result).message);
    });
});

$("#editModal #editModalSubmit").click(function () {
    var modal = $("#editModal");
    var self = $(this);

    var foodId = $(this).data().foodId;

    var location = modal.find("#location").val();
    var expiry = modal.find("#expiry").val();
    var foodDetails = modal.find("#foodDescription").val().replace(/\n/g, "<br>");

    var postData = {
        foodId,
        expiry,
        location,
        foodDetails,
        actionType: "edit",
    };

    $.post("api.php", postData, function (result) {
        self.parent().find(".divClose").click();
        $.toast("success", JSON.parse(result).message);
    });
});

$("#viewButton").click(function () {
    var foodId = $(this).parent().find("#editButton").data("ajax-data").foodId;
    request = $.ajax({
        type: "POST",
        url: "api.php",
        data: { foodId: foodId, actionType: "view" },
        success: function (result) {
            console.log(result);
            $("#viewModal").remove();
            generate_view_modal_html(JSON.parse(result).data);
            $("body").find("#viewModal").modal();
        },
        error: function (jqXHR, exception) {
            console.log(exception);
        },
    });
});

function generate_view_modal_html(data) {
    var trHtml = "";
    data.forEach((request, ind) => {
        trHtml += `
            <tr>
                <th scope="row">${ind + 1}</th>
                <td>${request.requestorName}</td>
                <td>${request.details}</td>
                <td>
                    <button class="btn btn-success"><i class="bi bi-check2" style="font-size: 20px;"></i></button>
                    <button class="btn btn-danger"><i class="bi bi-x" style="font-size: 20px;"></i></button>
                </td>
            </tr>
        `;
    });
    var modalHtml = `
        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewModalLabel">View Requests</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${trHtml}
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="divClose btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    
    `;
    $("body").append(modalHtml);
}
