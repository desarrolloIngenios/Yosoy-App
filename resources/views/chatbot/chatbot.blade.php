<!-- resources/views/chatbot.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot con Voz</title>
</head>

<body>
    <div id="chatbox">
        <!-- Aquí se mostrarán los mensajes del chat -->
    </div>

    <div id="voice-input">
        <button id="start-voice">Iniciar entrada de voz</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        document.getElementById('start-voice').addEventListener('click', startVoiceInput);

        function startVoiceInput() {
            if ('SpeechRecognition' in window || 'webkitSpeechRecognition' in window) {
                var recognition = new(window.SpeechRecognition || window.webkitSpeechRecognition)();

                // Configurar opciones del reconocimiento
                recognition.lang = 'es-ES'; // Configura el idioma según tus necesidades
                recognition.maxAlternatives = 5; // Ajusta el número máximo de alternativas

                // Variables para controlar el temporizador y el intervalo de inactividad
                var timeout;
                var inactiveInterval =
                5000; // 2 segundos de inactividad antes de considerar que la persona ha terminado de hablar

                // Evento que se dispara cuando se inicia el reconocimiento
                recognition.onstart = function() {
                    console.log('El reconocimiento de voz ha comenzado.');
                };

                // Evento que se dispara cuando se detecta un resultado de voz
                recognition.onresult = function(event) {
                    var mensaje = event.results[0][0].transcript;
                    mostrarRespuestaBot('Has dicho: ' + mensaje);

                    // Aquí puedes enviar el mensaje al controlador de Laravel, por ejemplo, mediante AJAX
                    // ...

                    // Reiniciar el temporizador de inactividad
                    resetInactiveTimer();
                };

                // Evento que se dispara cuando se detiene el reconocimiento
                recognition.onend = function() {
                    console.log('El reconocimiento de voz ha terminado.');

                    // Reiniciar la captura de voz después de un tiempo de inactividad
                    timeout = setTimeout(function() {
                        recognition.start();
                    }, inactiveInterval);
                };

                // Función para reiniciar el temporizador de inactividad
                function resetInactiveTimer() {
                    clearTimeout(timeout);
                    timeout = setTimeout(function() {
                        recognition.stop();
                    }, inactiveInterval);
                }

                // Iniciar el reconocimiento de voz
                recognition.start();
            } else {
                console.error('Tu navegador no admite la API de Web Speech.');
            }
        }


        function enviarMensaje() {
            var mensaje = prompt('Ingresa tu mensaje de texto:');

            // Realizar la solicitud al controlador de Laravel para procesar el mensaje
            $.ajax({
                type: 'POST',
                url: '/lex-webhook',
                data: {
                    message: mensaje
                },
                success: function(response) {
                    mostrarRespuestaBot(response.message);
                },
                error: function(error) {
                    console.error('Error al procesar el mensaje:', error);
                }
            });
        }

        function mostrarRespuestaBot(respuesta) {
            // Mostrar la respuesta del bot en el chatbox
            $('#chatbox').append('<p><strong>Bot:</strong> ' + respuesta + '</p>');
        }
    </script>
</body>

</html>
