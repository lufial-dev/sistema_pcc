<?php
    $params = $_POST['data'];
    $array = json_decode($params, true);
?>

<html>
  <head> 
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="theme-color" content="#780FA9">
    <link rel="stylesheet" href="views/assets/css/resultados-nottingham.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  </head>

  <body>
    <div class="container">
      <div class="top">
        Simetric Calc
      </div>

      <div class="content" id="content">
        <h1 class="title">Nottingham</h1>
        
        <?php 
          foreach ($array as $item){
            $image = str_replace(" ", "+", $item["image"]);
            $mimica = $item["mimica"];

            $supraorbitalDir = $item["face"]["nottingham"]["supraorbitalDir"];
            $supraorbitalEsq = $item["face"]["nottingham"]["supraorbitalEsq"];
            $infraorbitalDir = $item["face"]["nottingham"]["infraorbitalDir"];
            $infraorbitalEsq = $item["face"]["nottingham"]["infraorbitalEsq"];
            $cantoLateralEsq = $item["face"]["nottingham"]["cantoLateralEsq"];
            $cantoLateralDir = $item["face"]["nottingham"]["cantoLateralDir"];
            $comissuraLabialEsq = $item["face"]["nottingham"]["comissuraLabialEsq"];
            $comissuraLabialDir = $item["face"]["nottingham"]["comissuraLabialDir"];
        ?>

        <div class="mySlides">
          <div class="top-data">
            <div class='top-data-left'>
              <h1><?=$mimica?></h1>
              <img src=<?=$image?>>
              <button class="w3-button w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
              <button class="w3-button w3-display-right" onclick="plusDivs(+1)">&#10095;</button>
            </div>

            <div class="top-data-right">
              <div class='results'>
                <h2>Lado Direito</h2>
                <div>
                  <h1>SO para IO</h1>
                  <h3>28 pontos</h3>
                </div>
                <div>
                  <h1>LC para IM</h1>
                  <h3>44,2 pontos</h3>
                </div>
              </div>  

              <div class="line"></div>

              <div  class='results'>
                <h2>Lado Esquerdo</h2>
                <div>
                  <h1>SO para IO</h1>
                  <h3>28 pontos</h3>
                </div>
                <div>
                  <h1>LC para IM</h1>
                  <h3>44,2 pontos</h3>
                </div>
              </div>  
            </div>
          </div>
        </div>
        <?php
            }
        ?>

        
        <div class="total-simetric">
          <h1>Simetria: 97%</h1>
        </div>
      
      </div>
    </div>

    
  </body>
</html>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>


<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>