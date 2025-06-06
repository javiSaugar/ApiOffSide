# ***Documentación Api Rest OFF-Side.***

![][image1]

## **Autenticación y Gestión de Usuarios**

### **Autenticación de Usuario**

* **`POST /login`**

  * **Descripción:** Autentica a un usuario y emite un token API de Sanctum.  
  * **Método del Controlador:** `ControllerUsuarios@login`  
  * **Cuerpo de la Solicitud (JSON):**  
    * `email` (string, **requerido**, formato de email): La dirección de correo electrónico del usuario.  
    * `password` (string, **requerido**): La contraseña del usuario.  
  * **Respuestas:**

**`200 OK`**: Autenticación exitosa.  
 JSON  
{  
    "mensaje": "Inicio de sesión exitoso",  
    "token": "YOUR\_SANCTUM\_TOKEN",  
    "token\_type": "Bearer",  
    "user": {  
        "id": 1,  
        "name": "Nombre de Usuario",  
        "email": "usuario@example.com",  
        "telf": "123456789",  
        "nom\_ape": "Apellido de Usuario"  
    }  
}

* 

**`401 Unauthorized`**: Credenciales incorrectas.  
 JSON  
{  
    "mensaje": "Las credenciales proporcionadas son incorrectas"  
}

* 

**`422 Unprocessable Entity`**: Errores de validación (por ejemplo, campos faltantes, formato de email inválido).  
 JSON  
{  
    "mensaje": "Faltan campos por rellenar o los campos no son válidos",  
    "errores": {  
        "email": \["El campo email es obligatorio."\],  
        "password": \["El campo password es obligatorio."\]  
    }  
}

*   
* **`POST /logout`**

  * **Descripción:** Invalida el token API actual del usuario autenticado, cerrando su sesión.  
  * **Método del Controlador:** `ControllerUsuarios@logout`  
  * **Middleware:** `auth:sanctum`  
  * **Respuestas:**

**`200 OK`**: Sesión cerrada correctamente.  
 JSON  
{  
    "message": "Sesión cerrada"  
}

* 

### **Perfil de Usuario**

* **`GET /user`**

  * **Descripción:** Devuelve la información del usuario actualmente autenticado.  
  * **Método del Controlador:** `Closure` (cierre de ruta directo)  
  * **Middleware:** `auth:sanctum`  
  * **Respuestas:**

**`200 OK`**: Devuelve los datos del usuario autenticado.  
 JSON  
{  
    "id": 1,  
    "name": "Nombre de Usuario",  
    "email": "usuario@example.com",  
    "telf": "123456789",  
    "nom\_ape": "Apellido de Usuario"  
}

*   
  * **`401 Unauthorized`**: Si no se proporciona un token Sanctum válido.  
* **`GET /profile`**

  * **Descripción:** Devuelve la información del usuario actualmente autenticado. (Alias para la ruta `/user` para mayor claridad).  
  * **Método del Controlador:** `ControllerUsuarios@user`  
  * **Middleware:** `auth:sanctum`  
  * **Respuestas:** Las mismas que `GET /user`.

### **Gestión de Usuarios (Rutas Protegidas)**

Estas rutas requieren un **token API de Sanctum válido** en el encabezado `Authorization` (por ejemplo, `Bearer TU_TOKEN_SANCTUM`).

* **`POST /usuarios`**

  * **Descripción:** Registra un nuevo usuario.  
  * **Método del Controlador:** `ControllerUsuarios@store`  
  * **Cuerpo de la Solicitud (JSON):**  
    * `name` (string, **requerido**, max:255): Nombre completo del usuario.  
    * `email` (string, **requerido**, formato de email, único): Dirección de correo electrónico del usuario.  
    * `password` (string, **requerido**, min:6): Contraseña del usuario.  
    * `telf` (string, opcional, max:15): Número de teléfono del usuario.  
    * `nom_ape` (string, opcional, max:255): Nombre y apellido(s) del usuario.  
  * **Respuestas:**

**`201 Created`**: Usuario creado exitosamente.  
 JSON  
{  
    "message": "Usuario creado correctamente.",  
    "user": {  
        "name": "Nuevo Usuario",  
        "email": "nuevo@example.com",  
        "telf": null,  
        "nom\_ape": null,  
        "id": 2  
    }  
}

* 

