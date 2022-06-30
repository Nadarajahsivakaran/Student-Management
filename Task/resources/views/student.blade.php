@extends('layout')
@section('content')

    <button type="button" class="btn btn-success add" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add
    </button>

    <div class="container">

        <h1>Student Details</h1>

        <table class="table table-hover" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Full Name</th>
                    <th scope="col">Name With Initial</th>
                    <th scope="col">Address</th>
                    <th scope="col">DOB</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Registered Date</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->fullName }}</td>
                        <td>{{ $student->nameWithInitial }}</td>
                        <td>{{ $student->address }}</td>
                        <td>{{ $student->dob }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>
                            @if ($student->photo)
                                <img src="{{ asset('student/' . $student->photo) }}" width="100" height="60">
                            @endif
                        </td>
                        <td>{{ $student->registeredDate }}</td>
                        <td><button type="button" class="btn btn-primary edit" data-bs-toggle="modal"
                                onclick="edit({{ $student->id }})" data-bs-target="#exampleModal"><i
                                    class="far fa-edit"></i></button>
                        </td>
                        <td><a href="/studentDelete/{{ $student->id }}" type="button" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this item')"><i
                                    class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">

                        <form action="studentAdd" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="id" name="id">

                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" name="fullName"
                                    value="{{ old('fullName') }}">
                                @error('fullName')
                                    <span style="color: rgb(151, 4, 4); font-weight:bolder">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nameWithInitial" class="form-label">Name with Initial</label>
                                <input type="text" class="form-control" id="nameWithInitial" name="nameWithInitial"
                                    value="{{ old('nameWithInitial') }}">
                                @error('nameWithInitial')
                                    <span style="color: rgb(151, 4, 4); font-weight:bolder">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ old('address') }}">
                                @error('address')
                                    <span style="color: rgb(151, 4, 4); font-weight:bolder">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob"
                                    value="{{ old('dob') }}">
                                @error('dob')
                                    <span style="color: rgb(151, 4, 4); font-weight:bolder">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" aria-label="Default select example" name="gender"
                                    id="gender" value="{{ old('gender') }}">
                                    <option value="" disabled selected>Please Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                @error('gender')
                                    <span style="color: rgb(151, 4, 4); font-weight:bolder">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="photo" class="form-label">Photo</label>
                                <input class="form-control" type="file" id="photo" name="photo"
                                    value="{{ old('photo') }}">
                                @error('photo')
                                    <span style="color: rgb(151, 4, 4); font-weight:bolder">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="registeredDate" class="form-label"> Registered Date</label>
                                <input type="date" class="form-control" id="registeredDate" name="registeredDate"
                                    value="{{ old('registeredDate') }}">
                                @error('registeredDate')
                                    <span style="color: rgb(151, 4, 4); font-weight:bolder">{{ $message }}</span>
                                @enderror

                            </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger reset">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {

            if (!@json($errors->isEmpty())) {
                $('#exampleModal').modal('show');
            }

        });



        $('.add').click(function() {
            $("#exampleModalLabel").empty().append('Create Student');
            $('.reset').show();
            $('#id').val("");
            $('#fullName').val("");
            $('#address').val("");
            $('#nameWithInitial').val("");
            $('#dob').val("");
            $('#gender').val("");
            $('#photo').val("");
            $('#registeredDate').val("");

        })

        function edit(id) {

            $("#exampleModalLabel").empty().append('Update Student');
            $('.reset').hide();

            $.ajax({
                type: "GET",
                url: "/studentEdit/" + id,
                dataType: "json",

                success: function(response) {
                    $('#registeredDate').val(response.registeredDate);
                    $('#id').val(response.id);
                    $('#fullName').val(response.fullName);
                    $('#address').val(response.address);
                    $('#nameWithInitial').val(response.nameWithInitial);
                    $('#dob').val(response.dob);
                    $('#gender').val(response.gender);
                    $('#photo').val(response.photo);


                },

                error: function(response) {

                },
            });
        }
    </script>
@endsection
