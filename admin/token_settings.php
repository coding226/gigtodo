<?php

@session_start();

if(!isset($_SESSION['admin_email'])){
	
echo "<script>window.open('login','_self');</script>";
	 
}else{

$get_token_settings = $db->select("token_settings");
$row_token_settings = $get_token_settings->fetch();
$wallet_address = $row_token_settings->wallet_address;
$exchange_url = $row_token_settings->exchange_url;
$contract_address = $row_token_settings->contract_address;
$contract_abi = $row_token_settings->contract_abi;
$contract_bytecode = $row_token_settings->contract_bytecode;
$contract_decimals = $row_token_settings->contract_decimals;
$token_value = $row_token_settings->token_value;

?>

  <div class="breadcrumbs">
      <div class="col-sm-4">
          <div class="page-header float-left">
              <div class="page-title">
                  <h1><i class="menu-icon fa fa-cog"></i> Settings / Token Settings</h1>
              </div>
          </div>
      </div>
      <div class="col-sm-8">
          <div class="page-header float-right">
              <div class="page-title">
                  <ol class="breadcrumb text-right">
                      <li class="active">Token Settings</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>


  <div class="container pt-3">

  <div class="row"><!--- 1 row Starts --->
    <div class="col-lg-12"><!--- col-lg-12 Starts --->
      <div class="card mb-5"><!--- card mb-5 Starts --->
        <div class="card-header"><!--- card-header Starts --->
          <h4 class="h4"><i class="fa fa-money"></i> Token Settings </h4>
        </div><!--- card-header Ends --->
        <div class="card-body"><!--- card-body Starts --->
          <form method="post" enctype="multipart/form-data"><!--- form Starts --->

            
           

            <div class="form-group row"><!--- form-group row Starts --->
            <label class="col-md-3 control-label">Token Value ($) : </label>
            <div class="col-md-6">
              <input type="text"  name="token_value" class="form-control" value="<?= $token_value; ?>" required=""/>
            </div>
            </div><!--- form-group row Ends --->

            <div class="form-group row"><!--- form-group row Starts --->
            <label class="col-md-3 control-label"> Wallet Address : </label>
            <div class="col-md-6">
              <input type="text" name="wallet_address" class="form-control" value="<?= $wallet_address; ?>" required=""/>
            </div>
            </div><!--- form-group row Ends --->

            <div class="form-group row"><!--- form-group row Starts --->
              <label class="col-md-3 control-label"> Exchange Url : </label>
              <div class="col-md-6">
                <input type="text" name="exchange_url" placeholder="Exchange Url" class="form-control" value="<?= $exchange_url; ?>">
              </div>
            </div><!--- form-group row Ends --->

            <div class="form-group row"><!--- form-group row Starts --->
              <label class="col-md-3 control-label"> Contract Address : </label>
              <div class="col-md-6">
                <input type="text" name="contract_address" placeholder="Contract Address" class="form-control" value="<?= $contract_address; ?>">
              </div>
            </div><!--- form-group row Ends --->


            <div class="form-group row"><!--- form-group row Starts --->
              <label class="col-md-3 control-label"> Contract Decimals : </label>
              <div class="col-md-6">
                <input type="number" name="contract_decimals" placeholder="Contract Address" class="form-control" value="<?= $contract_decimals; ?>">
              </div>
            </div><!--- form-group row Ends --->

            <div class="form-group row"><!--- form-group row Starts --->
              <label class="col-md-3 control-label"> Contract ABI : </label>
              <div class="col-md-6">
                <textarea type="text" name="contract_abi" placeholder="Contract ABI" class="form-control"><?= $contract_abi; ?></textarea>
              </div>
            </div><!--- form-group row Ends --->

            <div class="form-group row"><!--- form-group row Starts --->
              <label class="col-md-3 control-label"> Contract Bytecode : </label>
              <div class="col-md-6">
                <textarea type="text" name="contract_bytecode" placeholder="Contract Bytecode" class="form-control"><?= $contract_bytecode; ?></textarea>
              </div>
            </div><!--- form-group row Ends --->

            


            <div class="form-group row"><!--- form-group row Starts --->
            <label class="col-md-3 control-label"></label>
            <div class="col-md-6">
              <input type="submit" name="update_token_settings" class="form-control btn btn-success" value="Update Token Settings">
            </div>
            </div><!--- form-group row Ends --->

          </form><!--- form Ends --->
        </div><!--- card-body Ends --->
      </div><!--- card mb-5 Ends --->
    </div><!--- col-lg-12 Ends --->
  </div><!--- 1 row Starts --->

  <?php
   
    if($videoPlugin == 1){ 
      include("../plugins/videoPlugin/admin/general_settings.php");
    }

    if($notifierPlugin == 1){ 
      include("../plugins/notifierPlugin/admin/api_settings.php");
    }

  ?>

</div><!--- container Ends --->

<?php

if(isset($_POST['update_token_settings'])){

  $rules = array(
    "token_value" => "required|number"
  );
  
    $messages = array("token_value" => "Please enter token value number.");
    $val = new Validator($_POST,$rules,$messages);
    if($val->run() == false){
      $_SESSION['error_array'] = array();
      echo "<script>alert_error('Please enter token value number.','index?token_settings');</script>";
    }else{
      $error_array = array();
      $data = $input->post();
      unset($data['update_token_settings']);
      $update_settings = $db->update("token_settings",$data);
      if($update_settings){
        $insert_log = $db->insert_log($admin_id,"currency_token_settings","","updated");
        echo "<script>alert_success('Token Settings has been updated successfully.','index?token_settings');</script>";
  }
}
}


?>

<?php } ?>