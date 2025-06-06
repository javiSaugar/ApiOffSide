<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentación de la API - OFFSIDE</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@300;400&display=swap');

        :root {
            --primary-dark: #2b2b2b; /* Fondo principal oscuro */
            --secondary-accent: #4CAF50; /* Verde vibrante para acentos (deportivo, energía) */
            --text-light: #e0e0e0; /* Texto claro principal */
            --bg-medium-dark: #3c3c3c; /* Fondos de tarjetas/secciones un poco más claros que el principal */
            --text-medium: #b0b0b0; /* Texto secundario gris medio */
            --white: #ffffff; /* Blanco para elementos muy específicos o iconos */
            --hover-lift: translateY(-5px);
            --transition-speed: 0.4s ease-in-out;
            --border-radius: 12px;
        }

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--primary-dark);
            color: var(--text-light);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden; /* Prevent horizontal scroll */
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
            width: 100%;
        }

        /* --- Header for API Doc --- */
        header {
            background-color: var(--primary-dark);
            color: var(--white);
            padding: 30px 0;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.4);
            border-bottom-left-radius: var(--border-radius);
            border-bottom-right-radius: var(--border-radius);
            margin-bottom: 20px;
        }

        header h1 {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            font-size: 3.5em;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.6);
        }

        header p {
            font-size: 1.2em;
            margin-top: 10px;
            opacity: 0.8;
        }

        /* --- API Documentation Section (main content) --- */
        .api-doc-section {
            background-color: var(--bg-medium-dark);
            margin: 20px 0;
            padding: 40px;
            border-radius: var(--border-radius);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
            transition: transform var(--transition-speed);
        }

        .api-doc-section:hover {
            transform: var(--hover-lift);
        }

        .api-doc-section h2 {
            font-family: 'Montserrat', sans-serif;
            color: var(--secondary-accent);
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5em;
            border-bottom: 4px solid var(--secondary-accent);
            padding-bottom: 10px;
            display: inline-block;
            width: auto;
            max-width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.4);
        }

        .api-doc-section > p { /* Styling for the general intro paragraph under h2 */
            font-size: 1.1em;
            color: var(--text-medium);
            margin-bottom: 1em;
        }

        /* --- Individual Endpoint Styling --- */
        .api-doc .endpoint {
            background-color: var(--primary-dark);
            padding: 25px;
            margin-bottom: 20px;
            border-radius: var(--border-radius);
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            transition: box-shadow var(--transition-speed);
        }

        .api-doc .endpoint:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }

        .api-doc .endpoint h3 {
            font-family: 'Montserrat', sans-serif;
            color: var(--white);
            font-size: 1.6em;
            margin-top: 0;
            margin-bottom: 15px;
            border-bottom: 2px solid var(--secondary-accent);
            padding-bottom: 8px;
        }

        .api-doc .endpoint .method {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            margin-right: 10px;
            font-size: 0.9em;
        }

        .api-doc .endpoint .method.post { background-color: #f44336; color: var(--white); } /* Red */
        .api-doc .endpoint .method.get { background-color: #4CAF50; color: var(--white); } /* Green */
        .api-doc .endpoint .method.put { background-color: #ff9800; color: var(--white); } /* Orange */
        .api-doc .endpoint .method.patch { background-color: #2196f3; color: var(--white); } /* Blue */
        .api-doc .endpoint .method.delete { background-color: #f44336; color: var(--white); } /* Red */

        .api-doc .endpoint .path {
            font-family: 'Courier New', monospace;
            background-color: #1a1a1a;
            color: #8BC34A; /* Light green for path */
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 1em;
        }

        .api-doc .endpoint p {
            margin-top: 10px;
            font-size: 0.95em;
            color: var(--text-medium);
        }

        .api-doc .endpoint h4 {
            color: var(--secondary-accent);
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 1.1em;
            border-left: 3px solid var(--secondary-accent);
            padding-left: 10px;
        }

        .api-doc .endpoint pre {
            background-color: #1a1a1a;
            color: #f0f0f0;
            padding: 15px;
            border-radius: 8px;
            overflow-x: auto;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
            border: 1px solid #444;
        }

        /* --- Footer --- */
        footer {
            background-color: var(--primary-dark);
            color: var(--text-medium);
            text-align: center;
            padding: 25px 0;
            margin-top: auto;
            font-size: 0.9em;
            box-shadow: 0 -4px 15px rgba(0,0,0,0.4);
            border-top-left-radius: var(--border-radius);
            border-top-right-radius: var(--border-radius);
        }

        footer p {
            margin: 0;
            opacity: 0.7;
        }

        /* --- Responsive Design --- */
        @media (max-width: 768px) {
            header h1 {
                font-size: 2.8em;
            }

            .api-doc-section {
                padding: 30px 20px;
            }

            .api-doc-section h2 {
                font-size: 2em;
            }
        }

        @media (max-width: 480px) {
            header h1 {
                font-size: 2.2em;
            }

            .api-doc-section {
                padding: 25px 15px;
            }

            .api-doc-section h2 {
                font-size: 1.7em;
            }

            .api-doc .endpoint {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <header>
        <div class="container">
            <h1>Documentación API OFFSIDE</h1>
            <p>Guía completa para interactuar con nuestra plataforma deportiva</p>
        </div>
    </header>

    <main class="container">
        <section class="api-doc-section api-doc">
            <h2>Rutas Públicas de la API</h2>
            <p>Aquí se detallan las rutas de la API de OFFSIDE.</p>

            <h3>Autenticación y Gestión de Usuarios</h3>
            <div class="endpoint">
                <h3><span class="method post">POST</span> <span class="path">/login</span></h3>
                <p><strong>Descripción:</strong> Autentica a un usuario y emite un token API de Sanctum.</p>
                <h4>Cuerpo de la Solicitud (JSON):</h4>
<pre>{
    "email": "string (requerido, formato email)",
    "password": "string (requerido)"
}</pre>
                <h4>Respuestas:</h4>
<pre><strong>200 OK:</strong>
{
    "mensaje": "Inicio de sesión exitoso",
    "token": "YOUR_SANCTUM_TOKEN",
    "token_type": "Bearer",
    "user": {
        "id": 1,
        "name": "Nombre de Usuario",
        "email": "usuario@example.com",
        "telf": "123456789",
        "nom_ape": "Apellido de Usuario"
    }
}

<strong>401 Unauthorized:</strong>
{
    "mensaje": "Las credenciales proporcionadas son incorrectas"
}

<strong>422 Unprocessable Entity:</strong>
{
    "mensaje": "Faltan campos por rellenar o los campos no son válidos",
    "errores": {
        "email": ["El campo email es obligatorio."],
        "password": ["El campo password es obligatorio."]
    }
}</pre>
            </div>

            <div class="endpoint">
                <h3><span class="method post">POST</span> <span class="path">/usuarios</span></h3>
                <p><strong>Descripción:</strong> Registra un nuevo usuario. (Aunque la documentación adjunta lo marca como protegido por `auth:sanctum`, su propósito de registro lo hace público para nuevos usuarios.)</p>
                <h4>Cuerpo de la Solicitud (JSON):</h4>
<pre>{
    "name": "string (requerido, max:255)",
    "email": "string (requerido, formato email, único)",
    "password": "string (requerido, min:6)",
    "telf": "string (opcional, max:15)",
    "nom_ape": "string (opcional, max:255)"
}</pre>
                <h4>Respuestas:</h4>
<pre><strong>201 Created:</strong>
{
    "message": "Usuario creado correctamente.",
    "user": {
        "name": "Nuevo Usuario",
        "email": "nuevo@example.com",
        "telf": null,
        "nom_ape": null,
        "id": 2
    }
}

<strong>422 Unprocessable Entity:</strong>
{
    "errors": {
        "email": ["El email ya ha sido tomado."]
    }
}</pre>
            </div>

            <h3>Sesiones</h3>
            <div class="endpoint">
                <h3><span class="method get">GET</span> <span class="path">/sesiones</span></h3>
                <p><strong>Descripción:</strong> Recupera una lista de todas las sesiones de entrenamiento, incluyendo la instalación, deporte, usuario y actividades relacionadas.</p>
                <h4>Respuestas:</h4>
<pre><strong>200 OK:</strong>
[
    {
        "ses_id": 1,
        "ses_hora": "10:00",
        "ses_fecha": "2025-06-15",
        "ses_ins_id": 1,
        "ses_dep_id": 1,
        "ses_use_id": 1,
        "ses_precio": 15.50,
        "ses_nombre": "Yoga Matutino",
        "instalacion": { "ins_id": 1, "ins_nombre": "Gimnasio Central" },
        "deporte": { "dep_id": 1, "dep_nombre": "Yoga" },
        "usuario": { "id": 1, "name": "Profesor A" },
        "actividades": [ { "act_id": 1, "act_ses_id": 1 } ]
    }
]</pre>
            </div>

            <div class="endpoint">
                <h3><span class="method get">GET</span> <span class="path">/sesiones/{id}</span></h3>
                <p><strong>Descripción:</strong> Recupera una única sesión por su ID, incluyendo la instalación, deporte, usuario y actividades relacionadas.</p>
                <h4>Parámetros de Ruta:</h4>
                <ul>
                    <li><code>id</code> (entero, <strong>requerido</strong>): El ID de la sesión.</li>
                </ul>
                <h4>Respuestas:</h4>
<pre><strong>200 OK:</strong>
{
    "ses_id": 1,
    "ses_hora": "10:00",
    "ses_fecha": "2025-06-15",
    "ses_ins_id": 1,
    "ses_dep_id": 1,
    "ses_use_id": 1,
    "ses_precio": 15.50,
    "ses_nombre": "Yoga Matutino",
    "instalacion": { "ins_id": 1, "ins_nombre": "Gimnasio Central" },
    "deporte": { "dep_id": 1, "dep_nombre": "Yoga" },
    "usuario": { "id": 1, "name": "Profesor A" },
    "actividades": [ { "act_id": 1, "act_ses_id": 1 } ]
}

<strong>404 Not Found:</strong>
{
    "message": "Sesión no encontrada"
}</pre>
            </div>

            <div class="endpoint">
                <h3><span class="method get">GET</span> <span class="path">/sesiones/filtrar/{nombre}</span></h3>
                <p><strong>Descripción:</strong> Busca sesiones por nombre.</p>
                <h4>Parámetros de Ruta:</h4>
                <ul>
                    <li><code>nombre</code> (string, <strong>requerido</strong>): El nombre o parte del nombre a buscar.</li>
                </ul>
                <h4>Respuestas:</h4>
<pre><strong>200 OK:</strong>
[
    {
        "ses_id": 1,
        "ses_nombre": "Sesión de Pilates",
        "instalacion": { /* ... */ },
        "deporte": { /* ... */ },
        "usuario": { /* ... */ },
        "actividades": [ /* ... */ ]
    }
]

<strong>404 Not Found:</strong>
{
    "message": "Sesión no encontrada"
}</pre>
            </div>

            <h3>Actividades</h3>
            <div class="endpoint">
                <h3><span class="method get">GET</span> <span class="path">/actividades</span></h3>
                <p><strong>Descripción:</strong> Recupera una lista de todas las actividades registradas en sesiones.</p>
                <h4>Respuestas:</h4>
<pre><strong>200 OK:</strong>
[
    { "act_id": 1, "act_ses_id": 1, "act_use_id": 1 },
    { "act_id": 2, "act_ses_id": 1, "act_use_id": 2 }
]</pre>
            </div>

            <div class="endpoint">
                <h3><span class="method get">GET</span> <span class="path">/actividades/{id}</span></h3>
                <p><strong>Descripción:</strong> Recupera una única actividad por su ID, incluyendo la sesión y el usuario asociados.</p>
                <h4>Parámetros de Ruta:</h4>
                <ul>
                    <li><code>id</code> (entero, <strong>requerido</strong>): El ID de la actividad.</li>
                </ul>
                <h4>Respuestas:</h4>
<pre><strong>200 OK:</strong>
{
    "act_id": 1,
    "act_ses_id": 1,
    "act_use_id": 1,
    "sesion": { /* Objeto Sesion */ },
    "usuario": { /* Objeto User */ }
}

<strong>404 Not Found:</strong>
{
    "message": "Actividad no encontrada"
}</pre>
            </div>

            <div class="endpoint">
                <h3><span class="method get">GET</span> <span class="path">/actividades/sesion/{sesionId}</span></h3>
                <p><strong>Descripción:</strong> Recupera todas las actividades asociadas a un ID de sesión específico.</p>
                <h4>Parámetros de Ruta:</h4>
                <ul>
                    <li><code>sesionId</code> (entero, <strong>requerido</strong>): El ID de la sesión.</li>
                </ul>
                <h4>Respuestas:</h4>
<pre><strong>200 OK:</strong>
{
    "message": "Actividades encontradas.",
    "data": [
        { "act_id": 1, "act_ses_id": 1, "act_use_id": 1 },
        { "act_id": 2, "act_ses_id": 1, "act_use_id": 2 }
    ]
}

<strong>404 Not Found:</strong>
{
    "message": "No se encontraron actividades para esta sesión."
}</pre>
            </div>

            <div class="endpoint">
                <h3><span class="method get">GET</span> <span class="path">/actividades/usuario/{userId}</span></h3>
                <p><strong>Descripción:</strong> Recupera todas las actividades asociadas a un ID de usuario específico.</p>
                <h4>Parámetros de Ruta:</h4>
                <ul>
                    <li><code>userId</code> (entero, <strong>requerido</strong>): El ID del usuario.</li>
                </ul>
                <h4>Respuestas:</h4>
<pre><strong>200 OK:</strong>
{
    "message": "Actividades encontradas.",
    "data": [
        { "act_id": 1, "act_ses_id": 1, "act_use_id": 1 },
        { "act_id": 3, "act_ses_id": 2, "act_use_id": 1 }
    ]
}

<strong>404 Not Found:</strong>
{
    "message": "No se encontraron actividades para este usuario."
}</pre>
            </div>

            <h3>Deportes</h3>
            <div class="endpoint">
                <h3><span class="method get">GET</span> <span class="path">/deportes</span></h3>
                <p><strong>Descripción:</strong> Recupera una lista de todos los deportes.</p>
                <h4>Respuestas:</h4>
<pre><strong>200 OK:</strong>
[
    { "dep_id": 1, "dep_nombre": "Fútbol", "dep_numparticipantes": 22 },
    { "dep_id": 2, "dep_nombre": "Baloncesto", "dep_numparticipantes": 10 }
]</pre>
            </div>

            <div class="endpoint">
                <h3><span class="method get">GET</span> <span class="path">/deportes/{id}</span></h3>
                <p><strong>Descripción:</strong> Recupera un único deporte por su ID.</p>
                <h4>Parámetros de Ruta:</h4>
                <ul>
                    <li><code>id</code> (entero, <strong>requerido</strong>): El ID del deporte.</li>
                </ul>
                <h4>Respuestas:</h4>
<pre><strong>200 OK:</strong>
{
    "dep_id": 1,
    "dep_nombre": "Fútbol",
    "dep_numparticipantes": 22
}

<strong>404 Not Found:</strong>
{
    "message": "Deporte no encontrado"
}</pre>
            </div>

            <h3>Instalaciones</h3>
            <div class="endpoint">
                <h3><span class="method get">GET</span> <span class="path">/instalaciones</span></h3>
                <p><strong>Descripción:</strong> Recupera una lista de todas las instalaciones deportivas.</p>
                <h4>Respuestas:</h4>
<pre><strong>200 OK:</strong>
[
    { "ins_id": 1, "ins_nombre": "Gimnasio Central", "ins_localidad": "Ciudad A" },
    { "ins_id": 2, "ins_nombre": "Pista Cubierta", "ins_localidad": "Ciudad B" }
]</pre>
            </div>

            <div class="endpoint">
                <h3><span class="method get">GET</span> <span class="path">/instalaciones/{id}</span></h3>
                <p><strong>Descripción:</strong> Recupera una única instalación por su ID.</p>
                <h4>Parámetros de Ruta:</h4>
                <ul>
                    <li><code>id</code> (entero, <strong>requerido</strong>): El ID de la instalación.</li>
                </ul>
                <h4>Respuestas:</h4>
<pre><strong>200 OK:</strong>
{
    "ins_id": 1,
    "ins_nombre": "Gimnasio Central",
    "ins_localidad": "Ciudad A",
    "ins_calle": "Calle Mayor",
    "ins_num": 10,
    "ins_coordenadas": "X,Y"
}

<strong>404 Not Found:</strong>
{
    "message": "Instalación no encontrada"
}</pre>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 OFFSIDE. Desarrollado por Javier Saugar Maqueda y Javier Jiménez Santos. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>
