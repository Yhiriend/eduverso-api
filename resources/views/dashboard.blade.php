<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cursos en Línea</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .button {
            display: inline-block;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            margin: 10px 0;
        }

        .button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Dashboard de Cursos en Línea</h1>

        <div class="card">
            <h2>Bienvenido, {{ $userName }}</h2>
            <p>Email: {{ $userEmail }}</p>
        </div>

        <div class="card">
            <h2>Estadísticas</h2>
            <p>Total de Cursos: 5</p>
            <p>Cursos Activos: 3</p>
            <p>Cursos Inactivos: 2</p>
        </div>

        <div class="card">
            <h2>Lista de Cursos</h2>
            <a href="" class="button">Agregar Nuevo Curso</a>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Curso de PHP</td>
                        <td>Aprende PHP desde cero.</td>
                        <td>Activo</td>
                        <td>
                            <a href="" class="button">Editar</a>
                            <form action="" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button" style="background-color: #dc3545;">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Curso de Laravel</td>
                        <td>Desarrolla aplicaciones con Laravel.</td>
                        <td>Activo</td>
                        <td>
                            <a href="" class="button">Editar</a>
                            <form action="" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button" style="background-color: #dc3545;">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Curso de JavaScript</td>
                        <td>Domina JavaScript en profundidad.</td>
                        <td>Inactivo</td>
                        <td>
                            <a href="" class="button">Editar</a>
                            <form action="" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button" style="background-color: #dc3545;">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Curso de HTML y CSS</td>
                        <td>Aprende a construir sitios web.</td>
                        <td>Activo</td>
                        <td>
                            <a href="" class="button">Editar</a>
                            <form action="" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button" style="background-color: #dc3545;">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Curso de React</td>
                        <td>Construye aplicaciones con React.</td>
                        <td>Inactivo</td>
                        <td>
                            <a href="" class="button">Editar</a>
                            <form action="" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button" style="background-color: #dc3545;">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>