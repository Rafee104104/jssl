<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><img src="../images/bar_left<?=$type?>.jpg" width="10" height="25" /></td>
                          <td class="body_box_topbar<?=$type?>"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="25%" class="poweredby"><a href="<?=WEBSITE_LINK?>" target="_blank"><?=POWERED_BY?></a> </td>
                              <td width="33%" style="text-align:left; font-size:12px;"><?=$title?></td>
                              <td class="msg_text"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td><img src="../images/icon<?=$type?>.jpg" width="24" height="25" align="top" />
								   <? if(isset($msg)) echo $msg; else echo 'Welcome .. '.$_SESSION['user']['fname'] ;?>
								  </td>
                                </tr>
                              </table></td>
                            </tr>
                          </table></td>
                          <td><img src="../images/bar_right<?=$type?>.jpg" width="13" height="25" /></td>
                        </tr>
</table>