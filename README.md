# FÚTBOL CON PERSISTENCIA

Repositorio donde se guarda la aplicación web de fútbol con persistencia de Sergio De la Fuente.

## Cómo ejecutar la aplicación web

1. Clona el repositorio: git clone https://github.com/Sergiodlf/FutbolPersistencia.git
2. Poner esta carpeta en la carpeta htdocs de tu instalación XAMPP.
3. Crea la base de datos con los scripts ubicados en la carpeta /FutbolPersistencia/persistence/scripts
4. Ejecuta en un navegador WEB http://localhost/FutbolPersistencia.

## Composición del proyecto

- Carpeta app donde se encuentran los principales php de la aplicación web.
  - equipos.php: Se ven todos los equipos con sus estadios, con la posibilidad de ver los partidos de cada equipo. Y un pequeño formulario para poder añadir un nuevo equipo con su estadio.
  - partidos.php: Se ven todos los partidos de la liga por jornada con su resultado. Y un formulario para poder añadir un nuevo partido en una jornada con el resultado.
  - partidos_de_equipos.php: Se ven todos los partidos de un equipo seleccionado.
  - anyadir_equipos.php: Es el php donde se redirigirá cuando se intenta crear un nuevo equipo, para hacer las validaciones.
  - anyadir_partidos.php: Es el php donde se redirigirá cuando se intenta crear un nuevo partido, para hacer las validaciones.
- Carpeta assets donde se encuentra el contenido de bootstrap de css y js.
- Carpeta persistence donde se encuentra la principal confirguración y principales clases del proyecto.
  - conf: Se encuentra la configuración de la base de datos.
  - DAO: Se encuentran las clases que harán las consultas a la base de datos.
  - scripts: Se encuentras los scripts para crear la base de datos.
  - PersistenceManager.php: Para conectar con la base de datos.
- Carpeta templates donde se encuentra el footer, head y header.
- Carpeta utils donde se encuentra SessionHelper.php.
- index.php: Es la encargada de redirigirte a la página correspondiente.