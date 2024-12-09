<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenidos a MotorX - Sistema de Ventas de Vehículos</title>
    
    <!-- Link a Bootstrap CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Opcional: iconos de FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles1.css">
</head>
<body>

    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MotorX</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#acerca">Acerca de Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#vehiculos">Vehículos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#equipo">Nuestro Equipo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registro.php">Registrarse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sección: Bienvenida (Home) -->
    <section id="home" class="container-fluid text-center mt-5">
        <div class="row">
            <div class="col">
                <h1 class="display-3">Bienvenidos a MotorX</h1>
                <p class="lead">Tu mejor opción en venta de vehículos, con un equipo de expertos dispuestos a ayudarte a encontrar el vehículo ideal para ti.</p>
                <a href="#vehiculos" class="btn btn-primary btn-lg mt-4">Ver nuestros vehículos</a>
            </div>
        </div>
    </section>

    <!-- Sección: Acerca de Nosotros -->
    <section id="acerca" class="container mt-5">
        <div class="row">
            <div class="col">
                <h2 class="text-center">Acerca de Nosotros</h2>
                <p>En MotorX, nos dedicamos a ofrecer vehículos de calidad para todos nuestros clientes. Con años de experiencia en el sector, garantizamos una atención personalizada y productos que se ajustan a tus necesidades.</p>
                <p>Nuestro equipo trabaja incansablemente para brindarte el mejor servicio, asegurando que cada vehículo que vendemos esté en óptimas condiciones.</p>
            </div>
        </div>
    </section>

    <!-- Sección: Vehículos -->
    <section id="vehiculos" class="container mt-5">
        <div class="row">
            <div class="col">
                <h2 class="text-center">Nuestros Vehículos</h2>
                <p class="text-center">Desde autos compactos hasta grandes SUV, tenemos el vehículo perfecto para ti. Descubre nuestra amplia gama de opciones disponibles.</p>
                <!-- Aquí puedes mostrar vehículos dinámicamente desde la base de datos -->
                <div class="row">
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card">
                            <img src="https://hips.hearstapps.com/hmg-prod/images/toyota-aygo-x-2022-1600-06-1643210491.jpg" class="card-img-top" alt="Vehículo 1">
                            <div class="card-body">
                                <h5 class="card-title">Modelo 1</h5>
                                <p class="card-text">Vehículo compacto, ideal para ciudad. Con excelente rendimiento de combustible.</p>
                                <a href="#" class="btn btn-primary">Ver más</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card">
                            <img src="https://gruasams.cl/wp-content/uploads/2023/04/image-59.png" class="card-img-top" alt="Vehículo 2">
                            <div class="card-body">
                                <h5 class="card-title">Modelo 2</h5>
                                <p class="card-text">SUV moderna, perfecta para familias y viajes largos. Amplio espacio y seguridad.</p>
                                <a href="#" class="btn btn-primary">Ver más</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card">
                            <img src="https://cdn-fastly.autoguide.com/media/2023/06/26/12865246/2015-mclaren-650s-spider-review.jpg?size=720x845&nocrop=1" class="card-img-top" alt="Vehículo 3">
                            <div class="card-body">
                                <h5 class="card-title">Modelo 3</h5>
                                <p class="card-text">Deportivo, ideal para quienes buscan velocidad y diseño. Equipado con lo último en tecnología.</p>
                                <a href="#" class="btn btn-primary">Ver más</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección: Nuestro Equipo -->
    <section id="equipo" class="container mt-5">
        <div class="row">
            <div class="col">
                <h2 class="text-center">Nuestro Equipo</h2>
                <p class="text-center">Un equipo dedicado a ofrecerte la mejor experiencia de compra de vehículos.</p>
                <div class="row">
                    <!-- Miembros del equipo -->
                    <div class="col-12 col-md-4">
                        <div class="card">
                            <img src="https://img.freepik.com/vector-premium/silueta-negra-hombre-traje-corbata_388558-577.jpg?w=360" class="card-img-top" alt="Miembro 1">
                            <div class="card-body">
                                <h5 class="card-title">Sebastian Bettacuort</h5>
                                <p class="card-text">Director de Ventas. Con más de 15 años de experiencia en el sector automotriz.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card">
                            <img src="https://img.freepik.com/vector-premium/silueta-negra-hombre-traje-corbata_388558-577.jpg?w=360" class="card-img-top" alt="Miembro 2">
                            <div class="card-body">
                                <h5 class="card-title">Emanuel Lara</h5>
                                <p class="card-text">Ayuda a nuestros clientes a encontrar el auto de lujo perfecto.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card">
                            <img src="https://img.freepik.com/vector-premium/silueta-negra-hombre-traje-corbata_388558-577.jpg?w=360" class="card-img-top" alt="Miembro 3">
                            <div class="card-body">
                                <h5 class="card-title">Juan Silva</h5>
                                <p class="card-text">Consultor de Vehículos. Dispuesto a ayudar a nuestros clientes a elegir el vehículo adecuado.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card">
                            <img src="https://img.freepik.com/vector-premium/silueta-negra-hombre-traje-corbata_388558-577.jpg?w=360" class="card-img-top" alt="Miembro 3">
                            <div class="card-body">
                                <h5 class="card-title">James Segura</h5>
                                <p class="card-text">Consultor de Vehículos. Dispuesto a ayudar a nuestros clientes a elegir el vehículo adecuado.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card">
                            <img src="https://img.freepik.com/vector-premium/silueta-negra-hombre-traje-corbata_388558-577.jpg?w=360" class="card-img-top" alt="Miembro 3">
                            <div class="card-body">
                                <h5 class="card-title">Miguel Lopez</h5>
                                <p class="card-text">Consultor de Vehículos. Dispuesto a ayudar a nuestros clientes a elegir el vehículo adecuado.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección: Contacto -->
    <section id="contacto" class="container mt-5 mb-5">
        <div class="row">
            <div class="col">
                <h2 class="text-center">Contacto</h2>
                <p class="text-center">Si tienes preguntas o deseas obtener más información, no dudes en contactarnos.</p>
                <form action="contacto.php" method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Script de Bootstrap (JavaScript) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
