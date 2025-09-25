<!DOCTYPE html>
<html>
<head>
    <title>Verificador de Cédulas Uruguayas</title>
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
    <a href="Comprobador.php" class="sidebar-link active">Verificador de Cedulas</a>
    <a href="generador.php" class="sidebar-link">Generador de Digito</a>
</div>

<div class="w3-overlay" onclick="w3_close()" id="myOverlay"></div>

<div class="formClass">
    <h1>Verificador de Cedulas</h1>
    
    <form action="" method="post" id="formNumeros">
        <input type="text" 
               id="cedulaCompleta" 
               name="cedulaCompleta" 
               placeholder="Numero a verificar (ej: 12345678)" 
               maxlength="8" 
               pattern="[0-9]{8}"
               value="<?php echo isset($_POST['cedulaCompleta']) ? htmlspecialchars($_POST['cedulaCompleta']) : ''; ?>"
               required>

        <button type="submit" id="submitbtn">Verificar Cedula</button>
    </form>

<?php 
function esNumeroRepetido($numero) {
    return strlen($numero) === strspn($numero, $numero[0]);
}

function calcularDigitoVerificador($primerosSiete) {
    $multiplicadores = [2, 9, 8, 7, 6, 3, 4];
    $digitos = str_split($primerosSiete);
    $suma = 0;

    for ($i = 0; $i < 7; $i++) {
        $suma += intval($digitos[$i]) * $multiplicadores[$i];
    }

    $resto = $suma % 10;
    return $resto === 0 ? 0 : 10 - $resto;
}

function verificarCedula($cedulaCompleta) {
    $primerosSiete = substr($cedulaCompleta, 0, 7);
    $digitoIngresado = intval(substr($cedulaCompleta, 7, 1));
    $digitoCalculado = calcularDigitoVerificador($primerosSiete);

    return [
        'esValida' => $digitoIngresado === $digitoCalculado,
        'digitoIngresado' => $digitoIngresado,
        'digitoCalculado' => $digitoCalculado
    ];
}

function formatearCedula($cedula) {
    return substr($cedula, 0, 1) . '.' . substr($cedula, 1, 3) . '.' . substr($cedula, 4, 3) . '-' . substr($cedula, 7, 1);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cedulaCompleta = trim($_POST['cedulaCompleta']);
    
    if (empty($cedulaCompleta)) {
        echo '<div class="result error">Error: Por favor, ingresa una cedula completa</div>';
    } elseif (!preg_match('/^[0-9]{8}$/', $cedulaCompleta)) {
        echo '<div class="result error">Error: La cedula debe tener exactamente 8 digitos</div>';
    } elseif (esNumeroRepetido($cedulaCompleta)) {
        echo '<div class="result error">Error: Cedula invalida: no se permiten todos los digitos iguales</div>';
    } else {
        $verificacion = verificarCedula($cedulaCompleta);
        
        if ($verificacion['esValida']) {
            echo '<div class="result success">Cedula VALIDA<br><small>La cedula ' . formatearCedula($cedulaCompleta) . ' es correcta</small></div>';
        } else {
            echo '<div class="result error">Cedula INVALIDA<br><small>Digito ingresado: ' . $verificacion['digitoIngresado'] . ' | Digito correcto: ' . $verificacion['digitoCalculado'] . '</small></div>';
        }
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