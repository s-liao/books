<?php

function open_books_database()
{
	try
	{
		$db = new PDO('sqlite:books.db');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		query_books($db);

	}
	catch (PDOException $e)
	{
		die($e->getMessage());
	}

	return $db;
}

function query_books($db)
{
	$MAX_LEN = 35;
	try
	{
		$query = "select b.id, b.title, b.isbn10 from Book b join Author a on a.book_id = b.id join Person p on p.id = a.person_id group by b.id order by b.title";
		//$query = "select b.title, b.isbn10, group_concat(p.last_name) from Book as b join Author as a on a.book_id = b.id join Person as p on p.id = a.person_id group by b.id";
		$result = $db->query($query);

		$rowarray = $result->fetchall(PDO::FETCH_ASSOC);
		$rowno = 0;

		foreach ($rowarray as $row)
		{
			$authors = find_book_authors($db, $row['b.id']);
			$authors_string = implode(", ", $authors);
			$authors_string = (strlen($authors_string) > $MAX_LEN - 3) ? substr($authors_string, 0, $MAX_LEN - 3)."..." : $authors_string;

			echo '<tr>';
			echo '<td>'.$row['b.title'].'</td>';
			echo '<td>'.$row['b.isbn10'].'</td>';
			echo '<td>'.$authors_string.'</td>';
			echo '</tr>';

			$rowno++;
		}
	}
	catch (PDOException $e)
	{
		die($e->getMessage());
	}

}

function find_book_authors($db, $book_id)
{
	$query = "select first_name, last_name from Person p join Author a on a.person_id = p.id join Book b on a.book_id = b.id where b.id = ".$book_id." order by last_name";

	$result = $db->query($query);

	$rowarray = $result->fetchall(PDO::FETCH_ASSOC);
	$rowno = 0;

	$authors = array();

	foreach ($rowarray as $row)
	{
		array_push($authors, $row['last_name']);
	}

	return $authors;
}

?>
