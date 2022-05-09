$(document).ready(async function () {
    console.log("Page Loaded");
});

$(".logo").click(function () {
    window.location.href = "/FoodDonationWebApp/dashboard.php";
});

$("#location").click(function () {
    getLocation();
});

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    $("#location").val(position.coords.latitude + "," + position.coords.longitude);
}
