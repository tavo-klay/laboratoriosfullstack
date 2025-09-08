<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Laboratorio 2</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
  <link rel="stylesheet" href="estilos.css">
  <script src="validation.js" defer></script>
</head>
<body>

<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block" style="display:none;z-index:5" id="mySidebar">
  <button class="w3-bar-item w3-button w3-xxlarge" onclick="w3_close()">Close &times;</button>
  <a href="calc1.php" class="w3-bar-item w3-button">Tablas multiplicar</a>
  <a href="calc2.php" class="w3-bar-item w3-button">Calculo 5 oro</a>
  <a href="calc3.php" class="w3-bar-item w3-button">Calculo factoriales</a>
</div>

<!-- Overlay -->
<div class="w3-overlay" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

<!-- Menu Button -->
<div>
  <button class="w3-button w3-white w3-xxlarge menu-button" onclick="w3_open()">&#9776;</button>
</div>

<!-- Formulario -->
<div class="formClass">
  <h1>Calculadora factoriales</h1>

  <form id="formNumeros" method="post">
    <input type="number" name="numero1" id="num1" placeholder="Ingrese el número a factorizar" required>
    <button type="submit" id="submitbtn">Enviar</button>
  </form>

  <div id="errorMsg" style="color:red; margin-top:10px;"></div>

  <div id="resultado" style="margin-top:20px;">
    <?php
    function factorial($n) {
      if ($n < 0) return "Error: no existe factorial de negativos";
      $resultado = 1;
      for ($i = 1; $i <= $n; $i++) {
        $resultado *= $i;
      }
      return $resultado;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $numero = $_POST["numero1"] ?? null;
      if (is_numeric($numero) && $numero >= 0 && floor($numero) == $numero) {
        $resultado = factorial((int)$numero);
        echo "<div style='font-size:20px; color:green; font-family:Arial;'>
                <strong>Resultado:</strong> $numero! = $resultado
              </div>";
      } else {
        echo "<p style='color:red;'>Error: el valor recibido no es válido.</p>";
      }
    }
    ?>
  </div>
</div>


<script>
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
  document.querySelector(".menu-button").style.display = "none";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
  document.querySelector(".menu-button").style.display = "block";

}
</script>

</body>
</html>