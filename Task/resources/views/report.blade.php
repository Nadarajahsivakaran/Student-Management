@extends('layout');
@section('content')
    <div class="container">

        <form action="/getDatas" method="get">
            @csrf

            <div class="row filter">

                <div class="col-2">
                    <label for="studentNo" class="form-label">Student No</label>
                    <input type="number" class="form-control" id="studentNo" name="studentNo">
                </div>

                <div class="col-2">
                    <label for="studentNo" class="form-label">Gender</label>
                    <select class="form-select" aria-label="Default select example" name="gender" id="gender">
                        <option value="" disabled selected>Please Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="col-2">
                    <label for="registeredFrom" class="form-label">Registered From</label>
                    <input type="date" class="form-control" id="from" name="from">
                </div>

                <div class="col-2">
                    <label for="registeredTo" class="form-label">Registered To</label>
                    <input type="date" class="form-control" id="to" name="to">
                </div>

                <div class="col-2">
                    <button type="submit" class="btn btn-success reportBtn">Submit</button>
                </div>

            </div>
        </form>


        <table class="table table-hover" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Name With Initial</th>
                    <th scope="col">Address</th>
                    <th scope="col">DOB</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Registered Date</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
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
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
