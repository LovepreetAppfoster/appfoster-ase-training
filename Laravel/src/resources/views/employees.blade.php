<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Employee Table</title>
    <style>
      /* Modal styles */
      .modalUser{
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* display: flex; */
            justify-content: center; 
            align-items: center; 
            z-index: 1;
        }
        .modal-content{
            background-color: #fff;
            padding: 15px 25px;
            border-radius: 5px;
            width: 25%;
        }
        .close-button {
            text-align: center;
        }
    </style>
</head>
<body>
  <div class="container mt-3 ">
        <div class="text-end">
            <a href="{{url('/')}}/users/create">
              <button class="btn btn-primary">Create New User</button>
            </a> 
        </div>
        <table class="table">
            <thead>
              <tr>
                <th>Employee_ID</th>
                <th >Name</th>
                <th >Email</th>
                <th >Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr>
                    <td>{{$user['emp_id']}}</td>
                    <td>{{$user['name']}}</td>
                    <td>{{$user['email']}}</td>
                    <td>
                      <button class="btn btn-info ms-2 show-details-btn" id="button-icon" data-id="{{ $user['emp_id'] }}">View
                      </button>
                      <a href="{{url('/users/edit')}}/{{ $user['emp_id'] }}">
                        <button class="btn btn-warning ms-2">Update</button>
                      </a>
                      <a href="{{url('/users/user/del')}}/{{$user['emp_id']}}">
                        <button class="btn btn-danger ms-2">Delete</button>
                      </a>
                      <a href="{{url('/users/user/projects')}}/{{$user['emp_id']}}">
                        <button class="btn btn-secondary ms-2">Projects</button>
                      </a>
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
          <!-- Modal -->
      <div id="userModal" class="modalUser">
        <div class="modal-content">
            {{-- <div class="modal-content"> --}}
              <h2>User Details</h2>
              <p><strong>ID:</strong> <span id="userId"></span></p>
              <p><strong>Name:</strong> <span id="userName"></span></p>
              <p><strong>Email:</strong> <span id="userEmail"></span></p>
            {{-- </div> --}}
            <div class="close-button mt-1"><button type="button" class="btn btn-outline-primary" id="close-modal">Close</button></div> 
        </div>
      </div>
      <script>

        function toggleModal() {
          const modal = document.getElementById('userModal');
          modal.style.display = (modal.style.display === 'flex') ? 'none' : 'flex';
        }

        async function showModal(userId) {
            const modal = document.getElementById('modal-content');
            //const closeBtn = document.getElementById('closeModal');
            const modalUserName = document.getElementById('userName');
            const modalUserEmail = document.getElementById('userEmail');
            const modalUserId = document.getElementById('userId')
            try {
                const response = await fetch(`/api/users/${userId}`);
                if (!response.ok) {
                throw new Error('Failed to fetch user details from the API.');
                }
                const userData = await response.json();
                const showdata = userData.data;
                modalUserName.textContent = showdata.name;
                modalUserEmail.textContent = showdata.email;
                modalUserId.textContent = showdata.emp_id;

                toggleModal();
      
              } catch (error) {
                console.error(error);
              }
        }

        document.addEventListener("click", function(){
          if(event.target.classList.contains('show-details-btn')){
            const userId = event.target.getAttribute('data-id');
            showModal(userId);
          }
        });

        document.getElementById('close-modal').addEventListener('click', () => {
            toggleModal();
        });
      </script>
</body>
</html>