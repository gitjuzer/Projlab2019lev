<?php require 'config.php'; user(1); 

	// Fájlnév
	define('FILENAME', 'test.php');
	
	// Akció
	if (isset($_POST['action_edit']) && user()>=5) {
		// update
		query(sql('test:edit', array('id'=>$_POST['id'],'name'=>$_POST['name'],'content'=>$_POST['content'],'courseid'=>$_POST['courseid'])),'array');
		echo 'Módosítás megtörtént. <a href="'.FILENAME.'">Tovább</a>'; exit();
	} else if (isset($_POST['action_new']) && user()>=5) {
		// insertinto
		query(sql('test:new', array('name'=>$_POST['name'],'content'=>$_POST['content'],'courseid'=>$_POST['courseid'])),'array');
		echo 'Létrehozva. <a href="'.FILENAME.'">Tovább</a>'; exit();
	} else if (isset($_POST['action_fill']) && user()==1) {
		// insertinto
		query(sql('test:fillNew', array('testid'=>$_POST['testid'],'answers'=>$_POST['answers'])),'array');
		echo 'Elküldve. <a href="'.FILENAME.'">Tovább</a>'; exit();
	}


	// HTML fejléc
	html('header', array(
	    'title'=>'Tesztek'.($_GET['a']=='new'?' - Új létrehozása':($_GET['a']=='edit'?' - Szerkesztés':'')), 
	    'style'=>'body{ font: 14px sans-serif; text-align: center; }
			div.qb { margin-bottom: 15px; width: 500px; text-align: left; }
            div.qb input { margin: 2px; }
            div.qb input[type="text"][name*="[q]"] { width: 90%; display: inline-block; }
            div.qb input[type="radio"][name*="[a]"] { display: inline-block; }
            div.qb input[type="text"][name*="[a"], div.qb label.a { width: 40%; display: inline-block; }
            div.qb label.a { padding: 7px; margin: 3px; background: rgba(150,150,150,0.2); position: relative; }
            div.qb label.a label { display: block; }
            div.qb input[type="radio"][name*="[a]"]:checked + label { background: rgba(100,150,255,0.5); }
            div.qb input.correct + label { background: rgba(100,255,100,0.5) !important; position:relative; }
            div.qb input.correct + label::after { content:"✓"; color: rgba(0,111,0,1); position:absolute; top:0px; right:5px; font-size:150%; }
            div.qb input.gooda + label { background: rgba(100,255,100,0.5); }
            div.qb input.wrong + label { box-shadow: 0 0 0 3px rgba(255,100,100,0.8) inset; }
            div.qb span.q { display: inline-block; margin: 10px 0 10px 0; font-size: 130%; font-weight: bold; }
            span.eredmeny { font-size: 150%; }
	    '
	));

	// Tartalom
?>

	<br>
	<?php if (isset($_GET['a'])) { ?><a href="<?php echo FILENAME; ?>" class="btn btn-info">&lt; Tesztek</a><?php } ?>
	<?php if (user()>=5) { ?><a href="<?php echo FILENAME; ?>?a=new" class="btn btn-info">Új</a><?php } ?>
	<a href="index.php" class="btn btn-warning">&lt; Kezdőlap</a>
	<br><br>

