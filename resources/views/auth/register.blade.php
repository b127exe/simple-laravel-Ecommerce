<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @if (session()->has('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session()->get('status')}}</strong><a href="/login" class="nav-link">Back</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="container my-5">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <h2 class="display-3 text-center">Register</h2>
                <form method="POST" action="{{url('/register-store')}}">
                    @csrf
                    <div class="mb-3">
                        <label class="lead">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="lead">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="lead">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="d-grid mt-4">
                        <button class="btn btn-primary">Register</button>
                    </div>
                </form>
              <div class="d-flex justify-content-between">
                <a href="/login" class="nav-link">Already an account</a>
              </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
