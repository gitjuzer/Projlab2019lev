<?php require 'config.php'; user(1); 

	// Fájlnév
	define('FILENAME', 'course.php');
	
	// Akció
	if (isset($_POST['action_edit']) && user()>=5) {
		// update
		query(sql('course:edit', array('id'=>$_POST['id'],'name'=>$_POST['name'],'content'=>$_POST['content'],'categoryid'=>$_POST['categoryid'],'creatorid'=>$_POST['creatorid'],'classid'=>$_POST['classid'])),'array');
		echo 'Módosítás megtörtént. <a href="'.FILENAME.'">Tovább</a>'; exit();
	} else if (isset($_POST['action_new']) && user()>=5) {
		// insertinto
		query(sql('course:new', array('name'=>$_POST['name'],'content'=>$_POST['content'],'categoryid'=>$_POST['categoryid'],'creatorid'=>(user()==9?$_POST['creatorid']:$_SESSION["id"]),'classid'=>$_POST['classid'] )),'array');
		echo 'Létrehozva. <a href="'.FILENAME.'">Tovább</a>'; exit();
	}


	// HTML fejléc
	html('header', array(
	    'title'=>'Kurzusok'.($_GET['a']=='new'?' - Új létrehozása':($_GET['a']=='edit'?' - Szerkesztés':'')), 
	    'style'=>'body{ font: 14px sans-serif; text-align: center; }'
	));

	// Tartalom
?>

	<br>
	<?php if (isset($_GET['a'])) { ?><a href="<?php echo FILENAME; ?>" class="btn btn-info">&lt; Kurzusok</a><?php } ?>
	<?php if (user()>=5) { ?><a href="<?php echo FILENAME; ?>?a=new" class="btn btn-info">Új</a><?php } ?>
	<a href="index.php" class="btn btn-warning">&lt; Kezdőlap</a>
	<br><br>

