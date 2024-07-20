$(document).ready(async function () {
    $("#expiry").datetimepicker();
});

$("select").on("change", function () {
    if (this.value == "reciever") {
        $("#expiry").parent().hide();
    } else {
        $("#expiry").parent().show();
    }
});
