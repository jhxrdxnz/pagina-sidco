// JavaScript para manejar el cambio de texto del input de archivo CV
document.addEventListener('DOMContentLoaded', function() {
    const cvInput = document.getElementById('cv');
    
    if (cvInput) {
        cvInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                // Obtener el nombre del archivo
                const fileName = this.files[0].name;
                
                // Crear un elemento span para mostrar el nombre del archivo
                let fileLabel = this.parentNode.querySelector('.file-label');
                if (!fileLabel) {
                    fileLabel = document.createElement('span');
                    fileLabel.className = 'file-label';
                    fileLabel.style.cssText = `
                        display: block;
                        margin-top: 5px;
                        font-size: 14px;
                        color: #28a745;
                        font-weight: 600;
                    `;
                    this.parentNode.appendChild(fileLabel);
                }
                fileLabel.textContent = `Archivo seleccionado: ${fileName}`;
                
                // Agregar una clase al input para estilizar
                this.classList.add('archivo-seleccionado');
                
                // Ocultar completamente el texto del input
                this.style.color = 'transparent';
                this.style.fontSize = '0';
                
            } else {
                // Si no hay archivo seleccionado, remover el label
                const fileLabel = this.parentNode.querySelector('.file-label');
                if (fileLabel) {
                    fileLabel.remove();
                }
                
                this.classList.remove('archivo-seleccionado');
                this.style.color = 'transparent';
                this.style.fontSize = '16px'; // Restaurar tamaño de fuente
            }
        });
    }
});
