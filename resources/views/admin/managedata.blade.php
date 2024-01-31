@extends('admin.admin')


@section('css')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">


@endsection

@section('content')



<div class="container bg-white px-5 mt-16 rounded-md pb-16">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="margin-top:2rem">
                    Ubah Data

    
                    
                </div>
                <div class="card-body">
                    <table class="table" id="ubahData">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>sample</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

    
@push('javascript')

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        $(function (){
            $('#ubahData').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                columns: [{
                    data
                }]
            })
        })
    </script>

@endpush

