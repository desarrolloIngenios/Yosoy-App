<section id="no-more-tables">
    <div class="table-responsive border-top userlist-table">
        <table id="{{ $table_id ?? '' }}" class="table card-table table-striped table-vcenter text-nowrap mb-0">
            <thead>
                <tr>
                    <th class="wd-lg-8p"><span>Usuario</span></th>
                    <th class="wd-lg-20p"><span></span></th>
                    <th class="wd-lg-20p"><span>Contacto</span></th>
                    {{-- <th class="wd-lg-20p"><span>Experiencias</span></th> --}}
                    <th class="wd-lg-20p"><span>Trabaja</span></th>
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
                                {{ $user['profile']['grupo_social_nombre'] ?? '-' }}
                                <br>
                                {{ isset($user['profile']['ciudad_residencia']['pais_departamento_ciudad']) ? $user['profile']['ciudad_residencia']['pais_departamento_ciudad'] : '-' }}
                            </td>
                        @endif
                        @if (isset($user['profile']['numero_contacto_1']))
                            <td data-title="Número">
                                {{ $user['profile']['numero_contacto_1'] }} - {{ $user['profile']['numero_contacto_2'] ?? '-' }}
                                <br>
                                @if (trim($user['email']) == '')
                                    {{ '-' }}
                                @else
                                    {{ $user['email'] }}
                                @endif
                            </td>
                        @endif
                        {{-- @if (isset($user['profile']['perfiles_laborales']))
                            <td data-title="Experiencia">
                                @foreach ($user['profile']['perfiles_laborales'] as $perfil_laboral)
                                    {{ $perfil_laboral['nivel_experiencia']['nombre'] ?? '' }}
                                    -
                                    {{ $perfil_laboral['cargo']['nombre'] ?? '' }}
                                    -
                                    {{ $perfil_laboral['tiempo_experiencia']['nombre'] ?? '' }}
                                    <br>
                                @endforeach
                            </td>
                        @else
                            <td>
                                Sin experiencia
                            </td>
                        @endif --}}
                        @if (isset($user['profile']['experiencias_laborales']))
                            <td>
                                @php
                                    $trabajando = false;
                                @endphp
                                @foreach ($user['profile']['experiencias_laborales'] as $experiencia_laboral)
                                    @if ($experiencia_laboral['fecha_fin'] == null)
                                        Trabajando - {{ $experiencia_laboral['contrato']['nombre'] ?? '' }}
                                        @php
                                            $trabajando = true;
                                        @endphp
                                        @break
                                    @endif
                                @endforeach
                                @if (!$trabajando)
                                    No está trabajando
                                @endif
                            </td>
                        @else
                            <td>
                                Sin datos de empleabilidad
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
                                <div class="pr-1 mb-xl-0">
                                    <a data-target="#bd-comment-modal-{{$user['id']}}" data-toggle="modal"
                                        class="btn btn-icon btn-success mr-2">
                                        <i class="fa fa-comment" aria-hidden="true"></i>
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

                    <!-- Comment modal -->
                    <div class="modal fade" id="bd-comment-modal-{{$user['id']}}" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel{{$user['id']}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title">Comentario a {{$user['name']}}</h6>
                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="commentsList{{$user['id']}}" class="mb-2">
                                        <!-- Comentarios existentes (cargados por backend o AJAX si se implementa) -->
                                    </div>
                                    <form id="form-comment{{$user['id']}}">
                                        <div class="form-group">
                                            <label for="comment_text{{$user['id']}}">Escribe un comentario</label>
                                            <textarea id="comment_text{{$user['id']}}" class="form-control" rows="4"></textarea>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Enviar</button>
                                        </div>
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
        var isSubmittingComment = false;
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

        var currentUserId = {!! json_encode(auth()->id()) !!};
        var csrfToken = '{{ csrf_token() }}';

        // Configure AJAX to include CSRF token and send cookies (session)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            xhrFields: {
                withCredentials: true
            }
        });

        // Escape HTML to prevent XSS when rendering comments
        function escapeHtml(str) {
            return $('<div/>').text(str).html();
        }

        // Load comments when a comment modal is opened
        $(document).on('shown.bs.modal', '.modal', function () {
            var modalId = $(this).attr('id');
            if (!modalId || !modalId.startsWith('bd-comment-modal-')) {
                return;
            }
            var userId = modalId.replace('bd-comment-modal-', '');
            var container = $('#commentsList' + userId);
            if (!container.length) return;
            // Always reload to show latest comments
            container.data('loaded', false);
            container.html('<p>Cargando comentarios...</p>');
            $.ajax({
                url: '/mentee-comments/' + userId,
                method: 'GET',
                success: function(response) {
                    container.empty();
                    if (!response.comments || response.comments.length === 0) {
                        container.html('<div class="border mb-1 rounded p-2">No hay comentarios.</div>');
                        return;
                    }
                    response.comments.forEach(function(c) {
                        var authorName = (c.author && c.author.name) ? c.author.name : 'Sistema';
                        var createdAt = c.created_at ? c.created_at : '';
                        var deleteBtn = (currentUserId && c.author_id == currentUserId) ? '<button class="btn btn-sm btn-danger ml-2 delete-comment-btn" data-id="' + c.id + '">Eliminar</button>' : '';
                        var html = '<div class="border mb-1 rounded p-2 comment-item">'
                            + '<div class="d-flex justify-content-between align-items-center">'
                            + '<div><strong>' + escapeHtml(authorName) + '</strong> <small class="text-muted">' + escapeHtml(createdAt) + '</small></div>'
                            + '<div>' + deleteBtn + '</div>'
                            + '</div>'
                            + '<p>' + escapeHtml(c.comment) + '</p>'
                            + '</div>';
                        container.append(html);
                    });
                    container.data('loaded', true);
                },
                error: function(xhr, status, error) {
                    var msg = 'Error cargando comentarios. HTTP ' + xhr.status;
                    try {
                        msg += ' - ' + (xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : xhr.responseText);
                    } catch (e) {
                        msg += ' - ' + xhr.responseText;
                    }
                    container.html('<div class="border mb-1 rounded p-2 text-danger">' + escapeHtml(msg) + '</div>');
                    console.error('Error loading comments:', xhr.status, xhr.responseText);
                }
            });
        });

        // Handle comment deletion (delegated)
        $(document).on('click', '.delete-comment-btn', function(e) {
            e.preventDefault();
            var btn = $(this);
            var commentId = btn.data('id');
            if (!confirm('¿Eliminar este comentario?')) return;
            btn.prop('disabled', true);
            $.ajax({
                url: '/mentee-comments/' + commentId,
                type: 'DELETE',
                data: { _token: csrfToken },
                success: function(resp) {
                    if (resp.success) {
                        btn.closest('.comment-item').remove();
                    } else {
                        alert(resp.message || 'No se pudo eliminar el comentario.');
                        btn.prop('disabled', false);
                    }
                },
                error: function(xhr) {
                    var text = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : xhr.responseText;
                    alert('Error en la solicitud. HTTP ' + xhr.status + ' - ' + text);
                    btn.prop('disabled', false);
                }
            });
        });

        // Handle comment form submissions
        $('form[id^="form-comment"]').submit(function(e) {
            e.preventDefault();
            if (isSubmittingComment) {
                console.log("Formulario de comentario ya está siendo enviado.");
                return;
            }
            isSubmittingComment = true;
            var submitButton = $(this).find('button[type="submit"]');
            var userId = $(this).attr('id').replace('form-comment', '');
            var commentText = $('#comment_text' + userId).val().trim();
            if (commentText === '') {
                alert('Por favor, escribe un comentario.');
                isSubmittingComment = false;
                return;
            }
            submitButton.prop('disabled', true);
            $.ajax({
                url: '/mentee-comments',
                type: 'POST',
                data: {
                    mentee_id: userId,
                    comment: commentText,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        alert('Comentario guardado.');
                        $('#bd-comment-modal-' + userId).modal('hide');
                        $('#comment_text' + userId).val('');
                    } else {
                        alert('Error al guardar comentario: ' + (response.message || ''));
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error en la solicitud AJAX: ' + error);
                },
                complete: function() {
                    isSubmittingComment = false;
                    submitButton.prop('disabled', false);
                }
            });
        });
    });
</script>

