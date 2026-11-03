    <!-- Para comprar con dinero falso:  -->
 <!-- 
sb-pizzb53670372@personal.example.com
Password: a!3LTQ.t
 -->

<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Club Santos Laguna | Guerreros</title>

    <!-- Conexión con el archivo CSS -->
    <link rel="stylesheet" href="estilo2.css">
    <link href="https://fonts.googleapis.com/css2?family=Manufacturing+Consent&display=swap" rel="stylesheet"></head>

<body>
    <header>
        <div class="logo">
            <div class="logo-icon">
                <img src="imagenes/slogo2.jpg" alt="Escudo">
            </div>

            <h1>Club Santos Laguna</h1>
        </div>

        <nav>
            <a href="#inicio">Inicio</a>
            <a href="#historia">Historia</a>
            <a href="#leyendas">Leyendas</a>
            <a href="#estadio">Estadio</a>
            <a href="#registro">Registro</a>
            <?php if (isset($_SESSION["id"])) { ?>
                <a href="catalogo.php">Abonos</a>
                <?php if ($_SESSION["rol"] === "admin") { ?>
                    <a href="panel.php">Panel</a>
                <?php } ?>
                <a href="logout.php">Salir (<?php echo htmlspecialchars($_SESSION["nombre"]); ?>)</a>
            <?php } else { ?>
                <a href="login.php">Iniciar sesión</a>
            <?php } ?>
        </nav>

    </header>


    <section class="hero" id="inicio">

        <div class="hero-content">
            <h2>¡Guerreros!</h2>
            <p>
                Una página dedicada a la historia, identidad,
                grandes jugadores y pasión del Club Santos Laguna.
            </p>

            <a href="#registro" class="btn">
                Quiero ser Guerrero
            </a>

        </div>

    </section>
    <!-- HISTORIA -->

    <section class="historia" id="historia">

        <div class="section-title">

            <h2>La Historia de Santos Laguna</h2>
            <p>
                Más de cuatro décadas de futbol y pasión en la Comarca Lagunera.
            </p>

        </div>


        <div class="historia-container">

            <div class="historia-text">

                <h3>Una institución de la Comarca</h3>

                <p>
                    Club Santos Laguna es uno de los equipos más representativos
                    del futbol mexicano y tiene una identidad profundamente ligada
                    a la Comarca Lagunera.
                </p>
                <p>
                    A lo largo de su historia, los Guerreros han construido una
                    afición apasionada y una identidad basada en la lucha,
                    perseverancia y trabajo en equipo.
                </p>
                <p>
                    El club ha conseguido importantes campeonatos y ha visto
                    pasar por sus filas a grandes futbolistas que dejaron una
                    huella en la historia del equipo.
                </p>

            </div>


            <div class="dato-box">
                <h3>Datos del Club</h3>

                <div class="dato">
                    <strong>Equipo</strong>
                    <p>Club Santos Laguna</p>
                </div>

                <div class="dato">
                    <strong>Apodo</strong>
                    <p>Los Guerreros</p>
                </div>

                <div class="dato">
                    <strong>Casa</strong>
                    <p>Estadio Corona</p>
                </div>
                <div class="dato">
                    <strong>Ubicación</strong>
                    <p>Comarca Lagunera</p>
                </div>
            </div>

        </div>

    </section>


    <!--IDENTIDAD GUERRERA -->

    <section class="guerreros">

        <div class="section-title">
            <h2>La Identidad Guerrera</h2>
            <p>
                Mucho más que fútbol.
            </p>

        </div>


        <div class="cards">

            <div class="card">
                <div class="card-top">
                    <img src="imagenes/Aficion.jpg" alt="Imagen">
                </div>
                <div class="card-content">
                    <h3>Espíritu Guerrero</h3>
                    <p>
                        La identidad de Santos está relacionada con la
                        lucha constante y la capacidad de competir hasta
                        el último minuto.
                    </p>
                </div>

            </div>


            <div class="card">

                <div class="card-top">
                    <img src="imagenes/espGuerrero.jpg" alt="Imagen">
                </div>

                <div class="card-content">
                    <h3>La Afición</h3>
                    <p>
                        La afición forma una parte fundamental de la
                        identidad del club y acompaña al equipo en
                        cada partido.
                    </p>
                </div>

            </div>


            <div class="card">
                <div class="card-top">
                    <img src="imagenes/trofeos.jpg" alt="Imagen">
                </div>
                <div class="card-content">
                    <h3>Campeonatos</h3>
                    <p>
                        Santos Laguna ha construido una historia de
                        títulos y grandes generaciones de futbolistas
                        que han marcado al club.
                    </p>
                </div>
            </div>
        </div>

    </section>


    <!--LEYENDAS -->

    <section class="leyendas" id="leyendas">
        <div class="section-title">
            <h2>Leyendas Guerreras</h2>
            <p>
                Jugadores que dejaron huella en Santos Laguna.
            </p>
        </div>


        <div class="legend-grid">

            <div class="legend-card borgetti">
                <h3>Jared Borgetti</h3>
                <span>Delantero</span>
                <p>
                    Uno de los máximos símbolos en la historia de Santos Laguna.
                    Destacó por su capacidad goleadora y sus remates de cabeza.
                    Es recordado como uno de los grandes delanteros que
                    defendieron la camiseta de los Guerreros.
                </p>
            </div>


            <div class="legend-card sanchez">
                <h3>Oswaldo Sánchez</h3>
                <span>Portero</span>
                <p>
                    Capitán y guardameta fundamental durante una etapa importante
                    del club. Fue una figura clave en los campeonatos conseguidos
                    por Santos y uno de los jugadores más queridos por la afición.
                </p>
            </div>


            <div class="legend-card ruiz">
                <h3>Rodrigo "Pony" Ruiz</h3>
                <span>Extremo</span>
                <p>
                    Futbolista chileno recordado por su técnica, regate,
                    visión de juego y capacidad para asistir a sus compañeros.
                    Fue una pieza importante en la historia del club.
                </p>
            </div>


            <div class="legend-card peralta">
                <h3>Oribe "cepillo" Peralta</h3>
                <span>Delantero</span>
                <p>
                    fue una figura clave en Santos Laguna, donde se consolidó
                     como ídolo al guiar al equipo a títulos de Liga MX y convertirse 
                     en uno de sus máximos goleadores históricos. Su etapa más brillante 
                     llegó en el Clausura 2012, cuando lideró al club hacia el campeonato con goles decisivos.
                </p>
            </div>
        </div>

    </section>


    <!-- ESTADIO -->

    <section class="estadio" id="estadio">

        <div class="section-title">

            <h2> Estadio Corona</h2>

            <p>
                La casa del dolor ajeno.
            </p>

        </div>


        <div class="stadium-info">

            <div class="stadium-box">

                <h3>2009</h3>

                <p>
                    Año de inauguración del Estadio Corona.
                </p>

            </div>


            <div class="stadium-box">

                <h3>30,000</h3>
                <p>
                    Capacidad aproximada del estadio.
                </p>

            </div>


            <div class="stadium-box">

                <h3>68 × 105</h3>

                <p>
                    Dimensiones aproximadas de la cancha en metros.
                </p>

            </div>

        </div>

    </section>


    <!--REGISTRO-->

    <section class="registro" id="registro">

        <div class="section-title">

            <h2> Conviertete en abonado</h2>

        </div>
        <div class="form-container">

            <h3>Registro de Abonado</h3>

            <p class="subtitle">
                Completa tus datos para formar parte de nuestra comunidad.
            </p>


            <form action="registro.php" method = "post">

                <div class="form-group">

                    <label for="nombre">
                        Nombre completo
                    </label>

                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        placeholder="Escribe tu nombre"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="celular">
                        Número de celular
                    </label>

                    <input
                        type="tel"
                        id="celular"
                        name="celular"
                        placeholder="Ej. 871 123 4567"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="correo">
                        Correo electrónico
                    </label>

                    <input
                        type="email"
                        id="correo"
                        name="correo"
                        placeholder="ejemplo@correo.com"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="password">
                        Contraseña
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Crea una contraseña"
                        required
                    >

                </div>

                <div class="form-group">

                    <label for="motivo">
                        ¿Cuál ha sido tu experiencia en el estadio?
                    </label>

                    <textarea
                        id="motivo"
                        name="motivo"
                        placeholder="Cuéntanos la razón por la que quieres ser abonado"
                        required
                    ></textarea>

                </div>

                 <img src="imagenes/pp.jpg" alt="paypal" width="200" height="150">
                 <img src="imagenes/v.jpg" alt="paypal" width="200" height="150">
                 <img src="imagenes/mc2.png" alt="paypal" width="200" height="130">

                <button type="submit" class="submit-btn">
                    Registrarme como abonado
                </button>

            </form>
        </div>
    </section>


    <!-- PIE DE PÁGINA -->

    <footer>

        <b><h3>Club Santos Laguna</h3></b>

        <p>
            ¡la 7tima ya duerme en el tecLaguna!
        </p>

        <p>
            Ganar sirveindo
        </p>

    </footer>


</body>
</html>

