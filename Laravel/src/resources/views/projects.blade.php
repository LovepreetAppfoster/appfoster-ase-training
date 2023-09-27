<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Projects</title>
</head>
<body>
    <div class="container mt-3 ">
        <div class="text-end">
            <a href="{{url('/users/user/projects')}}/{{$id}}/create">
              <button class="btn btn-primary">Create New Project</button>
            </a> 
        </div>
        <table class="table">
            <thead>
              <tr>
                {{-- <th>Employee_ID</th> --}}
                <th >Project ID</th>
                <th >Name</th>
                {{-- <th >Email</th> --}}
                <th >Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($projects as $project)
              <tr>
                    <td>{{$project['project_id']}}</td>
                    <td>{{$project['name']}}</td>
                    <td>
                      {{-- <button class="btn btn-info ms-2 show-details-btn" id="button-icon" data-id="{{ ['emp_id'] }}">View
                      </button> --}}
                      <a href="{{url('/users/user/projects')}}/{{$id}}/edit/{{$project['project_id']}}">
                        <button class="btn btn-warning ms-2">Update</button>
                      </a>
                      <a href="{{url('/users/user/projects')}}/{{$id}}/delete/{{$project['project_id']}}">
                        <button class="btn btn-danger ms-2">Delete</button>
                      </a>
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
</body>
</html>