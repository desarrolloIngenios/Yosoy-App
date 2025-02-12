<div class="modal fade" id="bd-example-modal-{{$user['id']}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h6 class="modal-title">Programas de {{$user['name']}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
              <div id="modalProgramasContenido{{$user['id']}}"></div>
          </div>
          <div class="modal-footer" id="programas{{$user['id']}}" style="display: none">
              <form id="form-programas{{$user['id']}}">
                  <label for="name">Programas disponibles</label>
                  <select class="form-control" id="programas_disponibles{{$user['id']}}">
                      <option value="">Seleccione un programa</option>
                  </select>
                  <button type="submit" class="btn btn-primary">Asignar</button>
              </form>
          </div>
      </div>
    </div>
  </div>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
  
      var isSubmitting = false;  // Estado para prevenir múltiples envíos
  
      // Asegurarse de que solo se adjunte una vez el evento 'shown.bs.modal'
      $('.modal').off('shown.bs.modal').on('shown.bs.modal', function () {
          var modalId = $(this).attr('id');
          var userId = modalId.split('-')[3];
  
          var modalContent = $('#modalProgramasContenido' + userId);
          var programasSelect = $('#programas_disponibles' + userId);
          var formPrograms = $('#programas' + userId);
  
          if (modalContent.length && modalContent.html().trim() === '') {
              $.ajax({
                  url: '/candidato/' + userId,
                  method: 'GET',
                  success: function(response) {
                      $(formPrograms).show();
                      modalContent.empty();
                      programasSelect.empty();
                      programasSelect.append('<option value="">Seleccione un programa</option>');
                      response.programas_disponible.forEach(function(programa) {
                          var option = `<option value="${programa.id}">${programa.title}</option>`;
                          programasSelect.append(option);
                      });
  
                      if (response.programas && response.programas.length > 0) {
                          response.programas.forEach(function(programa) {
                              var listItem = `
                                  <div class="border mb-1 rounded">
                                      <p class='text-center'>${programa.show__title}  -  <small class='h2' style="color: #5F208A">${programa.show__user__progress__percent} %</small> </p>
                                  </div>
                              `;
                              modalContent.append(listItem);
                          });
                      } else {
                          modalContent.html('<div class="border mb-1 rounded">No se han asignado programas.</div>');
                      }
                  },
                  error: function(error) {
                      console.error('Error al cargar los datos:', error);
                      modalContent.html('<div class="border mb-1 rounded">El usuario no está registrado en la plataforma de entrenamiento.</div>');
                  }
              });
          } else {
              console.log('El contenido ya ha sido cargado para este modal.');
          }
      });
  
      // Prevenir múltiples envíos de formularios
      $('form[id^="form-programas"]').submit(function(e) {
          e.preventDefault();  // Evitar el envío tradicional del formulario
  
          // Comprobar si ya se está enviando el formulario
          if (isSubmitting) {
              console.log("Formulario ya está siendo enviado. Prevención de envío.");
              return;  // Prevenir el envío si ya se está procesando una solicitud
          }
  
          isSubmitting = true;  // Marcar que se está enviando el formulario
          var submitButton = $(this).find('button[type="submit"]');
          var userId = $(this).attr('id').replace('form-programas', '');  
          var programId = $('#programas_disponibles' + userId).val();  
  
          // Verificar si se ha seleccionado un programa
          if (programId === '') {
              alert('Por favor, selecciona un programa.');
              isSubmitting = false;  // Restablecer el estado
              return;
          }
  
          if (submitButton.prop('disabled')) {
              return;  // Evitar el envío si el botón está deshabilitado
          }
  
          submitButton.prop('disabled', true);  // Deshabilitar el botón para prevenir envíos adicionales
  
          $.ajax({
              url: '/asignar-candidato',  // URL de la solicitud AJAX
              type: 'POST',
              data: {
                  user_id: userId,
                  program_id: programId,
                  _token: '{{ csrf_token() }}'  // Token CSRF para la seguridad
              },
              success: function(response) {
                  if (response.success) {
                      alert('Programa asignado con éxito');
                      // Si es necesario, cierra el modal después del éxito
                      // $('#bd-example-modal-' + userId).modal('hide');
                  } else {
                      alert('Hubo un error al asignar el programa: ' + response.message);
                  }
              },
              error: function(xhr, status, error) {
                  alert('Error en la solicitud AJAX: ' + error);
              },
              complete: function() {
                  isSubmitting = false;  // Restablecer el estado de envío
                  submitButton.prop('disabled', false);  // Habilitar el botón nuevamente
              }
          });
      });
  });
  </script>
  