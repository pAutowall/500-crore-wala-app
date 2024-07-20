$("#trackingButton").click(function() {
    $("body").remove("#trackingModal");
    generate_tracking_modal_html($(this).data("ajax-data"));
    $("body").find("#trackingModal").modal();
});

function generate_tracking_modal_html(requestId) {
    var modalHtml = `
        <div class="modal fade" id="trackingModal" tabindex="-1" role="dialog" aria-labelledby="trackingModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="trackingModalLabel">Add Tracking Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Tracking Link: </label>
                                <input type="text" class="form-control" id="trackingInfo" placeholder="https://glympse.com/0WMM-HW5N">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="divClose btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="trackingModalSubmit" type="button" class="btn btn-primary" data-ajax-data="${requestId}">Submit</button>
                    </div>

                </div>
            </div>
        </div>
    
    `;
    $("body").append(modalHtml);
}

$(document).on("click", "#trackingModalSubmit", function() {
    var requestId = $(this).data("ajax-data");
    var self = $(this);
    request = $.ajax({
        type: "POST",
        url: "api.php",
        data: { requestId: requestId, trackingLink: $("#trackingModal").find("#trackingInfo").val(), actionType: "addtracking" },
        success: function(result) {
            console.log(result);
            $.toast("success", JSON.parse(result).message);
            self.closest(".modal-content").find(".divClose").click();
            setTimeout(() => {
                window.location.reload()
            }, 1000);
        },
        error: function(jqXHR, exception) {
            console.log(exception);
        },
    });
});

$("#locationReachedButton").click(function() {
    var requestId = $(this).data("ajax-data");
    request = $.ajax({
        type: "POST",
        url: "api.php",
        data: { requestId: requestId, deliveryStatus: 3, actionType: "updateDeliveryStatus" },
        success: function(result) {
            console.log(result);
            $.toast("success", JSON.parse(result).message);
            setTimeout(() => {
                window.location.reload()
            }, 1000);
        },
        error: function(jqXHR, exception) {
            console.log(exception);
        },
    });
});

$("#completeRequestButton").click(function() {
    var requestId = $(this).data("ajax-data");
    request = $.ajax({
        type: "POST",
        url: "api.php",
        data: { requestId: requestId, deliveryStatus: 4, actionType: "updateDeliveryStatus" },
        success: function(result) {
            console.log(result);
            $.toast("success", JSON.parse(result).message);
            setTimeout(() => {
                window.location.reload()
            }, 1000);
        },
        error: function(jqXHR, exception) {
            console.log(exception);
        },
    });
});