<?php

	if (!isset($_GET['a'])) {

		$classid = query(sql('user:classid'),'single');
		$courses = query(sql('course:all',array('classid'=>$classid)),'array');

		echo '<style>td,th{border:1px solid #000;padding:6px;}</style>';
		echo '<table align="center"><tr>'.
			'<th>Az.</th><th>Megenvezés</th><th>Kategória</th>'.(user()>=5?'<th>Osztály</th>':'').'<th>Tartalom (részlet)</th><th>Műveletek</th></tr>';
		foreach ($courses as $num => $course) {
			echo '<tr>'.
				'<td>'.$course['id'].'</td>'.
				'<td style="text-align:left;">'.$course['name'].'</td>'.
				'<td style="text-align:left;">'.$course['category'].'</td>'.
				(user()>=5?'<td style="text-align:left;">'.$course['class'].'</td>':'').
				'<td style="text-align:left;">'.strip_tags($course['content']).'...</td>'.
				'<td><a href="'.FILENAME.'?a=read&id='.$course['id'].'" class="btn btn-info">Olvas</a> '
					.($course['creatorid']==$_SESSION["id"] || user() == 9?
					'<a href="'.FILENAME.'?a=edit&id='.$course['id'].'" class="btn btn-info">Szerk.</a>
					<a href="'.FILENAME.'?a=del&id='.$course['id'].'" class="btn btn-info">Törlés</a>':'').
				'</td>'.
			'</tr>';
		}
		echo '</table>';

	} else if (($_GET['a']=='edit' || $_GET['a']=='new') && user()>=5) {


		$coursecats = query(sql('course:catAll'));
		$userclasss = query(sql('user:classAll'),'array');

		if (user()==9) {
			$users = query(sql('user:all', array('WHERE'=>" WHERE permission=5")));
		}

		// szerk|új
		if (isset($_GET['id'])) {
			$courseinfo = query(sql('course:info', array('id'=>$_GET['id'])),'array')[0];
		}
?>

		<center>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="width:500px"> 
            <div class="form-group">
                <label>Megnevezés</label>
                <input type="text" name="id" value="<?php echo $courseinfo['id']; ?>" hidden>
                <input type="text" name="name" class="form-control" value="<?php echo $courseinfo['name']; ?>">
            </div>
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>Tartalom</label>
                <textarea class="form-control" name="content" rows="5" maxlength="20000"><?php echo $courseinfo['content']; ?></textarea>
            </div>
            <div class="form-group">
                <label>Kategória</label>
                <select class="form-control" name="categoryid">
                  <?php
                  	foreach ($coursecats as $coursecat) {
                  		echo '<option value="'.$coursecat['id'].'" '.($courseinfo['categoryid']==$coursecat['id']?' selected':'').'>'.$coursecat['name'].'</option>'."\n";
                  	}
                  ?>
                </select>
            </div>
            <div class="form-group">
                <label>Osztály</label>
                <select class="form-control" name="classid">
                  <option value="0">-</option>
                  <?php
                  	foreach ($userclasss as $userclass) {
                  		echo '<option value="'.$userclass['id'].'"'.($userclass['id']==$courseinfo['classid']?' selected':'').'>'.$userclass['name'].'</option>'."\n";
                  	}
                  ?>
                </select>
            </div>
            <?php if (user()==9) { ?>
            <div class="form-group">
                <label>Kurzus tulajdonosa</label>
                <select class="form-control" name="creatorid">
                  <?php
                  	foreach ($users as $user) {
                  		echo '<option value="'.$user['id'].'"'.($courseinfo['creatorid']==$user['id']?' selected':'').'>'.$user['username'].'</option>'."\n";
                  	}
                  ?>
                </select>
            </div>
        	<?php } ?>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="action_<?php echo $_GET['a']; ?>" value="<?php echo ($_GET['a']=='edit'?'Mentés':'Létrehozás'); ?>">
                <a class="btn btn-link" href="<?php echo FILENAME; ?>">Mégse</a>
            </div>
        </form>
    	</center>

<?php
	} else if ($_GET['a']=='read' && isset($_GET['id'])) {

		$courseinfo = query(sql('course:info', array('id'=>$_GET['id'])),'array')[0]; // kurzus
		$classid = query(sql('user:classid'),'single'); // osztály
		$courseread = query(sql('course:readInfo', array('courseid'=>$_GET['id'])))[0]; // olvasta már?
		$maxpage = substr_count($courseinfo['content'],'<hr>')+1; // maximum oldal

		// nem jogosult elolvasni --> átirányít a listára
		if ($courseinfo['classid'] != $classid) {
			header("location: ".FILENAME); exit();
		// még nem töltheti ki --> kiírás, hogy még nem olvasta el a leckét
		} else if ($courseread['last'] > 0 && !isset($_GET['page'])) {
			header("location: ".FILENAME.'?a=read&id='.$courseinfo['id'].'&page='.$courseread['last']); exit();
		} else {
			$page = explode('<hr>', $courseinfo['content'])[$_GET['page']-1];
			$pagenum = $_GET['page'];

			// haladás mentése
			if (isset($courseread['id'])) {
				query(sql('course:readEdit', array('id'=>$courseread['id'],'last'=>$pagenum,'max'=> ($pagenum>$courseread['max']?$pagenum:$courseread['max']) )),'array'); // mod
			} else {
				query(sql('course:readNew', array('courseid'=>$courseinfo['id'],'userid'=>$_SESSION["id"],'last'=>$pagenum,'max'=>$pagenum)),'array'); // új
			}

			// megjelenítés
			echo '<center><div style="width:500px; margin:20px 0 40px 0;text-align:left;">'.$page.'</div></center>';

			// Lapozás
			$lapozas_url = FILENAME.'?a=read&id='.$courseinfo['id'].'&page='; $prev = $_GET['page']-1; $next = $_GET['page']+1;
			if ($_GET['page'] > 1) { echo '<a href="'.$lapozas_url.$prev.'" class="btn btn-success">&lt; Előző oldal</a> '; }
			if ($_GET['page'] < $maxpage) { echo '<a href="'.$lapozas_url.$next.'" class="btn btn-success">Következő oldal &gt;</a>'; }
		}
		
	} else {
		header("location: ".FILENAME); exit();
	}

	// HTML lábléc
    html('footer');
?>