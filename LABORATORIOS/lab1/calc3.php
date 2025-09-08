<html>
<title>laboratorio 1</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
<link rel="stylesheet" href="estilos.css">
<body>
<script src="calc3HideForm.js"></script>
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
    <h1>Calculadora funciones</h1>

    <!--formulario -->
    <form action="calc3.php" method="post" id="formNumeros">
      <select name="operador" id="figuraSelect" onchange="mostrarCampos()">
        <option value="">elija una opcion</option>
        <option value="calcBask">calculo baskara</option>
        <option value="calcRaiz">calculo raiz</option>
        <option value="calcPot">Calculo Potencia</option>

</select>

 <!-- baskara -->
<div id="campos-areaCuad" class="input-field">
  <input type="number" name="lado" placeholder="Ingrese el lado del cuadrado" step="any" >
</div>

<!-- baskara -->
<div id="calcBask" class="input-field">
    <input type="number" name="a" placeholder="Ingrese A" step="any" >
    <input type="number" name="b" placeholder="Ingrese B" step="any" >
    <input type="number" name="c" placeholder="Ingrese C" step="any" >

</div>

<!-- raiz -->
<div id="calcRaiz" class="input-field">
    <input type="number" name="num1" placeholder="Ingrese numero para raiz cuadrada" step="any" >
</div>

<!-- potencia -->
<div id="calcPot" class="input-field">
    <input type="number" name="base" placeholder="Ingrese base" step="any" >
    <input type="number" name="exp" placeholder="Ingrese exponente" step="any" >
</div>

<button type="submit" id="submitbtn">Enviar</button>

    </form>

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
//FUNCIONES CALC3
//--------------------------------
function calcBask($a, $b, $c) {
    if (!is_numeric($a) || !is_numeric($b) || !is_numeric($c)){
        return "<span style='color:red;'>Error: el valor debe ser numérico.</span>";
    }
    
    // Verificar que 'a' no sea cero (no sería ecuación cuadrática)
    if ($a == 0) {
        return "<span style='color:red;'>Error: 'a' no puede ser cero en una ecuación cuadrática.</span>";
    }
    
    // Calcular el discriminante (Δ = b² - 4ac)
    $discriminante = ($b ** 2) - (4 * $a * $c);
    
    if ($discriminante > 0) {
        // Dos raíces reales diferentes
        $x1 = (-$b + sqrt($discriminante)) / (2 * $a);
        $x2 = (-$b - sqrt($discriminante)) / (2 * $a);
        $resultado = "Dos raíces reales:<br><br>x₁ = " . round($x1, 4) . "<br><br>x₂ = " . round($x2, 4);
        
    } elseif ($discriminante == 0) {
        // Una raíz real (raíz doble)
        $x = -$b / (2 * $a);
        $resultado = "Una raíz real (doble):<br><br>x = " . round($x, 4);
        
    } else {
        // Raíces complejas
        $parteReal = -$b / (2 * $a);
        $parteImaginaria = sqrt(abs($discriminante)) / (2 * $a);
        $resultado = "Raíces complejas:<br><br>x₁ = " . round($parteReal, 4) . " + " . round($parteImaginaria, 4) . "i<br><br>x₂ = " . round($parteReal, 4) . " - " . round($parteImaginaria, 4) . "i";
    }
    
    return "<BR><span style='font-size:24px; color:green; font-weight:bold; background-color:lightgrey; margin:15px; padding:20px; border-radius:20px; font-family:arial;'>$resultado</span>";
}

function calcRaiz($num1) {
if (!is_numeric($num1)){
        return "<span style='color:red;'>Error: el valor debe ser numérico.</span>";
    }

    $resultado = sqrt($num1);
    return "<BR><span style='font-size:24px; color:green; font-weight:bold; background-color:lightgrey; margin:15px; padding:20px; border-radius:20px; font-family:arial;'>$resultado</span>";
}

function calcPot($base, $exp) {
if (!is_numeric($base) || !is_numeric($exp)){
        return "<span style='color:red;'>Error: el valor debe ser numérico.</span>";
    }

$resultado = pow($base, $exp);

    return "<BR><span style='font-size:24px; color:green; font-weight:bold; background-color:lightgrey; margin:15px; padding:20px; border-radius:20px; font-family:arial;'>$resultado</span>";
}

// Ejemplo de uso con datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $operador = $_POST["operador"]; // Tomar el operador del select

    switch($operador)
    {
        case "calcBask":
            // CORREGIDO: Los nombres de los campos deben coincidir con los del HTML
            $a = $_POST["a"] ?? null;
            $b = $_POST["b"] ?? null;
            $c = $_POST["c"] ?? null;
            echo calcBask($a, $b, $c);
            break;
        case "calcRaiz":
            // CORREGIDO: El nombre del campo debe coincidir con el del HTML
            $num1 = $_POST["num1"] ?? null;
            echo calcRaiz($num1);
            break;
        case "calcPot":
            $base = $_POST["base"] ?? null;
            $exp = $_POST["exp"] ?? null;
            echo calcPot($base, $exp);
            break;
        default:
            echo "Operador invalido: " . $operador;
    }
}
?>
</body>
</html>