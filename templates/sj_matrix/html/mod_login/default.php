<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_login
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
?>

<div class="yt-loginform">
	<div class="yt-login">
		
		<div id="myLogin" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times-circle"></span></button>
						<h3 class="title"><?php echo JText::_('MOD_LOGIN_TITLE'); ?>  </h3>
					</div>
					<div class="row">
						<div class="col-sm-6 pull-left">
							<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" >
								
										<div class="userdata">
											<div id="form-login-username" class="form-group">
												<input id="modlgn-username" type="text" name="username" class="inputbox"  size="40" placeholder="<?php echo JText::_('USER_NAME_LOGIN'); ?>"/>
											</div>
											<div id="form-login-password" class="form-group">
												<input id="modlgn-passwd" type="password" name="password" class="inputbox" size="40"  placeholder="<?php echo JText::_('PASS_LOGIN'); ?>"/>
											</div>
											
											<div class="forgot-pass">
													<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
													<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
											</div>
											<div id="form-login-submit" class="control-group">
												<div class="controls">
													<button type="submit" tabindex="3" name="Submit" class="button"><?php echo JText::_('JLOGIN') ?></button>
												</div>
											</div>
											
											<input type="hidden" name="option" value="com_users" />
											<input type="hidden" name="task" value="user.login" />
											<input type="hidden" name="return" value="<?php echo $return; ?>" />
											<?php echo JHtml::_('form.token'); ?>
										</div>
								
								
							</form>
						</div>
						<div class="col-sm-6 pull-right">
							<div class="content-creat">
								<h3 class="title-new"><?php echo JText::_('JLOGIN_NEW_HERE') ?></h3>
								<span class="des"><?php echo JText::_('JLOGIN_DES') ?></span>
								<ul class="list">
									<li><?php echo JText::_('JLOGIN_LIST1') ?></li>
									<li><?php echo JText::_('JLOGIN_LIST2') ?></li>
									<li><?php echo JText::_('JLOGIN_LIST3') ?></li>
								</ul>
								<a href="<?php echo JRoute::_("index.php?option=com_users&view=registration");?>" onclick="showBox('yt_register_box','jform_name',this, window.event || event);return false;" class="btReverse">Create an account</a>
							</div>
						</div>
					</div>
					<?php if ($params->get('pretext')): ?>
							<div class="pretext">
							<p><?php echo $params->get('pretext'); ?></p>
							</div>
					<?php endif; ?>
					<?php if ($params->get('posttext')): ?>
							<div class="posttext">
								<p><?php echo $params->get('posttext'); ?></p>
							</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<a class="login-switch" data-toggle="modal" href="#myLogin" title="<?php JText::_('MOD_LOGIN');?>">
		  
		  <?php echo JText::_('MOD_LOGIN');?>
		</a>

	</div>
	
</div>

