var globalCarrData = '';
var globalCarrNombre = '';

    //###################################################-CARRERA-#########################################################  
        //---------------------------------SELECT CARRERA-------------------------------------------------
        function selecCarrera(globalUniData) {
          $('#selectCarrAjax').empty();//BORRA TODO EL CONTENEDOR 
          

          var uniData = {
            idU: globalUniData, // Crear un objeto con lo necesario
          }; 
          $.ajax({
            type: 'POST',
            data: uniData,
            url: baseUrl + 'carreraAjaxC',
            dataType: 'json',
            success: function(response) {
            //encabezado del select       
    
        
            // Iterar sobre cada universidad y agregarlo al contenedor
            $.each(response, function(index, carrera) {
              //crear un objeto para pasarlo por data-universidad la cual será utilizada mas adelante.
              var carreraData = {
              idU: carrera.idU,
              idCarrera: carrera.idCarrera,
              nombreCarrera: carrera.nombreCarrera,
              descripcionCarrera: carrera.descripcionCarrera, 
              imagenCarrera: carrera.imagenCarrera
              };
              var carreraHTML = 
                `
                <div onclick="manejarClick(this)" class="card" data-id-carrera="${carrera.idCarrera}" data-nombre-carrera="${carrera.nombreCarrera}" data-imagen-carrera="${carrera.imagenCarrera}" >
                  <img src="${carrera.imagenCarrera}" alt="By AnisSoft" draggable="false" class="cover-image" />
                  <div class="card-body">
                      <h5 class="card-title">${carrera.nombreCarrera}</h5>
                      <p class="card-hover-description">Click para ver materias</p>
                  </div>
                </div>

                `;
              $('#selectCarrAjax').append(carreraHTML);
              
            });
            //agregar el boton de crear universidad 
      }
    })
  }
      

//###################################################-CARRERA FILTRO-#########################################################

function manejarClick(button) {
  // Captura el idCarrera y nombreCarrera de los atributos data-id-carrera y data-nombre-carrera
  const idCarrera = button.getAttribute('data-id-carrera');
  const nombreCarrera = button.getAttribute('data-nombre-carrera');
  const imgCarrera = button.getAttribute('data-imagen-carrera');
  const welcomeSection2 = document.querySelector('.mensaje-inicio2');

  // Actualiza las variables globales
  globalCarrData = idCarrera;
  globalCarrNombre = nombreCarrera;

  // Opcional: Verificar que las variables se actualicen correctamente
  console.log('globalCarrData:', globalCarrData);
  console.log('globalCarrNombre:', globalCarrNombre);

  // Establecer el background-image usando el valor de imgCarrera
  welcomeSection2.style.backgroundImage = `url(${imgCarrera})`;
    
  // Opcional: Ajustar otras propiedades de estilo para asegurar que la imagen cubra el contenedor
  welcomeSection2.style.backgroundSize = 'cover';
  welcomeSection2.style.backgroundPosition = 'center';

  selecMateria(globalCarrData);
  mostrarSeccion('materia')
}