**`422 Unprocessable Entity`**: Errores de validación (por ejemplo, email ya existe, campos faltantes).  
 JSON  
{  
    "errors": {  
        "email": \["El email ya ha sido tomado."\]  
    }  
}

*   
  * **`500 Internal Server Error`**: Error del servidor durante la creación.  
* **`GET /usuarios`**

  * **Descripción:** Recupera una lista de todos los usuarios.  
  * **Método del Controlador:** `ControllerUsuarios@index`  
  * **Middleware:** `auth:sanctum`  
  * **Respuestas:**

**`200 OK`**: Devuelve un array JSON de objetos de usuario.  
 JSON  
\[  
    {  
        "id": 1,  
        "name": "Usuario Uno",  
        "email": "uno@example.com",  
        "telf": null,  
        "nom\_ape": "Apellido Usuario Uno"  
    },  
    {  
        "id": 2,  
        "name": "Usuario Dos",  
        "email": "dos@example.com",  
        "telf": "987654321",  
        "nom\_ape": "Apellido Usuario Dos"  
    }  
\]

*   
* **`GET /usuarios/{id}`**

  * **Descripción:** Recupera un único usuario por su ID.  
  * **Método del Controlador:** `ControllerUsuarios@show`  
  * **Middleware:** `auth:sanctum`  
  * **Parámetros de Ruta:**  
    * `id` (entero, **requerido**): El ID del usuario.  
  * **Respuestas:**

**`200 OK`**: Devuelve un objeto JSON del usuario.  
 JSON  
{  
    "id": 1,  
    "name": "Usuario Uno",  
    "email": "uno@example.com",  
    "telf": null,  
    "nom\_ape": "Apellido Usuario Uno"  
}

* 

**`404 Not Found`**: Si el usuario con el ID especificado no existe.  
 JSON  
{  
    "message": "Usuario no encontrado"  
}

*   
* **`PUT /usuarios/{id}`**

  * **Descripción:** Actualiza la información de un usuario existente por su ID.  
  * **Método del Controlador:** `ControllerUsuarios@update`  
  * **Middleware:** `auth:sanctum`  
  * **Parámetros de Ruta:**  
    * `id` (entero, **requerido**): El ID del usuario a actualizar.  
  * **Cuerpo de la Solicitud (JSON):**  
    * `name` (string, opcional, max:255): Nuevo nombre para el usuario.  
    * `email` (string, opcional, formato de email, único): Nuevo email para el usuario.  
    * `telf` (string, opcional, max:15): Nuevo número de teléfono.  
    * `nom_ape` (string, opcional, max:255): Nuevo nombre y apellido(s).  
  * **Respuestas:**

**`200 OK`**: Usuario actualizado exitosamente.  
 JSON  
{  
    "id": 1,  
    "name": "Nombre Actualizado",  
    "email": "actualizado@example.com",  
    "telf": "111222333",  
    "nom\_ape": "Apellido Actualizado"  
}

*   
  * **`404 Not Found`**: Si el usuario no existe.  
    * **`422 Unprocessable Entity`**: Errores de validación (por ejemplo, email ya tomado por otro usuario).  
* **`DELETE /usuarios/{id}`**

  * **Descripción:** Elimina un usuario por su ID.  
  * **Método del Controlador:** `ControllerUsuarios@destroy`  
  * **Middleware:** `auth:sanctum`  
  * **Parámetros de Ruta:**  
    * `id` (entero, **requerido**): El ID del usuario a eliminar.  
  * **Respuestas:**

**`200 OK`**: Usuario eliminado exitosamente.  
 JSON  
{  
    "message": "Usuario eliminado correctamente"  
}

*   
  * **`404 Not Found`**: Si el usuario no existe.  
* **`POST /usuarios/{id}/change-password`**

  * **Descripción:** Cambia la contraseña de un usuario específico.  
  * **Método del Controlador:** `ControllerUsuarios@changePassword`  
  * **Middleware:** `auth:sanctum`  
  * **Parámetros de Ruta:**  
    * `id` (entero, **requerido**): El ID del usuario cuya contraseña se va a cambiar.  
  * **Cuerpo de la Solicitud (JSON):**  
    * `password` (string, **requerido**, min:6, confirmed): La nueva contraseña.  
    * `password_confirmation` (string, **requerido**): Confirmación de la nueva contraseña.  
  * **Respuestas:**

**`200 OK`**: Contraseña actualizada exitosamente.  
 JSON  
{  
    "message": "Contraseña actualizada correctamente"  
}

