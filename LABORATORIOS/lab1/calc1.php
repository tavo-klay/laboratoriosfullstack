<html>
<title>laboratorio 1</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
<link rel="stylesheet" href="estilos.css">
<body>

<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block" style="display:none;z-index:5" id="mySidebar">
  <button class="w3-bar-item w3-button w3-xxlarge" onclick="w3_close()">Close &times;</button>
  <a href="calc1.php" class="w3-bar-item w3-button">Calculadora Normal</a>
  <a href="calc2.php" class="w3-bar-item w3-button">Calculadora Geométrica</a>
  <a href="calc3.php" class="w3-bar-item w3-button">Calculadora Ecuaciones Cuadráticas</a>
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
      <input type="number" name="numero1" id="num1" placeholder="Ingrese el primer número" required>
      <input type="number" name="numero2" id="num2" placeholder="Ingrese el segundo número" required>
      <select name="operador">
        <option value="+">Suma ➕</option>
        <option value="-">Resta ➖</option>
        <option value="x">Multipliación ✖️</option>
        <option value="/">División ➗</option>
      </select>
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
//FUNCIONES CALC1
//--------------------------------

function suma($num1, $num2) {
    // Validar que ambos sean numéricos
    if (!is_numeric($num1) || !is_numeric($num2)) {
        return "<span style='color:red;'>Error: ambos valores deben ser numéricos.</span>";
    }

    $resultado = $num1 + $num2;

    return "<span style='font-size:24px; color:green; font-weight:bold; background-color:lightgrey; margin:15px; padding:20px; border-radius:20px; font-family:arial;'>$resultado</span>";
}


function resta($num1, $num2) {
    if (!is_numeric($num1) || !is_numeric($num2)) {
        return "<span style='color:red;'>Error: ambos valores deben ser numéricos.</span>";
    }

    $resultado = $num1 - $num2;

    return "<span style='font-size:24px; color:green; font-weight:bold; background-color:lightgrey; margin:15px; padding:20px; border-radius:20px; font-family:arial;'>$resultado</span>";
}

function division($num1, $num2) {
    if (!is_numeric($num1) || !is_numeric($num2)) {
        return "<span style='color:red;'>Error: ambos valores deben ser numéricos.</span>";
    }
    if ($num2 == 0) {
    echo "<p>no se puede dividir por 0</p>";
}

    $resultado = $num1 / $num2;

    return "<span style='font-size:24px; color:green; font-weight:bold; background-color:lightgrey; margin:15px; padding:20px; border-radius:20px; font-family:arial;'>$resultado</span>";
}


function multip($num1, $num2) {
    if (!is_numeric($num1) || !is_numeric($num2)) {
        return "<span style='color:red;'>Error: ambos valores deben ser numéricos.</span>";
    }

    $resultado = $num1 * $num2;

    return "<span style='font-size:24px; color:green; font-weight:bold; background-color:lightgrey; margin:15px; padding:20px; border-radius:20px; font-family:arial;'>$resultado</span>";
}

// Ejemplo de uso con datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero1 = $_POST["numero1"] ?? null;
    $numero2 = $_POST["numero2"] ?? null;
    $operador = $_POST["operador"] ?? null;

    switch($operador)
    {
        case "+":
            echo suma($numero1, $numero2);
            break;
        case "-":
            echo resta($numero1, $numero2);
            break;
        case "x":
            echo multip($numero1, $numero2);
            break;
        case "/":
            echo division($numero1, $numero2);
            break;
        default:
            echo "Operador invalido ". $operador;
    }
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