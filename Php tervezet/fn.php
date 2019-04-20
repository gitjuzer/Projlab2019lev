<?php


/**
* SQL lekérdezés összeállítása
*  name (str) = megnevezés
*  data (arr) = adatok a lekérdezéshez
*/
function sql($_name, $data=null) {

	switch ($_name) {

		// Felhasználó
		// user (id, username, password, created_at, permission)
		case 'user:permission': return "SELECT permission FROM user WHERE id = ".$_SESSION["id"]; break;
		case 'user:classid': return "SELECT classid FROM user WHERE id = ".$_SESSION["id"]; break;
		case 'user:info': return "SELECT id, username, permission, (SELECT name FROM user_class WHERE id = u.classid) as class, classid FROM user as u WHERE id = ".$data["id"]; break;
		case 'user:new': return "INSERT INTO user (username, password, permission, classid) VALUES ('".$data["username"]."', '".password_hash($data['password'], PASSWORD_DEFAULT)."', ".$data["permission"].", ".((int)$data["permission"]==1?$data["classid"]:'0').")"; break;
		case 'user:edit': return "UPDATE user SET username = '".$data["username"]."'".($data["id"]==$_SESSION["id"]?'':", permission = ".$data["permission"]).(trim($data["password"])==''?'':", password = '".password_hash($data['password'], PASSWORD_DEFAULT)."'").", classid = ".((int)$data["permission"]==1?$data["classid"]:'0')." WHERE id = ".$data["id"]; break;
		case 'user:delete': return ""; break;
		case 'user:all': return "SELECT id, username, created_at, permission, (SELECT name FROM user_class WHERE id = u.classid) as class, classid FROM user as u".$data['WHERE']; break;
		case 'user:classInfo': return "SELECT id, name FROM user_class WHERE id = ".$data["id"]; break;
		case 'user:classNew': return "INSERT INTO user_class (name) VALUES ('".$data['name']."')"; break;
		case 'user:classEdit': return "UPDATE user_class SET name = '".$data["name"]."' WHERE id = ".$data["id"]; break;
		case 'user:classDelete': return ""; break;
		case 'user:classAll': return "SELECT id, name FROM user_class"; break;
		case 'user:passNew': return "UPDATE user SET password = ? WHERE id = ?"; break; // mysqli_stmt_bind_param
		case 'user:login': return "SELECT id, username, password FROM user WHERE username = ?"; break; // mysqli_stmt_bind_param
		case 'user:nameCheck': return "SELECT id FROM user WHERE username = ?"; break; // mysqli_stmt_bind_param
		case 'user:newReg': return "INSERT INTO user (username, password) VALUES (?, ?)"; break; // mysqli_stmt_bind_param

		// Teszt
		// test (id, courseid, name, content)
		// test_solved (id, testid, userid, answers)
		case 'test:info':   return "SELECT id, courseid, name, content, (SELECT name FROM course WHERE id = t.courseid) as coursename FROM test as t WHERE id = ".$data["id"]; break;
		case 'test:new':    return "INSERT INTO test (name, content, courseid) VALUES ('".$data['name']."', '".json_encode($data['content'], JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES)."', ".$data['courseid'].")"; break;
		case 'test:edit':   return "UPDATE test SET name = '".$data["name"]."', content = '".json_encode($data['content'], JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES)."', courseid = ".$data['courseid']." WHERE id = ".$data["id"]; break;
		case 'test:delete': return ""; break;
		case 'test:all':    return "SELECT id, (SELECT name FROM course WHERE id = t.courseid) as course, courseid, (SELECT creatorid FROM course WHERE id = t.courseid) as creatorid, name, (SELECT IF(id>0,'true','false') FROM test_solved WHERE testid = t.id and userid = ".$_SESSION["id"].") as filled FROM test as t".(user()==5?" WHERE (SELECT creatorid FROM course WHERE id = t.courseid) = ".$_SESSION["id"]:'').(user()==1?" WHERE (SELECT classid FROM course WHERE id = t.courseid) = ".$data['classid']:''); break;
		case 'test:fillInfo':return "SELECT id, testid, userid, answers, date FROM test_solved WHERE testid = ".$data['testid']." and userid = ".$_SESSION["id"]; break;
		case 'test:fillNew':return "INSERT INTO test_solved (testid, userid, answers) VALUES (".$data['testid'].", ".$_SESSION["id"].", '".json_encode($data['answers'], JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES)."')"; break;
		case 'test:filledInfo':return "SELECT id, username, (SELECT answers FROM test_solved WHERE userid = u.id and testid = ".$data['testid'].") as answers FROM user as u WHERE (SELECT userid FROM test_solved WHERE userid = u.id and testid = ".$data['testid'].") = id"; break;

		// Kurzus
		// course (id, categoryid, creatorid, name, content)
		// course_category (id, name)
		// course_read (id, courseid, userid, last, max)
		case 'course:info': return "SELECT id, name, content, (SELECT name FROM course_category WHERE id = c.categoryid) as category, categoryid, creatorid, classid FROM course as c WHERE id = ".$data["id"]; break;
		case 'course:new': return "INSERT INTO course (name, content, categoryid, creatorid) VALUES ('".$data['name']."', '".$data['content']."', ".$data['categoryid'].", ".$data['creatorid'].", ".$data['classid'].")"; break;
		case 'course:edit': return "UPDATE course SET name = '".$data["name"]."', content = '".$data["content"]."', categoryid = ".$data["categoryid"].(user()==9?", creatorid=".$data["creatorid"]:'').", classid = ".$data["classid"]." WHERE id = ".$data["id"]; break;
		case 'course:delete': return ""; break;
		case 'course:all': return "SELECT id, (SELECT name FROM course_category WHERE id = c.categoryid) as category, categoryid, name, SUBSTRING(content,1, 32) as content, (SELECT name FROM user_class WHERE id = c.classid) as class, classid, creatorid FROM course as c".(user()==5?" WHERE creatorid = ".$_SESSION["id"]:'').(user()==1?" WHERE classid = ".$data["classid"]:''); break;
		case 'course:catInfo': return "SELECT id, name FROM course_category WHERE id = ".$data["id"]; break;
		case 'course:catNew': return "INSERT INTO course_category (name) VALUES ('".$data['name']."')"; break;
		case 'course:catEdit': return "UPDATE course_category SET name = '".$data["name"]."' WHERE id = ".$data["id"]; break;
		case 'course:catDelete': return ""; break;
		case 'course:catAll': return "SELECT id, name FROM course_category"; break;
		case 'course:readInfo': return "SELECT id, courseid, userid, last, max FROM course_read WHERE courseid = ".$data['courseid']." and userid = ".$_SESSION["id"]; break;
		case 'course:readNew': return "INSERT INTO course_read (courseid, userid, last, max) VALUES (".$data['courseid'].", ".$data['userid'].", ".$data['last'].", ".$data['max'].")"; break;
		case 'course:readEdit': return "UPDATE course_read SET last = ".$data["last"].", max = ".$data["max"]." WHERE id = ".$data["id"]; break;

		// Def
		default: return ''; break;
	}

}

