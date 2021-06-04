<html>
<head> 
  <meta charset="utf-8">
  <meta charset="utf-8">
  <meta name="theme-color" content="#780FA9">
  <link rel="stylesheet" href="views/assets/css/captura.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/@mediapipe/camera_utils/camera_utils.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@mediapipe/control_utils/control_utils.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@mediapipe/drawing_utils/drawing_utils.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@mediapipe/face_mesh@0.3.1620080371/face_mesh.js" crossorigin="anonymous"></script> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
  <a href="#content" id="roll"></a>
  <div class="container">
    <div class="top">
        Simetric Calc
    </div>

    <div class="content" id="content">
      <div class="legenda" id="instruction">
        Carregando a camera. Aguarde...
      </div>

      <!-- <div>
          <button id="start-button">Iniciar Captura</button>
          <button id="show-points-nottingham">Mostrar Pontos de Nottingham</button>
          <button id="show-landmarks">Mostrar Pontos Faciais</button>
          <strong id="instruction"></strong>
        </div> -->
        
        <div class="canva-container">
          <canvas class="output_canvas" id="canva" width="680px" height="680px"></canvas>
          <img id="load-camera" alt="Carregando Camera" src="views/assets/images/load-camera.gif"/>
          <div id="load-dados">
            <img alt="Carregando Dados" src="views/assets/images/carregando-informacoes.gif"/>
            <h2>Carregando dados</h2>
          </div>
          <img id="contorno-img" alt="Contorno" src="views/assets/images/contorno-vermelho.png"/>
          
        </div>

        <div class="menu-capture" id="menu-capture">
          <img src="views/assets/images/icon-stop.png"/>
          <img src="views/assets/images/icon-help.png"/>
        </div>

        <div class="menu-final" id="menu-final">
          <a href="captura.php" id="button-new-capture" class="button">
              Nova Captura
          </a>
          <button id="button-results" class="button" > 
            Continuar
          </button>
        </div>
          
        
        <div class="status" id="status">
          <div class="status-img">
            <img id="status-0" src="views/assets/images/user-load-0.png">
            <img id="status150-0" src="" width="150px" height="150px" style="display:none">
            <img id="status50-0" src="" width="50px" height="50px" style="display:none">
            <h5>Repouso</h5>
          </div>
          <div class="status-img">
            <img id="status-1" src="views/assets/images/user-load-0.png">
            <img id="status150-1" src="" width="150px" height="150px" style="display:none">
            <img id="status50-1" src="" width="50px" height="50px" style="display:none">
            <h5>Sobrancelhas Erguidas</h5>
          </div>
          <div class="status-img">
            <img id="status-2" src="views/assets/images/user-load-0.png">
            <img id="status150-2" src="" width="150px" height="150px" style="display:none">
            <img id="status50-2" src="" width="50px" height="50px" style="display:none">
            <h5>Sorrindo</h5>
          </div>
          <div class="status-img">
            <img id="status-3" src="views/assets/images/user-load-0.png">
            <img id="status150-3" src="" width="150px" height="150px" style="display:none">
            <img id="status50-3" src="" width="50px" height="50px" style="display:none">
            <h5>Olhos precionados</h5>
          </div>
        </div>

        <div class="results" id="results"></div>
        <button id="button-start-capture" class="button" disabled="disabled"> 
          Iniciar Captura
        </button>
        <!-- <img class="input_video_2" src="./service/images/228-Repouso-04-06-2021-02-06-15-749002.png" width= "400px"/> -->
        <video class="input_video"></video>
      
    </div>

    
    
  </div>

  <?php
    $tecnica = $_GET['tecnica'];
    $url = "";
    if($tecnica == "nottingham")
      $url = "resultados-nottingham.php";
    else if($tecnica == "proporcao-radial")
      $url = "resultados-proporcao-radial.php";
    else if($tecnica == "razao-aurea")
      $url = "resultados-razao-aurea.php";
  ?>

  <div class="m-modal" id="m-modal-load-data">
        <div class="m-modal-title">
          Todos os dados foram carreados.
        </div>
        <div class="m-modal-content">
          <form method="post" action="<?=$url?>">
            <input type="hidden" name="data" id="input-data"/>
            <input type="submit" class="button" value="Ver Resultados"> 
              
        </form>
        </div>
      </div>
</body>
</html>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
<script src="./app.js" type="module"></script>


