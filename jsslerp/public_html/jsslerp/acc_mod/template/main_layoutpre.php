<? include("../template/main_layout_head.php")?>
			<div class="body_box">
			  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td colspan="3">
					  <div class="body_bar">
					  <?  include("../template/main_layout_msg_bar.php")?>
					  </div>
					  </td>
                    </tr>
                    <tr>
                     <td class="body_box_leftbar">
					  <img src="../images/body_04.jpg" width="10" height="417" />
					  </td>
                     <td>
					  
					  <div class="body_middlebox_bar">
					 <table width="210" border="0" cellspacing="0" cellpadding="0">
						  <tr>
						    <td>&nbsp;</td>
						    <td>&nbsp;</td>
						    <td>&nbsp;</td>
				       </tr>
						  <tr>
						    <td valign="top" style="vertical-align:top; margin-top:0px; width:215px;">
							<? if(isset($_SESSION['proj_id']))	include("../template/main_layout_menu.php");?></td>
						    <td valign="top">
							<?=$main_content?></td>
						  </tr>
						</table>
					  </div></td>
                      <td class="body_box_rightbar"><img src="../images/body_06.jpg" width="13" height="417" /></td>
                    </tr>
                    <tr>
                      <td><img src="../images/body_07.jpg" width="10" height="16" /></td>
                      <td class="body_box_bottombar"><img src="../images/body_08.jpg" width="739" height="16" /></td>
                      <td><img src="../images/body_09.jpg" width="13" height="16" /></td>
                    </tr>
                  </table></td>
                </tr>
              </table>
			</div>
<? include("../template/main_layout_foot.php")?>