/**
* SQL lekérdezés
*  sql (str)    = SQL lekérdezés
*  resmod (str) = találatok visszatérésének módja
*/
function query($_sql, $_resmod=null) {
	global $link;

	/* check connection */
	if ($link->connect_errno) {
	    printf("Connect failed: %s\n", $link->connect_error);
	    exit();
	}

	$singl = helper_sqlsinglerow($_sql);

	switch ($_resmod) {
		case 'single': $res = null;    break;
		case 'array':  $res = array(); break;
		default:       $res = array(); break;
	}

	// miért kel még mindig... ???
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if ($result = $link->query($_sql)) {

	    /* fetch associative array */
	    if (preg_match('/^SELECT/msi', $_sql)) {
	    while ($row = $result->fetch_assoc()) {
	        //printf ("%s (%s)\n", $row["Name"], $row["CountryCode"]);
	        //print_r($row);
			switch ($_resmod) {
				case 'single': $res = $row[$singl]; break;
				case 'array':  $res[] = $row; break;
				default:       $res[] = $row; break;
			}
	        
	    }


	    /* free result set */
	    $result->free();
		}
	}

	/* close connection */
	$link->close();	

	return $res;
}

/**
* Felhasználó
*  forcePerm (int) = jogosultság száma
* # Ha forcePerm==null, akkor: vissza adja a jogosultság számát
* # Ha forcePerm==szám, akkor: ha belépett felhasználó jogosultsága...
*    ... ua. mint a forcePerm, akkor true
*    ... nem ua. mint a forcePerm, akkor átirányítás az index.php-ra
*/
function user($_forcePerm=null) {

	global $link;

	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    	header("location: login.php"); exit;
	} else {
		// sql lekérdezés (1=diák;5=tanár;9=admin,0=felhasználó)
		$userPerm = query(sql('user:permission'), 'single');

				// konkrét jogosultság vagy csak lekérdezés
		if ($_forcePerm===null) {
			return (int)$userPerm;
		} else {
			if ($userPerm>=$_forcePerm) {
				return true;
			} else {
				header("location: index.php"); exit;
			}
		}


		
	}

}

