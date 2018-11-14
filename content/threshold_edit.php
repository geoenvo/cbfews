<?php
    require_once("config/db_con.php");
    $datas_threshold = array();
    $threshold = "SELECT * FROM kalikatir.threshold where id='".$_GET['threshold_id']."'";
    $res_threshold = myQueryDb($threshold);
    while ($res_threshold_row = myAssocDb($res_threshold)) {
        // code...
        $datas_threshold [] = $res_threshold_row;
    }
?>
<div class="card-body">
  <h5 class="card-title">Edit Pengaturan Threshold</h5>
  <form method="POST">
    <div class="form-group">
      <label for="nama_peringatan">Nama Peringatan</label>
      <input type="text" class="form-control" name="status_name" value="<?=$datas_threshold[0]['status_name']?>">
    </div>
    <div class="form-group">
        <label for="min_value">Min Value</label>
        <input type="number" class="form-control" name ="min_value" value="<?=$datas_threshold[0]['min_value']?>">
    </div>
    <div class="form-group">
        <label for="max_value">Max Value</label>
        <input type="number" class="form-control" name="max_value" value="<?=$datas_threshold[0]['max_value']?>">
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-success mb-2" name="updated">Perbarui</button>
    </div>
  </form>
</div>

<?php
if(isset($_POST['updated'])){
    $sql = "UPDATE threshold SET min_value='$_POST[min_value]',max_value='$_POST[max_value]' WHERE id='$_GET[threshold_id]'";
    echo $sql;
    $res = myQueryDb($sql);
    if($res){
        header("location:main.php?page=threshold_index");
    }
}
?>
