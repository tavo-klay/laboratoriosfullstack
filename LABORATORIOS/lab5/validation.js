// Clase extendida para estudiante
class Estudiante {
    constructor() {
        this.nombre = '';
        this.cedula = '';
        this.localidad = '';
        this.direccion = '';
        this.telefono = '';
        this.email = '';
        this.sitio = ''; // nuevo campo
        this.notas = [];
    }
}

var estudiante = new Estudiante();

// Mostrar partes
function mostrar(num) {
    document.getElementById('parte1').style.display = 'none';
    document.getElementById('parte2').style.display = 'none';
    document.getElementById('parte' + num).style.display = 'block';
}

// Validar cédula uruguaya
function validarCedula(cedula) {
    if (cedula.length != 8 || !/^[0-9]{8}$/.test(cedula)) return false;
    if (cedula.split('').every(d => d === cedula[0])) return false;

    var multiplicadores = [2, 9, 8, 7, 6, 3, 4];
    var suma = 0;

    for (var i = 0; i < 7; i++) {
        suma += parseInt(cedula[i]) * multiplicadores[i];
    }

    var resto = suma % 10;
    var digitoCalculado = resto == 0 ? 0 : 10 - resto;
    var digitoIngresado = parseInt(cedula[7]);

    return digitoCalculado == digitoIngresado;
}

// Validar email
function validarEmail(email) {
    var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

// Guardar datos
function guardar() {
    var nombre = document.getElementById('nombre').value;
    var cedula = document.getElementById('cedula').value;
    var localidad = document.getElementById('localidad').value;
    var direccion = document.getElementById('direccion').value;
    var telefono = document.getElementById('telefono').value;
    var email = document.getElementById('email').value;
    var sitio = document.getElementById('sitio')?.value || '';

    if (!nombre || !cedula || !localidad || !direccion || !telefono || !email) {
        alert('Complete todos los campos');
        return;
    }

    if (!validarCedula(cedula)) {
        alert('Cédula incorrecta');
        return;
    }

    if (!validarEmail(email)) {
        alert('Email inválido');
        return;
    }

    if (sitio && !validarURL(sitio)) {
        alert('La URL debe contener un path (ej: https://example.com/ruta)');
        return;
    }

    estudiante.nombre = nombre;
    estudiante.cedula = cedula;
    estudiante.localidad = localidad;
    estudiante.direccion = direccion;
    estudiante.telefono = telefono;
    estudiante.email = email;
    estudiante.sitio = sitio;

    alert('Datos guardados correctamente');
    mostrar(2);
}

// Enviar datos al PHP
function calcular() {
    if (!estudiante.nombre) {
        alert('Primero guarde los datos personales');
        return;
    }

    var notas = [];
    for (var i = 1; i <= 10; i++) {
        var nota = parseFloat(document.getElementById('nota' + i).value);
        if (!nota || nota < 1 || nota > 12) {
            alert('Complete todas las notas entre 1 y 12');
            return;
        }
        notas.push(nota);
    }

    estudiante.notas = notas;

    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'estudiante.php';

    var campos = ['nombre', 'cedula', 'localidad', 'direccion', 'telefono', 'email', 'sitio'];
    campos.forEach(function (campo) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = campo;
        input.value = estudiante[campo];
        form.appendChild(input);
    });

    for (var i = 0; i < notas.length; i++) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'nota' + (i + 1);
        input.value = notas[i];
        form.appendChild(input);
    }

    document.body.appendChild(form);
    form.submit();
}

// Validaciones en tiempo real
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('cedula').addEventListener('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '').substring(0, 8);
    });
});