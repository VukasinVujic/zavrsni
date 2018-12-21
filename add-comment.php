
<form action ='create-comment.php' method="post" name="forma" class ='add_content_wrapper'onsubmit="return proveraUnetihPodataka(['ime', 'komentar'], 'forma')">

	<input hidden  name='post_neki_id' value=" <?php  echo $_GET['post_id']; echo $_POST['id']; ?>" >

    <input  class="form_field name" type="text" name="ime" placeholder="Upisite vase ime">
    <input  class="form_field comment_txt" type='text' name='komentar'placeholder="Upisite komentar" name="komentar">>
    <input id="js_add_comment" class="btn btn-outline-primary" type="submit" name="submit" value="Dodaj komentar">

</form>


<script>
function proveraUnetihPodataka(aaa, forma) { 
	let validateFalse = [];
	aaa.forEach(polje => {
		let newpolje = document.forms[forma][polje].value;
	    if (newpolje == "" || newpolje == null || newpolje == 'undefined') {
	    	validateFalse.push(polje);
	    
	    }
	});

	if (validateFalse.length) {
		alert("Polje " + validateFalse[0] + " je obavezno!");

		return false;
	}

    return true;
};
</script>