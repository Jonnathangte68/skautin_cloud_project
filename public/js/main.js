$(".alert-danger").fadeTo(2000, 500).slideUp(500, function () {
    $(".alert-danger").slideUp(500);
});
$(".alert-success").fadeTo(2000, 500).slideUp(500, function () {
    $(".alert-success").slideUp(500);
});

$(document).ready(function () {
    history.replaceState(null, document.title, location.pathname + "#!/welcome");
    history.pushState(null, document.title, location.pathname);
    window.addEventListener("popstate", function () {
        if (location.hash === "#!/welcome") {
            history.replaceState(null, document.title, location.pathname);
            setTimeout(function () {
                location.replace(`${window.location.protocol + '// ' + window.location.hostname + ((window.location.port) ? ': ' + window.location.port : '')}`);
            }, 0);
        }
    }, false);
});