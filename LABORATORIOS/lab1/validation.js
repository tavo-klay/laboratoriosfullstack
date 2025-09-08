// ========================================
// VALIDATION.JS - Para todas las calculadoras
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formNumeros');
    const currentPage = window.location.pathname;
    
    if (form) {
        form.addEventListener('submit', function(e) {
            
            // ========================================
            // VALIDACIONES PARA CALC1 (Calculadora Normal)
            // ========================================
            if (currentPage.includes('calc1.php')) {
                const num1 = document.querySelector('input[name="numero1"]').value;
                const num2 = document.querySelector('input[name="numero2"]').value;
                const operador = document.querySelector('select[name="operador"]').value;
                
                if (!validarCampoNumerico(num1, 'primer número') || 
                    !validarCampoNumerico(num2, 'segundo número')) {
                    e.preventDefault();
                    return;
                }
                
                // Validación especial para división por cero
                if (operador === '/' && parseFloat(num2) === 0) {
                    e.preventDefault();
                    alert('No se puede dividir por cero.');
                    return;
                }
            }
            
            // ========================================
            // VALIDACIONES PARA CALC2 (Calculadora Geométrica)
            // ========================================
            else if (currentPage.includes('calc2.php')) {
                const figuraSelect = document.getElementById('figuraSelect');
                const figura = figuraSelect.value;
                
                // Validar que se haya seleccionado una figura
                if (!figura || figura === '') {
                    e.preventDefault();
                    alert('Por favor, seleccione una figura geométrica.');
                    return;
                }
                
                // Validar según la figura seleccionada
                switch(figura) {
                    case 'areaCuad':
                        const lado = document.querySelector('input[name="lado"]').value;
                        if (!validarCampoPositivo(lado, 'lado del cuadrado')) {
                            e.preventDefault();
                            return;
                        }
                        break;
                        
                    case 'areaRec':
                        const baseRec = document.querySelector('#campos-areaRec input[name="base"]').value;
                        const alturaRec = document.querySelector('#campos-areaRec input[name="altura"]').value;
                        if (!validarCampoPositivo(baseRec, 'base del rectángulo') || 
                            !validarCampoPositivo(alturaRec, 'altura del rectángulo')) {
                            e.preventDefault();
                            return;
                        }
                        break;
                        
                    case 'areaCir':
                        const radio = document.querySelector('input[name="radio"]').value;
                        if (!validarCampoPositivo(radio, 'radio del círculo')) {
                            e.preventDefault();
                            return;
                        }
                        break;
                        
                    case 'areaTri':
                        const baseTri = document.querySelector('#campos-areaTri input[name="base"]').value;
                        const alturaTri = document.querySelector('#campos-areaTri input[name="altura"]').value;
                        if (!validarCampoPositivo(baseTri, 'base del triángulo') || 
                            !validarCampoPositivo(alturaTri, 'altura del triángulo')) {
                            e.preventDefault();
                            return;
                        }
                        break;
                        
                    default:
                        e.preventDefault();
                        alert('Figura no válida seleccionada.');
                        return;
                }
            }
            
            // ========================================
            // VALIDACIONES PARA CALC3 (Calculadora de Funciones)
            // ========================================
            else if (currentPage.includes('calc3.php')) {
                const figuraSelect = document.getElementById('figuraSelect');
                const operacion = figuraSelect.value;
                
                // Validar que se haya seleccionado una operación
                if (!operacion || operacion === '') {
                    e.preventDefault();
                    alert('Por favor, seleccione una operación.');
                    return;
                }
                
                // Validar según la operación seleccionada
                switch(operacion) {
                    case 'calcBask':
                        const a = document.querySelector('#calcBask input[name="a"]').value;
                        const b = document.querySelector('#calcBask input[name="b"]').value;
                        const c = document.querySelector('#calcBask input[name="c"]').value;
                        
                        if (!validarCampoNumerico(a, 'coeficiente A') || 
                            !validarCampoNumerico(b, 'coeficiente B') || 
                            !validarCampoNumerico(c, 'coeficiente C')) {
                            e.preventDefault();
                            return;
                        }
                        
                        // A no puede ser cero
                        if (parseFloat(a) === 0) {
                            e.preventDefault();
                            alert('El coeficiente A no puede ser cero en una ecuación cuadrática.');
                            return;
                        }
                        break;
                        
                    case 'calcRaiz':
                        const num1 = document.querySelector('#calcRaiz input[name="num1"]').value;
                        if (!validarCampoNumerico(num1, 'número para la raíz cuadrada')) {
                            e.preventDefault();
                            return;
                        }
                        
                        // No puede ser negativo
                        if (parseFloat(num1) < 0) {
                            e.preventDefault();
                            alert('No se puede calcular la raíz cuadrada de un número negativo.');
                            return;
                        }
                        break;
                        
                    case 'calcPot':
                        const base = document.querySelector('#calcPot input[name="base"]').value;
                        const exp = document.querySelector('#calcPot input[name="exp"]').value;
                        
                        if (!validarCampoNumerico(base, 'base') || 
                            !validarCampoNumerico(exp, 'exponente')) {
                            e.preventDefault();
                            return;
                        }
                        
                        // 0 elevado a exponente negativo
                        if (parseFloat(base) === 0 && parseFloat(exp) < 0) {
                            e.preventDefault();
                            alert('No se puede calcular 0 elevado a un exponente negativo.');
                            return;
                        }
                        break;
                        
                    default:
                        e.preventDefault();
                        alert('Operación no válida seleccionada.');
                        return;
                }
            }
        });
    }
});

// ========================================
// FUNCIONES DE VALIDACIÓN
// ========================================

// Función para validar campos que deben ser positivos
function validarCampoPositivo(valor, nombreCampo) {
    if (valor === '' || valor === null || valor === undefined) {
        alert(`Por favor, ingrese el ${nombreCampo}.`);
        return false;
    }
    
    if (isNaN(valor) || !isFinite(valor)) {
        alert(`El ${nombreCampo} debe ser un número válido.`);
        return false;
    }
    
    const numero = parseFloat(valor);
    if (numero <= 0) {
        alert(`El ${nombreCampo} debe ser un número positivo mayor que cero.`);
        return false;
    }
    
    return true;
}

// Función para validar campos numéricos (permite negativos)
function validarCampoNumerico(valor, nombreCampo) {
    if (valor === '' || valor === null || valor === undefined) {
        alert(`Por favor, ingrese ${nombreCampo}.`);
        return false;
    }
    
    if (isNaN(valor) || !isFinite(valor)) {
        alert(`${nombreCampo} debe ser un número válido.`);
        return false;
    }
    
    return true;
}