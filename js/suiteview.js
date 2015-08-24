/**
 * Created by Jr Reyes on 7/15/15.
 */
$(document).ready(function () {
    if(window.location.href.indexOf("index.php") >= 0) {
        var res = window.location.href.replace("index.php", "");
        window.location = res;
    }
    $(".button-collapse").sideNav();
});

