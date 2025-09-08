<!DOCTYPE html>
<html>
<head>
    <title>Laboratorio 3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<script src="validation.js"></script>
<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block" style="display:none;z-index:5" id="mySidebar">
    <button class="w3-bar-item w3-button w3-xxlarge" onclick="w3_close()">Close &times;</button>
    <a href="calc1.php" class="w3-bar-item w3-button">Conversion bases numericas</a>
    <a href="calc2.php" class="w3-bar-item w3-button">Calculadora bases numericas</a>
</div>

<!-- Page Content -->
<div class="w3-overlay" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
<div>
    <button class="w3-button w3-white w3-xxlarge menu-button" onclick="w3_open()">&#9776;</button>
</div>

<div class="formClass">
    <h1>Conversión de Bases Numéricas</h1>
    
    <div>
        <strong>Información sobre bases:</strong><br>
        • Binario (base 2): usa dígitos 0-1<br>
        • Octal (base 8): usa dígitos 0-7<br>
        • Decimal (base 10): usa dígitos 0-9<br>
        • Hexadecimal (base 16): usa dígitos 0-9,A-F<br>
    </div>

    <!--formulario -->
    <form action="" method="post" id="formNumeros">
    <input type="text" name="numberInput" id="numberInput" placeholder="Número a convertir (ej: 1010, FF, 123)" required>
    <select name="fromBaseInput" id="fromBaseInput" required>
        <option value="">Seleccione base origen</option>
        <option value="2">Binario (2)</option>
        <option value="8">Octal (8)</option>
        <option value="10">Decimal (10)</option>
        <option value="16">Hexadecimal (16)</option>
    </select>

<select name="toBaseInput" id="toBaseInput" required>
    <option value="">Seleccione base destino</option>
    <option value="2">Binario (2)</option>
    <option value="8">Octal (8)</option>
    <option value="10">Decimal (10)</option>
    <option value="16">Hexadecimal (16)</option>
</select>

        <button type="submit" id="submitbtn">Convertir</button>
    </form>

<?php 
//--------------------------------
// FUNCIÓN CALCULOS DE BASES NUMERICAS
//--------------------------------
  
function convBase($numberInput, $fromBaseInput, $toBaseInput)
{
    if ($fromBaseInput == $toBaseInput) return $numberInput;

    $fromBaseChars = substr('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', 0, $fromBaseInput);
    $toBaseChars = substr('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', 0, $toBaseInput);

    $fromBase = str_split($fromBaseChars, 1);
    $toBase = str_split($toBaseChars, 1);
    $number = str_split(strtoupper($numberInput), 1);
    $fromLen = $fromBaseInput;
    $toLen = $toBaseInput;  
    $numberLen = strlen($numberInput);
    $retval = '';

    foreach ($number as $digit) {
        if (!in_array($digit, $fromBase)) {
            throw new Exception("Dígito '$digit' no válido para base $fromBaseInput");
        }
    }

    if ($toBaseInput == 10) {
        $retval = 0;
        for ($i = 1; $i <= $numberLen; $i++) {
            $digitValue = array_search($number[$i-1], $fromBase);
            $retval = bcadd($retval, bcmul($digitValue, bcpow($fromLen, $numberLen - $i)));
        }
        return $retval;
    }

    $base10 = ($fromBaseInput != 10) ? convBase($numberInput, $fromBaseInput, 10) : $numberInput;

    if ($base10 < $toBaseInput) {
        return $toBase[$base10];
    }

    while ($base10 != '0') {
        $remainder = bcmod($base10, $toLen);
        $retval = $toBase[$remainder] . $retval;
        $base10 = bcdiv($base10, $toLen, 0);
    }

    return $retval;
}

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $numberInput = trim($_POST["numberInput"] ?? '');
        $fromBaseInput = (int)($_POST["fromBaseInput"] ?? 0);
        $toBaseInput = (int)($_POST["toBaseInput"] ?? 0);

        $resultado = convBase($numberInput, $fromBaseInput, $toBaseInput);

        echo '<div>';
        echo '<strong>Resultado de la conversión:</strong><br>';
        echo "Número: $numberInput (base $fromBaseInput)<br>";
        echo "Convertido a: $resultado (base $toBaseInput)";
        echo '</div>';

    } catch (Exception $e) {
        echo '<div>';
        echo '<strong>Error:</strong> ' . $e->getMessage();
        echo '</div>';
    }
}
?>
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
</SCRIPT>

<footer style="text-align:center; margin-top:30px;">
    <a href="../lab1/calc1.php" style="display:inline-block; margin:5px; padding:8px 18px; background:#eee; color:#222; border:1px solid #bbb; border-radius:6px; text-decoration:none;">Lab 1 </a>
    <a href="../lab2/calc1.php" style="display:inline-block; margin:5px; padding:8px 18px; background:#eee; color:#222; border:1px solid #bbb; border-radius:6px; text-decoration:none;">Lab 2 </a>
    <a href="calc1.php" style="display:inline-block; margin:5px; padding:8px 18px; background:#eee; color:#222; border:1px solid #bbb; border-radius:6px; text-decoration:none;">Lab 3 </a>
    <a href="../lab4/Comprobador.php" style="display:inline-block; margin:5px; padding:8px 18px; background:#eee; color:#222; border:1px solid #bbb; border-radius:6px; text-decoration:none;">Lab 4 </a>
    <a href="../lab5/index.php" style="display:inline-block; margin:5px; padding:8px 18px; background:#eee; color:#222; border:1px solid #bbb; border-radius:6px; text-decoration:none;">Lab 5 </a>
</footer>
</script>
</body>
</html>