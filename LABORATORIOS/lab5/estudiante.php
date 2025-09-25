<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ficha Estudiante</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="formClass">
        <?php 
        
// Clase Estudiante simplificada
class Estudiante {
    public $nombre, $cedula, $localidad, $direccion, $telefono, $email, $notas = [], $promedio, $estado;

    public function __construct($datos, $notas) {
        $this->nombre = $datos['nombre'];
        $this->cedula = $datos['cedula'];
        $this->localidad = $datos['localidad'];
        $this->direccion = $datos['direccion'];
        $this->telefono = $datos['telefono'];
        $this->email = $datos['email'];
        $this->notas = $notas;
        $this->calcularPromedioYEstado();
    }

    private function calcularPromedioYEstado() {
        $this->promedio = round(array_sum($this->notas) / count($this->notas), 2);
        if ($this->promedio >= 1 && $this->promedio <= 3) $this->estado = 'Examen Febrero';
        elseif ($this->promedio >= 4 && $this->promedio <= 7) $this->estado = 'Examen Reglamentado';
        else $this->estado = 'Exonerado';
    }
}

// Validar cédula uruguaya simple
function validarCedula($cedula) {
    if (strlen($cedula) != 8 || !ctype_digit($cedula)) return false;
    if (count(array_unique(str_split($cedula))) == 1) return false;
    $m = [2,9,8,7,6,3,4]; $suma = 0;
    for ($i=0; $i<7; $i++) $suma += $cedula[$i]*$m[$i];
    $resto = $suma % 10;
    $digito = $resto == 0 ? 0 : 10 - $resto;
    return $digito == $cedula[7];
}

// Color según estado
function colorEstado($estado) {
    if ($estado == 'Examen Febrero') return 'rojo';
    if ($estado == 'Examen Reglamentado') return 'amarillo';
    if ($estado == 'Exonerado') return 'verde';
    return '';
}

// Procesar datos
$estudiante = null;
$color = '';
$hayDatos = false;  

if ($_POST) {
    $notas = [];
    for ($i=1; $i<=10; $i++) $notas[] = floatval($_POST['nota'.$i]);
    $estudiante = new Estudiante($_POST, $notas);
    $color = colorEstado($estudiante->estado);
    $hayDatos = true;
}


        if ($hayDatos) {
            echo "<h2>FICHA ESTUDIANTE</h2>";
            echo "<div id='ficha'>";
            echo "<p><strong>Nombre:</strong> " . htmlspecialchars($estudiante->nombre) . "</p>";
            echo "<p><strong>Cédula:</strong> " . htmlspecialchars($estudiante->cedula) . "</p>";
            echo "<p><strong>Localidad:</strong> " . htmlspecialchars($estudiante->localidad) . "</p>";
            echo "<p><strong>Dirección:</strong> " . htmlspecialchars($estudiante->direccion) . "</p>";
            echo "<p><strong>Teléfono:</strong> " . htmlspecialchars($estudiante->telefono) . "</p>";
            echo "<p><strong>Email:</strong> " . htmlspecialchars($estudiante->email) . "</p>";
            echo "<p><strong>Notas:</strong> " . implode(', ', $estudiante->notas) . "</p>";
            echo "<div class='promedio'><strong>Promedio:</strong> " . $estudiante->promedio . "</div>";
            echo "<div class='" . $color . "'><strong>" . $estudiante->estado . "</strong></div>";
            echo "</div><br>";
            echo "<button type='button' class='w3-button w3-blue' onclick='window.location.href=\"index.php\"'>Nuevo Estudiante</button>";
        } else {
            echo "<h2>Error</h2>";
            echo "<p>No se recibieron datos del formulario.</p>";
            echo "<button type='button' class='w3-button w3-blue' onclick='window.location.href=\"index.php\"'>Volver</button>";
        }


        ?>
    </div>
</body>