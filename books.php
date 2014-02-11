<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Stephen's Book Library</title>

		<link type="text/css" rel="stylesheet" href="books.css" />

		<?php
			require('books_database.php');
		?>
	</head>

	<body>
		<div id="allcontent">
		<h1 class="title">Welcome to Stephen's List of Books</h1>

		<div class="intro">
		<h2>Introduction</h2>

		<p>
			I'm using this site to hold a database of books that I have. The database is stored using SQLite and the website runs PHP to query the database.
		</p>
		</div>
			
		</p>

		<div class="book_list">
		<h2>Book List</h2>
		<p>
			<table>
			<tr>
			<th class="hdr">Title</th>
			<th class="hdr">ISBN</th>
			<th class="hdr">Authors</th>
			</tr>
			<?php
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

			$db = null;
			?>
			</table>
		</p>
		</div>
		<p class="bottom">
			<?php
			echo 'Current PHP version: ' . phpversion();
			?>
		</p>
		</div>
	</body>

</html>
