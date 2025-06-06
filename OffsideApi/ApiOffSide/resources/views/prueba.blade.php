<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OFFSIDE</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto:wght@300;400&display=swap');

        :root {
            --primary-dark: #2b2b2b; /* Fondo principal oscuro */
            --secondary-accent: #4CAF50; /* Verde vibrante */
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

        /* --- Header --- */
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

        header .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        header .logo-container img {
            max-width: 200px; /* Adjust logo size */
            height: auto;
            border-radius: 8px; /* Slightly rounded corners for the logo */
            box-shadow: 0 0 10px rgba(0,0,0,0.5); /* Subtle shadow for the logo */
            transition: transform 0.3s ease;
        }

        header .logo-container img:hover {
            transform: scale(1.05); /* Slightly enlarge logo on hover */
        }

        /* The original H1 and P elements are hidden to prioritize the image logo. */
        header h1, header p {
            display: none;
        }

        /* --- Section Styling --- */
        section {
            background-color: var(--bg-medium-dark);
            margin: 20px 0;
            padding: 40px;
            border-radius: var(--border-radius);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
            transition: transform var(--transition-speed);
            position: relative; /* For scroll-snap effect */
        }

        section:hover {
            transform: var(--hover-lift);
        }

        section h2 {
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

        /* --- General Paragraphs --- */
        section p {
            font-size: 1.1em;
            color: var(--text-medium);
            margin-bottom: 1em;
        }

        /* --- Mission, Vision, Values --- */
        .mvv-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .mvv-item {
            padding: 30px;
            background-color: var(--primary-dark);
            border-radius: var(--border-radius);
            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
            transition: transform var(--transition-speed), background-color var(--transition-speed);
            text-align: center;
        }

        .mvv-item:hover {
            transform: scale(1.03);
            background-color: #353535; /* Un tono un poco más claro al hover */
        }

        .mvv-item h3 {
            color: var(--secondary-accent);
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8em;
            margin-bottom: 15px;
            text-shadow: 0.5px 0.5px 2px rgba(0,0,0,0.3);
        }

        .mvv-item p, .mvv-item ul {
            font-size: 1.05em;
            color: var(--text-medium);
        }

        .mvv-item ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: left;
        }

        .mvv-item ul li {
            margin-bottom: 10px;
            padding-left: 30px;
            position: relative;
        }

        .mvv-item ul li::before {
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            content: "\f00c"; /* Checkmark icon */
            color: var(--secondary-accent);
            position: absolute;
            left: 0;
            top: 0;
        }

        /* --- Team Section --- */
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 40px;
            margin-top: 30px;
            justify-content: center;
        }

        .team-member {
            background-color: var(--primary-dark);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            padding: 30px;
            text-align: center;
            transition: transform var(--transition-speed), box-shadow var(--transition-speed);
        }

        .team-member:hover {
            transform: var(--hover-lift);
            box-shadow: 0 8px 25px rgba(0,0,0,0.4);
        }

        .team-member img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
            border: 5px solid var(--secondary-accent);
            box-shadow: 0 0 0 3px var(--bg-medium-dark);
            transition: transform var(--transition-speed);
        }

        .team-member:hover img {
            transform: rotate(5deg);
        }

        .team-member h3 {
            color: var(--white);
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8em;
            margin-bottom: 8px;
        }

        .team-member p {
            color: var(--text-medium);
            font-size: 1em;
        }

        .team-member .social-links a {
            color: var(--secondary-accent);
            font-size: 1.8em;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .team-member .social-links a:hover {
            color: var(--white);
        }

        /* --- Call to Action / Contacto --- */
        .cta-section {
            text-align: center;
            padding: 60px;
            background-color: var(--secondary-accent);
            color: var(--primary-dark);
            border-radius: var(--border-radius);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
            margin-top: 40px;
        }

        .cta-section h2 {
            color: var(--primary-dark);
            margin-bottom: 25px;
            border-bottom: none;
            padding-bottom: 0;
            text-shadow: 1px 1px 3px rgba(255,255,255,0.2);
        }

        .cta-section p {
            font-size: 1.3em;
            margin-bottom: 35px;
            opacity: 0.9;
            color: var(--primary-dark); /* Ensure text is dark on green background */
        }

        .cta-section a {
            display: inline-block;
            background-color: var(--primary-dark);
            color: var(--secondary-accent);
            padding: 18px 40px;
            border-radius: 8px;
            text-decoration: none;
            font-family: 'Montserrat', sans-serif;
            font-weight: bold;
            font-size: 1.2em;
            transition: background-color var(--transition-speed), transform var(--transition-speed), box-shadow var(--transition-speed);
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }

        .cta-section a:hover {
            background-color: #1a1a1a;
            transform: scale(1.07);
            box-shadow: 0 6px 15px rgba(0,0,0,0.4);
        }

        /* Styling for the API Documentation link specifically */
        .api-doc-link {
            color: var(--primary-dark); /* Default color for the link */
            text-decoration: underline;
            font-weight: bold;
            transition: color 0.3s ease; /* Smooth transition for color change */
        }

        .api-doc-link:hover {
            color: var(--secondary-accent); /* Green color on hover */
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

            section {
                padding: 30px 20px;
            }

            section h2 {
                font-size: 2em;
            }

            .mvv-grid {
                grid-template-columns: 1fr;
            }

            .team-grid {
                grid-template-columns: 1fr;
            }

            .cta-section {
                padding: 40px 20px;
            }

            .cta-section h2 {
                font-size: 1.8em;
            }

            .cta-section p {
                font-size: 1.1em;
            }

            .cta-section a {
                padding: 15px 30px;
                font-size: 1.1em;
            }
        }

        @media (max-width: 480px) {
            header h1 {
                font-size: 2.2em;
            }

            section {
                padding: 25px 15px;
            }

            section h2 {
                font-size: 1.7em;
            }

            .mvv-item, .team-member, .api-doc .endpoint {
                padding: 20px;
            }
            .team-member img {
                width: 120px;
                height: 120px;
            }
        }
    </style>
</head>
<body>

    <header>
        <div class="container logo-container">
          
            <img src="{{asset('imagenes/logoBlanco.png')}}" alt="OFFSIDE" />
        </div>
    </header>

    <main class="container">
        <section>
            <h2>Sobre Nosotros</h2>
            <p> Somos <b>Javier Saugar Maqueda y Javier Jiménez Santos</b>, dos  estudiantes  de Desarrollo de aplicaciones multiplataforma y
                apasionados por el deporte.
                Nos dimos cuenta de lo difícil que puede ser organizar partidos o encontrar gente con la que practicar un deporte,
                especialmente en la ajetreada vida moderna. Fue así como, en 2025,
                decidimos combinar nuestras habilidades en el <b>desarrollo de aplicaciones</b> para crear una solución a este
                problema.</p>
            <p>Nuestra visión es simple: hacer que sea increíblemente fácil para cualquiera encontrar y unirse a actividades deportivas
                cerca de ellos.
                Nos hemos enfocado en construir una aplicación intuitiva y eficiente.
                Cada línea de código está pensada para conectarte con otros
                entusiastas y para que tu próximo partido esté a solo un toque de distancia.</p>
        </section>

        <section>
            <h2>Nuestra Misión, Visión y Valores</h2>
            <div class="mvv-grid">
                <div class="mvv-item">
                    <h3>Misión</h3>
                    <p>Facilitar el acceso al deporte,
                        conectando a las personas para que puedan disfrutar de sus actividades físicas de manera sencilla, 
                        rápida y segura, a través de una aplicación móvil intuitiva.</p>
                </div>
                <div class="mvv-item">
                    <h3>Visión</h3>
                    <p>Ser la plataforma referente para conectar a personas y comunidades, haciendo que la práctica deportiva sea accesible y que surjan nuevas experiencias compartidas en cada encuentro.</p>
                </div>
                <div class="mvv-item">
                    <h3>Valores</h3>
                    <ul>
                        <li><strong>Conexión:</strong> Unir a personas a través del deporte.</li>
                        <li><strong>Accesibilidad:</strong> Deporte para todos, sin importar dónde estén.</li>
                        <li><strong>Innovación:</strong> Mejora continua en la experiencia del usuario.</li>
                        <li><strong>Pasión:</strong> Amamos el deporte y lo que hacemos.</li>
                        <li><strong>Simplicidad:</strong> Diseñar soluciones fáciles de usar.</li>
                    </ul>
                </div>
            </div>
        </section>

        <section>
            <h2>Conoce a Nuestro Equipo</h2>
            <p style="text-align: center; margin-bottom: 40px; font-size: 1.1em; color: var(--text-medium);">Somos los dos cerebros y las manos detrás de OFFSIDE.</p>
            <div class="team-grid">
                <div class="team-member">
                    <!-- 
                        Imagen de perfil de Javier Saugar Maqueda.
                        Por favor, asegúrate de que esta URL sea CORRECTA Y ACCESIBLE públicamente desde tu servidor.
                        Si la URL no funciona, verifica que la imagen esté subida correctamente
                        en "https://apioffside.com/storage/imagenes/jsm_Fot.jpg"
                        y que los permisos del servidor sean correctos, así como el enlace simbólico de Laravel.
                    -->
                    <img src="{{asset('imagenes/jsmFoto.jpg')}}" alt="Foto de Javier Saugar Maqueda" onerror="this.onerror=null; this.src='https://placehold.co/180x180/4CAF50/FFFFFF?text=J.S.M.';" />
                    <h3>Javier Saugar Maqueda</h3>
                    <p><strong>Cofundador & Desarrollador Backend</strong></p>
                    <p>Experto en arquitectura de sistemas y bases de datos. Apasionado por el fútbol y deportes de contacto</p>
                    <div class="social-links">
                        <a href="https://www.linkedin.com/in/javiersaugar12/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn Javier Saugar Maqueda"><i class="fab fa-linkedin"></i></a>
                        <a href="https://github.com/javiSaugar" target="_blank" rel="noopener noreferrer" aria-label="GitHub Javier Saugar Maqueda"><i class="fab fa-github"></i></a>
                    </div>
                </div>
                <div class="team-member">
                    <!-- 
                        Imagen de perfil de Javier Jiménez Santos.
                        Por favor, asegúrate de que esta URL sea CORRECTA Y ACCESIBLE públicamente desde tu servidor.
                        Si la URL no funciona, verifica que la imagen esté subida correctamente
                        en "https://apioffside.com/storage/imagenes/jjs_Fot.jpg"
                        y que los permisos del servidor sean correctos, así como el enlace simbólico de Laravel.
                    -->
                    <img src="{{asset('imagenes/jjsFoto.jpg')}}" alt="Foto de Javier Jiménez Santos" onerror="this.onerror=null; this.src='https://placehold.co/180x180/4CAF50/FFFFFF?text=J.J.S.';" />
                    <h3>Javier Jiménez Santos</h3>
                    <p><strong>Cofundador & Desarrollador Frontend</strong></p>
                    <p>Especialista en desarrollo frontend y experiencia de usuario. Apasionado por el fútbol y el running.</p>
                    <div class="social-links">
                        <a href="https://www.linkedin.com/in/javierjimenezsantos" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn Javier Jiménez Santos"><i class="fab fa-linkedin"></i></a>
                        <a href="https://github.com/jjimenezsantos" target="_blank" rel="noopener noreferrer" aria-label="GitHub Javier Jiménez Santos"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>
            <p style="text-align: center; margin-top: 40px; font-size: 1.1em; color: var(--text-medium);">Juntos, construimos **OFFSIDE** para transformar la forma en que las personas se conectan a través del deporte.</p>
        </section>

        <section class="cta-section">
            <h2>¡Tu próximo partido te espera en OFFSIDE!</h2>
            <p>Descarga nuestra aplicación móvil y únete a la comunidad deportiva.</p>
            <a href="#descarga-app">Descarga la App</a>
            <!-- Enlace a la documentación de la API, apuntando a la ruta de Laravel Blade -->
            <p style="margin-top: 30px; margin-bottom: 0; color: var(--primary-dark);">
                ¿Eres desarrollador? Consulta nuestra 
                <a href="/documentacion-offside" class="api-doc-link" target="_blank" rel="noopener noreferrer">Documentación de la API</a>.
            </p>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 OFFSIDE. Desarrollado por Javier Saugar Maqueda y Javier Jiménez Santos. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>
