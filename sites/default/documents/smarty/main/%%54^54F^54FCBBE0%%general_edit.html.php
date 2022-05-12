<?php /* Smarty version 2.6.33, created on 2022-05-06 12:48:47
         compiled from /var/www/html/nbh_openemr/templates/x12_partners/general_edit.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'xlt', '/var/www/html/nbh_openemr/templates/x12_partners/general_edit.html', 13, false),array('function', 'html_options', '/var/www/html/nbh_openemr/templates/x12_partners/general_edit.html', 58, false),array('modifier', 'attr', '/var/www/html/nbh_openemr/templates/x12_partners/general_edit.html', 15, false),)), $this); ?>
<form name="x12_partner" method="post" action="<?php echo $this->_tpl_vars['FORM_ACTION']; ?>
" class='form-horizontal' onsubmit="return top.restoreSession()">
    <div class="form-row my-sm-2">
        <label for="name" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Partner Name'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="name" name="name" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_name())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="name" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Submitter Name (3rd Party Submitter Only)'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="x12_submitter_name" name="x12_submitter_name" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_x12_submitter_name())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="id_number" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'ID Number (ETIN)'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="id_number" name="id_number" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_id_number())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_isa01" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'User logon Required Indicator (ISA01~ use 00 or 03)'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="x12_isa01" name="x12_isa01" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_x12_isa01())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_isa02" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'User Logon (If 03 above, else leave spaces) (ISA02)'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="x12_isa02" name="x12_isa02" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_x12_isa02())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)" maxlength="10">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_isa03" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'User password required Indicator (ISA03~ use 00 or 01)'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="x12_isa03" name="x12_isa03" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_x12_isa03())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_isa04" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'User Password (ISA04~ if 01 above, else leave spaces)'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="x12_isa04" name="x12_isa04" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_x12_isa04())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)" maxlength="10">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_isa05" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Sender ID Qualifier (ISA05)'), $this);?>
</label>
        <div class="col-sm-8">
            <select id="x12_isa05" name="x12_isa05" class="form-control">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['partner']->get_idqual_array(),'selected' => $this->_tpl_vars['partner']->get_x12_isa05()), $this);?>

            </select>
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_sender_id" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Sender ID (ISA06)'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="x12_sender_id" name="x12_sender_id" class="form-control"  value="<?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_x12_sender_id())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_isa07" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Receiver ID Qualifier (ISA07)'), $this);?>
</label>
        <div class="col-sm-8">
            <select id="x12_isa07" name="x12_isa07" class="form-control">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['partner']->get_idqual_array(),'selected' => $this->_tpl_vars['partner']->get_x12_isa07()), $this);?>

            </select>
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_receiver_id" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Receiver ID (ISA08)'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="x12_receiver_id" name="x12_receiver_id" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_x12_receiver_id())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_isa14" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Acknowledgment Requested (ISA14)'), $this);?>
</label>
        <div class="col-sm-8">
            <select id="x12_isa14" name="x12_isa14" class="form-control">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['partner']->get_x12_isa14_array(),'selected' => $this->_tpl_vars['partner']->get_x12_isa14()), $this);?>

            </select>
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_isa15" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Usage Indicator (ISA15)'), $this);?>
</label>
        <div class="col-sm-8">
            <select id="x12_isa15" name="x12_isa15" class="form-control">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['partner']->get_x12_isa15_array(),'selected' => $this->_tpl_vars['partner']->get_x12_isa15()), $this);?>

            </select>
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_gs02" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Application Sender Code (GS02)'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="x12_gs02" name="x12_gs02" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_x12_gs02())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_dtp03" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Eligibility Service Date (270 DTP03)'), $this);?>
</label>
        <div class="col-sm-8">
            <select id="x12_dtp03" name="x12_dtp03" class="form-control">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['partner']->get_x12_dtp03_type_array(),'selected' => $this->_tpl_vars['partner']->get_x12_dtp03()), $this);?>

            </select>
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="12_per06" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Submitter EDI Access Number (PER06)'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="12_per06" name="x12_per06" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_x12_per06())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_version" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Version'), $this);?>
</label>
        <div class="col-sm-8">
            <select id="x12_version" name="x12_version" class="form-control">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['partner']->get_x12_version_array(),'selected' => $this->_tpl_vars['partner']->get_x12_version()), $this);?>

            </select>
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="processing_format" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Processing format'), $this);?>
</label>
        <div class="col-sm-8">
            <select id="processing_format" name="processing_format" class="form-control">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['partner']->get_processing_format_array(),'selected' => $this->_tpl_vars['partner']->get_processing_format()), $this);?>

            </select>
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_gs03" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Application Receiver Code (GS03 - If blank ISA08 will be used)'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" maxlength="15" id="x12_gs03" name="x12_gs03" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_x12_gs03())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_sftp_login" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'SFTP Login Credentials'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" maxlength="45" id="x12_sftp_login" name="x12_sftp_login" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_x12_sftp_login())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_sftp_pass" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'SFTP Pass Credentials'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="password" maxlength="45" id="x12_sftp_pass" name="x12_sftp_pass" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_x12_sftp_pass())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_sftp_host" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'SFTP Host'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" maxlength="25" id="x12_sftp_host" name="x12_sftp_host" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_x12_sftp_host())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_sftp_port" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'SFTP Port'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" maxlength="5" id="x12_sftp_port" name="x12_sftp_port" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_x12_sftp_port())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_sftp_local_dir" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'SFTP Local Directory'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" maxlength="400" id="x12_sftp_local_dir" name="x12_sftp_local_dir" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_x12_sftp_local_dir())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_sftp_remote_dir" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'SFTP Remote Directory'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" maxlength="400" id="x12_sftp_remote_dir" name="x12_sftp_remote_dir" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->get_x12_sftp_remote_dir())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>

    <div class="btn-group offset-sm-2">
        <a href="javascript:add_x12();" class="btn btn-secondary btn-save" onclick="top.restoreSession()">
            <?php echo smarty_function_xlt(array('t' => 'Save'), $this);?>

        </a>
        <a href="controller.php?practice_settings&x12_partner&action=list"  class="btn btn-link btn-cancel" onclick="top.restoreSession()">
            <?php echo smarty_function_xlt(array('t' => 'Cancel'), $this);?>

        </a>
    </div>
    <input type="hidden" name="id" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['partner']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
    <input type="hidden" name="process" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['PROCESS'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
    <input type="hidden" name="sub" value="no" />
</form>

<?php echo '
<script>
function add_x12()
{
if (document.x12_partner.name.value.length>0)
{
top.restoreSession();
document.x12_partner.submit();
}
else
{
document.x12_partner.name.style.backgroundColor="red";
document.x12_partner.name.focus();
}
}

 function Waittoredirect(delaymsec) {
 var st = new Date();
 var et = null;
 do {
 et = new Date();
 } while ((et - st) < delaymsec);

   }
</script>
'; ?>
