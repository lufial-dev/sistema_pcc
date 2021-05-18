<?php
    $params = $_POST['data'];
    $array = json_decode($params, true);

    $SO_IO_R_rep = 0;
    $LC_M_R_rep = 0; 
    $SO_IO_L_rep = 0;
    $LC_M_L_rep = 0; 

    $SO_IO_R_sob = 0;
    $LC_M_R_sob = 0; 
    $SO_IO_L_sob = 0;
    $LC_M_L_sob = 0; 

    $SO_IO_R_sor = 0;
    $LC_M_R_sor = 0; 
    $SO_IO_L_sor = 0;
    $LC_M_L_sor = 0; 

    $SO_IO_R_pre = 0;
    $LC_M_R_pre = 0; 
    $SO_IO_L_pre = 0;
    $LC_M_L_pre = 0; 

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
        
            $SO_IO_R = 0;
            $LC_M_R = 0; 
            $SO_IO_L = 0;
            $LC_M_L = 0; 
        ?>

        <div class="mySlides">
          <div class="top-data">
            <div class='top-data-left'>
              <h1><?=$mimica?></h1>
              <img src=<?=$image?>>
              <button class="w3-button w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
              <button class="w3-button w3-display-right" onclick="plusDivs(+1)">&#10095;</button>
            </div>

            <?php
              if ($mimica == "Repouso"){
                
                $SO_IO_R_rep = calcDis($supraorbitalDir, $infraorbitalDir);
                $SO_IO_L_rep = calcDis($supraorbitalEsq, $infraorbitalEsq);
                $LC_M_R_rep = calcDis($cantoLateralDir, $comissuraLabialDir);
                $LC_M_L_rep = calcDis($cantoLateralEsq, $comissuraLabialEsq);
                
                $SO_IO_R = $SO_IO_R_rep;
                $SO_IO_L = $SO_IO_L_rep;
                $LC_M_R = $LC_M_R_rep; 
                $LC_M_L = $LC_M_L_rep;

              }else if($mimica == "Sobrancelhas Erguidas"){

                $SO_IO_R_sob = calcDis($supraorbitalDir, $infraorbitalDir);
                $SO_IO_L_sob = calcDis($supraorbitalEsq, $infraorbitalEsq);
                $LC_M_R_sob = calcDis($cantoLateralDir, $comissuraLabialDir);
                $LC_M_L_sob = calcDis($cantoLateralEsq, $comissuraLabialEsq);
                
                $SO_IO_R = $SO_IO_R_sob;
                $SO_IO_L = $SO_IO_L_sob;
                $LC_M_R = $LC_M_R_sob; 
                $LC_M_L = $LC_M_L_sob;
              }else if($mimica == "Sorrindo"){

                $SO_IO_R_sor = calcDis($supraorbitalDir, $infraorbitalDir);
                $SO_IO_L_sor = calcDis($supraorbitalEsq, $infraorbitalEsq);
                $LC_M_R_sor = calcDis($cantoLateralDir, $comissuraLabialDir);
                $LC_M_L_sor = calcDis($cantoLateralEsq, $comissuraLabialEsq);
                
                $SO_IO_R = $SO_IO_R_sor;
                $SO_IO_L = $SO_IO_L_sor;
                $LC_M_R = $LC_M_R_sor; 
                $LC_M_L = $LC_M_L_sor;
              }else if($mimica == "Olhos Fechados"){

                $SO_IO_R_pre = calcDis($supraorbitalDir, $infraorbitalDir);
                $SO_IO_L_pre = calcDis($supraorbitalEsq, $infraorbitalEsq);
                $LC_M_R_pre = calcDis($cantoLateralDir, $comissuraLabialDir);
                $LC_M_L_pre = calcDis($cantoLateralEsq, $comissuraLabialEsq);
                
                $SO_IO_R = $SO_IO_R_pre;
                $SO_IO_L = $SO_IO_L_pre;
                $LC_M_R = $LC_M_R_pre; 
                $LC_M_L = $LC_M_L_pre;
              }

              
            ?>

            <div class="top-data-right">
              <div class='results'>
                <h2>Lado Direito</h2>
                <div>
                  <h1>SO para IO</h1>
                  <h3><?=number_format($SO_IO_R, 2, ',', ' ')." Pontos"?></h3>
                </div>
                <div>
                  <h1>LC para M</h1>
                  <h3><?=number_format($LC_M_R, 2, ',', ' ')." Pontos"?></h3>
                </div>
              </div>  

              <div class="line"></div>

              <div  class='results'>
                <h2>Lado Esquerdo</h2>
                <div>
                  <h1>SO para IO</h1>
                  <h3><?=number_format($SO_IO_L, 2, ',', ' ')." Pontos"?></h3>
                </div>
                <div>
                  <h1>LC para IM</h1>
                  <h3><?=number_format($LC_M_L, 2, ',', ' ')." Pontos"?></h3>
                </div>
              </div>  
            </div>
          </div>
        </div>
        <?php
            }
        ?>

        <?php
          $R = ($SO_IO_R_sob / $SO_IO_R_rep)  + ($SO_IO_R_pre / $SO_IO_R_rep ) + ($LC_M_R_sor / $LC_M_R_rep);
          $L = ($SO_IO_L_sob / $SO_IO_L_rep)  + ($SO_IO_L_pre / $SO_IO_L_rep ) + ($LC_M_L_sor / $LC_M_L_rep);
          $simetria = toPositive($R - $L) * 100;
                
        ?>
        
        <div class="total-simetric">
          <h1>Simetria: 
            <?=number_format( 100 - $simetria, 2, ',', ' '). "%"?>
          </h1>
        </div>
        <div class="footer-data">
          <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
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
  echo "
    <script type=\"text/javascript\" src=\"https://www.gstatic.com/charts/loader.js\"></script>
    <script type=\"text/javascript\">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses', 'Profit'],
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var options = {
          width: 750,
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
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
