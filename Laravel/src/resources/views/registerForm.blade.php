<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Register Employee</title>
    <style>
        body{
            background-color: #c3c3c3;
        }

        .div-cus{
            background-color: white;
            width: 75%;
            position: relative;
            top: 50px;
            left: 150px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
   <div class="conatiner div-cus">
    <form action="{{url('/')}}/users/store" method="post" class="form-div mt-3 p-3">
        {{-- @csrf --}}
        <h2>Register New Employee</h2>
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name">
          {{-- <span class="text-danger">
            @error('name')
              {{$message}}
            @enderror
          </span> --}}
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        {{-- <div class="mb-3">
            <label for="phone" class="form-label">Phone no.</label>
            <input type="text" class="form-control" id="phone">
        </div> --}}
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div> 
</body>
</html>