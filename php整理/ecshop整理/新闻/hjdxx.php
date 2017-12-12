<?php
define('IN_ECS', true);
require(dirname(__FILE__) . '/includes/init.php');
if ((DEBUG_MODE & 2) != 2)
{
    $smarty->caching = true;
}
    assign_template();
    assign_dynamic('catalog');
    $position = assign_ur_here(0, $_LANG['catalog']);
	$article_id=$_GET["id"];
    $article = get_article_info($article_id);
	function get_article_info($article_id)
	{
		/* 获得文章的信息 */
		$sql = "SELECT a.*, IFNULL(AVG(r.comment_rank), 0) AS comment_rank ".
				"FROM " .$GLOBALS['ecs']->table('article'). " AS a ".
				"LEFT JOIN " .$GLOBALS['ecs']->table('comment'). " AS r ON r.id_value = a.article_id AND comment_type = 1 ".
				"WHERE a.is_open = 1 AND a.article_id = '$article_id' GROUP BY a.article_id";
		$row = $GLOBALS['db']->getRow($sql);
	
		if ($row !== false)
		{
			$row['comment_rank'] = ceil($row['comment_rank']);                              // 用户评论级别取整
			$row['add_time']     = local_date($GLOBALS['_CFG']['date_format'], $row['add_time']); // 修正添加时间显示
	
			/* 作者信息如果为空，则用网站名称替换 */
			if (empty($row['author']) || $row['author'] == '_SHOPHELP')
			{
				$row['author'] = $GLOBALS['_CFG']['shop_name'];
			}
		}
	
		return $row;
	}
	
	
	
	
	
	
	$smarty->assign("article",$article);
    $smarty->assign('keywords',     htmlspecialchars($article['keywords']));
    $smarty->assign('description', htmlspecialchars($article['description']));
	
	
	$smarty->display("hjdxx.dwt",$cache_id)
?>