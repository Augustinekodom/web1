<?php
//most functions in here were taken from lecture slides provided by my lecturer 

//print to console fuction used to test
function printToConsole($data) {
    $print = $data;
    if (is_array($print))
        $print = implode(',', $print);

    echo "<script>console.log('Debug Objects: " . $print . "' );</script>";
}

//UPDATE
function update($pdo, $table, $record, $primaryKey) {
	$query = 'UPDATE ' . $table . ' SET ';
	$parameters = [];

	foreach ($record as $key => $value) {
		$parameters[] = $key . ' = :' .$key;
	}

	$query .= implode(', ', $parameters);
	$query .= ' WHERE ' . $primaryKey . ' = :primaryKey';
	$record['primaryKey'] = $record[$primaryKey];
	
	$stmt = $pdo->prepare($query);
	$stmt->execute($record);
}


//SELECT WHERE
function find($pdo, $table, $field, $value) {
	$stmt = $pdo->prepare('SELECT * FROM ' . $table . ' WHERE ' . $field . ' = :value');

	$criteria = [
		'value' => $value
	];
	$stmt->execute($criteria);

	return $stmt->fetchAll();
}



//INSERT
function insert($pdo, $table, $record) {
        $keys = array_keys($record);

        $values = implode(', ', $keys);
        $valuesWithColon = implode(', :', $keys);

        $query = 'INSERT INTO ' . $table . ' (' . $values . ') VALUES (:' . $valuesWithColon . ')';

        $stmt = $pdo->prepare($query);

        $stmt->execute($record);
}

//DELETE
function delete($pdo, $table, $id) {
	$stmt = $pdo->prepare('DELETE FROM ' . $table . ' WHERE id = :id');
	$criteria = [
		'id' => $id
	];
	$stmt->execute($criteria);
}

//SELECT ALL
function findAll($pdo, $table) {
	$stmt = $pdo->prepare('SELECT * FROM ' . $table);

	$stmt->execute();

	return $stmt->fetchAll();
}