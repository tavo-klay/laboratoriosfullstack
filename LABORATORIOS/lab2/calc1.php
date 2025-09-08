<html>
<title>laboratorio 2</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
<link rel="stylesheet" href="estilos.css">
<body>

<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block" style="display:none;z-index:5" id="mySidebar">
  <button class="w3-bar-item w3-button w3-xxlarge" onclick="w3_close()">Close &times;</button>
  <a href="calc1.php" class="w3-bar-item w3-button">Tablas multiplicar</a>
  <a href="calc2.php" class="w3-bar-item w3-button">Calculo 5 oro</a>
  <a href="calc3.php" class="w3-bar-item w3-button">Calculo factoriales</a>
</div>

<!-- Page Content -->
<div class="w3-overlay" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

<div>
  <button class="w3-button w3-white w3-xxlarge menu-button" onclick="w3_open()">&#9776;</button>
</div>

<div class="formClass">
    <h1>Calculadora normal</h1>

    <!--formulario -->
    <form action="calc1.php" method="post" id="formNumeros">
    <input type="number" name="numero1" id="tablanum" placeholder="Ingrese el numero de la tabla (1-10)" required>
      <button type="submit" id="submitbtn">Enviar</button>
    </form>
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

<script src="validation.js"></script>

<?php
//--------------------------------
//FUNCIONES tablas multiplicar
//--------------------------------
function tabla($tablanum) {
    // Validación
    if (!is_numeric($tablanum) || $tablanum < 1 || $tablanum > 10) {
        return "<div style='color:red;'> ERROR: Ingrese un número entre 1 y 10.</div>";
    }

    $tabla = "";
    for ($i = 1; $i <= 10; $i++) {
        $resultado = $tablanum * $i;
        $tabla .= "<div style='padding:5px;'>$tablanum x $i = $resultado</div>";
    }

    return "<div style='font-family:Arial; font-size:18px; color:#333; background-color:#f0f0f0; padding:20px; border-radius:15px; width:fit-content; box-shadow:2px 2px 10px rgba(0,0,0,0.1);'>
                <strong><br>Tabla del $tablanum</strong><br><br>
                $tabla
            </div>";
}

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tablanum = $_POST["numero1"] ?? null;
    echo tabla($tablanum);
}
?>

<footer style="text-align:center; margin-top:30px;">
    <a href="../lab1/calc1.php" style="display:inline-block; margin:5px; padding:8px 18px; background:#eee; color:#222; border:1px solid #bbb; border-radius:6px; text-decoration:none;">Lab 1 </a>
    <a href="../lab2/calc1.php" style="display:inline-block; margin:5px; padding:8px 18px; background:#eee; color:#222; border:1px solid #bbb; border-radius:6px; text-decoration:none;">Lab 2 </a>
    <a href="../lab3/calc1.php" style="display:inline-block; margin:5px; padding:8px 18px; background:#eee; color:#222; border:1px solid #bbb; border-radius:6px; text-decoration:none;">Lab 3 </a>
    <a href="../lab4/Comprobador.php" style="display:inline-block; margin:5px; padding:8px 18px; background:#eee; color:#222; border:1px solid #bbb; border-radius:6px; text-decoration:none;">Lab 4 </a>
    <a href="../lab5/index.php" style="display:inline-block; margin:5px; padding:8px 18px; background:#eee; color:#222; border:1px solid #bbb; border-radius:6px; text-decoration:none;">Lab 5 </a>
</footer>
</body>
</html>