/**
* SQL lekérdezés első megadott oszlop neve
*  sql (str) = SQL lekérdezés
* # az első megadott oszlop nevével tér vissza
* # pl.: SELECT oszlop1, oszlop2, oszlop3 FROM... >> oszlop1
*/
function helper_sqlsinglerow($_sql) {
	return preg_replace('/^.*?SELECT[\s]{1,}([a-zA-Z0-9_-]{1,})(?:,|[\s]{1,}).*?$/m', '$1', $_sql);
}

/**
* HTML kód
*/
function html($_part, $data=null) {

	switch ($_part) {

		// Fejléc
		case 'header': echoNoTab('
			<!DOCTYPE html>
			<html lang="en">
			<head>
			    <meta charset="UTF-8">
			    <title>'.(is_array($data['title'])?$data['title'][0]:$data['title']).'</title>
			    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
			    '.(isset($data['style'])?'<style type="text/css">'.$data['style'].'</style>':'').'
			</head>
			<body>
			    '.($data['wrapper']?'<div class="wrapper">':'').'
			    <h2>'.(is_array($data['title'])?$data['title'][1]:$data['title']).'</h2>
		'); break;

		// Lábléc
		case 'footer': echoNoTab('
			    '.($data['wrapper']?'</div>':'').'
			</body>
			</html>
		'); break;
		
		// Egyik se...
		default: return ''; break;
	}

}

/**
* ECHO, tabulátorok nélkül
*/
function echoNoTab($_) {
	echo preg_replace('/\t/msi', '', $_);
}


function eredmeny($point, $max, $grade=false, $percent=false, $points=true, $pretext=true) {

	// százalék
	$P = 100 * $point / $max;

	// érdemjegy
	     if (  0 <= $P&&$P <=  39 ) { $G = 1; }
	else if ( 40 <= $P&&$P <=  54 ) { $G = 2; }
	else if ( 55 <= $P&&$P <=  74 ) { $G = 3; }
	else if ( 75 <= $P&&$P <=  89 ) { $G = 4; }
	else if ( 90 <= $P&&$P <= 100 ) { $G = 5; }

	// return
	return 
		($pretext?($grade?'Érdemjegy: ':''):'').($grade?$G:'').
		($pretext?(!$grade&&$percent?'Százalék: ':'').($grade&&$percent?' (':''):'').
		($percent?$P.'%':'').
		($pretext?($grade&&$percent?')':''):'').
		($points?($pretext?($grade||$percent?' &bull; ':'').'Pont: ':'').$point.'/'.$max:'')
	;

}

function q($text) {
	return preg_replace('/(u0022)/msi', '&quot;', $text);
}

?>