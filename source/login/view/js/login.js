$(document).ready(function () {
  $("#form-login").submit(function (e) {
    e.preventDefault();

    const form = $(this);

    if ($("#email").val() === "" || $("#passw").val() === "") {
      $("#message")
        .removeAttr("hidden")
        .html("Preencha todos os campos para prosseguir.");
    } else {
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
          console.log(e);
        },
      });
    }
  });

  $("#register-user").submit(function (e) {
    e.preventDefault();

    const formUser = $(this);
    const arrayFields = formUser.serializeArray();

    if (passwordEquals(arrayFields)) {
      arrayFields.splice(2, 1);

      $.ajax({
        type: "POST",
        url: formUser.action,
        data: arrayFields,
        success: function (response) {
          console.log(response);
        },
        error: function (e) {
          console.log("Erro" + e);
        },
      });
      
    } else {
      console.log("Não são iguais");
    }
  });

  function passwordEquals(form) {
    if (form[1].value === form[2].value) {
      return true;
    } else {
      return false;
    }
  }
});
