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
  <h1>Calculadora 5 de oro probabilidad</h1>

  <form id="formNumeros" method="post">
    <input type="number" name="n1" id="jugadas" placeholder="Ingrese el número de veces jugadas al 5 de oro" required>

    <button type="submit" id="submitbtn">Enviar</button>
  </form>

  <div id="errorMsg" style="color:red; margin-top:10px;"></div>

  <div id="resultado" style="margin-top:20px;">
 
<?php
function prob($jugadas) {
    $errores = [];

    // Validación
    if (!is_numeric($jugadas) || $jugadas < 1 || $jugadas > 171230)  {
        return "<div style='color:red;'>ERROR Ingrese una cantidad válida de jugadas (número mayor a 0 y menor a 160000).</div>";
    }

        // Probabilidad de acertar los 5 números en una jugada
        $probUna = (5/48) * (4/47) * (3/46) * (2/45) * (1/44);
        $probTotal =  1 - pow((1 - $probUna), $jugadas);


    // Mostrar resultado
    return "
    <div style='font-size:20px; color:#333; font-family:Arial; background-color:#f0f8ff; padding:20px; border-radius:15px;'>
        <p><strong>Jugadas realizadas:</strong> {$jugadas}</p>
        <p><strong>Probabilidad de ganar en una jugada:</strong> " . number_format($probTotal, 10) . "</p>
    </div>";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $n1 = $_POST["n1"] ?? null;
    echo prob($n1);
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