*   
  * **`404 Not Found`**: Si el usuario no existe.  
    * **`422 Unprocessable Entity`**: Errores de validación (por ejemplo, `password` y `password_confirmation` no coinciden, contraseña demasiado corta).  
* **`GET /usuarios/buscar`**

  * **Descripción:** Busca usuarios por su nombre.  
  * **Método del Controlador:** `ControllerUsuarios@buscarPorNombre`  
  * **Middleware:** `auth:sanctum`  
  * **Parámetros de Consulta:**  
    * `nombre` (string, **requerido**): El nombre parcial o completo a buscar.  
  * **Respuestas:**

**`200 OK`**: Devuelve un array JSON de objetos de usuario coincidentes.  
 JSON  
\[  
    {  
        "id": 1,  
        "name": "Juan Pérez",  
        "email": "juan@example.com",  
        "telf": null,  
        "nom\_ape": "Pérez, Juan"  
    }  
\]

* 

**`200 OK` (Array vacío)**: Si no se encuentran usuarios que coincidan con los criterios de búsqueda.  
 JSON  
\[\]

* 

---

## **Sesiones**

Estos endpoints gestionan las sesiones de entrenamiento.

* **`GET /sesiones`**

  * **Descripción:** Recupera una lista de todas las sesiones, incluyendo la instalación, deporte, usuario y actividades relacionadas.  
  * **Método del Controlador:** `ControllerSesiones@index`  
  * **Respuestas:**

**`200 OK`**: Devuelve un array JSON de objetos de sesión. Cada objeto de sesión incluye objetos anidados de `instalacion`, `deporte`, `usuario`, y arrays de `actividades`.  
 JSON  
\[  
    {  
        "ses\_id": 1,  
        "ses\_hora": "10:00",  
        "ses\_fecha": "2025-06-15",  
        "ses\_ins\_id": 1,  
        "ses\_dep\_id": 1,  
        "ses\_use\_id": 1,  
        "ses\_precio": 15.50,  
        "ses\_nombre": "Yoga Matutino",  
        "instalacion": { "ins\_id": 1, "ins\_nombre": "Gimnasio Central", /\* ... otros campos ... \*/ },  
        "deporte": { "dep\_id": 1, "dep\_nombre": "Yoga", /\* ... otros campos ... \*/ },  
        "usuario": { "id": 1, "name": "Profesor A", /\* ... otros campos ... \*/ },  
        "actividades": \[ { "act\_id": 1, "act\_ses\_id": 1, /\* ... otros campos ... \*/ } \]  
    }  
\]

*   
* **`GET /sesiones/{id}`**

  * **Descripción:** Recupera una única sesión por su ID, incluyendo la instalación, deporte, usuario y actividades relacionadas.  
  * **Método del Controlador:** `ControllerSesiones@show`  
  * **Parámetros de Ruta:**  
    * `id` (entero, **requerido**): El ID de la sesión.  
  * **Respuestas:**

**`200 OK`**: Devuelve un objeto JSON de la sesión.  
 JSON  
{  
    "ses\_id": 1,  
    "ses\_hora": "10:00",  
    "ses\_fecha": "2025-06-15",  
    "ses\_ins\_id": 1,  
    "ses\_dep\_id": 1,  
    "ses\_use\_id": 1,  
    "ses\_precio": 15.50,  
    "ses\_nombre": "Yoga Matutino",  
    "instalacion": { "ins\_id": 1, "ins\_nombre": "Gimnasio Central", /\* ... \*/ },  
    "deporte": { "dep\_id": 1, "dep\_nombre": "Yoga", /\* ... \*/ },  
    "usuario": { "id": 1, "name": "Profesor A", /\* ... \*/ },  
    "actividades": \[ { "act\_id": 1, "act\_ses\_id": 1, /\* ... \*/ } \]  
}

* 

**`404 Not Found`**: Si la sesión con el ID especificado no existe.  
 JSON  
{  
    "message": "Sesión no encontrada"  
}

*   
* **`GET /sesiones/filtrar/{nombre}`**

  * **Descripción:** Busca sesiones por nombre.  
  * **Método del Controlador:** `ControllerSesiones@buscarPorNombreSesion`  
  * **Parámetros de Ruta:**  
    * `nombre` (string, **requerido**): El nombre o parte del nombre a buscar.  
  * **Respuestas:**

