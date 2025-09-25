<!DOCTYPE html>
<html>
<head>
    <title>Generador de Dígito Verificador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<button class="menu-button" onclick="w3_open()">☰</button>

<div id="mySidebar">
    <div class="sidebar-header">
        <button class="sidebar-close" onclick="w3_close()">✕</button>
        <h3>Close</h3>
    </div>
    <a href="Comprobador.php" class="sidebar-link">Verificador de Cedulas</a>
    <a href="generador.php" class="sidebar-link active">Generador de Digito</a>
</div>

<div class="w3-overlay" onclick="w3_close()" id="myOverlay"></div>

<div class="formClass">
    <h1>Generador de Digito</h1>
   
    <form action="" method="post" id="formNumeros">
        <input type="text" 
               id="primerosSiete" 
               name="primerosSiete" 
               placeholder="Primeros 7 digitos (ej: 1234567)" 
               maxlength="7" 
               pattern="[0-9]{7}"
               value="<?php echo isset($_POST['primerosSiete']) ? htmlspecialchars($_POST['primerosSiete']) : ''; ?>"
               required>

        <button type="submit" id="submitbtn">Generar Digito</button>
    </form>

<?php 
function esNumeroRepetido($numero) {
    return strlen($numero) === strspn($numero, $numero[0]);
}

function calcularDigitoVerificador($primerosSiete) {
    if (!preg_match('/^[0-9]{7}$/', $primerosSiete)) {
        return false;
    }

    if (esNumeroRepetido($primerosSiete)) {
        return false;
    }

    $multiplicadores = [2, 9, 8, 7, 6, 3, 4];
    $digitos = str_split($primerosSiete);
    $suma = 0;

    for ($i = 0; $i < 7; $i++) {
        $suma += intval($digitos[$i]) * $multiplicadores[$i];
    }

    $resto = $suma % 10;
    return $resto === 0 ? 0 : 10 - $resto;
}

function formatearCedula($cedula) {
    return substr($cedula, 0, 1) . '.' . substr($cedula, 1, 3) . '.' . substr($cedula, 4, 3) . '-' . substr($cedula, 7, 1);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $primerosSiete = trim($_POST['primerosSiete']);
    
    if (empty($primerosSiete)) {
        echo '<div class="result error">Por favor, ingresa los primeros 7 digitos</div>';
    } elseif (!preg_match('/^[0-9]{7}$/', $primerosSiete)) {
        echo '<div class="result error">Los primeros 7 digitos deben ser numeros validos</div>';
    } elseif (esNumeroRepetido($primerosSiete)) {
        echo '<div class="result error">Numero invalido: no se permiten todos los digitos iguales</div>';
    } else {
        $digitoVerificador = calcularDigitoVerificador($primerosSiete);
        $cedulaCompleta = $primerosSiete . $digitoVerificador;
        echo '<div class="result info">Digito Calculado<br><small>Cedula completa: ' . formatearCedula($cedulaCompleta) . ' | Digito verificador: <strong>' . $digitoVerificador . '</strong></small></div>';
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
</script>

<footer style="text-align:center; margin-top:30px;">
    <a href="../lab1/calc1.php" style="display:inline-block; margin:5px; padding:8px 18px; background:#eee; color:#222; border:1px solid #bbb; border-radius:6px; text-decoration:none;">Lab 1 </a>
    <a href="../lab2/calc1.php" style="display:inline-block; margin:5px; padding:8px 18px; background:#eee; color:#222; border:1px solid #bbb; border-radius:6px; text-decoration:none;">Lab 2 </a>
    <a href="../lab3/calc1.php" style="display:inline-block; margin:5px; padding:8px 18px; background:#eee; color:#222; border:1px solid #bbb; border-radius:6px; text-decoration:none;">Lab 3 </a>
    <a href="../lab4/Comprobador.php" style="display:inline-block; margin:5px; padding:8px 18px; background:#eee; color:#222; border:1px solid #bbb; border-radius:6px; text-decoration:none;">Lab 4 </a>
    <a href="../lab5/index.php" style="display:inline-block; margin:5px; padding:8px 18px; background:#eee; color:#222; border:1px solid #bbb; border-radius:6px; text-decoration:none;">Lab 5 </a>
</footer>

</body>
</html>