<?
//SQLite Database test query
$count=0;
$db=sqlite_open("foo.db");
@sqlite_query($db,"CREATE TABLE foo (text varchar(10))",$sqliteerror);
sqlite_query($db, "INSERT INTO foo VALUES ('Hello')",$sqliteerror); 
sqlite_query($db, "INSERT INTO foo VALUES ('World')",$sqliteerror); 
$result=sqlite_query($db,"SELECT * from foo");
$count=sqlite_single_query($db,"SELECT count(text) from foo");
while($row=sqlite_fetch_array($result))
{
   print_r($row);
   echo "<br>";
}
sqlite_close($db);
echo "There are $count record(s) in the database<br>";
?>