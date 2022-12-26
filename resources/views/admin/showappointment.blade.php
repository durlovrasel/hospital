<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
</head>

<body>
    <div class="container-scroller">
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0">
                <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
                    <div class="ps-lg-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and
                                more with this template!</p>
                            <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo"
                                target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="https://www.bootstrapdash.com/product/corona-free/"><i
                                class="mdi mdi-home me-3 text-white"></i></a>
                        <button id="bannerClose" class="btn border-0 p-0">
                            <i class="mdi mdi-close text-white me-0"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- partial:partials/_sidebar.html -->

        @include('admin.sidebar')

        <!-- partial -->

        @include('admin.navbar')

        <!-- partial -->

        <div class="container-fluid page-body-wrapper">
            <div>
                <h1 style="text-align: center; padding:15px; font-size:35px"><b>Appointment List</b></h1>




                <style>
                    table {
                        font-family: arial, sans-serif;
                        border-collapse: collapse;
                        justify-content: center;
                    }

                    td,
                    th {
                        border: 1px solid #dddddd;
                        text-align: center;
                        padding: 8px;
                    }

                    td {
                        color: white;
                        font-size: 11px;
                    }

                    tr:nth-child(1) {
                        background-color: #00D9A5;
                        color: #ffffff;
                    }

                    tr {
                        background: #00D9A5;

                    }
                </style>



                <table>
                    <tr>
                        <th><b>Patient Name</b></th>
                        <th><b>Email Address</b></th>
                        <th><b>Phone Number</b></th>
                        <th><b>Doctor Name</b></th>
                        <th><b>Appointment Date</b></th>
                        <th><b>Message</b></th>
                        <th><b>Appointment Status</b></th>
                        <th><b>Approve</b></th>
                        <th><b>Discard</b></th>
                        <th><b>Send Email</b></th>
                    </tr>


                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->name }}</td>
                            <td>{{ $appointment->email }}</td>
                            <td>{{ $appointment->phone }}</td>
                            <td>{{ $appointment->doctor }}</td>
                            <td>{{ $appointment->date }}</td>
                            <td>{{ $appointment->message }}</td>
                            <td>{{ $appointment->status }}</td>
                            <td><a href="{{ url('approved', $appointment->id) }}"
                                    class="btn btn-md btn-success">Approve</a></td>
                            <td><a href="{{ url('discarded', $appointment->id) }}" class="btn btn-md btn-danger"
                                    onclick="return confirm('Are you sure want to discrd the appointment?')">Discard</a>
                            </td>
                            <td><a href="{{ url('emailview', $appointment->id) }}"
                                    class="btn btn-md btn-secondary">Send</a>
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
        </div>


        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.script')
        <!-- End custom js for this page -->
</body>

</html>
