/**
 * Valida si una base está permitida
 */
function validarBase(base) {
    const basesPermitidas = [2, 8, 10, 16];
    return basesPermitidas.includes(base);
}

/**
 * Valida los caracteres de un número según su base
 */
function validarCaracteres(numero, base) {
    if (!numero || !base) return true;
    
    const caracteresValidos = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'.slice(0, base);
    for (let char of numero.toUpperCase()) {
        if (!caracteresValidos.includes(char)) {
            return { valido: false, caracter: char };
        }
    }
    return { valido: true };
}

/**
 * Muestra errores en un alert
 */
function mostrarErrores(errores) {
    if (errores.length > 0) {
        alert("Errores encontrados:\n• " + errores.join("\n• "));
        return true;
    }
    return false;
}

//================================
// FUNCIONES ESPECÍFICAS DEL MENÚ
//================================

function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
    const menuButton = document.querySelector(".menu-button");
    if (menuButton) {
        menuButton.style.display = "none";
    }
}

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
    const menuButton = document.querySelector(".menu-button");
    if (menuButton) {
        menuButton.style.display = "block";
    }
}

//================================
// VALIDACIÓN PARA CONVERSOR DE BASES (calc1.php)
//================================
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formNumeros');

    if (form) {
        form.addEventListener('submit', function (e) {
            const numeroInput = document.getElementById('numberInput').value.trim().toUpperCase();
            const baseOrigen = parseInt(document.getElementById('fromBaseInput').value);
            const baseDestino = parseInt(document.getElementById('toBaseInput').value);

            let errores = [];

            // Validar bases
            if (!validarBase(baseOrigen)) {
                errores.push("Seleccione una base origen válida");
            }

            if (!validarBase(baseDestino)) {
                errores.push("Seleccione una base destino válida");
            }

            // Validar número no vacío
            if (!numeroInput) {
                errores.push("El número no puede estar vacío");
            }

            // Validar caracteres del número
            if (numeroInput && baseOrigen) {
                const validacion = validarCaracteres(numeroInput, baseOrigen);
                if (!validacion.valido) {
                    errores.push(`Dígito '${validacion.caracter}' no válido para base ${baseOrigen}`);
                }
            }

            // Prevenir envío si hay errores
            if (mostrarErrores(errores)) {
                e.preventDefault();
            }
        });
    }
});

//================================
// VALIDACIÓN PARA CALCULADORA DE BASES (calc2.php)
//================================
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formCalculadora');

    if (form) {
        form.addEventListener('submit', function(e) {
            const numero1 = document.getElementById('numero1').value.trim().toUpperCase();
            const base1 = parseInt(document.getElementById('base1').value);
            const numero2 = document.getElementById('numero2').value.trim().toUpperCase();
            const base2 = parseInt(document.getElementById('base2').value);
            const operacion = document.getElementById('operacion').value;
            
            let errores = [];
            
            // Validar campos requeridos
            if (!numero1) errores.push("El primer número no puede estar vacío");
            if (!numero2) errores.push("El segundo número no puede estar vacío");
            if (!validarBase(base1)) errores.push("Seleccione una base válida para el primer número");
            if (!validarBase(base2)) errores.push("Seleccione una base válida para el segundo número");
            if (!operacion) errores.push("Seleccione una operación");
            
            // Validar caracteres de ambos números
            if (numero1 && base1) {
                const validacion1 = validarCaracteres(numero1, base1);
                if (!validacion1.valido) {
                    errores.push(`Dígito '${validacion1.caracter}' no válido para primer número en base ${base1}`);
                }
            }
            
            if (numero2 && base2) {
                const validacion2 = validarCaracteres(numero2, base2);
                if (!validacion2.valido) {
                    errores.push(w`Dígito '${validacion2.caracter}' no válido para segundo número en base ${base2}`);
                }
            }
            
            // Validar división por cero
            if (operacion === 'division' && numero2 && base2) {
                const validacion = validarCaracteres(numero2, base2);
                if (validacion.valido) {
                    const valorDecimal = parseInt(numero2, base2);
                    if (valorDecimal === 0) {
                        errores.push('No se puede dividir por cero');
                    }
                }
            }
            
            // Prevenir envío si hay errores
            if (mostrarErrores(errores)) {
                e.preventDefault();
            }
        });
    }
});