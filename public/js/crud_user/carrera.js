globalCarrData=1; // Definir la variable global
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
            url: baseUrl + 'carreraAjax',
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
                <div class="card draggable" id="carrera-${carrera.idCarrera}" draggable="true" data-carrera='${JSON.stringify(carreraData)}'>
                  <img src="${carrera.imagenCarrera}" alt="By AnisSoft" title="${carrera.nombreCarrera}" draggable="false" />
                  <div class="card-body">
                    <h3 class="card-title">${carrera.nombreCarrera}</h3>
                  </div>
                </div>
                `;
              $('#selectCarrAjax').append(carreraHTML);
              
            //llenar el filtro
            var filtroCarrera =               
            `<option value="${carrera.idCarrera}">${carrera.nombreCarrera}</option>`;
            $('.carreraSelect').append(filtroCarrera);
            });
            //agregar el boton de crear universidad 


          // Asignar los valores a las variables globales
          var datosUniversidad = obtenerPrimerIdYNombre(response, "idCarrera", "nombreCarrera");
          globalCarrData = datosUniversidad.primerId;
          globalCarrNombre = datosUniversidad.primerNombre;
          selecMateria(globalCarrData);



      
      }
    })
        }
      
     
      
//###################################################-CARRERA FILTRO-#########################################################

$('.universidadSelect').change(function() {
  var idU = $(this).val();
  globalUniData = idU; // Asignar uniData a la variable global
  selecCarrera(globalUniData);
  // Seleccionar la opción correspondiente en el segundo filtro
  $('.universidadSelect').val(idU);
});
