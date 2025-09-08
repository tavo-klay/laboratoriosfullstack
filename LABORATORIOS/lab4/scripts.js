document.addEventListener('DOMContentLoaded', function(e) {
    
    const cedulaCompleta = document.getElementById('cedulaCompleta');
    if (cedulaCompleta) {
        cedulaCompleta.addEventListener('input', function(e) {
            // Remover cualquier caracter que no sea número
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Limitar a 8 dígitos
            if (this.value.length > 8) {
                this.value = this.value.substring(0, 8);
            }
        });

        // Validar al salir del campo
        cedulaCompleta.addEventListener('blur', function(e) {
            if (this.value.length > 0 && this.value.length < 8) {
                this.style.borderColor = 'var(--error-color)';
                this.title = 'La cédula debe tener exactamente 8 dígitos';
            } else {
                this.style.borderColor = 'var(--border-color)';
                this.title = '';
            }
        });
    }

    // Validar input de primeros 7 dígitos
    const primerosSiete = document.getElementById('primerosSiete');
    if (primerosSiete) {
        primerosSiete.addEventListener('input', function(e) {
            // Remover cualquier caracter que no sea número
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Limitar a 7 dígitos
            if (this.value.length > 7) {
                this.value = this.value.substring(0, 7);
            }
        });

        // Validar al salir del campo
        primerosSiete.addEventListener('blur', function(e) {
            if (this.value.length > 0 && this.value.length < 7) {
                this.style.borderColor = 'var(--error-color)';
                this.title = 'Debe ingresar exactamente 7 dígitos';
            } else {
                this.style.borderColor = 'var(--border-color)';
                this.title = '';
            }
        });
    }
    
// Función para verificar números repetidos
function esNumeroRepetido(numero) {
    return numero.split('').every(d => d === numero[0]);
}

    // Validación del formulario antes del envío
    const form = document.getElementById('formNumeros');
    if (form) {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Validar cédula completa
            if (cedulaCompleta) {
                const valor = cedulaCompleta.value.trim();
              if (valor.length !== 8 || !/^[0-9]{8}$/.test(valor) || esNumeroRepetido(valor)) {
    mostrarError(cedulaCompleta, 'Cédula inválida (no se permiten todos los dígitos iguales)');
                    isValid = false;
                } else {
                    limpiarError(cedulaCompleta);
                }
            }
            
            // Validar primeros 7 dígitos
            if (primerosSiete) {
                const valor = primerosSiete.value.trim();
             if (valor.length !== 7 || !/^[0-9]{7}$/.test(valor) || esNumeroRepetido(valor)) {
    mostrarError(primerosSiete, 'Número inválido (no se permiten todos los dígitos iguales)');
                    isValid = false;
                } else {
                    limpiarError(primerosSiete);
                }
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    }

 

    if (cedulaCompleta) {
        cedulaCompleta.addEventListener('input', function() {
            if (this.value.length === 8) {
                // Auto-enviar después de una pequeña pausa
                setTimeout(() => {
                    if (this.value.length === 8 && /^[0-9]{8}$/.test(this.value)) {
                        // Opcional: auto-enviar el formulario
                        // form.submit();
                    }
                }, 500);
            }
        });
    }

    if (primerosSiete) {
        primerosSiete.addEventListener('input', function() {
            if (this.value.length === 7) {
                // Auto-enviar después de una pequeña pausa
                setTimeout(() => {
                    if (this.value.length === 7 && /^[0-9]{7}$/.test(this.value)) {
s                        // form.submit();
                    }
                }, 500);
            }
        });
    }
});

// Función para mostrar errores de validación
function mostrarError(elemento, mensaje) {
    elemento.style.borderColor = 'var(--error-color)';
    elemento.title = mensaje;
    
    // Agregar clase de error si no existe
    if (!elemento.classList.contains('error')) {
        elemento.classList.add('error');
    }
}

// Función para limpiar errores
function limpiarError(elemento) {
    elemento.style.borderColor = 'var(--border-color)';
    elemento.title = '';
    elemento.classList.remove('error');
}