**`200 OK`**: Devuelve un array JSON de sesiones que coinciden con el nombre, incluyendo sus relaciones.  
 JSON  
\[  
    {  
        "ses\_id": 1,  
        "ses\_nombre": "Sesión de Pilates",  
        "instalacion": { /\* ... \*/ },  
        "deporte": { /\* ... \*/ },  
        "usuario": { /\* ... \*/ },  
        "actividades": \[ /\* ... \*/ \]  
    }  
\]

* 

**`404 Not Found`**: Si no se encuentran sesiones con el nombre proporcionado.  
 JSON  
{  
    "message": "Sesión no encontrada"  
}

*   
* **`POST /sesiones`**

  * **Descripción:** Crea una nueva sesión.  
  * **Método del Controlador:** `ControllerSesiones@store`  
  * **Cuerpo de la Solicitud (JSON):**  
    * `ses_hora` (string, opcional, requerido si existe, max:10): La hora de la sesión (ej. `"10:00"`).  
    * `ses_fecha` (date, opcional, requerido si existe): La fecha de la sesión (ej. `"2025-06-15"`).  
    * `ses_ins_id` (integer, opcional, requerido si existe): El **ID de la instalación** a la que pertenece la sesión. Debe existir en la tabla `instalaciones`.  
    * `ses_dep_id` (integer, opcional, requerido si existe): El **ID del deporte** al que pertenece la sesión. Debe existir en la tabla `deportes`.  
    * `mat_use_id` (integer, opcional, requerido si existe): El **ID del usuario** (monitor/creador) de la sesión. Debe existir en la tabla `users`.  
    * `ses_precio` (numeric, opcional, requerido si existe): El precio de la sesión.  
    * `ses_nombre` (string, opcional, requerido si existe, min:3, max:255): El nombre de la sesión.  
  * **Respuestas:**

**`201 Created`**: Sesión creada correctamente.  
 JSON  
{  
    "message": "Sesión creada correctamente.",  
    "sesion": {  
        "ses\_hora": "14:00",  
        "ses\_fecha": "2025-07-01",  
        "ses\_ins\_id": 1,  
        "ses\_dep\_id": 2,  
        "ses\_use\_id": 3,  
        "ses\_precio": 20.00,  
        "ses\_nombre": "Clase de Spinning",  
        "ses\_id": 2  
    }  
}

* 

**`422 Unprocessable Entity`**: Errores de validación (por ejemplo, IDs no existentes, campos faltantes, formato incorrecto).  
 JSON  
{  
    "errors": {  
        "ses\_ins\_id": \["El ID de instalación proporcionado no es válido."\]  
    }  
}

*   
  * **`500 Internal Server Error`**: Error del servidor.  
* **`PATCH /sesiones/{id}`**

  * **Descripción:** Modifica una sesión existente por su ID.  
  * **Método del Controlador:** `ControllerSesiones@update`  
  * **Parámetros de Ruta:**  
    * `id` (entero, **requerido**): El ID de la sesión a actualizar.  
  * **Cuerpo de la Solicitud (JSON):**  
    * `ses_hora` (string, opcional, requerido si existe, max:10): Nueva hora.  
    * `ses_fecha` (date, opcional, requerido si existe): Nueva fecha.  
    * `ses_ins_id` (integer, opcional, requerido si existe): Nuevo ID de instalación.  
    * `ses_dep_id` (integer, opcional, requerido si existe): Nuevo ID de deporte.  
    * `ses_use_id` (integer, opcional, requerido si existe): Nuevo ID de usuario.  
    * `ses_precio` (numeric, opcional, requerido si existe): Nuevo precio.  
    * `ses_nombre` (string, opcional, requerido si existe, max:255): Nuevo nombre.  
  * **Respuestas:**

**`200 OK`**: Sesión actualizada correctamente.  
 JSON  
{  
    "message": "Sesión actualizada correctamente",  
    "sesion": {  
        "ses\_id": 1,  
        "ses\_hora": "11:00",  
        "ses\_fecha": "2025-06-15",  
        "ses\_ins\_id": 1,  
        "ses\_dep\_id": 1,  
        "ses\_use\_id": 1,  
        "ses\_precio": 18.00,  
        "ses\_nombre": "Yoga Nocturno"  
    }  
}

