<?php
// PDO wrapper function
function runQuery($db, $query, $args = NULL) {

	// If it doesn't need an argument, execute the query
	if (!$args) {
			return $db->query($query);
	}

	// Prepare the statement
	$stmt = $db->prepare($query);
	$stmt->execute($args);

	// Return the prepared statement
	return $stmt;

} // End of pdo() function

// select function
function listAll($db, $table, $options = '') {
  $query = 'SELECT * FROM ' . $table . $options;

  $result = runQuery($db, $query);

  return $result;
}

function listByColumn($db, $table, $column, $options = '') {
  $query = 'SELECT ' . $column . ' FROM ' . $table . $options;

  $result = runQuery($db, $query);

  return $result;
}

// find data by id
function findById($db, $table, $primaryKey, $value, $options = '') {
	$query = 'SELECT * FROM ' . $table . ' WHERE ' . $primaryKey . '= :value ' . $options ;

	$parameters = [
		'value' => $value
	];

	$result = runQuery($db, $query, $parameters);

	return $result;
}

// find by field
function find($db, $table, $column, $value, $options = '') {
	$query = 'SELECT * FROM ' . $table . ' WHERE ' . $column . ' = :value ' . $options;

	$parameters = [
		'value' => $value
	];

	$result = runQuery($db, $query, $parameters);

	return $result;
}

// Process Date
function processDates($fields)
{
	foreach ($fields as $key => $value) {
		if ($value instanceof DateTime) {
			$fields[$key] = $value->format('Y-m-d');
		}
	}

	return $fields;
}

// insert into table
function insert($db, $table, $fields) {
	$query = 'INSERT INTO ' . $table . ' (';

	foreach ($fields as $key => $value) {
		$query .= $key . ',';
	}

	$query = rtrim($query, ',');

	$query .= ') VALUES (';

	foreach ($fields as $key => $value) {
		$query .= ':' . $key . ',';
	}

	$query = rtrim($query, ',');

	$query .= ')';

	$fields = processDates($fields);

	$result = runQuery($db, $query, $fields);

	return $result;
}

// update data
function update($db, $table, $fields, $primaryKey, $id, $options = '')
{
	$query = ' UPDATE `' . $table . '` SET ';

	foreach ($fields as $key => $value) {
		$query .= '`' . $key . '` = :' . $key . ',';
	}

	$query =rtrim($query, ',');

	$query .= ' WHERE `' . $primaryKey . '` = :primaryKey ' . $options;

	// Set the primaryKey variable
	$fields['primaryKey'] = $id;

	$fields = processDates($fields);

	$result = runQuery($db, $query, $fields);

	return $result;
}

// delete data
function delete($db, $table, $primaryKey, $id) {

	$query = 'DELETE FROM ' . $table . ' WHERE ' . $primaryKey . ' = :primaryKey';

	$fields = ['primaryKey' => $id];

	$result = runQuery($db, $query, $fields);

	return $result->rowCount();
}
