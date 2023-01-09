<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<section class="vh-100" style="background-color: #508bfc;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <form action="/register" method="post">
                            @csrf
                            <h3 class="mb-5">Registrarse</h3>

                            <div class="form-outline mb-4">
                                <input type="text" name="name" class="form-control form-control-lg" />
                                <label class="form-label" for="typeEmailX-2">Nombre</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="email" name="email" class="form-control form-control-lg" />
                                <label class="form-label" for="typeEmailX-2">Email</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" name="password" class="form-control form-control-lg" />
                                <label class="form-label" for="typePasswordX-2">Contraseña</label>
                            </div>

                            <div class="form-outline mb-4">
                                <input type="password" name="password_confirmation" class="form-control form-control-lg" />
                                <label class="form-label" for="typePasswordX-2">Confirma contraseña</label>
                            </div>

                            <input class="btn btn-primary btn-lg btn-block" type="submit" value="Registrarse">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