*   
  * **`404 Not Found`**: Si la sesión no existe.  
    * **`422 Unprocessable Entity`**: Errores de validación.  
* **`DELETE /sesiones/{id}`**

  * **Descripción:** Elimina una sesión por su ID.  
  * **Método del Controlador:** `ControllerSesiones@destroy`  
  * **Parámetros de Ruta:**  
    * `id` (entero, **requerido**): El ID de la sesión a eliminar.  
  * **Respuestas:**

**`200 OK`**: Sesión eliminada correctamente.  
 JSON  
{  
    "message": "Sesión eliminada correctamente"  
}

*   
  * **`404 Not Found`**: Si la sesión no existe.

---

## **Actividades**

Estos endpoints gestionan las actividades de los usuarios dentro de las sesiones.

* **`GET /actividades`**

  * **Descripción:** Recupera una lista de todas las actividades.  
  * **Método del Controlador:** `ControllerActividades@index`  
  * **Respuestas:**

**`200 OK`**: Devuelve un array JSON de objetos de actividad.  
 JSON  
\[  
    { "act\_id": 1, "act\_ses\_id": 1, "act\_use\_id": 1 },  
    { "act\_id": 2, "act\_ses\_id": 1, "act\_use\_id": 2 }  
\]

*   
* **`GET /actividades/{id}`**

  * **Descripción:** Recupera una única actividad por su ID, incluyendo la sesión y el usuario asociados.  
  * **Método del Controlador:** `ControllerActividades@show`  
  * **Parámetros de Ruta:**  
    * `id` (entero, **requerido**): El ID de la actividad.  
  * **Respuestas:**

**`200 OK`**: Devuelve un objeto JSON de la actividad, con sus relaciones `sesion` y `usuario` anidadas.  
 JSON  
{  
    "act\_id": 1,  
    "act\_ses\_id": 1,  
    "act\_use\_id": 1,  
    "sesion": { /\* Objeto Sesion \*/ },  
    "usuario": { /\* Objeto User \*/ }  
}

* 

**`404 Not Found`**: Si la actividad con el ID especificado no existe.  
 JSON  
{  
    "message": "Actividad no encontrada"  
}

*   
* **`POST /actividades`**

  * **Descripción:** Crea una nueva actividad.  
  * **Método del Controlador:** `ControllerActividades@store`  
  * **Cuerpo de la Solicitud (JSON):**  
    * `act_ses_id` (integer, **requerido**): El ID de la sesión a la que se une la actividad. Debe existir en la tabla `sesiones`.  
    * `act_use_id` (integer, **requerido**): El ID del usuario que realiza la actividad. Debe existir en la tabla `users`.  
  * **Respuestas:**

**`201 Created`**: Actividad creada correctamente.  
 JSON  
{  
    "message": "Actividad creada correctamente",  
    "data": {  
        "act\_ses\_id": 1,  
        "act\_use\_id": 3,  
        "act\_id": 3  
    }  
}

*   
  * **`422 Unprocessable Entity`**: Errores de validación (por ejemplo, IDs no existentes, campos faltantes).  
* **`PATCH /actividades/{id}`**

  * **Descripción:** Modifica una actividad existente por su ID.  
  * **Método del Controlador:** `ControllerActividades@update`  
  * **Parámetros de Ruta:**  
    * `id` (entero, **requerido**): El ID de la actividad a actualizar.  
  * **Cuerpo de la Solicitud (JSON):**  
    * `act_ses_id` (integer, opcional): Nuevo ID de la sesión.  
    * `act_use_id` (integer, opcional): Nuevo ID del usuario.  
  * **Respuestas:**

**`200 OK`**: Actividad actualizada correctamente.  
 JSON  
{  
    "act\_id": 1,  
    "act\_ses\_id": 2,  
    "act\_use\_id": 1  
}

*   
  * **`404 Not Found`**: Si la actividad no existe.  
* **`DELETE /actividades/{id}`**

  * **Descripción:** Elimina una actividad por su ID.  
  * **Método del Controlador:** `ControllerActividades@destroy`  
  * **Parámetros de Ruta:**  
    * `id` (entero, **requerido**): El ID de la actividad a eliminar.  
  * **Respuestas:**

**`200 OK`**: Actividad eliminada correctamente.  
 JSON  
{  
    "message": "Actividad eliminada correctamente"  
}

*   
  * **`404 Not Found`**: Si la actividad no existe.  
