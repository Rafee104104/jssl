<form action="" method="post">
  <div class="row justify-content-md-center bg-form-titel">

    <div class="col-md-4 form-group p-0" style="margin-top: 2.1% !important;">

<!--      <label class="label success" for="PBI_ID">Search With CID : </label>-->

      <input list="ids" name="cid" type="text" id="cid" value="<?= $_SESSION['cid'] ?>" placeholder="Search With CID" class="form-control mb-4" autocomplete="off"  
	  style="height: 40px !important; border-radius: 5px 0px 0px 5px; box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23); "/>

      <datalist id="ids">
        <?php

        $sql = "SELECT * from company_info";

        $query = @mysql_query($sql);
        while ($datarow = mysql_fetch_object($query)) { ?>
          <option value="<?= $datarow->id ?>"><?= $datarow->company_name ?></option>
        <?php } ?>
      </datalist>
    </div>
    <div class="col-md-1 form-group p-0" style="margin-top: 2.1% !important;">
      <button class="btn btn-info" type="submit" name="submit" style="height: 40px !important; border-radius: 0px 5px 5px 0px; box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);">Search</button>

    </div>
	</div>
</form>

<style>
.bmd-label-static{
	color:#333;
	font-weight: bold;
}
</style>