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
    <form action="{{url('/users/user/projects')}}/{{$id}}/update/{{$project_id}}" method="post" class="form-div mt-3 p-3">
        @csrf
        <div class="mb-3">
        <input type="hidden" name="id" value="{{ $id }}">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div> 
</body>
</html>