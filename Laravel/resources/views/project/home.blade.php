@include('welcome')

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="modal.css">
    <!-- Include jQuery from a CDN (Content Delivery Network) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="{{asset('style.css')}}">
    <title>Document</title>
    <style>
      .alert{
        width: 33%;
    margin: auto;
    text-align: center;
    margin-top: 20px;
      }
      #delete-selected-button{
        display: none;
        margin:15px;
      }
      
    </style>
</head>
<body>
  @yield('content')
  <div class="container mc-0">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="pt-3">
        <a href="/create"><input type="button" class="btn btn-info" value="Create"></a>
    </div>
    <div class="text-center">
      <button type="button" class="btn btn-danger" id="delete-selected-button">Delete Selected</button>
    </div>
    <form id="delete-form" action="{{ route('deleteSelected') }}" method="post">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        <input type="checkbox" id="select-all-checkbox">
                    </th>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Course</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cruds as $crud)
                <tr>
                    <td>
                        <input type="checkbox" class="row-checkbox" name="selected[]" value="{{ $crud->id }}">
                    </td>
                    <th scope="row">{{$crud->id}}</th>
                    <td>{{$crud->name}}</td>
                    <td>{{$crud->course}}</td>
                    <td>{{$crud->email}}</td>
                    <td>
                        <a href="{{ route('project.edit',['crud'=> $crud]) }}" class="btn btn-primary">Edit</a>

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{$crud->id}}">
                            Remove
                        </button>
                        <div id="myModal-{{$crud->id}}" class="modal fade">
                          <div class="modal-dialog modal-confirm">
                              <div class="modal-content">
                                  <div class="modal-header flex-column">
                                      <div class="icon-box">
                                          <i class="material-icons">&#xE5CD;</i>
                                      </div>
                                      <h4 class="modal-title w-100">Are you sure?</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  </div>
                                  <div class="modal-body">
                                      <p>Do you really want to delete these records? This process cannot be undone.</p>
                                  </div>
                                  <div class="modal-footer justify-content-center">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                      
                                      <a href="{{ route('project.delete', $crud) }}"  class="btn btn-danger">Delete</a>


                                      
                                  </div>
                              </div>
                          </div>
                      </div>
                  </td>
              </tr>
              @endforeach
            </tbody>
        </table>
       
    </form>
</div>

<script>
  // Assuming you have a checkbox with the id 'select-all-checkbox' and a button with the id 'delete-selected-button'

// Select the checkbox and button elements
const selectAllCheckbox = document.getElementById('select-all-checkbox');
const deleteSelectedButton = document.getElementById('delete-selected-button');

// Add an event listener to the checkbox to show/hide the button
selectAllCheckbox.addEventListener('change', function() {
  if (this.checked) {
    deleteSelectedButton.style.display = 'block'; // Show the button
  } else {
    deleteSelectedButton.style.display = 'none';  // Hide the button
  }
});


    // Select all checkbox
    document.getElementById('select-all-checkbox').addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('.row-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Delete selected button
    document.getElementById('delete-selected-button').addEventListener('click', function () {
        document.getElementById('delete-form').submit();
    });


    // delete button single

    fetch('/api/resources/{resource_id}', {
    method: 'DELETE',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        // Include any necessary headers, such as authentication tokens
    },
})
.then(response => {
    if (response.ok) {
        // Handle success
        console.log('Resource deleted successfully');
    } else {
        // Handle error
        console.error('Failed to delete resource');
    }
})
.catch(error => {
    console.error('Error:', error);
});


    
    setTimeout(() => {
      $('.alert').fadeOut();
    }, 5000);
    
  
</script>



</body>
</html>