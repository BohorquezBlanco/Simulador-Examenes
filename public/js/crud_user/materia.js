//###################################################-MATERIA-#########################################################
var globalMateriaData = '';
var globalMatNombre = '';
//---------------------------------SELECT MATERIA-------------------------------------------------
function selecMateria(globalCarrData) {
  $("#selectMatAjax").empty(); //BORRA TODO EL CONTENEDOR
  var uniData = {
    idCarrera: globalCarrData, // Crear un objeto con lo necesario
  };
  console.log("Soy unidata" + uniData);
  $.ajax({
    type: "POST",
    data: uniData,
    url: baseUrl + "materiaAjaxC",
    dataType: "json",
    success: function (response) {
      // Iterar sobre cada universidad y agregarlo al contenedor
      $.each(response, function (index, materia) {
        //crear un objeto para pasarlo por data-universidad la cual será utilizada mas adelante.
        var materiaData = {
          idCarrera: materia.idCarrera,
          idMateria: materia.idMateria,
          nombreMateria: materia.nombreMateria,
          descripcionMateria: materia.descripcionMateria,
          imagenMateria: materia.imagenMateria,
        };

        var MateriaHTML = `
                <div onclick="manejarClick2(this)" class="card" data-id-materia="${materia.idMateria}" data-nombre-materia="${materia.nombreMateria}" data-imagen-materia="${materia.imagenMateria}"'>
                  <img src="${materia.imagenMateria}" alt="By AnisSoft" title="${materia.nombreMateria}" draggable="false" class="cover-image"  />
                  <div class="card-body">
                    <h5 class="card-title">${materia.nombreMateria}</h5>
                    <p class="card-hover-description">Click para ver temarios</p>
                  </div>
                </div>
                `;
        $("#selectMatAjax").append(MateriaHTML);
      });
    }
  });
}
//###################################################-MATERIA FILTRO-#########################################################

function manejarClick2(button) {
  // Captura el idCarrera y nombreCarrera de los atributos data-id-carrera y data-nombre-carrera
  const idMateria = button.getAttribute('data-id-materia');
  const nombreMateria = button.getAttribute('data-nombre-materia');
  const imagenMateria = button.getAttribute('data-imagen-materia');
  const welcomeSection3 = document.querySelector('.mensaje-inicio3');

  // Actualiza las variables globales
  globalMateriaData = idMateria;
  globalMatNombre  = nombreMateria;

// Establecer el background-image usando el valor de imgCarrera
welcomeSection3.style.backgroundImage = `url(${imagenMateria})`;
    
// Opcional: Ajustar otras propiedades de estilo para asegurar que la imagen cubra el contenedor
welcomeSection3.style.backgroundSize = 'cover';
welcomeSection3.style.backgroundPosition = 'center';

  // Opcional: Verificar que las variables se actualicen correctamente
  console.log('globalMatData:',   globalMateriaData);
  console.log('globalMatNombre:',   globalMatNombre);
  
  selecTemario(globalMateriaData);
  mostrarSeccion('temario')
}