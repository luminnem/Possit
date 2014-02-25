function checkToSearch(e) {
	if (e.keyCode == 13) {
		search();
	}
}

function search() {
	var form = document.getElementById("searchForm");
	form.submit();
}