* **`GET /actividades/sesion/{sesionId}`**

  * **Descripción:** Recupera todas las actividades asociadas a un ID de sesión específico.  
  * **Método del Controlador:** `ControllerActividades@getBySesionId`  
  * **Parámetros de Ruta:**  
    * `sesionId` (entero, **requerido**): El ID de la sesión.  
  * **Respuestas:**

**`200 OK`**: Devuelve un array JSON de actividades para la sesión especificada.  
 JSON  
{  
    "message": "Actividades encontradas.",  
    "data": \[  
        { "act\_id": 1, "act\_ses\_id": 1, "act\_use\_id": 1 },  
        { "act\_id": 2, "act\_ses\_id": 1, "act\_use\_id": 2 }  
    \]  
}

* 

**`404 Not Found`**: Si no se encuentran actividades para la sesión.  
 JSON  
{  
    "message": "No se encontraron actividades para esta sesión."  
}

*   
* **`GET /actividades/usuario/{userId}`**

  * **Descripción:** Recupera todas las actividades asociadas a un ID de usuario específico.  
  * **Método del Controlador:** `ControllerActividades@getByUserId`  
  * **Parámetros de Ruta:**  
    * `userId` (entero, **requerido**): El ID del usuario.  
  * **Respuestas:**

**`200 OK`**: Devuelve un array JSON de actividades para el usuario especificado.  
 JSON  
{  
    "message": "Actividades encontradas.",  
    "data": \[  
        { "act\_id": 1, "act\_ses\_id": 1, "act\_use\_id": 1 },  
        { "act\_id": 3, "act\_ses\_id": 2, "act\_use\_id": 1 }  
    \]  
}

* 

**`404 Not Found`**: Si no se encuentran actividades para el usuario.  
 JSON  
{  
    "message": "No se encontraron actividades para este usuario."  
}

* 

---

## **Deportes**

Estos endpoints gestionan los diferentes tipos de deportes.

* **`GET /deportes`**

  * **Descripción:** Recupera una lista de todos los deportes.  
  * **Método del Controlador:** `ControllerDeportes@index`  
  * **Respuestas:**

**`200 OK`**: Devuelve un array JSON de objetos de deporte.  
 JSON  
\[  
    { "dep\_id": 1, "dep\_nombre": "Fútbol", "dep\_numparticipantes": 22 },  
    { "dep\_id": 2, "dep\_nombre": "Baloncesto", "dep\_numparticipantes": 10 }  
\]

*   
* **`GET /deportes/{id}`**

  * **Descripción:** Recupera un único deporte por su ID.  
  * **Método del Controlador:** `ControllerDeportes@show`  
  * **Parámetros de Ruta:**  
    * `id` (entero, **requerido**): El ID del deporte.  
  * **Respuestas:**

**`200 OK`**: Devuelve un objeto JSON del deporte.  
 JSON  
{  
    "dep\_id": 1,  
    "dep\_nombre": "Fútbol",  
    "dep\_numparticipantes": 22  
}

* 

**`404 Not Found`**: Si el deporte con el ID especificado no existe.  
 JSON  
{  
    "message": "Deporte no encontrado"  
}

*   
* **`POST /deportes`**

  * **Descripción:** Crea un nuevo deporte.  
  * **Método del Controlador:** `ControllerDeportes@store`  
  * **Cuerpo de la Solicitud (JSON):**  
    * `dep_nombre` (string, **requerido**, max:255): El nombre del deporte.  
    * `dep_numparticipantes` (integer, **requerido**): El número de participantes del deporte.  
  * **Respuestas:**

**`201 Created`**: Deporte creado correctamente.  
 JSON  
{  
    "message": "Deporte creado correctamente.",  
    "deporte": {  
        "dep\_nombre": "Voleibol",  
        "dep\_numparticipantes": 12,  
        "dep\_id": 3  
    }  
}

*   
  * **`422 Unprocessable Entity`**: Errores de validación (por ejemplo, campos faltantes, tipo incorrecto).  
    * **`500 Internal Server Error`**: Error del servidor.  
* **`PATCH /deportes/{id}`**

  * **Descripción:** Modifica un deporte existente por su ID.  
  * **Método del Controlador:** `ControllerDeportes@update`  
  * **Parámetros de Ruta:**  
    * `id` (entero, **requerido**): El ID del deporte a actualizar.  
  * **Cuerpo de la Solicitud (JSON):**  
    * `dep_Nombre` (string, opcional, requerido si existe, max:255): Nuevo nombre del deporte.  
    * `dep_numParticipantes` (integer, opcional, nulo): Nuevo número de participantes.  
  * **Respuestas:**

