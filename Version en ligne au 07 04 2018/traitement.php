<?php
if(isset($_POST)){
	//on veut obtenir ça
	/*
	1) $stmt = $dbh->prepare ("INSERT INTO user (firstname, surname) VALUES (:fname, :sname)");
	2) $stmt -> bindParam(':fname', 'John');
	$stmt -> bindParam(':sname', 'Smith');
	$stmt -> execute();
	*/
	//nos 8 champs (j'ai horreur de la répétition)
	$fields=array('designation','num','client','quantite','prixht','dateFacture','facturede','conditions');

	//On vérifie si la variable existe et sinon elle vaut NULL
	foreach($fields as $field){
		$$field = isset($_POST[$field]) ? $_POST[$field] : NULL;
	}
	//on passe à 1)
	$sql='INSERT INTO facturation (';
	foreach($fields as $field){
		$sql.=$field.',';
	}
	$sql=substr($sql,0,-1);
	$sql.=') VALUES (';
	foreach($fields as $field){
		$sql.=':'.$field.',';
	}
	$sql=substr($sql,0,-1);
	$sql.=')';
	//INSERT INTO facturation (designation,num,client,quantite,prixht,dateFacture,facturede,conditions) VALUES (:designation,:num,:client,:quantite,:prixht,:dateFacture,:facturede,:conditions)
	//on passe à 2
	foreach($fields as $field){
		$stmt -> bindParam(':'.$field,${$field});
	}
	if($stmt -> execute()){
		echo 'insertion réussie !';
	}
	else{
		echo 'Ouch !';
	}
}
?>