<?php

	if (!isset($_GET['a'])) {

		$classid = query(sql('user:classid'),'single');
		$tests = query(sql('test:all', array('classid'=>$classid)),'array');

		echo '<style>td,th{border:1px solid #000;padding:6px;}</style>';
		echo '<table align="center"><tr>'.
			'<th>Az.</th><th>Megnevezés</th><th>Kurzus</th><th>Műveletek</th></tr>';
		foreach ($tests as $num => $test) {
			echo '<tr>'.
				'<td>'.$test['id'].'</td>'.
				'<td style="text-align:left;">'.$test['name'].'</td>'.
				'<td style="text-align:left;">'.$test['course'].'</td>'.
				//'<td style="text-align:left;">'.strip_tags($test['content']).'...</td>'.
				'<td><a href="'.FILENAME.'?a=fill&id='.$test['id'].'" class="btn btn-info">'.($test['filled']=='true'||user()>=5?'Eredmény':'Kitöltés').'</a> '
					.($test['creatorid']==$_SESSION["id"] || user() == 9?
					'<a href="'.FILENAME.'?a=edit&id='.$test['id'].'" class="btn btn-info">Szerk.</a>
					<a href="'.FILENAME.'?a=del&id='.$test['id'].'" class="btn btn-info">Törlés</a>':'').
				'</td>'.
			'</tr>';
		}
		echo '</table>';

	} else if (($_GET['a']=='edit' || $_GET['a']=='new') && user()>=5) {


		$courses = query(sql('course:all'));

		// szerk|új
		if (isset($_GET['id'])) {
			$testinfo = query(sql('test:info', array('id'=>$_GET['id'])),'array')[0];
			$qaas = json_decode(q($testinfo['content']), JSON_OBJECT_AS_ARRAY);
		}
?>

		<center>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="width:500px"> 
            <div class="form-group">
                <label>Megnevezés</label>
                <input type="text" name="id" value="<?php echo $testinfo['id']; ?>" hidden>
                <input type="text" name="name" class="form-control" value="<?php echo $testinfo['name']; ?>">
            </div>
            <div class="form-group">
                <label>Kurzus</label>
                <select class="form-control" name="courseid">
                  <?php
                  	foreach ($courses as $course) {
                  		echo '<option value="'.$course['id'].'" '.($testinfo['courseid']==$course['id']?' selected':'').'>'.$course['name'].' ['.$course['id'].']</option>'."\n";
                  	}
                  ?>
                </select>
            </div>
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>Kérdések és válaszok</label>
                <?php
                	$qaas = (isset($qaas)?$qaas:[1=>null,2,3,4,5,6,7,8,9,10]); // JAVÍTANDÓ!!!!
                	foreach ($qaas as $key => $qaa) {
                		$i = $key;

                		echo '<div class="qb" style="text-align: center;">';
                		echo $i.'. <input type="text" name="content['.$i.'][q]" class="form-control" value="'.q($qaa['q']).'"><br>';
                		echo '<input type="radio" name="content['.$i.'][a]" value="1"'.($qaa['a']=='1'?' checked':'').'>';
                		echo '<input type="text" name="content['.$i.'][a1]" class="form-control" value="'.q($qaa['a1']).'">';
                		echo '<input type="radio" name="content['.$i.'][a]" value="2"'.($qaa['a']=='2'?' checked':'').'>';
                		echo '<input type="text" name="content['.$i.'][a2]" class="form-control" value="'.q($qaa['a2']).'"><br>';
                		echo '<input type="radio" name="content['.$i.'][a]" value="3"'.($qaa['a']=='3'?' checked':'').'>';
                		echo '<input type="text" name="content['.$i.'][a3]" class="form-control" value="'.q($qaa['a3']).'">';
                		echo '<input type="radio" name="content['.$i.'][a]" value="4"'.($qaa['a']=='4'?' checked':'').'>';
                		echo '<input type="text" name="content['.$i.'][a4]" class="form-control" value="'.q($qaa['a4']).'">';
                		echo '</div>';

                	}

                ?>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="action_<?php echo $_GET['a']; ?>" value="<?php echo ($_GET['a']=='edit'?'Mentés':'Létrehozás'); ?>">
                <a class="btn btn-link" href="<?php echo FILENAME; ?>">Mégse</a>
            </div>
        </form>
    	</center>

<?php
	} else if ($_GET['a']=='fill') {

		$testinfo = query(sql('test:info', array('id'=>$_GET['id'])),'array')[0];
		$courseinfo = query(sql('course:info', array('id'=>$testinfo['courseid'])),'array')[0]; // kurzus
		$classid = query(sql('user:classid'),'single'); // osztály
		$courseread = query(sql('course:readInfo', array('courseid'=>$testinfo['courseid'])))[0]; // hanyadik oldalnál jár?
		$testfillinfo = query(sql('test:fillInfo',array('testid'=>$_GET['id'])))[0]; // hanyadik oldalnál jár?

		// nem jogosult elolvasni --> átirányít a listára
		if ($courseinfo['classid'] != $classid && user()<5) {
			header("location: ".FILENAME); exit();
		// még nem töltheti ki --> kiírás, hogy még nem olvasta el a leckét
		} else if ($courseread['max'] != substr_count($courseinfo['content'],'<hr>')+1 && user()<5) {
			echo "Még nem olvastad végig a teszthez tartozó kurzust!";
		// 
		} else {

			$marKitoltve = isset($testfillinfo['id']) || user()>=5;

			if (isset($_GET['id'])) {
				$testinfo = query(sql('test:info', array('id'=>$_GET['id'])),'array')[0];
				$answers = json_decode(q($testfillinfo['answers']), JSON_OBJECT_AS_ARRAY); // felelt válaszok
				$qaas = json_decode(q($testinfo['content']), JSON_OBJECT_AS_ARRAY); // kérdés és helyes válasz
				$usersfilled = query(sql('test:filledInfo', array('testid'=>$_GET['id'])),'array');
			}

			// Számok...
			$qmax = 0; $good = 0;
			foreach ($qaas as $i => $qaa) {
				if (trim($qaa['q'])=='') { break; }
				$qmax++; $good += ($answers[$i]['a']==$qaas[$i]['a']?1:0);
			}

			echo '<h3>'.$testinfo['name'].'</h3><i>Kurzus: '.$testinfo['coursename'].'</i><br><br><br>';
			echo ($marKitoltve&&user()<5?'<b style="color:blue;">Már kitöltötted a tesztet. Eredményed:</b><br><br><span class="eredmeny">'.eredmeny($good, $qmax, true, true).'</span><br><br><br>':'');

        	if ($marKitoltve) {
        		echo '<center><form style="width:500px">';
        	} else {
        		echo '<center><form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post" style="width:500px">';
				echo '<input name="testid" value="'.$testinfo['id'].'" hidden>';
        	}

        	if (user()>=5) {

				echo '<style>td,th{border:1px solid #000;padding:6px;}</style>';
        		echo '<table><tr><th>Felhasználónév</th><th>Jegy</th><th>%</th><th>Pont</th><th>Műveletek</th></tr>';
        		foreach ($usersfilled as $key => $user) {

					// Számok...
					$_userAnsw = json_decode(q($user['answers']), JSON_OBJECT_AS_ARRAY);
					$_qmax = 0; $_good = 0;
					foreach ($qaas as $i => $qaa) {
						if (trim($qaa['q'])=='') { break; }
						$_qmax++; $_good += ($_userAnsw[$i]['a']==$qaas[$i]['a']?1:0);
					}

        			echo '<tr>';
        			echo '<td>'.$user['username'].'</td>';
        			echo '<td>'.eredmeny($_good, $_qmax, true, false, false, false).'</td>';
        			echo '<td>'.eredmeny($_good, $_qmax, false, true, false, false).'</td>';
        			echo '<td>'.eredmeny($_good, $_qmax, false, false, true, false).'</td>';
        			echo '<td><a data-id="'.$user['id'].'" href="#" class="btn btn-info">Megtekint</a></td>';
        			echo '</tr>';
        		}
        		echo '</table><br><br>';
        	}

        	foreach ($qaas as $key => $qaa) {
        		$i = $key;

        		if (trim($qaa['q'])=='') { break; }

        		$correct = $answers[$i]['a']==$qaas[$i]['a'];
        		$class = ($correct?'correct':'gooda');

        		echo '<center><div class="qb">';
        		echo '<span class="q">'.$i.'. '.$qaa['q'].'</span><br>';

        		for ($j=1; $j < 5; $j++) { 
	        		echo '<input id="q'.$i.'a'.$j.'" type="radio" name="answers['.$i.'][a]" value="'.$j.'"'.
	        			($marKitoltve?' class="'.
	        			  	($qaas[$i]['a']==$j?$class:
	        			  		($answers[$i]['a']==$j?' wrong':'')
	        			  	).'" disabled'.
	        			 	($answers[$i]['a']==$j?' checked':'')
	        			 	:''
	        			).'>';
	        		echo '<label class="a" for="q'.$i.'a'.$j.'">'.$qaa['a'.$j].'</label>'.($j==2?'<br>':'');
        		}

        		echo '</div></center>';

        	}

        	if ($marKitoltve&&user()<5) {
        		echo '<br><br><br><b style="color:blue;">Beküldve: '.$testfillinfo['date'].'</b><br><br><br>';
        	} else if (user()<5) {
        		echo '<br><br><br><input type="submit" class="btn btn-success" name="action_'.$_GET['a'].'" value="Teszt beküldése">';
        	}
        	
        	echo '</form></center>';

		}

	} else {
		header("location: ".FILENAME); exit();
	}

	// HTML lábléc
    html('footer');
?>