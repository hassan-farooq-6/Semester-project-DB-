<!doctype html>
<html lang="en">
  <head>
    <title>sign-up Page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <style>
      body {
        background-image: url('https://img.freepik.com/free-photo/vegetables-set-left-black-slate_1220-685.jpg?w=996&t=st=1686248132~exp=1686248732~hmac=b98276ea40fa563de41a2e480e1de5b63f86f7c708b89ce9b870e9126027afb1');
        background-size: cover;
      }
      .form-group {
        margin-bottom: 30px;
      }
    </style>
  </head>
  <body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
      <form action="progphp.php" method="post">
        <h1 class="text-center text-white">Sign up Page</h1>
        <div class="form-group">
          <label for="firstName" style="color: white;">First Name</label>
          <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name">
        </div>
        <div class="form-group">
          <label for="lastName" style="color: white;">Last Name</label>
          <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name">
        </div>
        
        <div class="form-group">
          <label for="contact" style="color: white;">Contact</label>
          <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter your contact number">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1" style="color: white;">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="Email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1" style="color: white;">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="Password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <a href="http://localhost/php_workspace/login.html" class="btn btn-secondary">Login</a>
      </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
