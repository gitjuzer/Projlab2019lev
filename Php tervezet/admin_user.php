<?php require 'config.php'; user(5); 

	// Fájlnév
	define('FILENAME', 'admin_user.php');
	
	// Akció
	if (isset($_POST['action_edit'])) {
		// update
		query(sql('user:edit', array('id'=>$_POST['id'],'username'=>$_POST['username'],'password'=>$_POST['password'],'permission'=>$_POST['permission'],'classid'=>$_POST['classid'])),'array');
		echo 'Módosítás megtörtént. <a href="'.FILENAME.'">Tovább</a>'; exit();
	} else if (isset($_POST['action_new'])) {
		// insertinto
		query(sql('user:new', array('username'=>$_POST['username'],'password'=>$_POST['password'],'permission'=>$_POST['permission'],'classid'=>$_POST['classid'])),'array');
		echo 'Létrehozva. <a href="'.FILENAME.'">Tovább</a>'; exit();
	}


	// HTML fejléc
	html('header', array(
	    'title'=>'Felhasználók kezelése'.($_GET['a']=='new'?' - Új létrehozása':($_GET['a']=='edit'?' - Szerkesztés':'')), 
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

		$users = query(sql('user:all'),'array');

		echo '<style>td,th{border:1px solid #000;padding:6px;}</style>';
		echo '<table align="center"><tr>'.
			'<th>Az.</th><th>Felhasználónév</th><th>Létrehozva</th><th>Osztály</th><th>Jogosultság</th><th>Műveletek</th></tr>';
		foreach ($users as $num => $user) {
			echo '<tr>'.
				'<td>'.$user['id'].'</td>'.
				'<td style="text-align:left;">'.$user['username'].'</td>'.
				'<td style="text-align:left;">'.$user['created_at'].'</td>'.
				'<td>'.($user['class']==0?'-':$user['class']).'</td>'.
				'<td style="text-align:left;">'.$user['permission'].' - ';
					switch ((int)$user['permission']) {
						case 1:  echo 'diák'; break;
						case 5:  echo 'tanár'; break;
						case 9:  echo 'admin'; break;
						case 0:  echo 'felhasználó'; break;
						default: echo ''; break;
					}
			echo '</td>'.
				'<td>'.((int)$user['permission'] < user() || $user['id']==$_SESSION["id"] || user() == 9?
					'<a href="'.FILENAME.'?a=edit&id='.$user['id'].'" class="btn btn-info">Szerk.</a>
					<a href="'.FILENAME.'?a=del&id='.$user['id'].'" class="btn btn-info">Törlés</a>':'').
				'</td>'.
			'</tr>';
		}
		echo '</table>';

	} else if ($_GET['a']=='edit' || $_GET['a']=='new') {

		// szerk|új
		if (isset($_GET['id'])) {
			$userinfo = query(sql('user:info', array('id'=>$_GET['id'])),'array')[0];
		}

		//if ((int)$userinfo['permission']==1 || $_GET['a']=='new') {
			$userclasss = query(sql('user:classAll'),'array');
		//}

?>

		<center>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="width:500px"> 
            <div class="form-group">
                <label>Felhasználónév</label>
                <input type="text" name="id" value="<?php echo $userinfo['id']; ?>" hidden>
                <input type="text" name="username" class="form-control" value="<?php echo $userinfo['username']; ?>">
            </div>
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>Jelszó<?php echo ($_GET['a']=='edit'?' módosítás':''); ?></label>
                <?php echo ($_GET['a']=='edit'?'<p>Csak akkor töltsd ki, ha módosítai szeretnéd!</p>':''); ?>
                <input type="password" name="password" class="form-control" value="">
            </div>
            <?php /*if ((int)$userinfo['permission']==1 || $_GET['a']=='new') {*/ ?>
            <div class="form-group">
                <label>Osztály</label>
                <p>Csak diák jogosultság esetén lesz elmentve! Minden más jogosultság esetén az itt beállított érték figyelmen kívűl lesz hagyva.</p>
                <select class="form-control" name="classid">
                  <option value="0">-</option>
                  <?php
                  	foreach ($userclasss as $userclass) {
                  		echo '<option value="'.$userclass['id'].'"'.($userclass['id']==$userinfo['classid']?' selected':'').'>'.$userclass['name'].'</option>'."\n";
                  	}
                  ?>
                </select>
            </div>
        	<?php /*}*/ ?>
            <div class="form-group">
                <label>Jogosultság</label>
                <select class="form-control" name="permission"<?php echo ($_GET['id']==$_SESSION["id"]?' disabled':'') ?>>
                  <option value="0" <?php echo ($userinfo['permission']=='0'?' selected':''); ?>>0 - felhasználó</option>
                  <option value="1" <?php echo ($userinfo['permission']=='1'?' selected':''); ?>>1 - diák</option>
                  <option value="5" <?php echo ($userinfo['permission']=='5'?' selected':''); ?>>5 - tanár</option>
                  <option value="9" <?php echo ($userinfo['permission']=='9'?' selected':''); ?>>9 - admin</option>
                </select>
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