**`200 OK`**: Deporte actualizado correctamente.  
 JSON  
{  
    "dep\_id": 1,  
    "dep\_nombre": "Fútbol Sala",  
    "dep\_numparticipantes": 10  
}

*   
  * **`404 Not Found`**: Si el deporte no existe.  
    * **`422 Unprocessable Entity`**: Errores de validación.  
* **`DELETE /deportes/{id}`**

  * **Descripción:** Elimina un deporte por su ID.  
  * **Método del Controlador:** `ControllerDeportes@destroy`  
  * **Parámetros de Ruta:**  
    * `id` (entero, **requerido**): El ID del deporte a eliminar.  
  * **Respuestas:**

**`200 OK`**: Deporte eliminado correctamente.  
 JSON  
{  
    "message": "Deporte eliminado correctamente"  
}

*   
  * **`404 Not Found`**: Si el deporte no existe.

---

## **Instalaciones**

Estos endpoints gestionan las instalaciones deportivas.

* **`GET /instalaciones`**

  * **Descripción:** Recupera una lista de todas las instalaciones.  
  * **Método del Controlador:** `ControllerInstalaciones@index`  
  * **Respuestas:**

**`200 OK`**: Devuelve un array JSON de objetos de instalación.  
 JSON  
\[  
    { "ins\_id": 1, "ins\_nombre": "Gimnasio Central", "ins\_localidad": "Ciudad A", /\* ... \*/ },  
    { "ins\_id": 2, "ins\_nombre": "Pista Cubierta", "ins\_localidad": "Ciudad B", /\* ... \*/ }  
\]

*   
* **`GET /instalaciones/{id}`**

  * **Descripción:** Recupera una única instalación por su ID.  
  * **Método del Controlador:** `ControllerInstalaciones@show`  
  * **Parámetros de Ruta:**  
    * `id` (entero, **requerido**): El ID de la instalación.  
  * **Respuestas:**

**`200 OK`**: Devuelve un objeto JSON de la instalación.  
 JSON  
{  
    "ins\_id": 1,  
    "ins\_nombre": "Gimnasio Central",  
    "ins\_localidad": "Ciudad A",  
    "ins\_calle": "Calle Mayor",  
    "ins\_num": 10,  
    "ins\_coordenadas": "X,Y"  
}

* 

**`404 Not Found`**: Si la instalación con el ID especificado no existe.  
 JSON  
{  
    "message": "Instalación no encontrada"  
}

*   
* **`POST /instalaciones`**

  * **Descripción:** Crea una nueva instalación.  
  * **Método del Controlador:** `ControllerInstalaciones@store`  
  * **Cuerpo de la Solicitud (JSON):**  
    * `ins_nombre` (string, **requerido**, max:255): El nombre de la instalación.  
    * `ins_localidad` (string, **requerido**, max:255): La localidad de la instalación.  
    * `ins_calle` (string, opcional, max:255): La calle de la instalación.  
    * `ins_coordenadas` (string, opcional, max:255): Coordenadas de la instalación.  
    * `ins_num` (integer, opcional): Número de la instalación (ej. número de edificio/pista).  
  * **Respuestas:**

**`201 Created`**: Instalación creada correctamente.  
 JSON  
{  
    "message": "Instalación creada correctamente.",  
    "instalacion": {  
        "ins\_nombre": "Piscina Municipal",  
        "ins\_localidad": "Ciudad B",  
        "ins\_calle": "Av. del Agua",  
        "ins\_coordenadas": null,  
        "ins\_num": 5,  
        "ins\_id": 3  
    }  
}

*   
  * **`422 Unprocessable Entity`**: Errores de validación (por ejemplo, campos faltantes, tipo incorrecto).  
    * **`500 Internal Server Error`**: Error del servidor.  
