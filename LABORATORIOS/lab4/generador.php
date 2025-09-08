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
class CedulaUruguaya {
    private $multiplicadores = [2, 9, 8, 7, 6, 3, 4];

    private function esNumeroRepetido($numero) {
        return strlen($numero) === strspn($numero, $numero[0]);
    }

    public function calcularDigitoVerificador($primerosSiete) {
        if (!preg_match('/^[0-9]{7}$/', $primerosSiete)) {
            throw new Exception("Los primeros 7 digitos deben ser numeros validos");
        }

        if ($this->esNumeroRepetido($primerosSiete)) {
            throw new Exception("Numero invalido: no se permiten todos los digitos iguales");
        }

        $digitos = str_split($primerosSiete);
        $suma = 0;

        for ($i = 0; $i < 7; $i++) {
            $suma += intval($digitos[$i]) * $this->multiplicadores[$i];
        }

        $resto = $suma % 10;
        return $resto === 0 ? 0 : 10 - $resto;
    }
}

function formatearCedula($cedula) {
    return substr($cedula, 0, 1) . '.' . substr($cedula, 1, 3) . '.' . substr($cedula, 4, 3) . '-' . substr($cedula, 7, 1);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $cedulaUY = new CedulaUruguaya();
        $primerosSiete = trim($_POST['primerosSiete']);
        
        if (empty($primerosSiete)) {
            throw new Exception("Por favor, ingresa los primeros 7 digitos");
        }

        $digitoVerificador = $cedulaUY->calcularDigitoVerificador($primerosSiete);
        $cedulaCompleta = $primerosSiete . $digitoVerificador;
        
        echo '<div class="result info">Digito Calculado<br><small>Cedula completa: ' . formatearCedula($cedulaCompleta) . ' | Digito verificador: <strong>' . $digitoVerificador . '</strong></small></div>';
        
    } catch (Exception $e) {
        echo '<div class="result error">Error: ' . $e->getMessage() . '</div>';
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

</body>
</html>