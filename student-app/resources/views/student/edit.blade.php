<!DOCTYPE html>
<html>
<head>
    <title>Create Student</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
<body>
     <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
<div class="container mt-5">
    <h2>Update Student</h2>
    <form action="{{route('student.update',$student)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" value='{{$student->name}}' name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" value='{{$student->email}}' name="email" required>
        </div>
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" class="form-control" id="age" value='{{$student->age}}' name="age" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>