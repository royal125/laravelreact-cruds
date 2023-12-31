@include('welcome')

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
  input{
    margin: 10px;
  }
</style>
<body>
<section class="vh-100" style="background-color: #eee;">

    <div>
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>


        @endif
    </div>
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Data process</p>

                <form class="form-control" method="POST" action="{{ route('project.update', $cruds) }}">

                    @method('PUT')  
                    @csrf

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                    <label for="name">Name</label>
<input type="text" id="form3Example1c" class="form-control" name="name" required value="{{$cruds->name}}" ><br/>

<label for="course">Course</label>
<input type="text" id="form3Example1c" class="form-control" name="course" value="{{$cruds->course}}"><br/>

<label for="email">Email</label>
<input type="email" id="form3Example1c" class="form-control" name="email" value="{{$cruds->email}}"><br/>

                         
                     <br>
                     &#160; 
                     <a href=""><button type="submit" class="btn btn-success">Update</button></a>
                    </div>
                  </div>

                 

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                  class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>