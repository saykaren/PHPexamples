<?php

if (isset($_POST['searchTerm'])) {
echo htmlspecialchars($_POST['searchTerm'], ENT_QUOTES);
}

?>

<form
action=""
method="post">
<input type="text" name="searchTerm">
<input type="submit" value="Search">
</form>

<!-- Don't trust user input
htmlspecialchars() to escape special characters <> " & (use ENT_QUOTES to escape ' too) -->