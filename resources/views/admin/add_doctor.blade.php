<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="container">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="container">
                    <form action="{{ url('upload_doctor') }}" method="POST" enctype="multipart/form-data"
                        style="padding: 100px;">
                        @csrf
                        <div class="form-group">
                            <label>Doctor's Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter name"
                                style="background: #191C24; color: white;" required>
                        </div>
                        <div class="form-group">
                            <label>Doctor's Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter phone"
                                style="background: #191C24; color: white;" required>
                        </div>
                        <div class="form-group">
                            <label>Doctor's Speciality</label><br>
                            <select name="speciality" class="custom-select mr-sm-2"
                                style="background: #191C24; width: 640px;" required>
                                <option selected>Select from here...</option>
                                <option value="General Physician">General Physician</option>
                                <option value="General Surgeon">General Surgeon</option>
                                <option value="Medicine Specialist">Medicine Specialist</option>
                                <option value="Gynecologist">Gynecologist</option>
                                <option value="Pediatrics">Pediatrics</option>
                                <option value="Cardiologist">Cardiologist</option>
                                <option value="Dermatologist">Dermatologist</option>
                                <option value="Psychiatrists">Psychiatrists</option>
                                <option value="Neurologist">Neurologist</option>
                                <option value="Ophthalmologist">Ophthalmologist</option>
                                <option value="Nephrologist">Nephrologist</option>
                                <option value="Orthopedics">Orthopedics</option>
                                <option value="Dentist">Dentist</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Room Number</label><br>
                            <select name="room" class="custom-select mr-sm-2"
                                style="background: #191C24; width: 640px;" required>
                                <option selected>Select from here...</option>
                                <option value="A-101">A-101</option>
                                <option value="A-102">A-102</option>
                                <option value="A-103">A-103</option>
                                <option value="A-201">A-201</option>
                                <option value="A-202">A-202</option>
                                <option value="A-301">A-301</option>
                                <option value="A-302">A-302</option>
                                <option value="A-401">A-401</option>
                                <option value="A-501">A-501</option>
                                <option value="A-601">A-601</option>
                                <option value="A-602">A-602</option>
                                <option value="A-603">A-603</option>
                                <option value="A-701">A-701</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Doctor's Image</label>
                            <input type="file" name="image" class="form-control"
                                style="background: #191C24; color:white;" required>
                        </div>
                        <input type="submit" class="btn btn-primary btn-lg">
                    </form>
                </div>
            </div>
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
</body>

</html>
