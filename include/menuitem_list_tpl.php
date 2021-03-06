<?php if (!defined('XOOPS_ROOT_PATH')) exit('Page access deny!'); ?>

<style>
#sortable{
width: 200px;
background-color:#D8D4E2;
border:1px solid #6B4C86;
}
#sortable li{
list-style: none;
font-size: 12px;
line-height: 150%;
margin: 1px;
padding: 3px 5px;
}
.sortableitem{
background-color:#BEDEFE;
border:1px solid #7EA6B2;
}
.sortableactive{
background-color:#D1E6EC;
border:1px solid #7EA6B2;
}
.sortablehover{
background-color:#D8D4E2;
border:1px solid #6B4C86;
}
.sorthelper{
background-color:#D8EDCF;
border:1px solid #7EA6B2;
}
</style>

<style>
.clear{
clear: both;
}
.warning{
background-color: yellow;
padding: 10px;
}
.error{
background-color:#CC3333;
padding: 10px;
}

/*
.form-outer th{
	background-color: #C8D6FB;
}
*/
.form-head{
	background-color: #678FF4;
	color:#FFFFFF;
	padding:4px;
}
.form-head a{
	color:#FFFFFF;
}
.form-head a:hoover{
	color:#FF9900;
}

.button{
	padding:2px 10px;
	border:double #666666;
	background-color:#CCCCCC;
}

.form-caption{
	text-align: right;
	padding-right: 10px;
}
.form-even{
	background-color: #DBE8FD;
}
.form-odd{
	background-color: #E1E9FB;
}

.pager{
	text-align:right;
	margin:15px;
}

#nav{
	/*float:left;*/
}
#nav li{
	display:inline;
	color:#000000;
	text-decoration:none;
	/*padding:2px 10px;
	border:double #666666;
	width:97px;
	height:22px;*/
	text-align:center;
	background-color:#ececec;
	margin-left:20px;
}
</style>
<!--header-->
<div>
<!--<img src="../images/simplepage_slogo.jpg" style="float: left;" />-->

<ul id="nav">
	<li><a href="menuitem.php?op=add" class="button"><?php echo _AD_SIMPLEPAGE_ADDMENUITEM; ?></a> </li>
</ul>
<div style="clear: both;"></div>
</div>

<!-- 用于发送删除的ID start -->
<form name="deletesel" action="<?php echo $_SERVER['PHP_SELF'].'?op=delete'; ?>" method="post">
<input name="menuitemId" type="hidden" value="" />
</form>

<script language="javascript" type="text/javascript">
<!--
function confirmDelete(id) {
	if (confirm('Do you confirm to delete?')) {
		document.deletesel.menuitemId.value = id;
		document.deletesel.submit();
		}
}
-->
</script>
<!-- 用于发送删除的ID end -->

<div style="margin: 20px 40px;">
<h3><?php echo _AD_SIMPLEPAGE_MENUITEM; ?></h3>
<table width="90%" border="1" align="center" cellpadding="3" cellspacing="0">
  <tr class="form-head">
		<td><div align="center">#</div></td>
		<td><div align="center"><?php echo _AD_SIMPLEPAGE_TITLE; ?></div></td>
    <td><div align="center"><?php echo _AD_SIMPLEPAGE_LINK; ?></div></td>
    <td><div align="center"><?php echo _AD_SIMPLEPAGE_ACTION; ?></div></td>
  </tr>
<?php
$cssClass = 'odd';
if ($menuitems) {
	foreach ($menuitems as $menuitem) { 
?>
	<tr class="<?php
	if ($cssClass == 'form-even') {
		$cssClass='form-odd';
	} else {
		$cssClass='form-even';
	}
	echo $cssClass;
	?>
	">
	<td><div align="center"><?php echo $menuitem->getVar('menuitemId'); ?></div></td>
	<td><div align="left"><?php echo $menuitem->getVar('title'); ?></div></td>
	<td><div align="center"><?php echo $menuitem->getAdminLink(); ?></div></td>
	<td><div align="center">
		<a href="<?php echo $_SERVER['PHP_SELF']; ?>?op=edit&amp;menuitemId=<?php echo $menuitem->getVar('menuitemId'); ?>"><?php echo _AD_SIMPLEPAGE_EDIT; ?></a> |
		<a href="#" id="<?php echo $menuitem->getVar('menuitemId'); ?>" onclick="javascript:confirmDelete(this.id);"><?php echo _AD_SIMPLEPAGE_DELETE; ?></a>
	</div></td>
	</tr>
<?php }
}	else { ?>
	<tr><td colspan="4" class="even"><div align="center"><?php echo _AD_SIMPLEPAGE_NOPAGE; ?></div></td></tr>
<?php } ?>
</table>
</div>

<?php if ($menuitems) { ?>
<div style="margin: 40px;">
	<h3><?php echo _AD_SIMPLEPAGE_SORTTHEMENU; ?></h3>
	<p><?php echo _AD_SIMPLEPAGE_DRAP_AND_DROP_THE_MENUITEM; ?></p>
	<div align="center">
	<ul id="sortable" class="sortablehover">
	<?php foreach ($menuitems as $menuitem) { ?>
		<li class="sortableitem" id="<?php echo $menuitem->getVar('menuitemId'); ?>"><?php echo $menuitem->getVar('title'); ?></li>
	<?php } ?>
	</ul>

<?php } ?>

	<form id="menuOrderForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input name="op" type="hidden" value="sort">
	<input name="menuOrder" id="menuOrder" type="hidden" value="1">
	<input name="orderSubmit" type="button" id="orderSubmit" value="<?php echo _AD_SIMPLEPAGE_SUBMITNEWORDER ?>" onclick="submitOrder();"/>
	</form>
	</div>

</div>

<script language="javascript" src="../include/jquery1.1.2.js"></script>
<script language="javascript" src="../include/interface.js"></script>
<script language="javascript" type="text/javascript">
$(document).ready(
	function() {
		$('#sortable').Sortable(
			{
				accept : 'sortableitem',
				activeclass : 'sortableactive',
				hoverclass : 'sortablehover',
				helperclass : 'sorthelper',
				opacity: 	0.5,
				fit :	false
			}
		)
	}	
);
</script>

<script language="javascript">
function submitOrder() {
		document.getElementById("menuOrder").value = $.SortSerialize('sortable').hash;		
		$("#menuOrderForm").submit();
}
</script>