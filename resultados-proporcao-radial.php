<?php
    $params = $_POST['data'];
    $array = json_decode($params, true);

    function toPositive($num){
      if($num < 0 )
        $num *=-1;
      return $num;
    }

    function calcDis($val1, $val2){
      $soma = ($val1[0] - $val2[0])^2 + ($val1[1] - $val2[1])^2;
      $distancia = 0;
        
        if (intval($soma) == 0){
            $distancia = 0;
        }else{
            //echo "<script>alert($soma)</script>";
            $distancia = sqrt(intval(toPositive($soma)));
        }
        return $distancia;
    }

    function maiorPormenor($val1, $val2){
      if($val1<$val2)
        return $val1/$val2;
      return $val2/$val1;
    }

    $sorrindoEsq = 0;
    $sorrindoDir = 0;
    $repousoEsq = 0;
    $repousoDir = 0;
    $sobrancelhaEsq = 0;
    $sobrancelhaDir = 0;
    $olhosEsq = 0;
    $olhosDir = 0;
?>

<html>
  <head> 
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="theme-color" content="#780FA9">
    <link rel="stylesheet" href="views/assets/css/resultados-proporcao.css">
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
        <h1 class="title">Proporcional Radial</h1>
        
        <?php 
          $total = 0;
          foreach ($array as $item){
            $image = str_replace(" ", "+", $item["image"]);
            $mimica = $item["mimica"];

            $linhaSargital = ($item["face"]["radial"]["p8"]);
            $larguraBipuliarDir = calcDis($item["face"]["radial"]["p4"], $linhaSargital);
            $larguraBipuliarEsq = calcDis($item["face"]["radial"]["p3"], $linhaSargital);
            $larguraFacialHorizontalDir = calcDis($item["face"]["radial"]["p6"], $linhaSargital);
            $larguraFacialHorizontalEsq = calcDis($item["face"]["radial"]["p5"], $linhaSargital);
            $larguraNazalDir = calcDis($item["face"]["radial"]["p9"], $linhaSargital);
            $larguraNazalEsq = calcDis($item["face"]["radial"]["p7"], $linhaSargital);
            $larguraLabialDir = calcDis($item["face"]["radial"]["p12"], $linhaSargital);
            $larguraLabialEsq = calcDis($item["face"]["radial"]["p11"], $linhaSargital);
            $larguraFacialVerticalDir = calcDis($item["face"]["radial"]["p8"], $item["face"]["radial"]["p16"]);
            $larguraFacialVerticalEsq = calcDis($item["face"]["radial"]["p17"], $item["face"]["radial"]["p8"]);

            // $linhaSargital = ($item["face"]["radial"]["linhaSargital"]);
            // $larguraBipuliarDir = ($item["face"]["radial"]["larguraBipuliarDir"]);
            // $larguraBipuliarEsq = ($item["face"]["radial"]["larguraBipuliarEsq"]);
            // $larguraFacialHorizontalDir = ($item["face"]["radial"]["larguraFacialHorizontalDir"]);
            // $larguraFacialHorizontalEsq = ($item["face"]["radial"]["larguraFacialHorizontalEsq"]);
            // $larguraNazalDir = ($item["face"]["radial"]["larguraNazalDir"]);
            // $larguraNazalEsq = ($item["face"]["radial"]["larguraNazalEsq"]);
            // $larguraLabialDir = ($item["face"]["radial"]["larguraLabialDir"]);
            // $larguraLabialEsq = ($item["face"]["radial"]["larguraLabialEsq"]);
            // $larguraFacialVerticalDir = ($item["face"]["radial"]["larguraFacialVerticalDir"]);
            // $larguraFacialVerticalEsq = ($item["face"]["radial"]["larguraFacialVerticalEsq"]);

        ?>

        <div class="mySlides" style="width: 100%; text-align: center">
          <div class="top-data">
            <div class='top-data-left'>
              <h1><?=$mimica?></h1>
              <img src=<?=$image?>>
            </div>
            <div class="buttons-w3">
              <button class="w3-button w3-display-left" id="w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
              <button class="w3-button w3-display-right" id="w3-display-right" onclick="plusDivs(+1)">&#10095;</button>
            </div>
            <?php
              if($mimica == "Repouso"){
                $repousoDir = $larguraBipuliarDir + $larguraFacialHorizontalDir + $larguraNazalEsq + $larguraLabialDir + $larguraFacialVerticalDir;
                $repousoEsq = $larguraBipuliarEsq + $larguraFacialHorizontalEsq + $larguraNazalEsq + $larguraLabialEsq + $larguraFacialVerticalEsq;
              }else if($mimica == "Sobrancelhas Erguidas"){
                $sobrancelhaDir = $larguraBipuliarDir + $larguraFacialHorizontalDir + $larguraNazalEsq + $larguraLabialDir + $larguraFacialVerticalDir;
                $sobrancelhaEsq = $larguraBipuliarEsq + $larguraFacialHorizontalEsq + $larguraNazalEsq + $larguraLabialEsq + $larguraFacialVerticalEsq;
              }else if($mimica == "Sorrindo"){
                $sorrindoDir = $larguraBipuliarDir + $larguraFacialHorizontalDir + $larguraNazalEsq + $larguraLabialDir + $larguraFacialVerticalDir;
                $sorrindoEsq = $larguraBipuliarEsq + $larguraFacialHorizontalEsq + $larguraNazalEsq + $larguraLabialEsq + $larguraFacialVerticalEsq;
              }else if($mimica == "Olhos Fechados"){
                $olhosDir = $larguraBipuliarDir + $larguraFacialHorizontalDir + $larguraNazalEsq + $larguraLabialDir + $larguraFacialVerticalDir;
                $olhosEsq = $larguraBipuliarEsq + $larguraFacialHorizontalEsq + $larguraNazalEsq + $larguraLabialEsq + $larguraFacialVerticalEsq;
              }

              $simetria = maiorPormenor($larguraBipuliarDir,$larguraBipuliarEsq)
                      + maiorPormenor($larguraFacialHorizontalDir,$larguraFacialHorizontalEsq)
                      + maiorPormenor($larguraNazalEsq,$larguraNazalDir)
                      + maiorPormenor($larguraLabialDir,$larguraLabialEsq)
                      + maiorPormenor($larguraFacialVerticalDir,$larguraFacialVerticalEsq);    
              $simetria = ($simetria / 5) * 100;
              $total+=$simetria; 
            ?>

          </div>

          <div class="total-simetric">
          <h1>Simetria <?=$mimica?>: 
              <?=number_format( $simetria , 2, ',', ' ')?> 
          
            </h1>
           
          </div>
          
        </div>
        
        <?php
            }
        ?>
        <div class="total-simetric">
          <h1>Simetria Total: 
              <?=number_format( ($total/4), 2, ',', ' ')?> 
          </h1>
        </div>

        
         
        <div class="footer-data">
          <div id="columnchart_material"></div>
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



<?php
  echo
    "<script type=\"text/javascript\" src=\"https://www.gstatic.com/charts/loader.js\"></script>
    <script type=\"text/javascript\">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Posiçao', 'Esquerdo', 'Direito'],
          ['Repouso', $repousoEsq, $repousoDir],
          ['Sobrancelhas Erguidas', $sobrancelhaEsq, $sobrancelhaDir],
          ['Sorrindo', $sorrindoEsq, $sorrindoDir],
          ['Olhos Precionados', $olhosEsq, $olhosDir],
        ]);

        var options = {
          width: 800,
          height: 550,
          
          chart: {
            title: 'Simetric Calc - Simetria Facial',
            subtitle: 'Escala de Nottingham',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  ";

  ?>
    
  </body>
</html>
