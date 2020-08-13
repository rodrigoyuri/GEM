$(document).ready(function () {

    $("form").submit(function (e) {
        e.preventDefault();

        const form = $(this);

        $.ajax({
            type: "post",
            url: form.attr("action"),
            data: form.serialize(),
            success: function (response) {

                let res = JSON.parse(response);

                if (res.url === window.location.href) {

                    $("#message").removeAttr("hidden").html(res.message);

                } else {
                    window.location.href = res.url;
                }

            },
            error: function (e) {
                alert("Erro" + e);
                console.log(e)
            }
        });

    });

    console.log("Consolo log fora do form");
});