<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header', $module);?>
<form method="post" action="sendmail.php" id="dform" onsubmit="return check();">
<table cellspacing="1" cellpadding="6" class="tb">
<tr>
<td class="tl">发件人</td>
<td class="tr"><strong><?php echo $_email;?></strong></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 收件人</td>
<td class="tr"><input type="text" name="email" id="email" value="<?php echo $email;?>" size="30"/><span id="demail" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 邮件标题</td>
<td class="tr"><input type="text" name="title" id="title" value="<?php echo $title;?>" size="50"/><span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 邮件正文</td>
<td class="tr"><textarea name="content" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', 'Basic', '98%', 350);?><span id="dcontent" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 验证码</td>
<td class="tr"><?php include template('captcha', 'chip');?> <span id="dcaptcha" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"> </td>
<td class="tr" height="30"><input type="submit" name="submit" value=" 发 送 " class="btn"/>&nbsp;&nbsp;<input type="button" value=" 预 览 " class="btn" onclick="mail_view();"/>&nbsp;&nbsp;<input type="button" value=" 返 回 " class="btn" onclick="history.back(-1);"/></td>
</tr>
</table>
</form>
<form method="post" action="sendmail.php" name="pmail" id="pmail" target="_blank">
<input type="hidden" name="preview" value="1"/> 
<input type="hidden" name="title" id="ptitle"/> 
<input type="hidden" name="content" id="pcontent"/> 
</form>
<script type="text/javascript">
function check() {
var len;
len = Dd('email').value.length;
if(len < 5) {
Dmsg('请填写收件人Email地址', 'email');
return false;
}
len = Dd('title').value.length;
if(len < 5) {
Dmsg('标题不能少于5个字，当前已输入'+len+'个字', 'title');
return false;
}
if(len > 40) {
Dmsg('标题不能多于40个字，当前已输入'+len+'个字', 'title');
return false;
}
len = FCKLen();
if(len < 10) {
Dmsg('内容不能少于10个字，当前已输入'+len+'个字', 'content');
return false;
}
if(len > 5000) {
Dmsg('内容不能多于5000个字，当前已输入'+len+'个字', 'content');
return false;
}
if(!is_captcha(Dd('captcha').value)) {
Dmsg('请填写验证码', 'captcha');
return false;
}
return true;
}
function mail_view() {
Dd('ptitle').value = Dd('title').value;
Dd('pcontent').value = FCKeditorAPI.GetInstance('content').GetXHTML(true);
Dd('pmail').submit();
}
</script>
<script type="text/javascript">s('mail');</script>
<?php include template('footer', $module);?>