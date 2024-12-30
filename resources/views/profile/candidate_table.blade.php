<section id="no-more-tables">
    <div class="table-responsive border-top userlist-table">
        <table id="{{ $table_id ?? '' }}" class="table card-table table-striped table-vcenter text-nowrap mb-0">
            <thead>
                <tr>
                    <th class="wd-lg-8p"><span>Usuario</span></th>
                    <th class="wd-lg-20p"><span></span></th>
                    <th class="wd-lg-20p"><span>Contacto</span></th>
                    <th class="wd-lg-20p"><span>Programas</span></th>
                    <th class="wd-lg-20p">Acciones</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($candidatas as $user)
                    @if (is_null($user) || is_null($user['name']))
                        @continue
                    @endif
                    <tr id="{{ $loop->index }}" class="user_row" style="{{ $style ?? '' }}">
                        <td data-title="">
                            @if (isset($user['foto_perfil_url']))
                                <img alt="avatar" class="rounded-circle avatar-md mr-2"
                                    src="{{ \Storage::disk('s3')->temporaryUrl($user['foto_perfil_url'], '+10 minutes') }}">
                            @else
                                <img alt="avatar" class="rounded-circle avatar-md mr-2"
                                    src="{{ URL::asset('/assets/img/faces/1.jpg') }}">
                            @endif
                            {{-- {{ $user['name'] }} --}}
                        </td>
                        @if (isset($user['profile']))

                        <td data-title="Nombre">
                            <i class="las la-{{ $user['profile']['is_empirico'] ? 'hammer' : 'graduation-cap' }} tx-20"></i>
                            @if (trim($user['profile']['full_name']) == '')
                                {{ '-' }}
                            @else
                                {{ $user['profile']['full_name'] }}
                            @endif
                            <br>
                            {{ $user['profile']['grupo_social_nombre'] }}
                            <br>
                            {{ isset($user['profile']['ciudad_residencia']) && isset($user['profile']['ciudad_residencia']['pais_departamento_ciudad']) ? $user['profile']['ciudad_residencia']['pais_departamento_ciudad'] : '-' }}
                        </td>
                    @endif
                        
                        @if ($user['profile']['numero_contacto_1'] )
                            <td data-title="Número">
                                {{ $user['profile']['numero_contacto_1'] }} - {{ $user['profile']['numero_contacto_2'] }}
                                <br>
                                @if (trim($user['email']) == '')
                                    {{ '-' }}
                                @else
                                    {{ $user['email'] }}
                                @endif
                            </td>
                        @endif
         
                        @if ($user['profile']['perfiles_laborales'] )
                        
                            <td data-title="Experiencia">
                                @foreach ($user['profile']['perfiles_laborales'] as $perfil_laboral)
                                    {{ $perfil_laboral['nivel_experiencia'] ? $perfil_laboral['nivel_experiencia']['nombre'] : '' }}
                                    -
                                    {{ $perfil_laboral['cargo'] ? $perfil_laboral['cargo']['nombre'] : '' }}
                                    -
                                    {{ $perfil_laboral['tiempo_experiencia'] ? $perfil_laboral['tiempo_experiencia']['nombre'] : '' }}
                                    <br>
                                @endforeach
                            </td>
                        @else
                            <td>
                                Sin experiencia
                            </td>
                        @endif
                        <td data-title="Acciones">
                            <div class="d-flex my-xl-auto right-content">
                                <div class="pr-1 mb-xl-0">
                                    <a target="_blank"
                                        href="https://api.whatsapp.com/send?phone=57{{ str_replace(' ', '', $user['profile']['numero_contacto_1']) }}"
                                        class="btn btn-icon mr-2">
                                        <img alt="avatar" class="rounded-circle avatar-md mr-2"
                                            src="{{ URL::asset('/assets/img/faces/WhatsApp.webp') }}">
                                    </a>
                                </div>
                          
                              
                                <div class="pr-1 mb-xl-0">

                                
                                    <a data-target="#bd-example-modal-{{$user['id']}}" data-toggle="modal"
                                        class="btn btn-icon btn-warning mr-2">
                                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                    <div class="modal fade" id="bd-example-modal-{{$user['id']}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title">Programas de {{$user['name']}}</h6>
                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="modalProgramasContenido{{$user['id']}}">
                                   
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

                @endforeach
                 
            </tbody>
        </table>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
  
      var isSubmitting = false;  
  
  
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
                          modalContent.html('<div class="border mb-1 rounded">No hay programas disponibles.</div>');
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
  
   
      $('form[id^="form-programas"]').submit(function(e) {
          e.preventDefault();  
  
     
          if (isSubmitting) {
              console.log("Formulario ya está siendo enviado. Prevención de envío.");
              return;  
          }
  
          isSubmitting = true; 
          var submitButton = $(this).find('button[type="submit"]');
          var userId = $(this).attr('id').replace('form-programas', '');  
          var programId = $('#programas_disponibles' + userId).val();  
  
         
          if (programId === '') {
              alert('Por favor, selecciona un programa.');
              isSubmitting = false;
              return;
          }
  
          if (submitButton.prop('disabled')) {
              return; 
          }
  
          submitButton.prop('disabled', true);  
  
          $.ajax({
              url: '/asignar-candidato',  
              type: 'POST',
              data: {
                  user_id: userId,
                  program_id: programId,
                  _token: '{{ csrf_token() }}' 
              },
              success: function(response) {
                  if (response.success) {
                      alert('Programa asignado con éxito');
                
                      $('#bd-example-modal-' + userId).modal('hide');
                  } else {
                      alert('Hubo un error al asignar el programa: ' + response.message);
                  }
              },
              error: function(xhr, status, error) {
                  alert('Error en la solicitud AJAX: ' + error);
              },
              complete: function() {
                  isSubmitting = false;  
                  submitButton.prop('disabled', false); 
              }
          });
      });
  });
  </script>
  
