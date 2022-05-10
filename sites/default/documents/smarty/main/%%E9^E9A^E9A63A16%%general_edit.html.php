<?php /* Smarty version 2.6.33, created on 2022-04-01 10:09:37
         compiled from /var/www/html/openemr/templates/insurance_companies/general_edit.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'attr', '/var/www/html/openemr/templates/insurance_companies/general_edit.html', 14, false),array('function', 'xlt', '/var/www/html/openemr/templates/insurance_companies/general_edit.html', 17, false),array('function', 'html_options', '/var/www/html/openemr/templates/insurance_companies/general_edit.html', 112, false),)), $this); ?>

<form name="insurancecompany" method="post" action="<?php echo $this->_tpl_vars['FORM_ACTION']; ?>
" class='form-horizontal' onsubmit="return top.restoreSession()">
    <!-- it is important that the hidden form_id field be listed first, when it is called it populates any old information attached with the id, this allows for partial edits
    if it were called last, the settings from the form would be overwritten with the old information-->
    <input type="hidden" name="form_id" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
    <?php if ($this->_tpl_vars['insurancecompany']->get_inactive() == 1): ?>
    <div class="form-row my-sm-2">
        <label for="inactive" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Reactivate'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="checkbox" id="inactive" name="inactive" class="checkbox" value="0" />
        </div>
    </div>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['insurancecompany']->get_inactive() == 0): ?>
    <div class="form-row my-sm-2">
        <label for="inactive" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Deactivate'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="checkbox" id="inactive" name="inactive" class="checkbox" value="1" />
        </div>
    </div>
    <?php endif; ?>
    <div class="form-row my-sm-2">
        <label for="name" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Name'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="name" name="name" class="form-control" aria-describedby="nameHelpBox" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->get_name())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
            <span id="nameHelpBox" class="help-block">(<?php echo smarty_function_xlt(array('t' => 'Required'), $this);?>
)</span>
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="attn" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Attn'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="attn" name="attn" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->get_attn())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="address_line1" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Address'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="address_line1" name="address_line1" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->address->line1)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="address_line2" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Address'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="address_line2" name="address_line2" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->address->line2)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="city" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'City'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="city" name="city" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->address->city)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="state" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'State'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" maxlength="2" id="state" name="state" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->address->state)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="zip" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Zip Code'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="zip" name="zip" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->address->zip)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="phone" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Phone'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="phone" name="phone" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->get_phone())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="fax" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Fax'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="fax" name="fax" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->get_fax())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="cms_id" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Payer ID'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="cms_id" name="cms_id" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->get_cms_id())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <?php if ($this->_tpl_vars['SUPPORT_ENCOUNTER_CLAIMS']): ?>
        <div class="form-row my-sm-2">
            <label for="alt_cms_id" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Payer ID For Encounter Claims'), $this);?>
</label>
            <div class="col-sm-8">
                <input type="text" id="alt_cms_id" name="alt_cms_id" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->get_alt_cms_id())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
            </div>
        </div>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['SUPPORT_ELIGIBILITY_REQUESTS']): ?>
    <div class="form-row my-sm-2">
        <label for="eligibility_id" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Payer Id For Eligibility'), $this);?>
</label>
        <div class="col-sm-8">
            <input type="text" id="eligibility_id" name="eligibility_id" class="form-control" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->get_eligibility_id())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onKeyDown="PreventIt(event)">
        </div>
    </div>
    <?php endif; ?>
    <div class="form-row my-sm-2">
        <label for="ins_type_code" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Payer Type'), $this);?>
</label>
        <div class="col-sm-8">
            <select id="ins_type_code" name="ins_type_code" class="form-control">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['insurancecompany']->ins_type_code_array,'selected' => $this->_tpl_vars['insurancecompany']->get_ins_type_code()), $this);?>

            </select>
        </div>
    </div>
    <div class="form-row my-sm-2">
        <label for="x12_default_partner_id" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Default X12 Partner'), $this);?>
</label>
        <div class="col-sm-8">
            <select id="x12_default_partner_id" name="x12_default_partner_id" class="form-control">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['x12_partners'],'selected' => $this->_tpl_vars['insurancecompany']->get_x12_default_partner_id()), $this);?>

            </select>
        </div>
    </div>
    <?php if ($this->_tpl_vars['SUPPORT_ELIGIBILITY_REQUESTS']): ?>
    <div class="form-row my-sm-2">
        <label for="x12_default_eligibility_id" class="col-form-label col-sm-2"><?php echo smarty_function_xlt(array('t' => 'Default Eligibility X12 Partner'), $this);?>
</label>
        <div class="col-sm-8">
            <select id="x12_default_eligibility_id" name="x12_default_eligibility_id" class="form-control">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['x12_partners'],'selected' => $this->_tpl_vars['insurancecompany']->get_x12_default_eligibility_id()), $this);?>

            </select>
        </div>
    </div>
    <?php endif; ?>
    <div class="btn-group offset-sm-2">
        <a href="javascript:submit_insurancecompany();" class="btn btn-secondary btn-save" onclick="top.restoreSession()">
            <?php echo smarty_function_xlt(array('t' => 'Save'), $this);?>

        </a>
        <a href="controller.php?practice_settings&insurance_company&action=list" class="btn btn-link btn-cancel" onclick="top.restoreSession()">
            <?php echo smarty_function_xlt(array('t' => 'Cancel'), $this);?>

        </a>
    </div>
    <input type="hidden" name="id" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['insurancecompany']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
    <input type="hidden" name="process" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['PROCESS'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
</form>

<?php echo '
<script>
    function submit_insurancecompany() {
        if(document.insurancecompany.name.value.length>0) {
            top.restoreSession();
            document.insurancecompany.submit();
            //Z&H Removed redirection
        } else{
            document.insurancecompany.name.style.backgroundColor="red";
            document.insurancecompany.name.focus();
        }
    }

    function jsWaitForDelay(delay) {
        var startTime = new Date();
        var endTime = null;
        do {
            endTime = new Date();
        } while ((endTime - startTime) < delay);
    }
</script>
'; ?>
