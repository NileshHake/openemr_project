<?php /* Smarty version 2.6.33, created on 2022-04-08 05:28:01
         compiled from /var/www/html/openemr/templates/pharmacies/general_edit.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'attr', '/var/www/html/openemr/templates/pharmacies/general_edit.html', 13, false),array('function', 'xlt', '/var/www/html/openemr/templates/pharmacies/general_edit.html', 15, false),array('function', 'html_options', '/var/www/html/openemr/templates/pharmacies/general_edit.html', 85, false),)), $this); ?>
<form name="pharmacy" method="post" action="<?php echo $this->_tpl_vars['FORM_ACTION']; ?>
"  class='form-horizontal' onsubmit="return top.restoreSession()">
<!-- it is important that the hidden form_id field be listed first, when it is called is populates any old information attached with the id, this allows for partial edits
        if it were called last, the settings from the form would be overwritten with the old information-->
    <input type="hidden" name="form_id" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['pharmacy']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
    <div class="form-row py-sm-2">
        <label for="name" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Name'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="name" name="name" class="form-control" aria-describedby="nameHelpBox" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['pharmacy']->name)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)" />
            <span id="nameHelpBox" class="help-block">(<?php echo smarty_function_xlt(array('t' => 'Required'), $this);?>
)</span>
        </div>
    </div>
    <div class="form-row py-sm-2">
        <label for="address_line1" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Address'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="address_line1" name="address_line1" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['pharmacy']->address->line1)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row py-sm-2">
        <label for="address_line2" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Address'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="address_line2" name="address_line2" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['pharmacy']->address->line2)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)" />
        </div>
    </div>
    <div class="form-row py-sm-2">
        <label for="city" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'City'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="city" name="city" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['pharmacy']->address->city)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)" />
        </div>
    </div>
    <div class="form-row py-sm-2">
        <label for="state" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'State'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" maxlength="2" id="state" name="state" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['pharmacy']->address->state)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)" />
        </div>
    </div>
    <div class="form-row py-sm-2">
        <label for="city" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Zip Code'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="zip" name="zip" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['pharmacy']->address->zip)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)" />
        </div>
    </div>
    <div class="form-row py-sm-2">
        <label for="email" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Email'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="email" name="email" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['pharmacy']->email)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row py-sm-2">
        <label for="phone" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Phone'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="phone" name="phone" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['pharmacy']->get_phone())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)" />
        </div>
    </div>
    <div class="form-row py-sm-2">
        <label for="fax" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Fax'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="fax" name="fax" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['pharmacy']->get_fax())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)" />
        </div>
    </div>
    <div class="form-row py-sm-2">
        <label for="npi" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'NPI'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="npi" name="npi" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['pharmacy']->get_npi())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)" />
        </div>
    </div>
    <div class="form-row py-sm-2">
        <label for="ncpdp" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'NCPDP'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="ncpdp" name="ncpdp" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['pharmacy']->get_ncpdp())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)" />
        </div>
    </div>
    <div class="form-row py-sm-2">
        <label for="transmit_method" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Default Method'), $this);?>
</label>
        <div class="col-sm-8">
            <select id="transmit_method" name="transmit_method" class="form-control">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['pharmacy']->transmit_method_array,'selected' => $this->_tpl_vars['pharmacy']->transmit_method), $this);?>

            </select>
        </div>
    </div>
    <div class="btn-group offset-sm-2">
        <a href="javascript:submit_pharmacy();" class="btn btn-secondary btn-save" onclick="top.restoreSession()">
            <?php echo smarty_function_xlt(array('t' => 'Save'), $this);?>

        </a>
        <a href="controller.php?practice_settings&pharmacy&action=list" class="btn btn-link btn-cancel" onclick="top.restoreSession()">
            <?php echo smarty_function_xlt(array('t' => 'Cancel'), $this);?>

        </a>
    </div>
    <input type="hidden" name="id" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['pharmacy']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
    <input type="hidden" name="process" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['PROCESS'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
</form>

<?php echo '
<script>
function submit_pharmacy()
{
    if(document.pharmacy.name.value.length>0)
    {
        top.restoreSession();
        document.pharmacy.submit();
        //Z&H Removed redirection
    }
    else
    {
        document.pharmacy.name.style.backgroundColor="red";
        document.pharmacy.name.focus();
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
