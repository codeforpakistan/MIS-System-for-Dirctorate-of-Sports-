<!-- Main Content -->
<div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4><?=$title?></h4>
                  </div>
                  <div class="card-body">
                    <div class="row">

                      <div class="col-4" style="border:1px solid #000">
                        <img alt="image" src="assets/images/Duplicate Card Receipt.png" class="header-logo" style="width:100%;" />
                        
                        <table  width="100%" border="0" cellpadding="0px"   style="margin-top: 20px;">
                        <tr>
                          <th width="26%">Branch Code:</th>
                          <td style="border-bottom: 1px solid #000;"></td>
                        </tr>
                        <tr>
                          <th width="28%">Branch Name:</th>
                          <td style="border-bottom: 1px solid #000;"></td>
                        </tr>

                        <tr>
                          <th width="26%">Date:</th>
                          <td style="border-bottom: 1px solid #000;"></td>
                        </tr>
                      </table>

                      <table style="margin-top: 10px;" width="100%">
                        <tr>
                          <td width="25.33%">Mcb</td>
                          <td width="50.33%"></td>
                          <td width="25.33%">easypaisa</td>
                        </tr>
                      </table>

                      <br>

                       <table width="100%" border="1" style="margin-top: 10px;">
                        <tr>
                          <td width="150px;">Challan No:</td>
                          <td></td>
                        </tr>

                        <tr>
                          <td>Name:</td>
                          <td><?=$bank_challan[0]->ath_name?></td>
                        </tr>

                        <tr>
                          <td>CNIC:</td>
                          <td><?=$bank_challan[0]->ath_cnic?></td>
                        </tr>

                        <tr>
                          <td>Payment Mode:</td>
                          <td><?=$bank_challan[0]->ath_payment_mode?></td>
                        </tr>


                       



                        <tr>
                          <td>Games:</td>
                          <td>
                       <?php $total_fee = 0;
                              $admision_fee = 0;
                              $game_fee = 0;

                              if(!empty($bank_challan)){ 
                        foreach($bank_challan as $bank_challan){?>
                          <?=$bank_challan->game_name?>



                      <?php 
                      $game_fee         += $bank_challan->ath_game_fee;
                      $admision_fee     += $bank_challan->ath_game_admission_fee; 
                    } }?>
                      </td>
                    </tr>

                        
                        <tr>
                          <td>Due Date:</td>
                          <td></td>
                        </tr>
                         <tr>
                          <td>Total Fee:</td>
                          <td><?=$admision_fee+$game_fee?></td>
                        </tr>
                      </table>

                      <table width="100%" style="margin-top: 20px;">
                        <tr>
                          <td style="border-bottom: 1px solid #000;width:30%"></td>
                          <td width="5%"></td>
                          <td style="border-bottom: 1px solid #000;width:25%"></td>
                          <td width="5%"></td>
                          <td style="border-bottom: 1px solid #000;width:25%"></td>
                        </tr>

                        <tr>
                          <td align="center">Applicant Signature</td>
                          <td></td>
                          <td align="center">Casier</td>
                          <td></td>
                          <td align="center">Officer</td>
                        </tr>
                      </table>
                      </div>

                    </div>
                  </div>

                  <div class="card-body">
                    <div class="row">

                      <div class="col-4" style="border:1px solid #000">
                        <img alt="image" src="assets/images/Duplicate Card Receipt.png" class="header-logo" style="width:100%;" />
                        
                        <table  width="100%" border="0" cellpadding="0px"   style="margin-top: 20px;">
                        <tr>
                          <th width="26%">Branch Code:</th>
                          <td style="border-bottom: 1px solid #000;"></td>
                        </tr>
                        <tr>
                          <th width="28%">Branch Name:</th>
                          <td style="border-bottom: 1px solid #000;"></td>
                        </tr>

                        <tr>
                          <th width="26%">Date:</th>
                          <td style="border-bottom: 1px solid #000;"></td>
                        </tr>
                      </table>

                      <table style="margin-top: 10px;" width="100%">
                        <tr>
                          <td width="25.33%">Mcb</td>
                          <td width="50.33%"></td>
                          <td width="25.33%">easypaisa</td>
                        </tr>
                      </table>

                      <br>

                       <table width="100%" border="1" style="margin-top: 10px;">
                        <tr>
                          <td width="150px;">Challan No:</td>
                          <td></td>
                        </tr>

                        <tr>
                          <td>Name:</td>
                          <td><?=$bank_challan[0]->ath_name?></td>
                        </tr>

                        <tr>
                          <td>CNIC:</td>
                          <td><?=$bank_challan[0]->ath_cnic?></td>
                        </tr>

                        <tr>
                          <td>Payment Mode:</td>
                          <td><?=$bank_challan[0]->ath_payment_mode?></td>
                        </tr>


                       



                        <tr>
                          <td>Games:</td>
                          <td>
                       <?php $total_fee = 0;
                              $admision_fee = 0;
                              $game_fee = 0;

                              if(!empty($bank_challan)){ 
                        foreach($bank_challan as $bank_challan){?>
                          <?=$bank_challan->game_name?>



                      <?php 
                      $game_fee         += $bank_challan->ath_game_fee;
                      $admision_fee     += $bank_challan->ath_game_admission_fee; 
                    } }?>
                      </td>
                    </tr>

                        
                        <tr>
                          <td>Due Date:</td>
                          <td></td>
                        </tr>
                         <tr>
                          <td>Total Fee:</td>
                          <td><?=$admision_fee+$game_fee?></td>
                        </tr>
                      </table>

                      <table width="100%" style="margin-top: 20px;">
                        <tr>
                          <td style="border-bottom: 1px solid #000;width:30%"></td>
                          <td width="5%"></td>
                          <td style="border-bottom: 1px solid #000;width:25%"></td>
                          <td width="5%"></td>
                          <td style="border-bottom: 1px solid #000;width:25%"></td>
                        </tr>

                        <tr>
                          <td align="center">Applicant Signature</td>
                          <td></td>
                          <td align="center">Casier</td>
                          <td></td>
                          <td align="center">Officer</td>
                        </tr>
                      </table>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>