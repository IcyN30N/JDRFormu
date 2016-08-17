$(document).ready(function () {
    $("select").change(function () {
        var genTypeVal = $("select").val();
        $("h1").text(genTypeVal);
    });
});