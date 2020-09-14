$(document).ready(function () {
  $("#form-cad-user").submit(function (e) {
    e.preventDefault();
    sendDataUser();
  });

  $("[modal-delete]").on("click", getListUser());

  $("#list-usuario").on("click", "[delete-user]", deleteUser);

  function getListUser() {
    let url = $("#form-cad-user").attr("action");
    $("#list-usuario tbody tr").remove();

    $.get(url, function (data) {
      let users = JSON.parse(data);

      users = users == null ? [] : users;

      users.map((e) => {
        let row = `<tr>
                      <td>${e.email}</td>
                      <td>
                        <button name='delete-user' value='${e.codigo}' delete-user>
                          <i class="fas fa-trash"></i>Excluir
                        </button>
                      </td>
                    </tr>`;
        $("#list-usuario").append(row);
      });
    });
  }

  function sendDataUser() {
    const formUser = $("#form-cad-user");
    const arrayFields = formUser.serializeArray();

    if (igualsPassword(arrayFields)) {
      arrayFields.splice(2, 1);

      $.ajax({
        type: "POST",
        url: formUser.attr("action"),
        data: arrayFields,
        success: function (response) {
          console.log(response);
          alert("Cadastro de usuário realizado com sucesso");
          $("#form-cad-user")[0].reset();
          getListUser();
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

  function deleteUser() {
    let id = $(this).val();
    let lineButton = $(this);

    $.ajax({
      type: "DELETE",
      url: $("#form-cad-user").attr("action") + "/" + id,
      success: function (response) {
        if (response) {
          alert("Usuário excluido com sucesso");
          lineButton[0].parentElement.parentElement.setAttribute(
            "hidden",
            "hidden"
          );
        } else {
          alert("Erro ao tentar excluir o usuário");
        }
      },
      error: function (error) {
        console.log("Erro: " + error);
      },
    });
  }
});
