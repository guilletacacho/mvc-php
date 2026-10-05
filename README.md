# Entradas Messi

## Configurar la base de datos

Antes de iniciar la aplicación, crea `config/config.ini` con los datos de tu MySQL:

```ini
[database]
db_host = localhost
db_user = root
db_pass = tu_password
db_name = entradas_messi
db_port = 3306
```

Usa en `db_port` el puerto donde escucha MySQL. El predeterminado suele ser `3306`; en la configuración local de este proyecto está puesto `3307`. Si cambias el puerto de MySQL en XAMPP, actualiza también `db_port` aquí. El usuario, la contraseña y el nombre de la base deben coincidir con tu instalación.

Importa `app/sql/entradas_messi.sql` en MySQL antes de usar el sitio. No subas `config/config.ini` al repositorio: contiene credenciales locales.

## Iniciar

Con Apache y MySQL activos en XAMPP, abre:

```text
http://localhost/php-mvc/
```

Las rutas amigables requieren que Apache tenga `mod_rewrite` activo y permita las reglas de `.htaccess`.

## Cómo agregar una funcionalidad al MVC

El recorrido de una petición es: `index.php` recibe la URL, `Router` elige un controlador y un método, el controlador coordina el modelo y la vista, el modelo consulta la base de datos cuando hace falta y `MustacheRender` muestra la plantilla. Por ejemplo, `/lugares` termina en `LugaresController::show()` y su resultado se muestra en `app/view/lugaresView.mustache`.

### Ejemplo: agregar una página básica de noticias

1. **Definí qué necesita la página.** Si solo muestra contenido fijo, alcanza con controlador y vista. Si tiene que leer o guardar información, también necesitás un modelo y posiblemente una tabla. Para crear una tabla, agregá el SQL correspondiente a `app/sql/entradas_messi.sql` y ejecutalo en la base configurada.

2. **Creá el controlador** en `app/controller/NoticiasController.php`. El router busca controladores con el método `get` + nombre en `Configuration.php`; para `noticias`, espera `getNoticiasController()`. El controlador recibe modelo y renderizador por constructor. Su método `show()` obtiene los datos y termina llamando, por ejemplo, a `$this->render->renderiza("noticias", $data)`.

3. **Si hay datos, creá el modelo** en `app/model/NoticiasModel.php`. Recibí `$database` en el constructor e implementá métodos que consulten los datos. Usá las operaciones disponibles en `helper/MyDatabase.php` (`queryOne`, `queryAll` y `execute`). El controlador llama esos métodos; la vista no accede directamente a la base.

4. **Creá la plantilla** `app/view/noticiasView.mustache`. `renderiza("noticias", $data)` carga ese nombre automáticamente y lo incluye entre `header.php` y `footer.php`. En Mustache, las claves de `$data` se usan como `{{titulo}}`; para listas podés iterar con `{{#noticias}}...{{/noticias}}`.

5. **Registrá la funcionalidad en `app/Configuration.php`.** Agregá los `require_once` del modelo y controlador junto a los existentes. Agregá `getNoticiasController()` que construya `NoticiasController` con el modelo y `getRender()`. Si no hay modelo, el controlador igual recibe el renderizador y su factory lo construye directamente. Cuando corresponda, agregá también el método privado `getNoticiasModel()` para pasarle `$this->getDatabase()`.

6. **Abrí la ruta y revisá el resultado.** Con el nombre del controlador en minúsculas, la URL será `http://localhost/php-mvc/noticias`; el router usa `show()` como método predeterminado. Para otro método, usá `http://localhost/php-mvc/noticias/nombreMetodo`. Los enlaces y formularios de la vista deben apuntar a esas rutas.

En resumen: una página nueva suele requerir controlador + plantilla + registro en `Configuration.php`; agregá modelo y cambios SQL cuando la funcionalidad trabaje con datos. Podés tomar `LugaresController`, `LugaresModel` y `lugaresView.mustache` como ejemplo completo.
