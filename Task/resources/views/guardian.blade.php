@extends('layout');
@section('content')

    <button type="button" class="btn btn-success add" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add
    </button>


    <div class="container">

        <h1>Student Guardian Details</h1>

        <table class="table table-hover" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Student</th>
                    <th scope="col">Guardian</th>
                    <th scope="col">Contact No</th>
                    <th scope="col">Address</th>
                    <th scope="col">Relation</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($studentGuardians as $studentGuardian)
                    <tr>
                        <td>{{ $studentGuardian->fullName }}</td>
                        <td>{{ $studentGuardian->giardianName }}</td>
                        <td>{{ $studentGuardian->contactNo }}</td>
                        <td>{{ $studentGuardian->Address }}</td>
                        <td>{{ $studentGuardian->relation }}</td>
                        <td><button type="button" class="btn btn-primary edit" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" onclick="edit({{ $studentGuardian->id }})">Edit</button>
                        </td>
                        <td><a href="/guarianDelete/{{ $studentGuardian->id }}" type="button"
                                onclick="return confirm('Are you sure you want to delete this item')"
                                class="btn btn-danger">Delete</a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Create Student Guardian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">

                        <form action="/studentGuardianAdd" method="POST">
                            @csrf
                            <input type="hidden" id="id" name="id">

                            <div class="mb-3">
                                <label for="student_id" class="form-label">Student</label>
                                <select class="form-select" aria-label="Default select example" name="student_id"
                                    id="student_id" value="{{ old('student_id') }}">
                                    <option value="" disabled selected>Please Select Student</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->fullName }}</option>
                                    @endforeach
                                </select>
                                @error('student_id')
                                    <span style="color: rgb(151, 4, 4); font-weight:bolder">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <span style="color: rgb(151, 4, 4); font-weight:bolder">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="contactNo" class="form-label">Contact No</label>
                                <input type="number" class="form-control" id="contactNo" name="contactNo"
                                    value="{{ old('contactNo') }}">
                                @error('contactNo')
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
                                <label for="relation" class="form-label">Relation</label>
                                <input type="text" class="form-control" id="relation" name="relation"
                                    value="{{ old('relation') }}">
                                @error('relation')
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
            $("#exampleModalLabel").empty().append('Create Student Guardian');
            $('.reset').show();
            $("#student_id").val("");
            $("#name").val("");
            $("#contactNo").val("");
            $("#address").val("");
            $("#relation").val("");
            $("#id").val("");
        });

        function edit(id) {

            $("#exampleModalLabel").empty().append('Update Student Guardian');
            $('.reset').hide();

            $.ajax({
                type: "GET",
                url: "/studentGuardianEdit/" + id,
                dataType: "json",

                success: function(response) {
                    $("#student_id").val(response.student_id);
                    $("#name").val(response.giardianName);
                    $("#contactNo").val(response.contactNo);
                    $("#address").val(response.Address);
                    $("#relation").val(response.relation);
                    $("#id").val(response.id);
                },

                error: function(response) {

                },
            });
        }
    </script>
@endsection