* **`PATCH /instalaciones/{id}`**

  * **Descripción:** Modifica una instalación existente por su ID.  
  * **Método del Controlador:** `ControllerInstalaciones@update`  
  * **Parámetros de Ruta:**  
    * `id` (entero, **requerido**): El ID de la instalación a actualizar.  
  * **Cuerpo de la Solicitud (JSON):**  
    * `ins_Nombre` (string, opcional, requerido si existe, max:255): Nuevo nombre.  
    * `ins_localidad` (string, opcional, requerido si existe, max:255): Nueva localidad.  
    * `ins_calle` (string, opcional, max:255): Nueva calle.  
    * `ins_coordenadas` (string, opcional, max:255): Nuevas coordenadas.  
    * `ins_num` (integer, opcional): Nuevo número.  
  * **Respuestas:**

**`200 OK`**: Instalación actualizada correctamente.  
 JSON  
{  
    "ins\_id": 1,  
    "ins\_nombre": "Gimnasio Principal",  
    "ins\_localidad": "Ciudad A",  
    "ins\_calle": "Calle Principal",  
    "ins\_num": 12,  
    "ins\_coordenadas": "Z,W"  
}

*   
  * **`404 Not Found`**: Si la instalación no existe.  
    * **`422 Unprocessable Entity`**: Errores de validación.  
* **`DELETE /instalaciones/{id}`**

  * **Descripción:** Elimina una instalación por su ID.  
  * **Método del Controlador:** `ControllerInstalaciones@destroy`  
  * **Parámetros de Ruta:**  
    * `id` (entero, **requerido**): El ID de la instalación a eliminar.  
  * **Respuestas:**

**`200 OK`**: Instalación eliminada correctamente.  
 JSON  
{  
    "message": "Instalación eliminada correctamente"  
}

*   
  * **`404 Not Found`**: Si la instalación no existe.

---

[image1]: <data:image/png;base64,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c2vbM3qlkaolgxetfF7mc+zde3f2mxt/kf3bRz+UvfWUk7OVhy+TsdIFbYMn4+gBHvt7EuYaaYFVntjZxyip/btNpnXEyuXZK1/x0uz9//Du7PNnfyq77bZfl01e+0TP8RaNLTZ7Homrc7LR++1Nv8jeeOLx2YrDPRgjDJLjqWjy+s/o2UBNFDJTbS16kWahYmFa/L0zeZswUmGq4v9h7tJjeb238ztry61cPq9nPSBDeWu5p16plPPOOy/X7NJULWcoTq73PqNijVa99LzqoaiQHC5Vku9TWizyddQdGL3aC6O3g9E7d1czenHMstG7CKMH0AuqMXru8vybl74w+8gZH8xWrbpFRm9jdl8+QrWj0St1f5YmQfacdhs2rMmuvPLb2Re/+Lnsve85PXvTyW/M3viG47MTTjg2e8MbjstNU830xuOzE994nORlR510onVCLofjQx/6p+zCr/9X9pOf/E92772r8mcL400a7e/HLRm9LZ4uxgM1Htic/frG6/NBJMuWH1y3rtui0SsatrSQLKZpT7KZc4HrFrTYR2r0ojBO911+Y0SYPRu9J5WvlvtZwmopV1bHz5o1y29b6PD8X/HY9VAat0q3D+oaWtbT3F4YvdoLo4fRA4AKsNGTabDRezy98LxML2y/09Utep5Hzybp1t/9JvP8d9FdG123MRijfV699tY9T2r80INbs4cful/Lbfq/57LbKvNUOz2wPbSlsGz//KC3zefc21h+lnBd9tBDm6VN5de4lV6DVuq6lem7392298joeQLle7OfXvuj7IUvOiJbsqTUdVkqkIoGr3+NXnTdKu3yrtsoHLszQek2RRW387Joqvw5KrkohGMbd/faiLllz0Zvn332eVKF84pqWvQCD2xQYT5h5syZR+nc/hJhiOMXwzuQijBYPl+Z0bOVFq/qyejt6oMxZBIa1ujNnzvvzr0nTTp4ikyeVS2OE0t5PDd69cx/RUVYbPR0c3VeX4yelp0aveIxa620DCoayzi+yrqHVCbwjB5Ab3DLkJ+l8jNVcWGlF13HC3JetuKwQ7OTT3p9dtNvf5UbPc8/F5MNl948YWMXJqnU5VlqKSu9miyfNHl7MrlxPqlx7VSaKDmdhDmdjDnWewLl0lszwqiWJn9266TNqefTK726zdOr3P+Azu1+z6Xnt2Osy678/nezRQeUni90nNjk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AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAANgF+P8VkW6uBzXzWgAAAABJRU5ErkJggg==>