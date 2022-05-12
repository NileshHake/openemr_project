<?php /* Smarty version 2.6.33, created on 2022-04-11 16:33:21
         compiled from /var/www/html/openemr/interface/forms/soap/templates/general_new.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'xlt', '/var/www/html/openemr/interface/forms/soap/templates/general_new.html', 3, false),array('function', 'headerTemplate', '/var/www/html/openemr/interface/forms/soap/templates/general_new.html', 4, false),array('function', 'xla', '/var/www/html/openemr/interface/forms/soap/templates/general_new.html', 63, false),array('modifier', 'attr', '/var/www/html/openemr/interface/forms/soap/templates/general_new.html', 12, false),array('modifier', 'text', '/var/www/html/openemr/interface/forms/soap/templates/general_new.html', 17, false),)), $this); ?>
<html>
<head>
<title><?php echo smarty_function_xlt(array('t' => 'SOAP'), $this);?>
</title>
<?php echo smarty_function_headerTemplate(array(), $this);?>

</head>
<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <h2><?php echo smarty_function_xlt(array('t' => 'SOAP'), $this);?>
</h2>
                <form name="soap" method="post" action="<?php echo $this->_tpl_vars['FORM_ACTION']; ?>
/interface/forms/soap/save.php" onsubmit="return top.restoreSession()">
                    <input type="hidden" name="csrf_token_form" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['CSRF_TOKEN_FORM'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Subjective'), $this);?>
</legend>
                        <div class="container">
                            <div class="form-group" >
                                <textarea name="subjective" class="form-control" cols="60" rows="6" onkeyup="top.isSoapEdit = true;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_subjective())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</textarea>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Objective'), $this);?>
</legend>
                        <div class="container">
                            <div class="form-group">
                                <textarea name="objective" class="form-control" cols="60" rows="6" onkeyup="top.isSoapEdit = true;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_objective())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</textarea>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Assessment'), $this);?>
</legend>
                        <div class="container">
                            <div class="form-group">
                                <textarea name="assessment" class="form-control" cols="60" rows="6" onkeyup="top.isSoapEdit = true;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_assessment())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</textarea>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><?php echo smarty_function_xlt(array('t' => 'Plan'), $this);?>
</legend>
                        <div class="container">
                            <div class="form-group">
                                <textarea name="plan" class="form-control" cols="60" rows="6" onkeyup="top.isSoapEdit = true;"><?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_plan())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</textarea>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-primary btn-save" name="Submit"><?php echo smarty_function_xlt(array('t' => 'Save'), $this);?>
</button>
                            <button type="button" class="btn btn-secondary btn-cancel" id="btnClose"><?php echo smarty_function_xlt(array('t' => 'Cancel'), $this);?>
</button>
                        </div>
                        <input type="hidden" name="id" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_id())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
                        <input type="hidden" name="activity" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_activity())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
                        <input type="hidden" name="pid" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['data']->get_pid())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
                        <input type="hidden" name="process" value="true" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php echo '
    <script>
        const close = function() {
            if (top.isSoapEdit === true) {
                dlgopen(\'\', \'\', 450, 125, \'\', \'<div class="text-danger">'; ?>
<?php echo smarty_function_xla(array('t' => 'Warning'), $this);?>
<?php echo '</div>\', {
                    type: \'Alert\',
                    html: \'<p>'; ?>
<?php echo smarty_function_xla(array('t' => 'Do you want to close the tabs?'), $this);?>
<?php echo '</p>\',
                    buttons: [
                        {text: \''; ?>
<?php echo smarty_function_xla(array('t' => 'Cancel'), $this);?>
<?php echo '\', close: true, style: \'default btn-sm\'},
                        {text: \''; ?>
<?php echo smarty_function_xla(array('t' => 'Close'), $this);?>
<?php echo '\', close: true, style: \'danger btn-sm\', click: closeSoap},
                    ],
                    allowDrag: false,
                    allowResize: false,
                });
            } else {
                top.restoreSession();
                location.href = \'javascript:parent.closeTab(window.name, false)\';
            }
        }

        const closeSoap = function() {
            top.isSoapEdit = false;
            top.restoreSession();
            location.href = \'javascript:parent.closeTab(window.name, false)\';
        }
        $(\'#btnClose\').click(close);
    </script>
    '; ?>

</body>
</html>