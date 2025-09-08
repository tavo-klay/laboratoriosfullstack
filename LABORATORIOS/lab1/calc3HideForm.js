// ========================================
// calc3HideForm.js - Para mostrar/ocultar campos en calc3.php
// ========================================

function mostrarCampos() {
    const operacion = document.getElementById('figuraSelect').value;
    
    // Ocultar todos los campos
    const todosCampos = document.querySelectorAll('.input-field');
    todosCampos.forEach(campo => {
        campo.style.display = 'none';
        // Desactivar required en todos los inputs dentro del campo
        const inputs = campo.querySelectorAll('input');
        inputs.forEach(input => {
            input.removeAttribute('required');
            input.value = ''; // Limpiar valores previos
        });
    });
    
    // Mostrar solo el campo seleccionado
    if (operacion && operacion !== '') {
        const campoActivo = document.getElementById(operacion);
        if (campoActivo) {
            campoActivo.style.display = 'block';
            // Activar required en los inputs del campo activo
            const inputs = campoActivo.querySelectorAll('input');
            inputs.forEach(input => {
                input.setAttribute('required', 'required');
            });
        }
    }
}