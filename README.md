# Entradas Messi

Este proyecto usa MySQL en el puerto **3307**. La conexión se configura en `config/config.ini` y `Configuration.php` lee ese valor para crear la conexión PDO.

## Cambiar el puerto que usa el proyecto

1. Abre `config/config.ini` en la carpeta del proyecto.
2. Busca la línea:

   ```ini
   db_port = 3307
   ```

3. Reemplaza `3307` por el puerto donde está escuchando tu servidor MySQL. Por ejemplo, si MySQL usa el puerto predeterminado, escribe:

   ```ini
   db_port = 3306
   ```

4. Guarda el archivo.
5. Confirma que MySQL esté iniciado y que la base de datos indicada en `db_name` exista (`entradas_messi` por defecto).
6. Recarga el proyecto. Si no logra conectarse, revisa que el puerto configurado aquí coincida con el puerto real de MySQL y que `db_host`, `db_user` y `db_pass` sean correctos.

No hace falta modificar `helper/MyDatabase.php`: la clase recibe el puerto desde la configuración y lo incorpora a la conexión PDO. `Configuration.php` también obtiene ese valor de `config/config.ini`.

## Cambiar el puerto de MySQL en XAMPP

Si quieres cambiar el puerto en el que escucha el servidor MySQL, además de actualizar la configuración del proyecto:

1. Abre el **Panel de control de XAMPP**.
2. En la fila **MySQL**, pulsa **Config** y abre `my.ini`.
3. Busca las entradas `port` de la configuración de MySQL (por ejemplo, bajo `[client]` y `[mysqld]`). Cambia el valor al puerto deseado en las secciones correspondientes.
4. Guarda `my.ini` y reinicia MySQL desde el Panel de control de XAMPP.
5. Actualiza `db_port` en `config/config.ini` con el mismo número.
6. Comprueba que ese puerto no esté ocupado por otro programa y vuelve a cargar el proyecto.

> El puerto debe coincidir en el servidor MySQL y en `config/config.ini`. Cambiar solo el archivo del proyecto no cambia el puerto del servidor.
