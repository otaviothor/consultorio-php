$(document).ready(() => {
  $('.sidenav').sidenav();
  $('select').formSelect();
  $('.tabs').tabs();
  $('.dropdown-trigger').dropdown();

  const datepicker = document.querySelector('.datepicker');
  M.Datepicker.init(datepicker, {
    monthsFull: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
    monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
    weekdaysFull: ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'],
    weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
    weekdaysLetter: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
    selectMonths: true,
    selectYears: true,
    clear: false,
    format: 'dd/mm/yyyy',
    closeOnSelect: true
  });

  const timepicker = document.querySelector('.timepicker');
  M.Timepicker.init(timepicker, {
    twelveHour: false
  });
});

function deletarPlano(id) {
  var res = confirm("Deseja realmente excluir esse plano?");
  if (res === true) {
    $.get({
      url: `planoController.php?action=delete&id=${id}`,
      success: response => {
        alert(response);
        location.href = 'verPlanos.php';
      }
    })
  }
}

function deletarEspecialidade(id) {
  var res = confirm("Deseja realmente excluir essa especialidade?");
  if (res === true) {
    $.get({
      url: `especialidadeController.php?action=delete&id=${id}`,
      success: response => {
        alert(response);
        location.href = 'verEspecialidades.php';
      }
    })
  }
}

function deletarMedico(id) {
  var res = confirm("Deseja realmente excluir esse médico?");
  if (res === true) {
    $.get({
      url: `medicoController.php?action=delete&id=${id}`,
      success: response => {
        alert(response);
        location.href = 'index.php';
      }
    })
  }
}

function deletarPaciente(id) {
  var res = confirm("Deseja realmente excluir esse paciente?");
  if (res === true) {
    $.get({
      url: `pacienteController.php?action=delete&id=${id}`,
      success: response => {
        alert(response);
        location.href = 'index.php';
      }
    })
  }
}

function deletarConsulta(id) {
  var res = confirm("Deseja realmente excluir essa consulta?");
  if (res === true) {
    $.get({
      url: `consultaController.php?action=delete&id=${id}`,
      success: response => {
        alert(response);
        location.href = 'index.php';
      }
    })
  }
}