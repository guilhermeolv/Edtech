<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Teste | Guilherme Oliveira
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <div class="logo"><a href="#" class="simple-text logo-normal">
          Sistema Escolar
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active " id="menuAluno">
            <a class="nav-link" href="#">
              <i class="material-icons">person</i>
              <p>Alunos</p>
            </a>
          </li>
          <li class="nav-item " id="menuCurso">
            <a class="nav-link" href="#">
              <i class="material-icons">book</i>
              <p>Cursos</p>
            </a>
          </li>
          <li class="nav-item " id="menuMatricula">
            <a class="nav-link" href="#">
              <i class="material-icons">school</i>
              <p>Matrícula</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <div class="content" style="margin-top: -11px;">
        <div id="app">
          <div id="tabAluno">
            <alunos-component/>
          </div>
          <div  id="tabCurso" style="display: none">
            <cursos-component/>
          </div>
          <div  id="tabMatricula" style="display: none">
            <matriculas-component/>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="#">
                  Teste criado por Guilherme Oliveira, em 02/05/2021
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </footer>
    </div>
  </div>
  
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="../assets/js/plugins/moment.min.js"></script>

  <script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>


  <script src="{{ asset('js/app.js') }}"></script>
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <script>
    $(document).ready(function() {

      $().ready(function() {
        $('#menuAluno').click(function() {
          $(this).addClass('active');
          $('#menuCurso').removeClass('active');
          $('#menuMatricula').removeClass('active');

          $('#tabAluno').show();
          $('#tabCurso').hide();
          $('#tabMatricula').hide();
        });
        $('#menuCurso').click(function() {
          $(this).addClass('active');
          $('#menuAluno').removeClass('active');
          $('#menuMatricula').removeClass('active');
          $('#tabAluno').hide();
          $('#tabCurso').show();
          $('#tabMatricula').hide();
        });
        $('#menuMatricula').click(function() {
          $(this).addClass('active');
          $('#menuAluno').removeClass('active');
          $('#menuCurso').removeClass('active');
          $('#tabAluno').hide();
          $('#tabCurso').hide();
          $('#tabMatricula').show();
        });
      });
    });
  </script>
</body>

</html>