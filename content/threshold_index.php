<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/kalikatir">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Threshold</li>
  </ol>
</nav>
<div class="card" style="margin-top:10px;">
  <div class="card-body">
    <h5 class="card-title">Pengaturan Threshold</h5>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Nama Peringatan</th>
                <th>Min Value</th>
                <th>Max Value</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nama Peringatan</th>
                <th>Min Value</th>
                <th>Max Value</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
var table;
    $(function(){
        table = $("#example").DataTable({
            "processing": true,
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            "ajax": {
                "url":"ajax/data_threshold.php",
                "dataSrc": 'data'
            },
            "columns":[
                {data : 'status_name'},
                {data : 'min_value'},
                {data : 'max_value'},
                {
                    data: null,render: function ( data, type, row ){
                        var id=row.id;
                        return '<a href="main.php?page=threshold_edit&threshold_id='+id+'" class="editor_edit"><i class="fas fa-eye-dropper"></i> Edit</a>';
                    }
                }
            ]
        });
    })
</script>
