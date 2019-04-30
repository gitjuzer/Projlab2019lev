<?php require 'config.php'; user(5); 

	// Fájlnév
	define('FILENAME', 'admin_coursecat.php');
	
	// Akció
	if (isset($_POST['action_edit'])) {
		// update
		query(sql('course:catEdit', array('id'=>$_POST['id'],'name'=>$_POST['name'])),'array');
		echo 'Módosítás megtörtént. <a href="'.FILENAME.'">Tovább</a>'; exit();
	} else if (isset($_POST['action_new'])) {
		// insertinto
		query(sql('course:catNew', array('name'=>$_POST['name'])),'array');
		echo 'Létrehozva. <a href="'.FILENAME.'">Tovább</a>'; exit();
	}


	// HTML fejléc
	


	html('header', array(
	    'title'=>'Kurzus kategóriák kezelése'.($_GET['a']=='new'?' - Új létrehozása':($_GET['a']=='edit'?' - Szerkesztés':'')), 
	    'style'=>'body{ font: 14px sans-serif; text-align: center; }'
	));

	// Tartalom
?>

	<br>
	<a href="<?php echo FILENAME; ?>" class="btn btn-info">Összes</a>
	<a href="<?php echo FILENAME; ?>?a=new" class="btn btn-info">Új</a>
	<a href="index.php" class="btn btn-warning">&lt; Kezdőlap</a>
	<br><br>

<?php

	if (!isset($_GET['a'])) {

		$coursecats = query(sql('course:catAll'),'array');

		echo '<style>td,th{border:1px solid #000;padding:6px;}</style>';
		echo '<table align="center"><tr>'.
			'<th>Az.</th><th>Megnevezés</th><th>Műveletek</th></tr>';
		foreach ($coursecats as $num => $coursecat) {
			echo '<tr>'.
				'<td>'.$coursecat['id'].'</td>'.
				'<td style="text-align:left;">'.$coursecat['name'].'</td>'.
				'<td>'.(user() >= 5?
					'<a href="'.FILENAME.'?a=edit&id='.$coursecat['id'].'" class="btn btn-info">Szerk.</a>
					<a href="'.FILENAME.'?a=del&id='.$coursecat['id'].'" class="btn btn-info">Törlés</a>':'').
				'</td>'.
			'</tr>';
		}
		echo '</table>';

	} else if ($_GET['a']=='edit' || $_GET['a']=='new') {

		// szerk|új
		if (isset($_GET['id'])) {
			$coursecatinfo = query(sql('course:catInfo', array('id'=>$_GET['id'])),'array')[0];
		}
?>

		<center>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="width:500px"> 
            <div class="form-group">
                <label>Megnevezés</label>
                <input type="text" name="id" value="<?php echo $coursecatinfo['id']; ?>" hidden>
                <input type="text" name="name" class="form-control" value="<?php echo $coursecatinfo['name']; ?>">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="action_<?php echo $_GET['a']; ?>" value="<?php echo ($_GET['a']=='edit'?'Mentés':'Létrehozás'); ?>">
                <a class="btn btn-link" href="<?php echo FILENAME; ?>">Mégse</a>
            </div>
        </form>
    	</center>

<?php
	}

	// HTML lábléc
    html('footer');
?>