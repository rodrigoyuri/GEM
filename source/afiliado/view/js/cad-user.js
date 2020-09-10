$(document).ready(function () {
  $("#form-cad-user").submit(function (e) {
    e.preventDefault();
    sendDataUser();
  });

  function sendDataUser() {
    const formUser = $("#form-cad-user");

    if (igualsPassword(formUser.serializeArray())) {
      $.ajax({
        type: "POST",
        url: formUser.attr("action"),
        data: formUser.serializeArray(),
        success: function (response) {
          console.log(response);
          alert("Cadastro de usuário realizado com sucesso");
        },
        error: function (error) {
          console.log("Erro " + error);
        },
      });
    } else {
      alert(
        "Senhas diferentes ou campos vazios, por favor verifique de novo antes de realizar o cadastro"
      );
    }
  }

  function igualsPassword(elemet) {
    if (
      elemet[1].value !== "" &&
      elemet[2].value !== "" &&
      elemet[1].value == elemet[2].value
    ) {
      return true;
    } else {
      return false;
    }
  }

  function cancelForm() {
    $(".modal-container").addClass("modal-hidden");
    $("#form-cad-user")[0].reset();
  }
});
