<form action="" method="post">
  <div class="row justify-content-md-center">

    <div class="col-md-3 form-group">

      <label class="label success" for="PBI_ID">Search With CID : </label>

      <input list="ids" name="cid" type="text" id="cid" value="<?= $_SESSION['cid'] ?>" class="form-control mb-4" autocomplete="off" />

      <datalist id="ids">
        <?php

        $sql = "SELECT * from company_info";

        $query = @mysql_query($sql);
        while ($datarow = mysql_fetch_object($query)) { ?>
          <option value="<?= $datarow->id ?>"><?= $datarow->company_name ?></option>
        <?php } ?>
      </datalist>
    </div>
    <div class="col-md-3 form-group" style="margin-top: 2.5% !important;">
      <button class="btn btn-info" type="submit" name="submit">Search</button>

    </div>
	</div>
</form>