<?php
    $params = $_POST['data'];
    $array = json_decode($params, true);

    function toPositive($num){
      if($num < 0 )
        $num *=-1;
      return $num;
    }

    function maiorPormenor($val1, $val2){
      if($val1<$val2)
        return $val1-$val2;
      return $val2-$val1;
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
        <h1 class="title">Razão Aurea</h1>
        
        <?php 
          $erroTotal = 0;
          foreach ($array as $item){
            $image = str_replace(" ", "+", $item["image"]);
            $mimica = $item["mimica"];

            $cantoBocaEsq = ($item["face"]["aurea"]["cantoBocaEsq"]);
            $cantoBocaDir = ($item["face"]["aurea"]["cantoBocaDir"]);
            $olhoEsq = ($item["face"]["aurea"]["olhoEsq"]);
            $olhoDir = ($item["face"]["aurea"]["olhoDir"]);
            $queixo = ($item["face"]["aurea"]["queixo"]);
            $baseNariz = ($item["face"]["aurea"]["baseNariz"]);
            $cabelo = ($item["face"]["aurea"]["cabelo"]);
            $narizEsq = ($item["face"]["aurea"]["narizEsq"]);
            $narizDir = ($item["face"]["aurea"]["narizDir"]);
            $temporaEsq = ($item["face"]["aurea"]["temporaEsq"]);
            $temporaDir = ($item["face"]["aurea"]["temporaDir"]);
            $cantoOlhoDir = ($item["face"]["aurea"]["cantoOlhoDir"]);
            $cantoOlhoEsq = ($item["face"]["aurea"]["cantoOlhoEsq"]);
            
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
              $disCantoBoca_Olho_Esq = calcDis($cantoBocaEsq, $olhoEsq);
              $disCantoBoca_Queixo_Esq = calcDis($cantoBocaEsq, $queixo);
              $erro1Esq = ($disCantoBoca_Olho_Esq - $disCantoBoca_Queixo_Esq * 1.618);
              
              $disCantoBoca_Olho_Dir = calcDis($cantoBocaDir, $olhoDir);
              $disCantoBoca_Queixo_Dir = calcDis($cantoBocaDir, $queixo);
              $erro1Dir = toPositive($disCantoBoca_Olho_Dir - $disCantoBoca_Queixo_Dir * 1.618);

              $baseNariz_Cabelo = calcDis($baseNariz, $cabelo);
              $baseNariz_Queixo = calcDis($baseNariz, $queixo);
              $erro2 = toPositive($baseNariz_Cabelo - $baseNariz_Queixo * 1.618);

              $larguraBoca = calcDis($cantoBocaDir, $cantoBocaEsq);
              $larguraNariz = calcDis($narizDir, $narizEsq);
              $erro3 = toPositive($larguraBoca - $larguraNariz * 1.618);

              $disTamporas = calcDis($temporaDir, $temporaEsq);
              $disOlho = calcDis($cantoOlhoDir, $cantoOlhoEsq);
              $erro4 = toPositive($disTamporas - $disOlho * 1.618);

              $erroTotal += ($erro1Dir + $erro1Esq + $erro2 + $erro3 + $erro4);
              
            ?>

          </div>          
        </div>
        
        <?php
            }
        ?>
        <div class="total-simetric">
          <h1>Simetria Total: 
              <?=number_format( (100 - $erroTotal/4), 2, ',', ' ')?> 
          </h1>
        </div>

        
         
        <div class="footer-data">
          
          <div id="chart_div"></div>
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
  $erro1 = $erro1Dir + $erro1Esq / 2;
  echo
    "<script type=\"text/javascript\" src=\"https://www.gstatic.com/charts/loader.js\"></script>
    <script type=\"text/javascript\">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Medidas', 'Sales'],
          ['1',  $erro1],
          ['2',  $erro2],
          ['3',  $erro3],
          ['4',  $erro4]
        ]);

        var options = {
          title: 'Company Performance',
          hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0},
          width: 800,
          height: 550,
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  ";

  ?>
    
  </body>
</html>
