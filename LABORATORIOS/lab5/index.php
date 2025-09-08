<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registro Estudiante</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="formClass">
        <h1>Estudiante</h1>
        
        <div id="parte1">
            <form id="formNumeros">
                <input type="text" id="nombre" placeholder="Nombre Completo">
                <input type="text" id="cedula" placeholder="Cédula">
                <input type="text" id="localidad" placeholder="Localidad">
                <input type="text" id="direccion" placeholder="Dirección">
                <input type="text" id="telefono" placeholder="Teléfono">
                <input type="email" id="email" placeholder="Email">
                <button type="button" id="submitbtn" onclick="guardar()">Guardar</button>
            </form>
        </div>

        <div id="parte2" style="display:none;">
            <form id="formNumeros">
                <input type="number" id="nota1" placeholder="Nota 1">
                <input type="number" id="nota2" placeholder="Nota 2">
                <input type="number" id="nota3" placeholder="Nota 3">
                <input type="number" id="nota4" placeholder="Nota 4">
                <input type="number" id="nota5" placeholder="Nota 5">
                <input type="number" id="nota6" placeholder="Nota 6">
                <input type="number" id="nota7" placeholder="Nota 7">
                <input type="number" id="nota8" placeholder="Nota 8">
                <input type="number" id="nota9" placeholder="Nota 9">
                <input type="number" id="nota10" placeholder="Nota 10">
                <button type="button" id="submitbtn" onclick="calcular()">Calcular</button>
            </form>
        </div>
    </div>

    <script src="validation.js"></script>
    <footer style="text-align:center; margin-top:30px;">
    <a href="../lab1/calc1.php" style="display:inline-block; margin:5px; padding:8px 18px; background:#eee; color:#222; border:1px solid #bbb; border-radius:6px; text-decoration:none;">Lab 1 </a>
    <a href="../lab2/calc1.php" style="display:inline-block; margin:5px; padding:8px 18px; background:#eee; color:#222; border:1px solid #bbb; border-radius:6px; text-decoration:none;">Lab 2 </a>
    <a href="calc1.php" style="display:inline-block; margin:5px; padding:8px 18px; background:#eee; color:#222; border:1px solid #bbb; border-radius:6px; text-decoration:none;">Lab 3 </a>
    <a href="../lab4/Comprobador.php" style="display:inline-block; margin:5px; padding:8px 18px; background:#eee; color:#222; border:1px solid #bbb; border-radius:6px; text-decoration:none;">Lab 4 </a>
    <a href="../lab5/index.php" style="display:inline-block; margin:5px; padding:8px 18px; background:#eee; color:#222; border:1px solid #bbb; border-radius:6px; text-decoration:none;">Lab 5 </a>
</footer>
</body>
</html>